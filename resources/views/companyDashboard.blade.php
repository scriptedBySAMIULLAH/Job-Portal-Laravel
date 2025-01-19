<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>CompanyDashboard</title>
  @vite('resources/css/app.css')

  <!-- link for choices.js library  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
  <!-- link for choices.js library end  -->

  <!-- link for wyswyg  -->

  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>


  <script>
    CKEDITOR.replace('description');
  </script>
  <!-- link for wyswyg end  -->


  <!-- scipt for wyswyg editior where it is applied -->
  <style>
    .hide-scrollbar::-webkit-scrollbar {
      display: none;
      /* for Chrome, Safari, and Opera */
    }

    .shad:hover {

      box-shadow: 0 0 1.5em rgba(225, 128, 87, 0.9);
    }
  </style>



  <!-- /////////////////sweetalert js///////////////////////    -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- /////////////////sweetalert js ends//////////////////////    -->

  <!-- for sweetalert library -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- for sweetalert library ends-->

</head>

<body class="bg-gradient-to-bl from-slate-100 via-gray-200 to-slate-300  font-body">


  @if (session('ProfileUpdated'))
  <script>
    Swal.fire('Profile Updated SuccessFully');
  </script>

  @endif


  <!-- FOR GO BACK  -->
  <a href="{{route('index')}}" class=" fixed right-0 TOP-0 text-white bg-[rgb(5,0,12)] opacity-1 border rounded-full px-2 py-1 shad "><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="28px" fill="#ffff">
      <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z" />
    </svg></a>
  <div class="flex flex-col  ">
    <!-- nav area -->
    <div id="dynamicBackground" class="bg-gray-800 text-white p-2 flex justify-center   items-center flex-col text-center bg-center bg-cover bg-blend-overlay bg-black/40 bg-fixed shadow-md shadow-zinc-950" style="background-image: url(https://api.pexels.com/v1/search?query=technology&per_page=1&page=1&apikey=ZbHCUbWe1V0lBxwOPvjfWQB9uMarF8EeHKYWomtbB503iHuNxkO6GcF9
)">
      <!-- Company Logo -->
      <img src="{{ asset('storage/'.$company_logo)}}" alt="Company Logo" class="h-16 w-16 mb-2 rounded-full object-cover" />

      <!-- Company Name -->
      <div class="mb-0">
        <h2 class="text-base text-blue-400 block mb-2">{{$company_name}}</h2>

        <!-- Owner Name -->
        @auth

        <!--  auth auth -->


        <p class="text-xs font-serif">Welcome😎!{{ auth()->user()->name}}</p>
        @endauth

      </div>
      <!-- Navigation Links -->
      <ul class="space-y-2 mt-4 flex flex-col items-center  gap-1 font-Roboto font-semibold">
        <li>
          <a href="{{route('companyapplicant')}}" class="flex py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#8C1AF6">
              <path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
            </svg>Applications</a>
        </li>

        <li>
          <a href="{{route('browse_candidate')}}" class="flex items-center py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 -960 960 960" width="22px" fill="white"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>Browse Candidates</a>
        </li>
        

        <li>
          <a href="#jobs " onclick="showPage('jobs')" class="flex py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#EA33F7">
              <path d="M160-120q-33 0-56.5-23.5T80-200v-440q0-33 23.5-56.5T160-720h160v-80q0-33 23.5-56.5T400-880h160q33 0 56.5 23.5T640-800v80h160q33 0 56.5 23.5T880-640v440q0 33-23.5 56.5T800-120H160Zm0-80h640v-440H160v440Zm240-520h160v-80H400v80ZM160-200v-440 440Z" />
            </svg>Jobs</a>
        </li>
        <li>
          <a href="{{route('show_create_job')}}" class="flex py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#BDD6AC">
              <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h360v80H200v560h560v-360h80v360q0 33-23.5 56.5T760-120H200Zm120-160v-80h320v80H320Zm0-120v-80h320v80H320Zm0-120v-80h320v80H320Zm360-80v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Z" />
            </svg>Post Job</a>
        </li>

        <li>
          <a href="#settings" onclick="showPage('settings')" class="flex py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FB4C">
              <path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z" />
            </svg>Settings</a>
        </li>



        <li class=" flex justify-center item-center">

          <!-- logout  -->
          <form action="{{route('Logout')}}" method="post">
            @csrf
            <button class="flex py-2 px-4 text-red-500 hover:text-red-400 hover:bg-gray-800 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FBFD">
                <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
              </svg> Logout</button>
          </form>
          <!-- logout  ends-->
        </li>
        <li>
          <a href="{{URL::to('deleteProfile/'.auth()->id())}}" class="flex  py-2 px-4 text-red-500 hover:text-red-400 hover:bg-gray-800 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#F19E39">
              <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
            </svg> Delete Profile</a>
        </li>

      </ul>
    </div>
  </div>





  <!-- this is the (your jobs) section here  -->
  <div id="jobs" class="flex-1  p-4 relative ">

    <h1 class="heading text-center ">Jobs Created</h1>
    <!-- table here  -->

    <div class="overflow-x-auto min-w-full  mt-8 ">
      <table id="jobtable" class="min-w-full overflow-x-auto bg-white table-fixed whitespace-nowrap ">


        <!-- min-w-full chotii screen pr bi full 100% length -->
        <thead class="bg-gray-600 text-white text-center w-full">
          <tr>
            <th scope="col" class="w-1/6 py-3 text-left px-4 tracking-wider uppercase">Title</th>
            <th scope="col" class="w-1/12 py-3 text-left px-4 tracking-wider uppercase">Date</th>
            <th scope="col" class="w-1/6 py-3 text-left px-4 tracking-wider uppercase">Salary</th>
            <th scope="col" class="w-1 py-[1rem] text-left px-[1rem] tracking-wider uppercase">Skills</th>
            <th scope="col" class="w-1/6 py-3 text-left px-4 tracking-wider uppercase">View</th>
            <th scope="col" class="w-1/6 py-3 text-left px-4 tracking-wider uppercase">End on</th>
            <th scope="col" class="w-1/12 py-3 text-left px-4 tracking-wider uppercase">Update</th>
            <th scope="col" class="w-1/12 py-3 text-left px-4 tracking-wider uppercase">Delete</th>
            <th scope="col" class="w-1/6 py-3 text-left px-4 tracking-wider uppercase">Status</th>
          </tr>
        </thead>
        <tbody class="text-gray-700 bg-white divide-y divide-gray-400">


          @foreach ($jobs as $job )


          <tr id="job-row-{{$job->id}}" class=" text-sm md:text-base lg:text-lg">
            <td class="py-3 px-4 text-sm md:text-base lg:text-lg">{{ $job->jobtitle}}</td>
            <td class="py-3 px-6 text-nowrap text-sm md:text-base lg:text-lg">{{ $job->created_at->toFormattedDateString()}}</td>
            <td class="py-3 px-6 text-nowrap text-sm md:text-base lg:text-lg">{{ $job->salary}}</td>
            <td class="py-3 px-[12px] pl-[5px] text-sm md:text-base lg:text-lg">
              @foreach ($job->skills as $skill )
              <!-- $job->skills   why this way b/c one single job is assocated with skill you cant do like jobs->skills this have collextion of jobs not single job -->
              {{ $skill->name}}<br>

              @endforeach
            </td>
            <td class="py-3 px-6 text-nowrap text-blue-500 hover:text-blue-900"><a href="{{ URL::to('jobsummary/'.$job->id)}}">View</a></td>
            <td class="py-3 px-6 text-nowrap">{{ $job->endson->toFormattedDateString()}}</td>
            <td>
              <button class="border border-black bg-transparent  rounded-sm text-black p-1 font-bold  transition-transform ease-in-out duration-400  hover:scale-[1.02] " onclick="openmodal(true, '{{ $job->id }}')"> Update </button>
            <td class="">
              <a href="{{ route('DeleteJob',['id' => $job->id])}}" class="border border-black bg-transparent  rounded-sm text-black p-1  font-bold  transition-transform ease-in-out duration-400  hover:scale-[1.02] ">
                Delete
              </a>
            </td>

            <!-- jobexpiry -->
            @if (Carbon\Carbon::now()->lessThan($job->endson))
            <td><button disabled class="bg-green-200 rounded-full px-2 py-1   font-bold text-center text-gray-500 hover:text-gray-700">Active</button></td>
            @else
            <td><button disabled class="bg-red-100 border border-red-400 text-red-700 px-2 py-2 rounded relative">Expired</button></td>
            @endif
            <!-- jobexpiry ends -->
            <!-- //update form td pl dont mess  -->
            <td>

              <!-- //////////////////updateform/////////////// -->



              <div class=" fixed inset-0  hidden  hide-scrollbar  w-[40%] mx-auto" id="modal-{{ $job->id }}">

                <div class="h-[90vh] overflow-y-auto  shadow-md rounded-md bg-gradient-to-tr  from-orange-600 via-slate-200 to-indigo-500 p-6 space-y-4 ">


                  <div class=" flex justify-end">
                    <button onclick="closemodal('{{ $job->id }}')" class="text-black text-xl relative flex hover:bg-black hover:text-yellow-400 hover:rounded rounded-full">&times;</button>

                  </div>
                  <span class="flex justify-center item-center text-gray-700">Update</span>
                  <form class="updateForm">

                    @csrf

                    <input type="hidden" name="id" value="{{ $job->id }}">
                    <!-- title-->
                    <div class="mb-4">
                      <label for="title" class="block text-sm font-medium text-black">Job Title</label>

                      <input type="text" id="title" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required value="{{$job->jobtitle}}" />
                      @error('title')
                      <p class="text-indigo-400"></p>
                      @enderror
                    </div>

                    <div class="mb-4">
                      <label for="description" class="block text-sm font-medium text-black">Job Description</label>
                      <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required value="{{$job->description}}"></textarea>
                      @error('description')
                      <p class="text-indigo-400"></p>
                      @enderror
                    </div>
                    <!-- Skills -->
                    <div class="mb-4 px-1 flex flex-1">
                      <label for="skills" class="block text-sm font-medium text-black">Skills</label>

                      <select id="skill" name="skills[]" multiple class="block w-full height-12  overflow-y-auto skill-select">
                        @foreach ($skills as $skill)

                        <option value="{{ $skill->id }}" @if($job->skills->contains($skill)) selected @endif>{{ $skill->name }}</option>
                        @endforeach
                      </select>
                      @error('skills')
                      <p class="text-indigo-400">{{$message}}</p>
                      @enderror
                    </div>
                    <!-- Proficiency Level -->
                    <div class="mb-4">
                      <label for="proficiency" class="block text-sm font-medium text-black">Proficiency Level</label>
                      <select id="proficiency" name="proficiency" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="{{$job->profiency}}">{{$job->profiency}}</option>
                        <option value="Beigneer">Beigneer</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Pro">Pro</option>
                      </select>
                      @error('proficiency')
                      <p class="text-indigo-400"></p>
                      @enderror
                    </div>
                    <!-- Salary -->
                    <div class="mb-4">
                      <label for="salary" class="block text-sm font-medium text-black">Salary</label>
                      <input type="number" id="salary" name="salary" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required min="5000" value="{{$job->salary}}" />
                      @error('salary')
                      <p class="text-indigo-400">{{$message}}</p>
                      @enderror
                    </div>
                    <!-- Gender -->
                    <div class="mb-4">
                      <label for="gender" class="block text-sm font-medium text-black">Gender</label>
                      <select id="gender" name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="{{$job->gender}}">{{$job->gender}}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Any">Any</option>
                      </select>
                      @error('gender')
                      <p class="text-indigo-400">{{$message}}</p>
                      @enderror
                    </div>
                    <!-- Job Type -->
                    <div class="mb-4">
                      <label for="job-type" class="block text-sm font-medium text-black">Job Type</label>
                      <select id="job-type" name="jobtype" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none">
                        <option value="{{$job->jobtype}}">{{$job->jobtype}}</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Contract">Contract</option>
                        <option value="Temporary">Temporary</option>
                      </select>
                      @error('jobtype')
                      <p class="text-indigo-400">{{$message}}</p>
                      @enderror
                    </div>
                    <!-- Location -->
                    <div class="mb-4">
                      <label for="location" class="block text-sm font-medium text-black">Location</label>

                      <select id="location" name="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{$location->name}}</option>
                        @endforeach
                      </select>
                      @error('location')
                      <p class="text-indigo-400">{{$message}}</p>
                      @enderror
                    </div>
                    <!-- Positions -->
                    <div class="mb-4">
                      <label for="positions" class="block text-sm font-medium text-black">Number of Positions</label>
                      <input type="number" id="positions" name="positions" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required value="{{$job->numberofpositions}}" />
                      @error('positions')
                      <p class="text-indigo-400"></p>
                      @enderror
                    </div>
                    <!-- Age Limit -->
                    <div class="mb-4">
                      <label for="age-limit" class="block text-sm font-medium text-black">Age Limit</label>
                      <input type="number" id="age-limit" name="agelimit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required min="18" value="{{$job->agelimit}}" />
                      @error('agelimit')
                      <p class="text-indigo-400">{{$message}}</p>
                      @enderror
                    </div>
                    <!-- Working Hours -->
                    <div class="mb-4">
                      <label for="working-hours" class="block text-sm font-medium text-black">Working Hours</label>
                      <input type="text" id="working-hours" name="workinghours" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required value="{{$job->workinghours}}" />
                      @error('workinghours')
                      <p class="text-indigo-400">{{$message}}</p>
                      @enderror
                    </div>
                    <!-- Experience Level -->
                    <div class="mb-4 ">
                      <label for="experience-level" class="block text-sm font-medium text-black">Experience Level</label>
                      <select name="experiencelevel" id="experience-level" class="w-full">

                        <option value="{{$job->workinghours}}">{{$job->workinghours}}</option>
                        <option value="Entry Level">Entry Level</option>
                        <option value="Mid Level">Mid Level</option>
                        <option value="Senior Level">SeniorLevel</option>
                      </select>
                      @error('experiencelevel')
                      <p class="text-indigo-400">{{$message}}</p>
                      @enderror
                    </div>
                    <!-- End Date -->
                    <div class="mb-4">
                      <label for="ends-on" class="block text-sm font-medium text-black">Ends On</label>
                      <input type="date" id="ends-on" name="endson" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required value="{{$job->endson}}" />
                      @error('endson')
                      <p class="text-indigo-400">{{$message}}</p>
                      @enderror
                    </div>
                    <!-- Submit Button -->
                    <div class="mt-6">
                      <button class="w-fullhover:bg-[#BAFF39] text-[#E85A4F] border border-black py-2 px-4   hover:rounded rounded-full   focus:outline-none hover:text-slate-700 ">
                        Save Changes
                      </button>
                    </div>
                  </form>

                </div>
              </div>
            </td>

          </tr>
          @endforeach

        </tbody>
      </table>

    </div>
    <p>{{$jobs->links()}}</p>
    <!-- table here ends  -->
  </div>

  <!-- this is the  jobs section ends  here  -->



  <div id="settings" class="bg-slate-100 opacity-150 backdrop-blur-2xl py-3 sm:py-5   w-full flex-1 hidden">

    <p class="text-center font-bold text-2xl text-black">Settings</p>

    <!-- user picture -->
    <br>
    <div class=" hover:bg-[conic-gradient(at_top,_var(--tw-gradient-stops))] from-gray-900 via-gray-100 to-gray-900 opacity-100  border border-orange-700 border-x-4 mx-auto  flex justify-center items-center flex-col text-center  bg-white border-y-black border-y-4  h-full max-w-2xl px-4 sm:px-10 py-2  overflow-hidden space-y-4 rounded-md">

      <div class="flex justify-center  items-center gap-4 ">

        <img src="{{asset('storage/'.$company_logo)}}" class=" w-16 h-16  sm:w-24 sm:h-24 rounded-full sm:rounded-lg" alt="company_logo" srcset="">
        <p class="text-lg font-bold">{{auth()->user()->name}}</p>
      </div>
      <hr class="border border-blue-500">


      <form action="{{route('companyUpdateProfile')}}" method="POST" class="px-4 " id="updateForm" enctype="multipart/form-data">

        @csrf
        <input type="hidden" name="role" value="company">
        <div class="mb-4 flex items-center justify-center text-nowrap gap-2">
          <label class="block mb-2 text-sm font-medium text-gray-700" for="company_logo">Company Logo</label>
          <input type="file" id="company_logo" name="company_logo" class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer focus:outline-none ring-2">
        </div>

        <div class="mb-4">
          <label for="owner_name" class="block mb-2 text-sm font-medium text-gray-700">Owner Name</label>
          <input type="text" id="owner_name" name="owner_name" class="w-full px-3 py-2 border rounded-lg text-gray-300" value="{{auth()->user()->name}}" required>
        </div>
        <div class="mb-4">
          <label for="owner_email" class="block mb-2 text-sm font-medium text-gray-700">Owner Email</label>
          <input type="text" id="owner_email" name="owner_email" class="w-full px-3 py-2 border rounded-lg text-gray-300" value="{{auth()->user()->email}}">
          @error('owner_email')

          <p class="text-red-400 font-semibold"> {{$message}}</p>
          @enderror


        </div>

        <label for="company_name" class="block mb-2">Company Name</label>
        <input type="text" id="company_name" name="company_name" class="w-full px-3 py-2 border rounded mb-4 text-gray-300" value="{{$company_details->companyname}}" required>
        @error('company_name')
        <p class="text-red-400 font-semibold"> {{$message}}</p>
        @enderror

        <label for="email" class="block mb-2">Company Email</label>
        <input type="email" id="email" name="email" class="w-full px-3 py-2 border text-gray-300 rounded mb-4" value="{{$company_details->companyemail}}">
        @error('email')
        <p class="text-red-400 font-semibold"> {{$message}}</p>
        @enderror

        <label for="password" class="block mb-2">Password</label>
        <input type="password" id="password" name="password" class="w-full px-3  text-gray-300 py-2 border rounded mb-4" placeholder="********" required>
        <small class="text-gray-400">Leave blank if you dont want to update password!</small>

        <label for="phone_number" class="block mb-2">Phone Number</label>
        <input type="tel" id="phone_number" name="phone_number" class="w-full px-3 py-2 border rounded mb-4 text-gray-300" value="{{$company_details->phonenumber}}" required>
        @error('phone_number')
        <p class="text-red-400 font-semibold"> {{$message}}</p>
        @enderror
        <label for="location" class="block mb-2">Location</label>
        <select id="location" name="location" class="w-full px-3 py-2 border rounded mb-4">
          <option value="{{$company_details->location_id}}">{{ $company_location}}</option>
          @foreach ($locations as $loc)
          <option value="{{$loc->id}}">{{$loc->name}}</option>
          @endforeach

        </select>

        <label for="company_type" class="block mb-2">Ownership Type</label>
        <select id="company_type" name="company_type" class="w-full px-3 py-2 border rounded mb-4">
          <option value="{{$company_details->company_type}}">{{$company_details->company_type}}</option>

          <option value="startup">Startup</option>
          <option value="medium">Medium</option>
          <option value="enterprise">Enterprise</option>
        </select>

        <label for="web_url" class="block mb-2">Website URL</label>
        <input type="url" id="web_url" name="web_url" class="w-full text-blue-300 px-3 py-2 border rounded mb-4" value="{{$company_details->websiteurl}}" required>
        @error('web_url')
        <p class="text-red-400 font-semibold"> {{$message}}</p>
        @enderror
        <label for="employees_count" class="block mb-2">Number of Employees</label>
        <input type="number" id="employees_count" name="employees_count" class="w-full px-3 py-2 border rounded mb-4" value="{{$company_details->numberofemployees}}" required>
        @error('employees_count')
        <p class="text-red-400 font-semibold"> {{$message}}</p>
        @enderror
        <label for="description" class="block mb-2">Description</label>
        <textarea id="description" name="description" rows="4" class="w-full px-3 py-2 border rounded mb-4" placeholder="Tell nore about your Company
          
          ">{{$company_details->description}}</textarea> @error('description')
        <p class="text-red-400 font-semibold"> {{$message}}</p>
        @enderror
        <div class="flex justify-around"> <button type="submit" class="bg-transparent border border-black text-black px-4 py-2 rounded hover:bg-orange-400 animate-bounce">Save Changes</button>

        </div>

      </form>
    </div>
  </div>
  

  <!-- Main Content Area ends-->

  <!-- a success message -->
  @include('successMsg')


  <!-- a success message ends-->

  <!-- a Delete message -->
  @if(session('Delete'))
  <div class=" text-white font-bold py-2 px-4 focus:shadow-outline shadow-blue-500/50 fixed bottom-0 right-0  bg-gradient-to-to-tr from-orange-700 to-indigo-300 rounded-md opacity-2 " id="myMsg">{{ session('Delete') }}</div>

  @endif

  <!-- imported script ffrom pexels api  -->
  <script>
    // Ensures the entire HTML document is fully loaded
    window.onload = function() {
      fetch('https://api.pexels.com/v1/search?query=technology&per_page=80', { // Requesting more images
          headers: {
            Authorization: 'ZbHCUbWe1V0lBxwOPvjfWQB9uMarF8EeHKYWomtbB503iHuNxkO6GcF9' // Replace YOUR_API_KEY with your actual Pexels API key
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.photos.length > 0) {
            // Choose a random image from the returned list
            const randomIndex = Math.floor(Math.random() * data.photos.length);
            const imageUrl = data.photos[randomIndex].src.original;
            const backgroundDiv = document.getElementById('dynamicBackground');
            if (backgroundDiv) {
              backgroundDiv.style.backgroundImage = `url('${imageUrl}')`;
            } else {
              console.error('Element with id "dynamicBackground" not found.');
            }
          } else {
            console.error('No photos returned from Pexels API.');
          }
        })
        .catch(error => console.error('Error fetching image:', error));
    };
  </script>

  <!-- imported script ffrom pexels api ends  -->



  <!-- job alter -->

  <script>
    let form = document.querySelectorAll('.updateForm');


    form.forEach((ele) => {




      ele.addEventListener('submit', function(e) {
        e.preventDefault();

        // FormData collection
        let formData = new FormData(this);


        // console.log(formData);

        // Fetch request
        fetch("{{ route('jobalter')}}", {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }

        }).then(response => {
          // console.log('hi');
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        }).then(data => {
          let jobDetails = data.success;
          console.log(jobDetails);
          // Select the row  want to update  on ui 
          let row = document.getElementById(`job-row-${jobDetails.id}`);
          let skillarray = jobDetails.skills;


          row.cells[0].innerText = jobDetails.jobtitle;
          row.cells[1].innerText = new Date(jobDetails.created_at).toLocaleDateString();

          row.cells[2].innerText = jobDetails.salary;
          skillarray.forEach((ele) => {

            row.cells[3].innerHTML += ele.name;

          })

          row.cells[4].innerText = jobDetails.profiency;
          row.cells[5].innerText = jobDetails.endson;


          alert('Job updated successfully');
        }).catch(error => {
          console.error('Error:', error);
          alert('Error updating job');
        });
      });
    })
  </script>

  <!-- job alter ends-->
