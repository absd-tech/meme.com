<div>
     
<section class="pt-4 pb-8 font-meme"><!-- Main section -->
    <div class="pt-2 pb-8 mb-4"><!-- All content div -->
        <div class="flex justify-between shadow-md border-2 mb-4 py-6 px-4" id="header"><!-- Header div -->
            <img src="{{asset('images/laugh_icon.jfif')}}" alt="" class="object-cover w-10 h-6">

          <div> 
            <div class="cursor-pointer md:hidden" id="burger" onclick="reponsiveNavbar()">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>   
            </div>
            <div class="mx-4 font-meme relative hidden md:block" id="nav">
                <ul class="md:flex gap-10 cursor-pointer">
                    <li class="text-blue-600 font-bold">Home</li>
                    <li class="cursor-pointer hover:text-gray-400 font-bold" onclick="createForm()" id="create">Create Post</li>
                    <li class="font-bold"></li>
                    <li onclick="notification()" class="font-bold relative">Notification
                      <span class="absolute bottom-2 text-blue-400">{{$totalNotifications}}</span>
                    
                    </li>
                    
                    <div class="w-full max-w-xs border-1  hidden md:mt-8" id="notify">
                      @if($notifications != "")
                      @foreach ($notifications as $notification)
                      <a href="#{{$notification->post_id}}" wire:click="$emit('deleteNotification',{{$notification->id}})"><p class="bg-gray-400 px-4 py-2 mb-2">{{$notification->someone}} {{$notification->body}}</p> </a>
                        
                      @endforeach
                       
                      @else
                       <p class="">No any Notification!</p> 
                         
                      @endif 
                    </div>     
                    <li wire:click="logout" class="font-bold">Logout</li>
                </ul>
                

                <div class="absolute left-20 top-8" id="form"><!-- Child div -->
                    <div class="w-96 max-w-xs border-2 px-4 py-2 bg-gray-400"><!-- Create Post -->
                        <form class="">
                          <div class="mb-2">
                            <label class="block text-gray-700  font-bold mb-2 font-meme text-sm">
                              Your Post
                            </label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline font-meme" type="text" placeholder="Write your meme" cols="30" rows="10" wire:model="body">
                            </textarea>  
                          </div>

                          <div class="mb-4">
                            <input type="file" wire:change="$emit('fileUpload')" class="cursor-pointer" id="image" wire:model="photo">   
                            @error('photo')
                              <span class="text-red-600">{{$message}}</span>
                            @enderror 
                            
                            @if ($image!= "")
                             <img src="{{$image}}" alt="">    
                            @endif
                            
                          </div>

                          @if (session()->has('error'))
                          <span class="text-red-600 mb-2">{{session('error')}}</span>
                             
                         @endif
                          
        
                          <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline font-meme" type="button" wire:click="posted">
                              Post
                            </button>
                            
                          </div>

                        </form>
                        
                      </div><!-- End of Creating post -->

                </div><!-- End of child div -->
            </div>
                 
          </div>
        </div><!-- End of Header div -->
        @if (session()->has('success'))
         <p class="text-green-600 font-meme text-center mb-3">{{session('success')}}</p>    
        @endif

       <div>
        @foreach ($posts as $post)
        
        <div class="mx-2 md:mx-64 border-2 font-meme rounded-md shadow-md" wire:key="{{$post->id}}" id="{{$post->id}}"><!-- Posts -->
            
            <div class=" flex justify-start py-6 px-4"><!-- post header -->
              <div class="flex gap-8">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-6 inline-block">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
  
                    <div>
                     
                      <p class="text-blue-400">{{$post->user->name}}</p>
                              
                      <small>{{$post->created_at->diffForHumans()}}</small>
  
                    </div>
              </div>

          </div> <!-- end of post header -->

          <div class="py-6 px-4"><!-- Post Body -->
              <p>
                  {{$post->body}}
              </p> <br><br>

              <div>
                  <img src="{{asset("storage/posts/$post->image")}}" alt="" class="w-full object-cover">
              </div>

              <div class="flex justify-around my-3">
                  <div class=""><!-- Like -->             
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block cursor-pointer" wire:click="$emit('liked',{{$post->id}})">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                      </svg>
                      <span>{{$post->like->love}}</p>
                          
                  </div><!-- Like -->

                    <div>
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block relative cursor-pointer" wire:click="$emit('showComments',{{$post->id}})">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                      </svg>
                      
                      
                      
                    
                      <!-- Comments -->
                      <div class="" id="comments"><!--comments section -->
                        
                        @if (count($post->comments) == 0) 
                        <div class="shadow-md border-2 px-3 py-2 flex gap-10">
                          <span>No comment was added!</span>
                          <span class="text-2xl cursor-pointer font-bold hover:text-blue-600" wire:click="$emit('createComment',{{$post->id}})">+</span>
                          @if ($writeComment == $post->id)
                          <div class="w-full max-w-xs border-2 px-4 py-2 bg-gray-400 absolute" id="commentForm"><!-- Create Comment -->
                            <form class="">
                              
                              <div class="mb-2">
                                <div class="flex justify-between">
                                  <label class="block text-gray-700  font-bold mb-2 font-meme text-sm">
                                    Your Comment
                                  </label>
                                  <span class="text-right text-red-600 cursor-pointer" onclick="remove()">x</span>
                                </div>
                                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline font-meme" type="text" placeholder="Write your meme" cols="30" rows="4" wire:model="comment">
                                </textarea>  
                              </div>
                              <div class="flex items-center justify-between">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline font-meme" type="button" wire:click="commenting">
                                  Comment
                                </button>
                                
                              </div>
    
                            </form>
                            
                          </div><!-- End of Creating Comment -->
                            
                          @endif
                               
                        </div>
  
                        @else
                        <div class="shadow-md border-2 px-3 py-2 text-sm h-60 overflow-scroll w-60">
                          <div>
                          <p class="text-2xl cursor-pointer font-bold hover:text-blue-600 text-righ relative" wire:click="$emit('createComment',{{$post->id}})">+</p>
                          @if ($writeComment == $post->id)
                          <div class="w-full max-w-xs border-2 px-4 py-2 bg-gray-400 absolute" id="commentForm"><!-- Create Comment -->
                            <form class="">
                              
                              <div class="mb-2">
                                <div class="flex justify-between">
                                  <label class="block text-gray-700  font-bold mb-2 font-meme text-sm">
                                    Your Comment
                                  </label>
                                  <span class="text-right text-red-600 cursor-pointer" onclick="remove()">x</span>
                                </div>
                                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline font-meme" type="text" placeholder="Write your meme" cols="30" rows="4" wire:model="comment">
                                </textarea>  
                                
                              </div>
                              <div class="flex items-center justify-between">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline font-meme" type="button" wire:click="commenting">
                                  Comment
                                </button>
                                
                              </div>
    
                            </form>
                            
                          </div><!-- End of Creating Comment -->
                            
                          @endif
                          </div>
                         
                          <div>
                            @foreach ($post->comments as $comment)
                            <div wire:key="{{$comment->id}}" class="bg-gray-200 px-3 py-2 my-2 rounded shadow-md">
                              <span class="my-2 text-blue-400">{{$comment->commenter_name}}</span>
                            
                             <p class="my-2">{{$comment->body}}</p>
                              
                            </div>
                               
                            @endforeach    
                          </div>
                          
                        </div>
                                  
                              
                        @endif
                       

                      </div> <!-- end of comments section -->  
                      
                      <!-- Comments -->
                       
                    </div>
                             
              </div>

          </div><!-- end of Post Body -->

              
            
            
        </div><!-- End of posts -->  <br>
        @endforeach
      

