<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>JobseekerDashboard</title>
  @vite('resources/css/app.css')
  
 <!-- /////////////////sweetalert js///////////////////////    -->

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- /////////////////sweetalert js ends//////////////////////    -->

<!-- for sweetalert library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- for sweetalert library ends-->

<!-- fontawesom -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- fontawesom ends-->
  <style>
    .ion-icon {
      font-size: 29px;
      color: black;
    }

    .shad:hover {

      box-shadow: 0 0 1.5em rgba(0, 128, 0, 0.9);
    }

  </style>

</head>

<body class=" font-body">
@include('successMsg')
  <!-- if jobseeker or job not found error -->
  @if(session('error'))
  <p class="fixed bottom-0 right-0 border bg-gradient-to-tr from-green-400 to-orange-500 rounded-lg bg-opacity-5 text-black p-2 font-body" id="myMsg">{{session('error')}}</p>
  @else
  <p style="display:none"></p>
  @endif


  <a href="{{route('index')}}" class=" fixed right-0 top-0 bg-[#fff] opacity-1 border rounded-full px-2 py-1 shad">
    
  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff1D23">
      <path d="M160-120v-375l-72 55-48-64 120-92v-124h80v63l240-183 440 336-48 63-72-54v375H160Zm80-80h200v-160h80v160h200v-356L480-739 240-556v356Zm-80-560q0-50 35-85t85-35q17 0 28.5-11.5T320-920h80q0 50-35 85t-85 35q-17 0-28.5 11.5T240-760h-80Zm80 560h480-480Z" />
    </svg></a>



  <div class="flex flex-col">

    <!-- nav area for jobseeker a background type-->
    <div id='dynamicBackground' class="bg-gray-800 text-white p-2 flex justify-center items-center flex-col text-center bg-center bg-cover bg-blend-overlay bg-black/40 bg-fixed shadow-md shadow-zinc-950" style="background-image: url(https://api.pexels.com/v1/search?query=flowers&per_page=1&page=1&apikey=ZbHCUbWe1V0lBxwOPvjfWQB9uMarF8EeHKYWomtbB503iHuNxkO6GcF9
)">
      <!-- jobseeker Logo -->
      <img src="{{asset('storage/'.$jobseekerPicture)}}" alt="JobseekerImg" class="h-16 w-16 mb-2 rounded-full object-cover" />


      <div class="mb-0 mt-2">


        <!-- js Name -->

        @auth


        <p class="text-normal font-serif">{{auth()->user()->name}}</p>
        @endauth
      </div>
      <!-- Navigation Links -->
      <ul class="space-y-2 mt-4 flex flex-col items-center justify-center font-lora">
        <!-- <li> later we put 
              <a
                href="#Applications"
                onclick="showPage('Applications')"
                class="block py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded"
                >Applications</a
              >
            </li> -->
        <li>
          <a href="#jobapplied" onclick="showPage('jobapplied')" class="flex  py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#EA33F7"><path d="M480-263 120-623l56-57 304 304 224-224H520v-80h320v320h-80v-183L480-263Z"/></svg>JobsApplied</a>
        </li>
        <li class="flex flex-col items-center">
          <a href="{{route('Layout-Selection_view')}}"  class="flex  py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded"><i class="fa-solid fa-eye" style="color: #74C0FC;"></i>CV Preview</a>
        </li>
        <li class="flex flex-col items-center">
          <a href="{{route('showEditForm')}}"  class="flex  py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffff">
              <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/>
            </svg>
          </i>
          Edit CV
        </a>
        </li>
        <li>
          <a href="#SaveJob" onclick="showPage('SaveJob')" class="flex py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8b"><path d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z"/></svg>Save Job</a>
        </li>
        <li>
          <form action="{{route('Logout')}}" method="post">
            @csrf
            <button class="flex  py-2 px-4 text-red-500 hover:text-red-400 hover:bg-gray-800 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FBFD"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>Logout</button>
          </form>
        </li>

        <li class=" py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded">
            <a href="{{route('JobseekerProfileSetting')}}" onclick="showPage('settings')" class="flex py-2 px-4 text-gray-300 hover:text-white hover:bg-gray-700 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FB4C"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>Settings</a>
          </li>

        <li>
          <a href="#delete-profile" class="flex py-2 px-4 text-red-500 hover:text-red-400 hover:bg-gray-800 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#F19E39"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>Delete Profile</a>
        </li>

      </ul>
    </div>
  </div>
  <!-- jobapplied portion -->
  <div id="jobapplied" class=" p-4">
    <!-- Jobs Content Goes Here -->
    <h1 class="text-2xl font-bold  text-center ">Applied <span class="font-bold text-orange-500 ">Jobs</span></h1>
    <!-- table here  -->

    <div class="overflow-x-auto max-w-screen-lg mx-auto mt-8">

    @if ($jobseekerwithjob && $jobseekerwithjob->apply->isNotEmpty())
      <table class="min-w-full bg-white table-fixed bg-transparent border border-blue-400 text-white">
        <!-- min-w-full chotii screen pr bi full 100% length -->
        <thead class="bg-gray-800 text-white">
          <tr>
            <th class="w-1/6 py-3 text-center px-4">Title</th>
            <th class="w-1/5 py-3 text-center px-6 text-nowrap">Company Name</th>
            <th class="w-1/6 py-3 text-center px-4">Salary</th>
            <th class="w-1/6 py-3 text-center px-4">Skills</th>
            <th class="w-1/6 py-3 text-center px-4">End on</th>
            <th class="w-1/6 py-3 text-center px-4">View</th>
            <th class="w-1/12 py-3 text-center px-4">Delete</th>
            <th class="w-1/6 py-3 text-center px-4">Status</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          

          @foreach ( $jobseekerwithjob->apply as $ajob)
        
    
     

          <tr>
            <td class="py-3 px-4">{{$ajob->jobtitle}}</td>


            <td class="py-3 px-6 text-nowrap">{{$ajob->User->companyinfo->companyname}}</td>
            <td class="py-3 px-4">{{$ajob->salary}}</td>
            <td class="py-3 px-4">
              @foreach ( $ajob->skills as $jobWithSkills )


              {{$jobWithSkills->name }},<br>

              @endforeach
            </td>
            <!-- expirejob chk-->
            @if (\Carbon\Carbon::now()->greaterThan($ajob->endson))
            <td class=" text-red-600 bg-slate-100  text-nowrap px-4 ">{{ $ajob->endson->toFormattedDateString()}} <span class=" border rounded-md ">Expired‼</span></td>
            @elseif(!\Carbon\Carbon::now()->greaterThan($ajob->endson))
            <td class="text-green-800  text-nowrap ">{{ $ajob->endson->toFormattedDateString()}}</td>
            <!-- expirejob chk end-->
            @endif
            <td class="py-3 px-4">
              <a href="{{URL::to('jobsummary/'.$ajob->id)}}" class=" text-black text-center font-bold flex justify-center items-center bg-transparent border border-black hover:bg-green-200 py-1 px-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="Green">
                  <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                </svg>
              </a>
            </td>
            <td class="py-3 px-4">
              <button class="bg-transparent border border-black hover:bg-red-200 py-[.1] px-4 rounded text-white font-bold mx-0  dlt-btn" data-id="{{$ajob->id}} text-center ">
                <ion-icon name="trash-outline" class="ion-icon"></ion-icon>
              </button>
            </td>



            <td class="py-3 px-4 ">
              <!-- aim is to show stauts crosspomding to job but must have that crossponding job id  and applicationn table job_id if match then show stauts-->
              @foreach ( $ids as $ele)

              <!-- $ids  dont actually have ids it  has appliication table refrence all() -->
              @if ($ajob->id== $ele->job_id)

              <span class="statusColor rounded-md border bg-transparent border-black text-black font-bold  flex flex-1 text-center justify-center items-center px-1 transition transform duration-150 ease-in-out hover:scale-90  ">{{$ele->status}}</span>

              @endif
              @endforeach
            </td>
          </tr>

          @endforeach
        </tbody>
       
      </table>
    </div>
    
    <!-- table here ends  -->
    @else
            <div class=" text-center border border-slate-500 space-y-4 py-2 shadow-md rounded-md">
          <strong>No Applications Yet!</strong>
          <p class="text-gray-500">Not sure what to apply for? Here's some advice:</p>
          <ul class="list-disc text-left ml-4">
              <li>Make sure your profile is up to date.</li>
              <li>Explore jobs based on your skills and interests.</li>
              <li>Don't wait too long – some jobs close quickly!</li>
          </ul>
          <a href="{{ route('index')}}" class="btn3">Browse Available Jobs</a>
      </div>
            @endif
  </div>
  <!-- jobapplied portion ends-->
 
  <!-- jobsave portion -->
  <div id="SaveJob" class="hidden mt-2">
  <h1 class="text-center font-bold text-2xl"><span class="text-pink-700">Save</span> Jobs</h1>
  @if ($jobseekerwithjob->saves->isNotEmpty() && $jobseekerwithjob)
    
  
  <div class="overflow-x-auto max-w-screen-lg mx-auto mt-8">
    
   
    <table class="min-w-full bg-white table-fixed hover:odd">
      <thead class="bg-transparent text-black font-semibold hover:text-blue-500 border border-black">
        <tr>
          <th class="w-1/6 py-3 text-center px-4">Title</th>
          <th class="w-1/3 py-3 text-center px-4 text-nowrap">Company Name</th>
          <th class="w-1/3 py-3 text-center px-4 text-nowrap">Company Email</th>
          <th class="w-1/6 py-3 text-center px-4">Salary</th>
          <th class="w-1/6 py-3 text-center px-4">Skills</th>
          <th class="w-1/6 py-3 text-center px-4">End on</th>
          <th class="w-1/12 py-3 text-center px-4">View</th>
          <th class="w-1/12 py-3 text-center px-4">Delete</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        @foreach ($jobseekerwithjob->saves as $singlejob)
          <tr id="job-row-{{ $singlejob->id }}">
            <td class="py-3 px-4">{{ $singlejob->jobtitle }}</td>
            <td class="py-3 px-6 text-nowrap">{{ $singlejob->User->companyinfo->companyname }}</td>
            <td class="py-3 px-6 text-nowrap">{{ $singlejob->User->companyinfo->companyemail }}</td>
            <td class="py-3 px-4">{{ $singlejob->salary }}</td>
            <td class="py-3 px-4">
              {{ $singlejob->skills->pluck('name')->implode(', ') }}
            </td>

            <!-- Checking Expired‼ jobs -->
            @if (\Carbon\Carbon::now()->greaterThan($singlejob->endson))
              <td class="text-red-600 bg-slate-100 text-nowrap px-4">
                {{ $singlejob->endson->toFormattedDateString() }}
                <span class="border rounded-md">Expired‼</span>
              </td>
            @else
              <td class="text-green-800 text-nowrap">
                {{ $singlejob->endson->toFormattedDateString() }}
              </td>
            @endif

            <!-- View Button -->
            <td class="py-3 px-4">
              <a href="{{ route('jobsummary', $singlejob->id) }}" class="text-black text-center font-bold flex justify-center items-center bg-transparent border border-black hover:bg-green-200 py-1 px-4 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="Green">
                  <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                </svg>
              </a>
            </td>

            <!-- Delete Button -->
            <td class="py-3 px-4">
              <button class="hover:bg-red-400 bg-transparent font-bold py-1 px-2 rounded dlt-btn text-black border border-black" data-id="{{ $singlejob->id }}">
                Delete
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
      
    
  </div>
  @else
  <strong>Go and save Now!</strong>
           @endif
   
