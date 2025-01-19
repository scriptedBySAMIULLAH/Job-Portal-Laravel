<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Summary</title>
    @vite('resources/css/app.css')
    <style>
        .shad:hover {

            box-shadow: 0 0 1.5em rgba(150, 50, 20, 1);
        }
    </style>

    <!-- /////////////////sweetalert js///////////////////////    -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- /////////////////sweetalert js ends//////////////////////    -->

    <!-- for sweetalert library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- for sweetalert library ends-->
</head>

<body class="bg-slate-100 font-body">


    <!-- already save error -->
    @include('errMsg')
    <!-- already save error end-->

    <!-- message -->

    @if(session('Jobsaved'))
    <script>
        Swal.fire('Jobsaved SuccessFully');
    </script>
    @else
    <p style="display:none"></p>
    @endif


    @if(session('jobapply'))
    <script>
        Swal.fire('Job Apply Success Fully');
    </script>

    @endif
    <!-- main wrapper to hold all-->
    <div class="max-w-4xl mx-auto p-5 bg-gradient-to-tr from-green-400 to-indigo-300">
        <div class="bg-white shadow-lg rounded-lg p-6 mb-4 ">
            <div class="border border-black bg-transparent w-fit opacity-70 hover:opacity-100 duration-300 pr-2 ">
                <a href="javascript:history.back()" class="flex items-center font-semibold text-gray-5 rounded">

                    <svg class="w-4 h-4 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>

                    Back</a>
            </div>

            <div class="flex flex-wrap  sm:justify-between">
                <h1 class="text-xl font-bold mt-[0.5em]">{{$jobDetail->jobtitle}}</h1>
                <div class="flex flex-wrap  sm:flex-row-reverse gap-1 w-[50%]">
                    <span class=" text-blue-800 text-nowrap flex items-center justify-center ">{{$jobDetail->User->companyinfo->companyname}}</span>
                    <img class="h-16 w-16 rounded-full " src="{{ asset('storage/'.$jobDetail->User->companyinfo->picture)}}" alt="LOGOCompany">
                    <hr class="mb-4">
                </div>

            </div>

            <div>
                <h2 class="font-semibold text-lg text-gray-500">Full-Length Description:</h2>
                <p class=" mt-2">{{$jobDetail->description}}</p>
            </div>

            <div class="flex flex-col mt-4 mb-4">

                <p class="font-semibold text-gray-700">Skills</p>
                <ul class="text-sm font-medium">
                    @foreach ($jobDetail->skills as $skill )
                    <li>{{ $skill->name}}
                        @if (!$loop->last)
                        ,
                        @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h2 class="font-semibold text-lg text-gray-500"">Location:</h2>
                <p class=" mt-2 text-lg">{{$jobDetail->location->name}}</p>
            </div>
            <div class="mt-4">
                <h2 class="font-semibold text-lg text-gray-500"">Positions:</h2>
                <p class=" 0">{{$jobDetail->numberofpositions}}</p>
            </div>
            <div class="mt-4">
                <h2 class="font-semibold text-lg text-gray-500"">Age Limit:</h2>
                <p class="">{{$jobDetail->agelimit}}</p>
            </div>
            <div class=" mt-4">
                    <h2 class="font-semibold text-lg text-gray-500"">Working Hours:</h2>
                <p class="">{{$jobDetail->agelimit}}</p>
            </div>
            <div class=" mt-4">
                        <h2 class="font-semibold text-lg text-gray-500"">Experience Level:</h2>
                <p class="">{{$jobDetail->workinghours}}</p>
            </div>
            <div class=" mt-4">
                            <h2 class="font-semibold text-lg text-gray-500"">Gender:</h2>
                <p class="">{{$jobDetail->gender}}</p>
            </div>
            <div class=" mt-4">
                                <h2 class="font-semibold text-lg text-gray-500"">Ends on:-</h2>

                <!-- nothing but checking expiry of job -->
                @if (\Carbon\Carbon::now()->greaterThan($jobDetail->endson))
                <p class=" text-red-600">{{ $jobDetail->endson->toFormattedDateString()}} <span class=" border rounded-md shado">Expired‼</span></p>
                                    @elseif(!\Carbon\Carbon::now()->greaterThan($jobDetail->endson))
                                    <p class="text-green-600">{{ $jobDetail->endson->toFormattedDateString()}}</p>
                                    @endif

            </div>
            <!-- if role is jobseeker and job is -->
            <div class="mt-4 flex justify-between">
                <!-- for auth user hn href="{{URL::to('')}}" -->
                @auth


                @if (Auth::User()->role=='jobseeker' && !\Carbon\Carbon::now()->greaterThan($jobDetail->endson))


                <a href="{{URL::to("savejob/".$jobDetail->id)}}" class="font-bold text-lg cursor-pointer" onclick="Save()" id="save">❤</a> @endauth
                <!-- for loffer -->
                @elseif (!Auth::check())
                <!-- if not login also not click save job -->
                @if (!\Carbon\Carbon::now()->greaterThan($jobDetail->endson))

                <button class="font-bold text-lg  " onclick="loginchecker()" id="savelogin">❤</button>
                @else
                <span class="text-gray-500">You cant apply or save expire job😴!!</span>
                @endif


                @endif

                <div>
                    @auth
                    @if (Auth::User()->role=='jobseeker' && !\Carbon\Carbon::now()->greaterThan($jobDetail->endson))
                    <!-- as only jobseeker apply on job -->

                    <button class="button" onclick="CvConfirmation()" id="btn">Apply</button>
                    <div id="modal" class="hidden">
                        <div class="flex items-center justify-center fixed inset-0  bg-transparent bg-slate-100 border border-black h-full">

                            <div class="flex flex-col items-center justify-center max-w-md border border-black shadow-md shadow-gray-100 px-10 space-y-16 relative">
                                <div class="absolute top-0 right-0">

                                    <strong onclick="closeModal()" class="cursor-pointer text-xl font-bold hover:text-yellow-500">&times;</strong>
                                </div>
                                <p class="text-lg">Do You want to Update Your CV?</p>
                                <div class="flex justify-between   w-full pb-4">

                                    <a href="{{route('JobseekerProfileSetting')}}" class="button px-4">Yes</a>
                                    <a href="{{route('jobapply',['id'=>$jobDetail->id])}}" class="button">No</a>
                                </div>

                            </div>


                        </div>
                    </div>



                    @endif
                    @endauth

                    @if (!Auth::check())
                    <button class="font-bold text-lg button" onclick="ApplyNotLogin()" id="Applylogin">Apply</button>
                    @endif

                </div>
            </div>

        </div>

    </div>


    <script>
        const saveIcon = document.getElementById('save');
        //function for  save and remove
        function Save() {
            if (saveIcon.innerHTML == '❤') {

                saveIcon.innerHTML = 'Saved💚';
            } else {
                saveIcon.innerHTML = '❤';
            }

            setTimeout(() => {
                if (saveIcon.innerHTML == 'Saved💚') {

                    saveIcon.innerHTML = '❤'
                }

            }, 5000)

        }
    </script>


    <script>
        function loginchecker() {




            const saveIcon = document.getElementById('savelogin');




            if (saveIcon.innerHTML == '❤') {
                saveIcon.style.color = 'red';
                confirm('Are you sure You are Logged In 🧐');
                saveIcon.innerHTML = 'Please Login First👻';
            } else {
                saveIcon.innerHTML == '❤'

            }
            setTimeout(() => {

                if (saveIcon.innerHTML == 'Please Login First👻') {
                    saveIcon.style.color = 'black';
                    saveIcon.innerHTML = '❤'

                }
            }, 5000)


        }
    </script>

    <script>
        const myMsg = document.getElementById('myMsg');


        if (myMsg.innerHTML !== ' ') {
            setTimeout(() => {

                myMsg.style.display = 'none';
            }, 4000);
        }
    </script>




    <script>
        function ApplyNotLogin() {

            const ApplyNotLogin = document.getElementById('Applylogin');
            if (ApplyNotLogin) {
                if (ApplyNotLogin.innerHTML == 'Apply') {
                    ApplyNotLogin.style.color = 'red';
                    confirm('Are you sure You are Logged In 🧐');
                    ApplyNotLogin.innerHTML = 'Please Login First👻';
                } else {
                    ApplyNotLogin.innerHTML == 'Apply'

                }
                setTimeout(() => {

                    if (ApplyNotLogin.innerHTML = 'Please Login First👻') {
                        ApplyNotLogin.style.color = 'black';
                        ApplyNotLogin.innerHTML = 'Apply'
                    }

                }, 5000)

            }
        }
    </script>


    <!-- script for cv confirmation modal -->
    <script>
        function CvConfirmation() {
            let btn = document.getElementById('btn').classList.add('hidden');
            let modalOpen = document.getElementById('modal').classList.remove('hidden');

        }

        function closeModal() {
            let modalOpen = document.getElementById('modal').classList.add('hidden');
            let btn = document.getElementById('btn').classList.remove('hidden');

        }
    </script>

</html>