<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mainSignupPage</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-300">
    <div class="  flex flex-col sm:flex-row justify-center items-center h-screen gap-4 sm:gap-11">
        <div class=" hover:translate-x-2  hover:translate-y-2 hover:opacity-50 duration-300 p-4 bg-gray-100 rounded-lg shadow-md flex flex-col items-center  shadow-slate-600">
            <span class="text-lg sm:text-2xl font-bold mb-4 block">🚀 Company Registration 🌟</span>

            <a href="{{route('UserReg_Comp')}}" class="mt-4  hover:text-white hover:bg-black   text-black border border-black font-bold py-2 px-4 rounded">
                Register
            </a>
        </div>
        <div class="p-4 hover:translate-x-2  hover:translate-y-2 hover:opacity-50 duration-300  shadow-slate-600 bg-gray-100 rounded-lg shadow-md flex flex-col items-center text-nowrap">
            <span class="text-lg sm:text-2xl font-bold mb-4"> 😍 Jobseeker Registration 👨‍💻</span>

            <a href="{{route('UserReg_Js')}}" class="mt-4 hover:text-white hover:bg-black  font-bold py-2 px-4 rounded text-black border border-black">
                Register
            </a>
        </div>
    </div>

</body>

</html>