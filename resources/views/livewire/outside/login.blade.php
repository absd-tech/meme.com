    <section class="flex justify-center pt-12"><!-- Main Section -->

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 border-2"><!--All Content div -->
          @if (session()->has('success'))
          <span class="font-meme text-green-600 font-bold text-lg">{{session('success')}}</span>
            
          @endif
            <div class="text-center mb-4"><!-- Header section -->
                <img src="{{asset('images/laugh_icon.jfif')}}" alt="" class="object-cover w-28 h-32 flex mx-32">
                <h3 class="font-meme font-bold text-7xl">meme</h3>

            </div><!--End of header Section -->

            <div class="w-full max-w-xs"><!-- Login Form -->
                <form class="">
                  <div class="mb-4">
                    <label class="block text-gray-700  font-bold mb-2 font-meme text-sm" for="username">
                      Username
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline font-meme" id="username" type="text" placeholder="Username" wire:model="name">
                    @error('name')
                    <span class="text-red-600 font-meme">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2 font-meme" for="password">
                      Password
                    </label>
                    <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline font-meme" id="password" type="password" placeholder="******************" wire:model="password">

                    @error('password')
                    <span class="text-red-600 font-meme">{{$message}}</span>
                    @enderror

                    @if (session()->has('error'))
                    <span class="text-red-600 font-meme">{{session('error')}}</span>  
                    @endif
                
                  </div>
                  <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline font-meme" type="button" wire:click="login">
                      Log In
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 font-meme" href="{{url('register')}}">
                       Don't have Account ? <br> Register
                    </a>
                  </div>
                </form>
                
              </div><!-- End of login form -->
              



        </div><!-- End of All Content div -->

    </section><!-- End of Main Section -->
 
