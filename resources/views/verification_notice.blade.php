<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link</title>
    @Vite('resources/css/app.css')
   
</head>
<body class="bg-slate-200">
    <strong>Verification Link🔗</strong>

    <div class="flex flex-col justify-center h-screen">
            <div class="max-w-sm rounded-md border border-green-500 mx-auto text-center space-y-4">
            <p class="text-gray-700 font-semibold ">A Verification link is send to you please click to verify your account!</p>
 
            <form action="{{route('verification.send')}}" method="post">

            @csrf
            <input type="hidden" name="email" value="{{$email}}">
            <button type="submit">Resend</button>
      
            </form>
            </div>

    </div>
</body>
</html>