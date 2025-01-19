<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CV</title>
    @vite('resources/css/app.css')



    <!-- for progress bar -->
    <style>
        ::-moz-progress-bar {
            background-color: green;
            border-radius: 2px;
        }
    </style>



    <!-- /////////////////sweetalert js///////////////////////    -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- /////////////////sweetalert js ends//////////////////////    -->

    <!-- for sweetalert library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- for sweetalert library ends-->

    @include('errMsg')
    
</head>

<body class="bg-[#d3d2cf]">


    @if (session('success'))

    <script>
        Swal.fire('Success✔');
    </script>

    {{session()->forget('success')}}


    @endif

    @if (session('step-2'))

    <script>
        document.getElementById('step-2').classList.remove('hidden')
    </script>

    @endif
    @if (session('step-3'))

    <script>
        document.getElementById('step-3').classList.remove('hidden')
    </script>

    @endif
    @if (session('step-4'))

    <script>
        document.getElementById('step-4').classList.remove('hidden')
    </script>

    @endif
    @if (session('step-5'))

    <script>
        document.getElementById('step-5').classList.remove('hidden')
    </script>

    @endif




    <div class="bg-red-300 font-bold text-center w-[15rem] hidden px-4 py-2 rounded-full sticky top-4 " id="err">
        <span>Please provide valid input</span>
    </div>
    <progress value="1" max="5" id="progress" onclick="Next()" class="bg-transparent px-2 py-2 border border-black rounded-full  float-right sticky top-6"></progress>
    <form action="{{route('cv_validator',['editForm'])}}" class="px-4 flex  flex-col flex-wrap items-center container my-6 justify-center space-y-6" method="post" enctype="multipart/form-data" >
      
       
        @csrf
        <!-- Step 1 -->
        <div id="step-1" class="flex flex-col">
            <strong class="heading text-center ">Basic Bio</strong>
        
            <div class="flex flex-col items-center sm:justify-between w-full sm:w-auto">
                <button type="button" id="customButton" onclick="opn()" class="btn3 sm:w-auto w-full mb-4 sm:mb-0">
                    Choose Image
                </button>
                @error('img')
                <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                @enderror
                <small class="text-gray-700 mb-2 sm:mb-0 sm:ml-4">Please upload less than 5MB</small>
                <div>
                    <input type="file" name="img" id="img" accept="image/*" onchange="uploadImage(event)" class="hidden" />
                </div>
                <img src="{{asset('storage/cv_images/'.$userBio->img)}}" alt="user image" class="h-[8em] w-[8em] rounded-md mt-4 sm:mt-0" id="prevImg" />
                <div class="hidden float-right sm:ml-4 mt-4 sm:mt-0" id="img-holder">
                    <img src="" alt="" id="display" class="h-[8em] w-[8em] rounded-md" />
                </div>
            </div>
        
            <div class="w-full">
                <div class="flex flex-col sm:flex-row gap-4 mb-4">
                    <div class="w-full sm:w-1/2">
                        <input type="hidden" name="user" value="{{auth()->id()}}">
                        <label for="name" class="block text-gray-700">First Name</label>
                        <input type="text" id="name" name="name" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3 w-full placeholder-gray-700" maxlength="25" placeholder="John" value="{{$userBio->name}}" required />
                        @error('name')
                        <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                        @enderror
                    </div>
                    <div class="w-full sm:w-1/2">
                        <label for="surname" class="block text-gray-700">Surname</label>
                        <input type="text" id="surname" name="surname" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 w-full px-3 placeholder-gray-700" placeholder="Doe" value="{{$userBio->surname}}" required />
                        @error('surname')
                        <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                        @enderror
                    </div>
                </div>
        
                <div class="mb-4">
                    <label for="profession" class="block text-gray-700">Profession</label>
                    <input type="text" id="profession" name="profession" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 w-full px-3 placeholder-gray-700" placeholder="Web Developer, Unity Developer" value="{{$userBio->profession}}" maxlength="50" required />
                    @error('profession')
                    <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="city-state" class="block text-gray-700">City-state</label>
                    <input type="text" name="city_state" id="city-state" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 w-full px-3 placeholder-gray-700" placeholder="Islamabad" value="{{$userBio->city_state}}" maxlength="20" required />
                    @error('city_state')
                    <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700">Phone</label>
                    <input type="tel" id="phone" name="phone" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 w-full sm:w-1/2 px-3 placeholder-gray-700" placeholder="+92 3115...." min="0" value="{{$userBio->phone}}" required />
                    @error('phone')
                    <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 w-full px-3 placeholder-gray-700" placeholder="johndoe@gmail.com" required value="{{$userBio->email}}" />
                    @error('email')
                    <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="yourself" class="block text-gray-700">Little About Yourself</label>
                    <textarea name="yourself" id="yourself" cols="30" rows="8" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 w-full placeholder-gray-700" maxlength="50" placeholder="I'm a web developer and build websites.....">{{$userBio->yourself}}</textarea>
                    @error('yourself')
                    <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                    @enderror
                </div>
        
                <button type="button" onclick="Next(2,'step-1')" class="btn3 w-full sm:w-auto">Next</button>
            </div>
        </div>
        
        <div class="hidden conatiner mx-auto" id="step-2">
            <p class="heading">SKills</p>
            <p class="text-gray-600 mb-4">
                Write the Skills comma seperated, and rate them
            </p>
            <div id="skill_wrapper" class="skill_wrapper">
                @foreach ($userSkill as $ele)
                <div class="mb-2 skill_container">



                    <input type="text" name="skill[]" id="skill" placeholder="mysql,nodejs,bun"
                        class="placeholder-zinc-500 px-2 inpt" value="{{$ele->skil}}">
                        <input type="hidden" name="skillval" value="{{$loop->count}}">
                    @error('skill')
                    <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                    @enderror
                    <label for="rate" onclick="on()" class="text-gray-700 font-semibold">Rate</label>
                    <select name="rate[]" id="rate"
                        class=" text-center shadow-gray-400 rounded-xl bg-transparent border border-black req">

                        @foreach ([1,2,3,4,5] as $rating )


                        <option value="{{$rating}}" {{$rating==$ele->rate_value ? 'selected' :''}} class="bg-gray-200">
                            <!-- thats a show part of rating -->
                            @switch($rating)
                            @case($rating==1)

                            ⭐

                            @break
                            @case($rating==2)

                            ⭐⭐

                            @break
                            @case($rating==3)

                            ⭐⭐⭐

                            @break
                            @case($rating==4)

                            ⭐⭐⭐⭐

                            @break

                            @case($rating==5)

                            ⭐ ⭐⭐⭐⭐

                            @break

                            @default

                        <option value="#" class="bg-gray-200"></option>
                        @endswitch

                        </option>
                        @endforeach

                        <option value="1" class="bg-gray-200">⭐</option>
                        <option value="2" class="bg-gray-300">⭐⭐</option>
                        <option value="3" class="bg-gray-300">⭐⭐⭐</option>
                        <option value="4" class="bg-gray-300">⭐⭐⭐⭐</option>
                        <option value="5" class="bg-gray-300">⭐⭐⭐⭐⭐</option>
                    </select>

                </div>
                @endforeach
            </div>
            <button type="button" onclick="addmore(2)" class="border  border-blue-700 text-blue-700 focus:ring-2 bg-transparent px-1 py-0   text-lg font-bold hover:bg-slate-200"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="24px" fill="#0000F5">
                    <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                </svg></button>
            <br>
            <button type="button" onclick="Next(3,'step-2')" class="btn3">Next</button>
            <button type="button" onclick="Previous(1,'step-2')" class="btn3">Previous</button>
        </div>
        <div class="hidden flex-col px-4" id="step-3">
            <strong class="heading">Work History</strong>
            <p class="text-gray-700">
                Start with your most recent job and work backward.
            </p>
            <div id="holdAll" class="flex flex-col gap-4">
                @foreach ($userworkHistory as $ele)
                <div id="main-wrapper">
                    <div class="flex gap-4 flex-wrap">
        
                        <input type="hidden" name="WorkHistoryValue" value="{{$loop->count}}">
                        
                        <div class="w-full sm:w-1/2 lg:w-1/3">
                            <label for="JobTitle" class="block text-gray-700">Job Title</label>
                            <input type="text" name="JobTitle[]" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3 placeholder-gray-700 w-full" placeholder="UI designer" maxlength="100" value="{{$ele->JobTitle}}" required />
                            @error('JobTitle')
                            <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                            @enderror
                        </div>
                        
                        <div class="w-full sm:w-1/2 lg:w-1/3">
                            <label for="Employer" class="block text-gray-700">Employer</label>
                            <input type="text" id="Employer" required class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3 placeholder-gray-700 w-full" maxlength="100" name="Employer[]" placeholder="Microsoft Corporation" value="{{$ele->Employer}}" />
                            @error('Employer')
                            <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                            @enderror
                        </div>
        
                        <div class="w-full sm:w-1/2 lg:w-1/3">
                            <label for="Location" class="block text-gray-700">Location</label>
                            <input type="text" id="Location" name="Location[]" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3 placeholder-gray-700 w-full" placeholder="Rawalpindi" value="{{$ele->Location}}" maxlength="50" required />
                            @error('Location')
                            <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                            @enderror
                        </div>
                    </div>
        
                    <div class="mt-4">
                        <div class="flex gap-4 flex-wrap flex-col sm:flex-row">
        
                            <div class="flex justify-center items-center gap-4">
                                <label for="sdate" class="block text-gray-700">Start Date</label>
                                <select name="stdmonthsW[]" class="h-12 px-4 rounded-md shadow-md border border-gray-700 w-full sm:w-auto" id="gg">
                                    <option value="Months" disabled selected>Months</option>
                                    @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                    <option value="{{$month}}" {{ $month== $ele->stdmonthsW ? 'selected' :''}}>{{ $month}}</option>
                                    @endforeach
                                </select>
                                <select name="stdyearsW[]" class="h-12 px-4 rounded-md shadow-md border border-gray-700 w-full sm:w-auto">
                                    <option value="Years" disabled selected>Years</option>
                                    @foreach ([2024, 2023, 2022, 2021, 2020, 2019, 2018, 2017, 2016, 2015, 2014, 2013, 2012, 2011, 2010] as $year)
                                    <option value="{{$year}}" {{$year==$ele->stdyearsW ? 'selected':''}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
        
                            <div class="flex justify-center items-center gap-4">
                                <label for="sdate" class="block text-gray-700">End Date</label>
                                <select name="endmonthsW[]" class="h-12 px-4 rounded-md shadow-md border border-gray-700 w-full sm:w-auto">
                                    <option value="Months" disabled selected>Months</option>
                                    @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                    <option value="{{ $month }}" {{ $month == $ele->endmonthsW ? 'selected' : '' }}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                <select name="endyearsW[]" class="h-12 px-4 rounded-md shadow-md border border-gray-700 w-full sm:w-auto">
                                    <option value="Years" disabled selected>Years</option>
                                    @foreach([2024, 2023, 2022, 2021, 2020, 2019, 2018, 2017, 2016, 2015, 2014, 2013, 2012, 2011, 2010] as $year)
                                    <option value="{{$year}}" {{ $year == $ele->endyearsW ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        
            <button type="button" onclick="addmore(3)" class="border border-blue-700 text-blue-700 focus:ring-2 bg-transparent px-2 py-1 text-lg font-bold hover:bg-slate-200">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="24px" fill="#0000F5">
                    <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                </svg> Add More
            </button>
        
            <br>
        
            <button type="button" onclick="Next(4,'step-3')" class="btn3">Next</button>
            <button type="button" onclick="Previous(2,'step-3')" class="btn3">Previous</button>
        </div>
        






        <div class="hidden" id="step-4">
            <strong class="heading">Tell us about your education</strong>
            <p class="text-gray-700">
                Enter your education experience so far, even if you are a current student or did not graduate.
            </p>
            <div id="All" class="flex flex-col gap-4">
        
                @foreach ($userEducation as $ele)
                <div id="mainwrpr" class="space-y-6">
                    <div class="flex flex-col sm:flex-row gap-4">
        
                        <input type="hidden" name="educationValue" value="{{$loop->count}}">
                        <div class="flex-1">
                            <label for="schName" class="block text-gray-700">School Name</label>
                            <input type="text" id="schName" name="schName[]" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3 w-full" placeholder="eg University of Karachi" required maxlength="100" value="{{$ele->schName}}" />
                            @error('schName')
                            <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label for="schlLoc" class="block text-gray-700">School Location</label>
                            <input type="text" id="schlLoc" name="schlLoc[]" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3 w-full" placeholder="eg Islamabad" required maxlength="100" value="{{$ele->schlLoc}}" />
                            @error('schlLoc')
                            <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="filtudy" class="block text-gray-700">Field of Study</label>
                        <input type="text" id="filtudy" name="fieldstudy[]" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3 placeholder-slate-500 w-full" placeholder="eg Computer science" required maxlength="20" value="{{$ele->fieldstudy}}" />
                        @error('fieldstudy')
                        <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                        @enderror
                    </div>
        
                    <label for="Degr" class="block text-gray-700">Degree</label>
                    <select name="Degree[]" id="Degr" class="h-12 px-4 rounded-md shadow-md border border-gray-700 w-full sm:w-auto">
                        <option value="" disabled selected>Select your degree</option>
                        @foreach ([
                            "HighSchool",
                            "Associates",
                            "Bachelors",
                            "Masters",
                            "PhD",
                            "Certificate",
                            "Diploma",
                            "PostDoctorate",
                            "ProfessionalDegree",
                            "Doctorate",
                            "TradeSchool",
                            "VocationalTraining",
                            "AdvancedCertificate",
                            "TechnicalDiploma"
                            ] as $degree)
                            <option value="{{$degree}}"
                            {{$degree===$ele->Degree ?'selected': ''}}
                            >{{$degree}}</option>
                        @endforeach
                    </select>
        
                    <label for="Degrdate" class="block text-gray-700">Graduation Date (or expected Graduation Date)</label>
                    <select name="GraduationDateYears[]" id="Degrdate" class="h-12 px-4 rounded-md shadow-md border border-gray-700 w-full sm:w-auto">
                        <option value="#" disabled selected>Years</option>
                        @foreach ([2024, 2023, 2022, 2021, 2020, 2019, 2018, 2017, 2016, 2015, 2014, 2013, 2012, 2011, 2010] as $year)
                            <option value="{{$year}}" {{$year==$ele->GraduationDateYears ? 'selected':''}}>
                                {{$year}}
                            </option>
                        @endforeach
                    </select>
        
                    <select name="GraduationDatemonths[]" class="h-12 px-4 rounded-md shadow-md border border-gray-700 w-full sm:w-auto">
                        <option value="Months" disabled selected>Months</option>
                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                            <option value="{{  $month}}"
                                {{ $month== $ele->GraduationDatemonths ? 'selected' :''}}>{{ $month}}</option>
                        @endforeach
                    </select>
        
                </div>
                @endforeach
            </div>
            <button onclick="addmore(4)" class="border mt-2 border-blue-700 text-blue-700 focus:ring-2 bg-transparent px-1 py-0 text-lg font-bold hover:bg-slate-200">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="24px" fill="#0000F5">
                    <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                </svg>
            </button>
            <br>
            <button type="button" onclick="Next(5,'step-4')" class="btn3">Next</button>
            <button type="button" onclick="Previous(3,'step-4')" class="btn3">Previous</button>
        </div>
        
        
        <div class="hidden space-y-5" id="step-5">
            <strong class="font-bold text-2xl font-montserrat">Projects</strong>
            <p class="text-gray-700 font-montserrat">Provide details about your project to showcase your experience.</p>
            <div id="project_box">
                @foreach ($userProjects as $ele)
                <input type="hidden" name="ProjectsValue" value="{{$loop->count}}">
                <div class="container flex flex-col gap-4">
                    <label for="techUse" class="block text-gray-700">Technologies Used</label>
                    <input type="text" name="techUse[]" id="techUse" class="inpt w-full sm:w-3/6 md:w-3/6" value="{{$ele->techUse}}">
                    @error('techUse')
                    <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                    @enderror
        
                    <label for="projects" class="block text-gray-700">Project Description</label>
                    <textarea name="projects[]" id="projects" cols="8" rows="4" placeholder="Briefly describe the project and your responsibilities." class="placeholder-gray-700 inpt border bg-gray-400 p-2 focus:outline-none w-full sm:w-3/6 md:w-3/6">{{$ele->projects}}</textarea>
                    @error('projects')
                    <span class="text-red-700 font-bold font-montserrat">{{($message)}}</span>
                    @enderror
                </div>
                @endforeach
            </div>
        
            <button type="button" onclick="addmore(5)" class="border mt-2 border-blue-700 text-blue-700 focus:ring-2 bg-transparent px-1 py-0 text-lg font-bold hover:bg-slate-200">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="24px" fill="#0000F5">
                    <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                </svg>
            </button>
        
            <button type="button" onclick="Previous(4, 'step-5')" class="btn3">Previous</button>
            <button type="submit" class="btn3 hover:bg-gradient-to-tr from-orange-300 to-pink-300">Save Changes</button>
        </div>
        

    </form>



</body>
<!-- chkLogin -->

<script>
    function chkLogin() {

        Swal.fire('Login to proceed')

    }
</script>
<!-- chkLogin ends -->






<!-- main script -->
<script>
    function addmore(num) {
        let main_wrapper = document.getElementById("main-wrapper"),
            holdAll = document.getElementById("holdAll"),
            All = document.getElementById("All"),
            mainwrpr = document.getElementById("mainwrpr"),
            projects = document.getElementById('project_box');
        const nw = document.createElement('div');
        if (num === 3) {
            nw.innerHTML = `<div class="border border-b-black my-6 w-full"></div> <div id="main-wrapper">
                    <div class="flex gap-4">
                     <button id="delete" class="border border-black bg-transparent text-black px-2 focus:ring-2 focus:ring-red-700" onClick=del(this)><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#8B0000"><path d="m291-240-51-51 189-189-189-189 51-51 189 189 189-189 51 51-189 189 189 189-51 51-189-189-189 189Z"/></svg></button>
                        <div>
                            <label for="JobTitle" class="block text-gray-700">Job Title</label>
                            <input type="text" name="JobTitle[]" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3" maxlength="10" required />
                        </div>
                        <div>
                            <label for="Employer " class="block text-gray-700">Employer</label>
                            <input type="text" id="Employer" required
                                class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3"
                                max="15" name="Employer[]" />

                        </div>
                        <div>
                            <label for="Location" class="block text-gray-700">Location</label>
                            <input type="text" id="Location" name="Location[]" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3" maxlength="10" required />
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="flex gap-4 flex-wrap flex-col space-y-5">

                            <div class="flex justify-center items-center gap-4 flex-wrap">
                                <label for="sdate" class="block text-gray-700">Start Date</label>
                                <select name="stdmonthsW[]" class="h-12 px-4 rounded-md shadow-md border border-gray-700">
                                    <option value="Months" disabled selected>Months</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                                <select name="stdyearsW[]" class="h-12 px-4 rounded-md shadow-md border border-gray-700">
                                    <option value="" disabled selected>Years</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                </select>
                            </div>
                            <div class="flex justify-center items-center gap-4 flex-wrap">
                                <label for="sdate" class="block text-gray-700">End Date</label>
                                <select name="endmonthsW[]" class="h-12 px-4 rounded-md shadow-md border border-gray-700">
                                    <option value="Months" disabled selected>Months</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                                <select name="endyearsW[]" class="h-12 px-4 rounded-md shadow-md border border-gray-700">
                                    <option value="" disabled selected>Years</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>`;

            holdAll.appendChild(nw);
        } else if (num === 4) {

            nw.innerHTML = ` 
      <div id="mainwrpr" class="space-y-6">
                    <div class="flex gap-4">
                     <button id="delete" class="border border-black bg-transparent text-black px-2 py-1 focus:ring-2 focus:ring-red-700" onClick=del(this)><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#8B0000"><path d="m291-240-51-51 189-189-189-189 51-51 189 189 189-189 51 51-189 189 189 189-51 51-189-189-189 189Z"/></svg></button>
                        <div>
                            <label for="schName" class="block text-gray-700">School Name</label>
                            <input type="text" id="schName" name="schName[]" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3" placeholder="egUniversity of Karachi" required />
                        </div>
                        <div>
                            <label for="schlLoc" class="block text-gray-700">School Location</label>
                            <input type="text" id="schlLoc" name="schlLoc[]" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3" placeholder="eg.Islamabad" required />

                        </div>
                    </div>
                    <div>
                        <label for="filtudy" class="block text-gray-700">Field of Study</label>
                        <input type="text" id="filtudy" name="fieldstudy[]" class="rounded-sm border border-gray-500 bg-transparent text-black hover:ring-2 outline-none ring-gray-600 px-3 placeholder-slate-500" placeholder="eg.computerscience" required />

                    </div>



                    <label for="Degr" class="block text-gray-700">Degree</label>
                    <select name="Degree[]" id="Degr" class="h-12 px-4 rounded-md shadow-md border border-gray-700">
                        <option value="" disabled selected>Select your degree</option>
                        <option value="HighSchool">High School Diploma</option>
                        <option value="Associates">Associate's Degree</option>
                        <option value="Bachelors">Bachelor's Degree</option>
                        <option value="Masters">Master's Degree</option>
                        <option value="PhD">Ph.D.</option>
                        <option value="Certificate">Certificate</option>
                        <option value="Diploma">Diploma</option>
                        <option value="PostDoctorate">Post Doctorate</option>
                        <option value="ProfessionalDegree">Professional Degree</option>
                        <option value="Doctorate">Doctorate</option>
                        <option value="TradeSchool">Trade School Diploma</option>
                        <option value="VocationalTraining">Vocational Training</option>
                        <option value="AdvancedCertificate">Advanced Certificate</option>
                        <option value="TechnicalDiploma">Technical Diploma</option>
                    </select>



                    <label for="Degrdate" class="block text-gray-700">Graduation Date (or expected Graduation Date)</label>
                    <select name="GraduationDateYears[]" id="Degrdate" class="h-12 px-4 rounded-md shadow-md border border-gray-700">
                        <option value="" disabled selected>Years</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                        <option value="2013">2013</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                        <option value="2010">2009</option>
                        <option value="2010">2008</option>
                    </select>

                    <select name="GraduationDatemonths[]" class="h-12 px-4 rounded-md shadow-md border border-gray-700">
                        <option value="Months" disabled selected>Months</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>




                </div>`;


            All.appendChild(nw);
        } else if (num == 2) {

            nw.innerHTML = ` <div class="mb-2 skill_container">
   <button id="delete" class="border border-black bg-transparent text-black px-2 focus:ring-2 focus:ring-red-700" onClick=del(this)><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#8B0000"><path d="m291-240-51-51 189-189-189-189 51-51 189 189 189-189 51 51-189 189 189 189-51 51-189-189-189 189Z"/></svg></button>
  <input type="text" name="skill[]" id="skill"  placeholder="mysql,nodejs,bun"
    class="placeholder-zinc-500 px-2 inpt">

  <p class="ratenew inline" onclick="newSkill()" class="text-gray-700 font-semibold">Rate</p>
  <select name="rate[]" 
    class="hidden text-center shadow-gray-400 rounded-xl bg-transparent border border-black req">
    <option value="1" class="bg-gray-200">⭐</option>
    <option value="2" class="bg-gray-300">⭐⭐</option>
    <option value="3" class="bg-gray-300">⭐⭐⭐</option>
    <option value="4" class="bg-gray-300">⭐⭐⭐⭐</option>
    <option value="5" class="bg-gray-300">⭐⭐⭐⭐⭐</option>
  </select>
</div>`;

            skill_wrapper.appendChild(nw);


        } else if (num == 5) {

            nw.innerHTML = `
           <div  id="project_box">
                <div class="container flex flex-col gap-4">
              <div class=" border border-b-4 border-b-black h-8"></div>
                 <button type="button" id="delete" class="border w-fit mt-4 border-black bg-transparent text-black px-2 focus:ring-2 focus:ring-red-700" onClick=del(this)><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#8B0000"><path d="m291-240-51-51 189-189-189-189 51-51 189 189 189-189 51 51-189 189 189 189-51 51-189-189-189 189Z"/></svg></button>
                <label for="techUse " class="block text-gray-700 ">Technologies Used</label>
                <input type="text" name="techUse[]" id="techUse" class="inpt w-3/6">
                <label for="projects" class="block   text-gray-700">Project Description</label>
                <textarea name="projects[]" id="projects" cols="8" rows="4" placeholder="Briefly describe the project and your responsibilities." class="placeholder-gray-700 inpt border  bg-gray-400 p-2 focus:outline-none w-3/6"></textarea>
                </div>
            </div>`;

            projects.appendChild(nw);

        } else {

            alert('j')
        }
        // main_wrapper.classList.add('hidden')

    }

    function newSkill() {
        let lastNewlyCreateDiv = document.getElementById('skill_wrapper');
        let lastchild = lastNewlyCreateDiv.lastElementChild;
        // console.log(lastchild.lastElementChild);
        let realEle = lastchild.lastElementChild.childNodes[7];
        realEle.classList.remove('hidden')



    }




    function del(element) {



        //HERE TRAVERSE TO PARENT
        element.parentElement.parentElement.remove()

    }
    const errTaker = () => {
        let bt = document.getElementById("stp1");
        let namee = document.getElementById("name"),
            error = document.getElementById("err"),
            surname = document.getElementById('surname'),
            profession = document.getElementById('profession'),
            city_state = document.getElementById('city-state');
        yourself = document.getElementById('yourself');


        array = [

            namee, surname, profession, city_state, yourself

        ]

        array.forEach(element => {


            element.addEventListener("input", () => {
                // console.log(element.value);
                // console.log(element.id);
                if (!isNaN(element.value) || (element.value == '')) {


                    error.classList.remove('hidden')
                    setTimeout(() => {

                        error.classList.add('hidden')

                    }, 5000)
                    bt.disabled = true;
                } else {
                    error.classList.add('hidden')
                    bt.disabled = false;
                }
            });
        });


    };
    errTaker()

    function on() {
        document.getElementById("rate").classList.toggle("hidden");
    }

    function opn() {
        document.getElementById("img").click();
    }

    function uploadImage(event) {
        event.preventDefault();
        let img = document.getElementById("display");
        let imgholder = document.getElementById("img-holder");

        //frst we are getting a file from user which is located in fileobj
        let file = event.target.files[0];

        //get the file which is uploaded by usr

        if (file) {


            let prevImg = document.getElementById("prevImg")
            prevImg.className = 'hidden';
            console.log('okay');
        }
        console.log(file);

        //now we have to read the file

        const reader = new FileReader();

        reader.readAsDataURL(file); //when this is readed then a load event will fire

        reader.addEventListener("load", (event) => {
            event.preventDefault();
            const data = event.target.result;

            img.src = data;
            imgholder.classList.remove("hidden");
        });
    }

    function Next(num, its) {
        document.getElementById("progress").value = num;
        // console.log(progress);


        let navigator = document.getElementById(`step-${num}`);
        let existing = document.getElementById(its);

        existing.classList.add("hidden");
        navigator.classList.remove("hidden");

        // console.log(navigator);
    }

    function Previous(num, its) {
        document.getElementById("progress").value = num;
        let navigator = document.getElementById(`step-${num}`);
        let existing = document.getElementById(its);

        existing.classList.add("hidden");
        navigator.classList.remove("hidden");
    }
</script>

@include('successMsg')

</html>