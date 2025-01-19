<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApplicationEmail</title>
    @vite('resources/css/app.css')
    

</head>
<body class="font-body ">
<div class="border border-black bg-gradient-to-tr from-indigo-500 via-purple-500 to-orange-500">
    <div class="flex flex-col items-center space-y-4">
<h2>New Application Received!!</h2>
<p class="text-blue-400 hover:underline hover:opacity-[.5]">

Hi,{{$mailBag['companyData']->companyname}}</p>
<p>You have received a new application UnderJob  title! </p>    
<span class="text-gray-400  font-semibold">{{$mailBag['jobData']->jobtitle}}</span>


<p>Applicant Details</p>


<ul class="list-none space-y-2">

<li>Name:{{$mailBag['jobseekerData']->jobseekername}}</li>
<li class="text-blue-400 hover:underline">Email:{{$mailBag['jobseekeremail']}}</li>
</ul>

</div>
<div class="flex  w-10 mt-2 text-gray-500"><h4 class="mx-auto">Please visit your account to get  applicant's Resume</h4></div>
</div>
</body>
</html>