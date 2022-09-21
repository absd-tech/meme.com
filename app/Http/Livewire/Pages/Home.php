<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Livewire\WithFileUploads;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Notification;

class Home extends Component
{  
    use WithFileUploads;
    public $image;
    public $body;
    public $user;
    public $postId;
    public $hasLike;
    public $writeComment;
    public $comment;
    public $photo;
    public $current;


    

    
  //Method for posting meme
  protected $rules = [
    'photo'=>'image|max:1999'
  ];

  public function updated($photo){
    $this->validateOnly($photo);

  }
    public function posted(){
        
        if($this->body == "" && $this->image == ""){
            session()->flash('error','Please put something!');
            return;
        }

        else{
            $id = Auth::id();
            $this->user = User::where('id',$id)->first();
            //Check if image or body or both are entered
            if($this->body != "" && $this->image != ""){
                //Validate image      
                $picha = $this->photo->getClientOriginalName();
                $path = $this->photo->storeAs('public/posts',$picha);
            
                $postId = Post::create([
                    'body'=>$this->body,
                    'image'=>$picha,
                    'user_id'=>$id

                ]);

                Like::create([
                    'post_id'=> $postId->id

                ]);
                 $this->body = "";
                 $this->photo = "";
                session()->flash('success','Meme is successfuly posted');
                return;

            }

            if($this->body != "" && $this->image == ""){
                //body imewekwa
                
                $postId = Post::create([
                    'body'=>$this->body,
                    'user_id'=>$id

                ]);

                Like::create([
                    'post_id'=> $postId->id

                ]);
                 $this->body = "";
                session()->flash('success','Meme is successfuly posted');
                return;


            }

            if($this->body == "" && $this->image != ""){
                //picha imewekwa
                $picha = $this->photo->getClientOriginalName();
                $path = $this->photo->storeAs('public/posts',$picha);
                $postId = Post::create([
                    'image'=>$picha,
                    'user_id'=>$id

                ]);

                Like::create([
                    'post_id'=> $postId->id

                ]);
                 $this->photo = "";
                session()->flash('success','Meme is successfuly posted');
                return;


            }
        }
    }

    //Starting of listening image uploaded
    protected $listeners = [
        
              'like' => 'liked',
              'imageUpload'=>'fileUpload',
              'comment'=>'createComment',
              'notificationDeletion'=>'deleteNotify'
    ];

    //notification deletion
    public function deleteNotify($id){
        //delete notification with above id
        $notification = Notification::where('id',$id)->first();
        $notification->delete();

    }

    public function fileUpload($image){
        $this->image = $image;
    }

    //Finishing of listening image uploaded

    //Create Comments
    public function createComment($postId){
        $this->writeComment = $postId;

    }

    public function commenting(){
        if($this->comment == ""){
            return;
        }

        else{
            $id = Auth::id();
            $user = User::where('id',$id)->first();
            Comment::create([
                'body'=>$this->comment,
                'post_id'=>$this->writeComment,
                'commenter_name'=>$user->name,     
            ]);

            $postOwner = Post::where('id',$this->writeComment)->first();
            $postOwner = $postOwner->user_id;

            //create a notification
            Notification::create([
                'body'=>'Commented on your post',
                'someone'=>$user->name,
                'user_id'=>$postOwner,
                'post_id'=>$this->writeComment
            ]);

            $this->writeComment = "";
            $this->comment ="";

        }
        
    }
    //End of creating comment


    //Statrting listening liked event
    
    public function liked($id){
        $this->postId = $id;
        //lets get like id
        $likeId = Like::where('post_id',$id)->first();

        //Lets get user id
        $userId = Auth::id();
        
        $hasLike = $likeId->user()->where('user_id',$userId)->exists();
       
        
        if($hasLike){
            //Already liked the post

            //detach that user id
            $likeId->user()->detach($userId);

            //update number of likes(love)
            $love = $likeId->love - 1;
            Like::where('id',$likeId->id)->update([
                'love'=>$love
            ]);

        }

        else{
            //Not yet liked the post

            //Attach user id
            $likeId->user()->attach($userId);

            //update number of likes(love)
            $love = $likeId->love + 1;
            Like::where('id',$likeId->id)->update([
                'love'=>$love
            ]);
            
        }
       
    }
     
    //Finishing listening liked event

    
    //Starting of Logout method
    public function logout(){
        return redirect()->to('logout');
    }
    //Ending of Logout method

   

    public function render()
    { 
       $this->current = Auth::id();
       $notify = User::where('id',$this->current)->first();
       $notify = $notify->name;
        
        return view('livewire.pages.home',[
            'posts'=>Post::orderBy('created_at','desc')->get(),
            'notifications'=>Notification::where('user_id',$this->current)->where('someone','!=',$notify)->orderBy('created_at','desc')->get(),
            'totalNotifications'=>Notification::where('user_id',$this->current)->where('someone','!=',$notify)->count(),

        ]);
              
    }
}
