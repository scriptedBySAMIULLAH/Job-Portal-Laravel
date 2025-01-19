<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobseeker Registration</title>
    @vite('resources/css/app.css')
          <!-- /////////////////sweetalert js///////////////////////    -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- /////////////////sweetalert js ends//////////////////////    -->

 <!-- for sweetalert library -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- for sweetalert library ends-->
</head>

<body class=" font-body bg-slate-100">
    <div class="flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Register as Jobseeker 👨‍💻</h1>
            @if(session('error'))
            <p class="text-red-500 text-xs italic">{{ session('error') }}</p>
            @endif
            <form class="space-y-4" enctype="multipart/form-data" method="post" action="{{route('register')}}" id="regForm" autocomplete="off">
                <input type="hidden" name="token" value="{{csrf_token()}}">
                @csrf
                <input type="hidden" name="userid" value="{{$userid}}">
                <input type="hidden" name="name" value="{{$name}}">
                <input type="hidden" name="role" value="jobseeker">


                <!-- <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" required placeholder="Name" class="mt-1 p-2 w-full border shadow-sm border-gray-300 rounded-md focus:outline-green-400 focus:ring-2 focus:ring-blue-500" autocomplete="off" value="{{old('name')}}">

                    <p class="text-red-500 text-xs italic"> @error('name'){{ $message }} @enderror</p>

                </div> -->
                <!-- <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Email" class="mt-1 p-2 w-full border shadow-sm border-gray-300 rounded-md focus:outline-green-400 focus:ring-2 focus:ring-blue-500" autocomplete="off" value="{{old('email')}}">

                    <p class="text-red-500 text-xs italic"> @error('email'){{ $message }} @enderror</p>

                </div> -->
                <!-- <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Password" class="mt-1 p-2 w-full border shadow-sm border-gray-300 rounded-md focus:outline-green-400 focus:ring-2 focus:ring-blue-500" autocomplete="off">

                    <p class="text-red-500 text-xs italic"> @error('password'){{ $message }}@enderror</p>

                </div> -->
                <div>
                    <label for="picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                    <input type="file" id="picture" name="picture" class="mt-1 p-2 w-full border shadow-sm border-gray-300 rounded-md focus:outline-green-400 focus:ring-2 focus:ring-blue-500" autocomplete="off">

                    <p class="text-red-500 text-xs italic"> @error('picture'){{ $message .'Allowed ones--> jpeg,png,gif' }}@enderror</p>

                </div>
                <div>
                    <label for="cv" class="block text-sm font-medium text-gray-700">Resume</label>
                    <input type="file" id="cv" name="cv" required class="mt-1 p-2 w-full border shadow-sm border-gray-300 rounded-md focus:outline-green-400 focus:ring-2 focus:ring-blue-500" autocomplete="off" value="{{old('cv')}}">

                    <p class="text-red-500 text-xs italic"> @error('cv'){{ $message .'Allowed ones--> pdf,doc,docx' }}@enderror</p>

                </div>
                <div>
                    <button type="submit" class="w-full p-2 hover:bg-black text-[#E85A4F] border border-black rounded-md  transition-colors" onclick="regCheck(event)">
                        Sign Up
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

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

<!-- empty reg button check -->
<script>
    function regCheck(event) {
        let reg = document.getElementById('regForm').value;

        if (!reg.checkValidity()) {
            event.preventDefault();

            Swal.fire(
                " Some fields are Empty 🤔");
        } else {

            return true;
        }
    }
</script>

</html>