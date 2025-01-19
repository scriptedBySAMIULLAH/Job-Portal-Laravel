<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Settings</title>

    @vite('resources/css/app.css')

</head>

<body class="bg-slate-100 font-body">

  
 <!-- for the settings page -->

 <div id="settings" class="bg-gray-200 py-4 sm:py-6 ">
 <a href="javascript:history.back()" class="text-blue-800 font-Roboto font-bold"><-Back</a>
          <p class="text-center heading ">Settings</p>
        
          <!-- user picture -->
<br>
          <div class=" hover:bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-gray-100 to-gray-300 opacity-100 max-w-xl border border-x-4 mx-auto space-y-6 py-4 sm:py-6 px-4  sm:px-6 bg-white border-y-black border-y-4">

            <div class="flex justify-center  items-center gap-4">
              
          <img src="{{asset('storage/'.$jobseekerPicture)}}" class=" w-16 h-16  sm:w-24 sm:h-24 rounded-full sm:rounded-lg" alt="" srcset="">
          <p>{{auth()->user()->name}}</p>
        </div>
         

            <form action="{{route('jobseekerUpdateProfile')}}" method="post"  enctype="multipart/form-data" class="space-y-6 flex sm:items-center sm:flex-col flex-wrap pr-2 pl-0 flex-1" >

            @csrf
            <input type="hidden" name="role" value="jobseeker">

              <div class=" flex gap-2 sm:gap-4 sm:w-full items-center">
              <label for="name" >Name</label>

              <input type="text"  id="name" name="name" class="sm:w-full py-2 rounded-lg ring-2 ring-green-400 outline-none" value="{{auth()->user()->name}}">
            </div>
            @error('name')
        <p class="text-red-400 font-semibold"> {{$message}}</p>
        @enderror
            <div class=" flex gap-2 sm:gap-4 sm:w-full items-center "> <label for="Email">Email</label>
              <input type="Email"  id="Email" name="email" class="sm:w-full py-2 rounded-lg ring-2 ring-green-400 outline-none" value="{{auth()->user()->email}}">
              @error('email')
        <p class="text-red-400 font-semibold"> {{$message}}</p>
        @enderror
            
            </div>
             


              <div class=" flex gap- sm:gap-4 sm:w-full items-center ">
              <label for="password text-sm">Pass</label>
              <input type="password"  id="password" name="password" class="sm:w-full py-2 rounded-lg ring-2 ring-green-400 outline-none"  placeholder="********">
              <small class="text-gray-400">Leave blank if you dont want to update password!</small>
              @error('password')
        <p class="text-red-400 font-semibold"> {{$message}}</p>
        @enderror
            </div>

            <div class=" flex gap-2 sm:gap-4 sm:w-full items-center">
              <label for="ProfilePic">ProfilePic</label>
              <input type="file"  id="ProfilePic" name="picture" class="sm:w-full py-2 rounded-lg  outline-none">
              @error('picture')
        <p class="text-red-400 font-semibold"> {{$message}}</p>
        @enderror
            </div>

            <div class=" flex gap-2 sm:gap-4 sm:w-full items-center  ">
              <label for="CV">CV</label>
              <input type="file"  id="CV" name="cv" class="sm:w-full py-2 rounded-lg  outline-none ">  
            </div>
            @error('cv')
        <p class="text-red-400 font-semibold"> {{$message}}</p>
        @enderror

            <div class="flex justify-around"> <button type="submit" class="button ">Save Changes</button>

</div>
            </form>

          </div>
         </div>


</body>

@if (session('ProfileUpdated'))
  <script>
    Swal.fire('Profile Updated SuccessFully');
  </script>
  @endif

</html>