</body>


<!-- script for replacing content  -->
<script>
  function showPage(page) {
    // Hide all  inintally b/c except the default dashboard  pages b/c only one can be seen at time
    // document.getElementById("Applications").classList.add("hidden");
    document.getElementById("jobs").classList.add("hidden");
    // document.getElementById("postjob").classList.add("hidden");
    document.getElementById("settings").classList.add("hidden");

    // Show the selected page
    document.getElementById(page).classList.remove("hidden");
  }
</script>
<!-- script for replacing content  end-->

<!-- script for choices.js library -->

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- script for choices.js library end -->
<!-- for the update modal -->
<script>
  new Choices("#skills", {
    removeItemButton: true, // Allows removal of selected item
  });
</script>
<!-- for the update modal end -->
<!-- script for choices.js library tag removal -->
<script>
  let skill = document.querySelectorAll('.skill-select')
  skill.forEach((ele) => {
    new Choices(ele, {
      removeItemButton: true,
    });

  });
</script>

<!-- script for choices.js library  tag remoaval end-->

<!-- heres wyswyg apply on ele -->

<script>
  CKEDITOR.replace('description', {
    enterMode: CKEDITOR.ENTER_BR, // Use <br> instead of <p> on Enter
    shiftEnterMode: CKEDITOR.ENTER_BR, // Use <br> instead of <p> on Shift+Enter
    autoParagraph: false, // Disable automatic paragraph wrapping
    allowedContent: true, // Allow all content (disable automatic filtering)
    removeFormatAttributes: ''
  });
</script>
<!-- heres wyswyg apply end -->

<!-- flash mesage remover script -->
<script>
  const myMsg = document.getElementById('myMsg');


  if (myMsg.innerHTML !== '') {
    setTimeout(() => {

      myMsg.style.display = 'none';
    }, 4000)
  }
</script>

<!-- flash mesage remover script end -->

<!-- modal generaaator update fun  -->
<script>
  function openmodal(par, jobId) {
    const modal = document.getElementById('modal-' + jobId);
    if (par) {
      modal.classList.remove('hidden');
    } else {
      modal.classList.add('hidden');
    }
  }

  function closemodal(jobId) {
    const modal = document.getElementById('modal-' + jobId);
    modal.classList.add('hidden');
  }
</script>

<!-- modal generaaator update fun  ends-->





<script>
  let updateForm = document.getElementById('updateForm');

  if (!updateForm.checkValidity()) {


    updateForm.preventDefault();

    Swal.fire('Some Inputs are invalid');
  }
</script>

</html>