<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration</title>
    @vite('resources/css/app.css')
</head>
<body class=" font-body">

<div class="bg-slate-400">

    <div class="outer h-[100dvh] w-full flex flex-col items-center">
    <a href="javascript:history.back()" class="text-black ml-4 mt-6"><-Back</a>
            <div class="max-w-md rounded-md shadow-md border border-blue-400 mx-auto px-2 sm:py-4 sm:px-4 ">
                <form action="{{route('User_Registeration')}}" method="post" class="w-full space-y-6">
                    @csrf

                <input type="hidden" name="role" value="jobseeker">
               

                        <div >
                            <label for="name" class="block text-slate-700">Name</label>
                            <input type="text" name="name" id="name" class="outline-none from-cyan-400 ring-4 hover:ring-slate-400 rounded-sm px-2 py-2" placeholder="Full name">
                        </div>

                        <div >
                            <label for="email" class="block text-slate-700">Email</label>
                            <input type="email" name="email" id="email"   class="outline-none from-cyan-400 ring-4 hover:ring-slate-400 rounded-sm px-2 py-2" placeholder="Email address">
                        </div>

                        <div >
                            <label for="password" class="block text-slate-700">Password</label>
                            <input type="password" name="password" id="password"  class="outline-none from-cyan-400 ring-4 hover:ring-slate-400 rounded-sm px-2 py-2" placeholder="Password">
                        </div>

                        <div>
                           
                            <button class="text-slate-700 border border-black text-lg text-base w-full ">Register</button>
                        </div>


                </form>


            </div>

    </div>
    </div>
</body>
</html>