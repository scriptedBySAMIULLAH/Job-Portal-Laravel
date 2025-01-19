<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
</head>

<body class="bg-[conic-gradient(at_bottom_left,_var(--tw-gradient-stops))] from-fuchsia-300 via-green-400 to-rose-700">
    @if(session('success'))
    <div class="flex justify-center items-center text-base">
        <p class="text-green-500 text-bold italic" id="myMsg">{{ session('success'). '😎' }}</p>
    </div> @endif
  


    <div class="px-4 grid   items-center justify-center  shadow-lg h-screen">
        <div class="w-full max-w-[660px]  grid  grid-cols-1  sm:grid-cols-2 items-centerborder-purple-400 justify-center     rounded-lg shadow-lg h-[450px]  border border-black ">

            <img src="{{asset('pexels-n-voitkevich-4772846.jpg')}}" alt="" srcset="" class="rounded-lg overflow-hidden object-cover h-[450px] w-[400px] hidden sm:block hover:animate-pulse">
            <div class="flex flex-1 flex-col justify-center items-center  border border-black  sm:space-y-4">
                <p class="font-bold text-center text-xl">Job<span class=" text-2xl font-bold">Shop🍒</span></p>
                <form class=" flex flex-col items-center space-y-6 justify-center   px-4" method="post" action="{{route('ResetPassword')}}">
                    @csrf

                    <input type="hidden" name="userEmail" value="{{$userEmail}}">
                    <div class="w-full space-y-4">
                        <label for="email" class="font-bold">New Password <span class="text-indigo-700">*</span></label>
                        <input type="Password" name="newpassword" id="email" class="w-full px-4 py-2  rounded ring  ring-offset-fuchsia-700 outline-none">
                        @error('newpassword')
                        <p class="text-red-600 text-base font-bold italic" id="myMsg">{{$message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-green-400 px-2 py-2 rounded bg-transparent border border-black  hover:text-gray-700 font-bold">Go</button>

                </form>
                <div class="flex gap-2 justify-center items-center">
                    <p class="text-center font-medium">Want to Login?</p><a href="{{route('login')}}" class="text-blue-800 hover:underline text-center">Login Now!</a>

                </div>
            </div>

        </div>
    </div>
</body>
<!-- script for removing congrts msg -->
<script>
    const myMsg = document.getElementById('myMsg');


    if (myMsg.innerHTML !== ' ') {
        setTimeout(() => {

            myMsg.style.display = 'none';
        }, 8000);
    }
</script>

<script>
    window.onload = function() {
        var emailField = document.getElementById('email');
        var passwordField = document.getElementById('password');

        // Check if the fields are autofilled
        if (emailField.value !== '' || passwordField.value !== '') {
            // If autofilled, clear the fields
            emailField.value = '';
            passwordField.value = '';
        }
    }
</script>

</html>