<script>
   function createForm(){
        
        var form = document.getElementById('form');
        if(form.classList.contains('hidden')){
            form.classList.remove('hidden')
        }

        else{
            form.classList.add('hidden');
        }     
    }

    function notification(){
      var notify = document.getElementById('notify');
      if(notify.classList.contains('hidden')){
        notify.classList.remove('hidden')
      }

      else{
        notify.classList.add('hidden');
      }
    }

    function reponsiveNavbar(){
      var navBar = document.getElementById('nav');
      var header = document.getElementById('header');
      if(navBar.classList.contains('hidden')){
        navBar.classList.remove('hidden');
        header.classList.remove('justify-between');
        //header.classList.add('start');
        
      }

      else{
        navBar.classList.add('hidden');
        header.classList.add('justify-between');
      }
    }

   
   //deleteNotification
   livewire.on('deleteNotification',(notificationId)=>{
    livewire.emit('notificationDeletion',notificationId);

   });
   

    //Like
    Livewire.on('liked',(id)=>{
      var postId = id;
      
      //Emit event
      livewire.emit('like',postId);

    });

    //imageUpload
    livewire.on('fileUpload',()=>{
      //Get the file
      let fileInput = document.getElementById('image');

      let file = fileInput.files[0];

      let reader = new FileReader();

      reader.readAsDataURL(file);

      reader.onloadend = ()=>{
        livewire.emit('imageUpload',reader.result);

      }


    });

    //showComment
    

    livewire.on('showComments',(postId)=>{
       let mitambo = document.getElementById('comments');
       
       if(mitambo.classList.contains('hidden')){
        mitambo.classList.remove('hidden');
        console.log('nimetoa');
       }

       else{
         mitambo.classList.add('hidden');
         console.log('nimeweka');
       }
       
    });

    livewire.on('createComment',(postId)=>{
      
     livewire.emit('comment',postId);
      

    });

  function remove(){
    let remove = document.getElementById('commentForm');
    remove.classList.add('hidden');
  }
      

     

      
      
     
    

</script>
</div>
</div><!-- End of All content div -->
</section><!-- End of main section -->
</div>