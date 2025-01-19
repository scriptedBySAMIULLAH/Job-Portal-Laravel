<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
</head>

<body class="bg-slate-100">
    
    @if(session('success'))
    <div class="flex items-center text-white   justify-center flex-col border bg-green-500">
        <p class="text-white font-bold italic  border border-black" id="myMsg">{{ session('success'). '😎' }}</p>
    </div> @endif
    @if(session('errors'))
    <div class="flex justify-center items-center">
        <p class="flex items-center justify-center flex-col border bg-red-500 font-bold" id="myMsg">{{ session('errors'). '😒' }}</p>
    </div> @endif
@include('navbar')

    <div class="px-4 grid   items-center justify-center  shadow-lg h-screen group ">
    @include('errMsg')
        <div class="w-full max-w-[660px]  grid  grid-cols-1  sm:grid-cols-2 items-centerborder-purple-400 justify-center     rounded-lg shadow-lg group-hover:bg-[conic-gradient(at_top,_var(--tw-gradient-stops))] from-gray-900 via-gray-100 to-gray-900 h-[450px]  border border-black">

            <img src="https://images.pexels.com/photos/4050312/pexels-photo-4050312.jpeg?auto=compress&cs=tinysrgb&w=600" alt="IMG_FROM_PEXELS" srcset="" class="rounded-lg  object-cover h-[450px] w-[400px] hidden sm:block">
            <div class="flex flex-1 flex-col justify-center items-center sm:space-y-2">
                <p class="font-bold text-center text-4xl">Login</p>
                <form class=" flex flex-col items-center space-y-6 justify-center px-4" method="post" action="{{route('Loginuser')}}">
                    @csrf
                    <div class="w-full">
                        <label for="email" class="font-bold">Email</label>
                        <input type="email" name="email" id="email" class="w-full px-4 py-2  rounded ring  ring-offset-fuchsia-700 outline-none">
                    </div>
                    <div class="w-full">
                        <label for="password " class="font-bold">Password</label>
                        <input type="password" name="password" id="password" class="w-full px-4 py-2  rounded outline-none ring ring-offset-teal-700">
                        <span><button type="button" class="inline font-bold text-xl" id="btn"><input type="checkbox" name="showpassword" id="showpassword"></button> <small>Show password</small></span>
                    </div>
                    <div class="flex flex-col space-y-2 w-full">

                        <button type="submit" class="w-full bg-green-400 px-2 py-2 rounded bg-transparent border border-black font-medium flex items-center justify-center gap-2  hover:bg-black hover:text-white hover:fill-white">Login<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ed">
                                <path d="M480-120v-80h280v-560H480v-80h280q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H480Zm-80-160-55-58 102-102H120v-80h327L345-622l55-58 200 200-200 200Z" />
                            </svg></button>


                        <a href="{{route('googleLogin')}}" class="w-full px-2 py-2 rounded border border-black font-medium  hover:text-white text-center  hover:bg-black"> Login With <span class="text-bold ">Google</span>&nbsp;<i class="fab fa-google"></i>

                        </a>
                        <a href="{{route('showForgotPasswordform')}}" class="w-full text-center px-2 py-1 opacity-100 hover:opacity-70 text-blue-800 duration-150 hover:text-blue-900 font-semibold">Reset Password</a>

                    </div>
                </form>
                <div class="flex gap-2 justify-center items-center">
                    <p class="text-center ">New here?</p><a href="{{route('signup')}}" class="text-blue-800 hover:underline text-center">Join Now!</a>

                </div>
            </div>

        </div>
    </div>
</body>
<!-- show pass -->
<script>
    document.getElementById('showpassword').addEventListener('change', () => {

        let typee = document.getElementById("password");
        // console.log(typee);

        if (typee.value) {

            if (typee.type == "password") {

                // typee.type=="text"
                typee.setAttribute('type', "text")

            } else {

                typee.setAttribute('type', "password")


            }

        }





    })
</script>


<!-- show pass -->

<!-- script for removing congrts msg -->
<script>
    const myMsg = document.getElementById('myMsg');


    if (myMsg.innerHTML !== ' ') {
        setTimeout(() => {

            myMsg.style.display = 'none';
        }, 5000);
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