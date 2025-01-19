<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registeration Verification</title>
    @vite('resources/css/app.css')
    

</head>
<body class="font-body ">

    <h3 style="color: blue;">Hi,{{$mailBag['userName']}}</h3>
    <p style="color:black;font:bold">Please click button below to verify!</p>

     <a href="{{route('emailVerificationProcess',['token'=>$mailBag['token']])}}">verify</a>
    
 
</div>
</body>
</html>