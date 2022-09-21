<div><!-- All content div -->
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
                <li class="font-bold hidden"></li>
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
    
</div><!-- end of content div -->
