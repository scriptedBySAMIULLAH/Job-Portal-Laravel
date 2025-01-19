<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration</title>
    @vite('resources/css/app.css')
</head>

<body class=" font-body bg-slate-200">
<a href="javascript:history.back()" class="text-blue-600 ml-4 mt-6"><-Back</a>
    <div class="outer h-[100dvh] w-full flex justify-center items-center">
   
        <div class="max-w-md rounded-md shadow-md border border-blue-800 mx-auto p-4">
            <form action="{{route('User_Registeration')}}" method="post" class="w-full space-y-5">
                @csrf
                <input type="hidden" name="role" value="company">

                <div>
                    <label for="name"  class="block text-slate-700">Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" value="{{old('name')}}" required class="p-1 rounded-md outline-none from-cyan-400 ring-3 hover:ring-slate-400 px-2 py-2" placeholder="Full name">
                    @error('name')

                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-slate-700">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" value="{{old('email')}}" required class="p-1 rounded-md outline-none from-cyan-400 ring-3 hover:ring-slate-400 px-2 py-2" placeholder="Email address">
                    @error('email')

                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-slate-700">Password</label>
                    <input type="password" name="password" id="password" autocomplete="new-password"  value="{{old('password')}}" required class="p-1 rounded-md outline-none from-cyan-400 ring-3 hover:ring-slate-400 px-2 py-2" placeholder="Password">
                    @error('password')

                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>

                    <button class="border border-black  text-base w-full text-slate-800">Sign Up</button>
                </div>


            </form>


        </div>

    </div>

</body>

</html>