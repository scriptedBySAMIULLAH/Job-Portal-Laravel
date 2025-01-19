<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
</head>

<body class="bg-[radial-gradient(ellipse_at_bottom_right,_var(--tw-gradient-stops))] from-indigo-200 via-slate-600 to-indigo-200 font-body">
    @if(session('success'))
    <div class="flex justify-center items-center text-base">
        <p class="text-green-500 text-bold italic" id="myMsg">{{ session('success'). '😎' }}</p>
    </div> @endif
    @if(session('errors'))
    <div class="flex justify-center items-center fixed bottom-0 right-0 bg-black">
        <p class="text-red-600 text-lg font-bold italic" id="myMsg">{{ session('errors'). '😒' }}</p>
    </div> 
    @elseif (!session('errors'))
    <div class=" hidden  justify-center items-center fixed bottom-0 right-0 bg-black">
        <p class="text-red-600 text-lg font-bold italic" id="myMsg">{{ session('errors'). '😒' }}</p>
    </div> 
    @endif


    <div class="px-4 grid   items-center justify-center  shadow-lg h-screen  ">
        <div class="w-full max-w-[660px]  grid  grid-cols-1  sm:grid-cols-2 items-centerborder-purple-400 justify-center     rounded-lg shadow-lg h-[450px]  border border-black ">

            <img src="{{asset('pexels-alexislozano-12947260.jpg')}}" alt="" srcset="" class="rounded-lg  object-cover h-[450px] w-[400px] hidden sm:block hover:animate-pulse">
            <div class="flex flex-1 flex-col justify-center items-center sm:space-y-4">
                <p class="font-bold text-center text-xl">Job<span class=" text-2xl font-bold">Shop🍒</span></p>
                <form class=" flex flex-col items-center space-y-6 justify-center px-4" method="post" action="{{route('processForgotPasswordform')}}">
                    @csrf
                    <div class="w-full space-y-4">
                        <label for="email" class="font-bold">Email</label>
                        <input type="email" name="email" id="email" class="w-full px-4 py-2  rounded ring  ring-offset-fuchsia-700 outline-none">
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