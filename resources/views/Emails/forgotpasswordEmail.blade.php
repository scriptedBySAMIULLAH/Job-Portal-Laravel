<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApplicationEmail</title>



</head>

<body>

    <h2>Password Reset Request!!</h2>
    <p style="font-weight:bold;Color:000080">

        Hi,{{$mailBag['userdata']->name}}</p><br>
    <p style="font-style:italic;Color:111180">As per your Forgot password request,Please click link below to reset password!</p> <br>

    <a style="text-decoration:underline;Color:000080" href="{{route('PasswordResetform',['token'=>$mailBag['token']])}}">Reset Lost password🔑</a><br>

    <p style="text-decoration:underline;Color: #a1c9f2;">Thanks for Using our Platform</p><br>
  


</body>

</html>