</div>

  <!-- jobsave portion -->


  <!-- a del button icon -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <!-- a del button icon end -->
</body>
<!-- script for pexels    -->
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


<!-- script for pexels   ends -->



<!-- script for replacing -->

<script>
  function showPage(page) {
    // Hide all  inintally b/c except the default dashboard  pages b/c only one can be seen at time
    document.getElementById("jobapplied").classList.add("hidden");
    document.getElementById("SaveJob").classList.add("hidden");
    
    // Show the selected page
    document.getElementById(page).classList.toggle("hidden");
  }
</script>

<!-- /////////////////sweetalert js///////////////////////    -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- /////////////////sweetalert js ends//////////////////////    -->


<!-- ////////////for removing job////////////////////////// -->

<script>
  let buttons = document.querySelectorAll('.dlt-btn');


  buttons.forEach((ele) => {
    ele.addEventListener('click', function() {
      const jobid = this.getAttribute('data-id');
      // console.log(jobid);
      // `jobdestroy/${jobid}` why doing this b/c we are on client side 

      Swal.fire({
        title: "Success✔",
       
        icon: "warning",
        imageUrl: "https://source.unsplash.com/random/",
        imageWidth: 200,
        imageHeight: 200,
        imageAlt: "Custom image",
        showCancelButton: true,
        confirmButtonColor: "#DECAb",
        cancelButtonColor: "#FDee5",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {



        if (result.isConfirmed) { // if conformed then proceed all this
          fetch(`jobdestroy/${jobid}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          }).then(Response => {
            //take response from server and return it as json as it is promised based also Y/N

            if (!Response.ok) {

              throw new Error('something went wrong😼');
            }
            return Response.json();
          }).then(data => {
            // let successResponse=data.success;//as we are getting array respone
            // another way 
            const [status, msg] = data; //destruct arrray
            console.log(data);
            if (status == 'success') {
              // console.log(data.success);
              Swal.fire({
                title: "Deleted!",
                text: "Deleted",
                confirmButtonColor: '#AB4426',
                imageUrl: "https://source.unsplash.com/random",
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Custom image"
              });
              ele.closest('tr').remove(); // current ele ka tr pkro
            } else

            {
              Swal.fire({
                title: "Not Deleted!",
                text: "Unable to found.",
                icon: "error",
                imageUrl: "https://source.unsplash.com/random",
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Custom image"
              });
            }
            console.log(data);
          }).catch(err => {
            Swal.fire({
              title: "Error!",
              text: `Failed to Delete a Saved Job .${err}`,
              icon: "error",
              imageUrl: "https://unsplash.it/400/200",
              imageWidth: 400,
              imageHeight: 200,
              imageAlt: "Custom image"
            });
            console.log(err);
          });
        }
      });
    })
  })
</script>



<script>
  let btn = document.querySelectorAll('.dlt-btn');

  btn.forEach((ele) => {
    ele.addEventListener('click', function() {

      const jobid = this.getAttribute('data-id');
      Swal.fire({
        title:"Deleted",
        text: "Success",
        icon: "warning",
        imageUrl: "https://source.unsplash.com/random/",
        imageWidth: 200,
        imageHeight: 200,
        imageAlt: "Custom image",
        showCancelButton: true,
        confirmButtonColor: "#DECAb",
        cancelButtonColor: "#FDee5",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {



        if (result.isConfirmed) { // if conformed then proceed all this
          fetch(`applyjobdelete/${jobid}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          }).then(Response => {
            //take response from server and return it as json as it is promised based also Y/N

            if (!Response.ok) {

              throw new Error('something went wrong😼');
            }
            return Response.json();
          }).then(data => {
            // let successResponse=data.success;//as we are getting array respone
            // another way 
            const [status, msg] = data; //destruct arrray
            console.log(data);
            if (status == 'success') {
              // console.log(data.success);
              Swal.fire({
                title: "Deleted!",
                text: "Deleted🚮",
                confirmButtonColor: '#AB4426',
                imageUrl: "https://source.unsplash.com/random",
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Custom image"
              });
              ele.closest('tr').remove();
            } else

            {
              Swal.fire({
                title: "Not Deleted!",
                text: "Unable to found.",
                icon: "error",
                imageUrl: "https://source.unsplash.com/random",
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Custom image"
              });
            }

          }).catch(err => {
            Swal.fire({
              title: "Error!",
              text: `Failed to Delete Job .${err}`,
              icon: "error",
              imageUrl: "https://unsplash.it/400/200",
              imageWidth: 400,
              imageHeight: 200,
              imageAlt: "Custom image"
            });
            console.log(err);
          });
        }
      });

    })
  })
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
let statusColor=document.querySelectorAll('.statusColor');
statusColor.forEach((ele)=>{


if(ele.textContent==='Pending'){
ele.style.background='rgba(211, 211, 211, 1)'
  console.log('heeeeeeeeeeeee');
}

else if (ele.textContent==='Rejected')

{
  ele.style.background='rgba(255,0,0,0.5)'
  console.log('hooooooo');

}
else if (ele.textContent==='Shortlisted'){

  ele.style.background='rgba(0, 128, 128, 0.5)'
}
else if (ele.textContent==='Accepted'){

ele.style.background='rgba(0, 255, 0, 0.5)'
}
else
{

  console.log('heeeeeeehhiiieeeeee');
}
// console.log(statusColor);

})

</script>


</html>