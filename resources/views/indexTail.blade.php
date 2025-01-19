<!DOCTYPE html>
<html lang="en">

<head>

  <!-- //fonts poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Job Shop</title>
  {{-- <link href="{{ asset('resources/css/app.css') }}" rel="stylesheet"> --}}

  @vite('resources/css/app.css')

  <!-- this is the reveale js library -->
  <script src="https://unpkg.com/scrollreveal"></script>

  <!-- this is the reveale js library ends-->

  <!-- font\wesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- font\wesome ends-->

  <!-- /////////////////sweetalert js///////////////////////    -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- /////////////////sweetalert js ends//////////////////////    -->

  <!-- for sweetalert library -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- for sweetalert library ends-->
  <style>
    .shad:hover {

      box-shadow: 0 0 1.5em rgba(150, 50, 20, 1);
    }
  </style>
</head>

<body class="h-screen font-serif text-black font-body bg-[#EAE7DC]">
  @include('navbar')
  @if (session('errors'))
  <Script>
    Swal.fire('NO Job Found');
  </Script>
  @endif
  <!-- searcharea and filter -->
  <div class="h-auto sm:h-screen flex flex-col items-center justify-center w-full bg-center bg-cover bg-blend-overlay bg-black/50 bg-fixed " style="
        background-image: url(https://cdn.pixabay.com/photo/2020/11/03/04/59/search-bar-5708612_1280.jpg);
      ">
    <div class="flex flex-col items-center justify-center space-y-6 flex-wrap card">
      <div class="bg-opacity-30 backdrop-blur-lg shadow-lg text-center overflow-hidden p-4">
        <h1 class="text-base sm:text-4xl  text-white font-bold mb-4 -tracking-tighter sm:tracking-normal split">

        </h1>

      </div>

      <!-- a search bar and filter -->
      <div class="space-y-2 sm:space-y-4 ">

        <!-- this is searchform -->
        <form action="{{route('index')}}" method="get" class=" flex flex-wrap flex-col overflow-hidden sm:flex-row sm:gap-4 space-y-4 sm:space-y-5">
          <div class="flex flex-col sm:flex-row relative sm:border border-white w-full rounded sm:gap-2 gap-0 sm:pr-2 pr-0 py-1 sm:py-0 px-3 sm:px-0 bg-white ">
            <input type="search" name="searchquery" id="searchquery" placeholder="Keywords" class="rounded w-[100%] p-2 sm:p-2 bg-gray-200 outline-none  placeholder-slate-500 placeholder:text-sm sm:placeholder:text-base" autocomplete="off" />
            <button type="submit" class="text-black top-20 -translate-y-1/2 absolute right-0 transition transform hover:scale-75" onclick=" searchCheck(event)"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#00000">
                <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
              </svg></button>
          </div>
        </form>


        <!-- this is searchform ends-->


        <!-- actually this form i for filtering -->

        <form action="{{route('index')}}" method="get" class="flex flex-wrap flex-col overflow-hidden sm:flex-row sm:gap-8 space-y-4 sm:space-y-5 items-center justify-center ">
          <div class="flex flex-col sm:flex-row sm:items-center space-y-1 sm:space-y-0 sm:space-x-2">
            <label for="proficiency" class=" text-lg text-gray-200">Proficiency</label>
            <select name="Proficiency" id="proficiency" class=" px-1 py-1  outline-none focus:ring ring-orange-400 rounded-lg bg-transparent hover:bg-slate-200 text-white border border-white hover:text-[#E85A4F]" onchange="this.form.submit()">
              <option value="All" {{$Proficency=='All' ? 'selected' : ''}} class="text-gray-400">All</option>
              <option value="Beigneer" {{$Proficency=='Beigneer' ? 'selected' : ''}} class="text-gray-400">Beigneer</option>
              <option value="Intermediate" {{$Proficency=='Intermediate' ? 'selected' : ''}} class="text-gray-400">Intermediate</option>
              <option value="Pro" {{$Proficency=='Pro' ? 'selected' : ''}} class="text-gray-400">Pro</option>
            </select>
        </form>
      </div>
      <!-- actually this form i for filtering ends -->

    </div> <!-- a search bar and filter  ends-->

  </div>
  </div>
  <!-- searcharea and filter ends -->




  <!--   
search bar or hero  -->

  <!-- here handling search if no record found  -->
  @if (session('noJobFound'))

  <script>
    Swal.fire({
      title: "oppss",
      text: "No Job Found!",
    });
  </script>

  @endif


  <!-- here handling search if no record found end -->


  <!-- our latest job section -->

  <div class="mx-auto px-2 sm:container">
    <!-- latest job here -->
    <div class="text-center self-center mt-2 font-bold leading-relaxed font-Roboto text-3xl border border-slate-300 mb-4">
      <span>Welcome to Job Shop</span>
    </div>
    <div class="grid gap-4 grid-cols-1 sm:grid-cols-3 ">


      <!-- dynamic content here -->
      <!-- Card 1 -->
      @foreach ($jobs as $job)
      <!-- no expire job will be display -->
      @if (!\Carbon\Carbon::now()->greaterThan($job->endson))


      <div class="card border-pink-900 bg-white shadow-lg rounded-lg p-1 sm:p-2  shadow-black border hover:border-indigo-800 hover:bg-gray-100 ">
        <h2 class="text-xl font-bold ">{{$job->jobtitle}}</h2>

        <a href="{{route('CompanInfo',['id'=>$job->User->companyinfo->id])}}" class="text-base text-blue-700 mt-1 flex items-center  hover:text-blue-500 underline">
          {{$job->User->companyinfo->companyname}}<svg xmlns="http://www.w3.org/2000/svg" focusable="false" role="img" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" class=" css-r5jz5s eac13zx0 h-4 w-6" class="underline">
            <path d="M14.504 3a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h3.085l-9.594 9.594a.5.5 0 000 .707l.707.708a.5.5 0 00.707 0l9.594-9.595V9.5a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-6a.5.5 0 00-.5-.5h-6z"></path>
            <path d="M5 3.002a2 2 0 00-2 2v13.996a2 2 0 001.996 2.004h14a2 2 0 002-2v-6.5a.5.5 0 00-.5-.5h-1a.5.5 0 00-.5.5v6.5L5 18.998V5.002L11.5 5a.495.495 0 00.496-.498v-1a.5.5 0 00-.5-.5H5z"></path>
          </svg></a>
        <!-- job assocaited locations -->
        <p class="text-gray-500 flex mt-1">
          <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="24px" fill="#032B49">
            <path d="M480-301q99-80 149.5-154T680-594q0-90-56-148t-144-58q-88 0-144 58t-56 148q0 65 50.5 139T480-301Zm0 101Q339-304 269.5-402T200-594q0-125 78-205.5T480-880q124 0 202 80.5T760-594q0 94-69.5 192T480-200Zm0-320q33 0 56.5-23.5T560-600q0-33-23.5-56.5T480-680q-33 0-56.5 23.5T400-600q0 33 23.5 56.5T480-520ZM200-80v-80h560v80H200Zm280-520Z" class="text-2xl" />
          </svg>{{$job->location->name}}
        </p>
        <p class="text-gray-600 mt-1 line-clamp-2">
          {{$job->description}}
        </p>
        <div class="mt-4 flex flex-wrap gap-1">
          <span class=" text-blue-800 text-xs font-semibold px-2.5 py-0.5 flex items-center rounded"><svg xmlns="http://www.w3.org/2000/svg" focusable="false" height="20px" role="img" fill="currentColor" viewBox="0 0 20 20" data-testid="section-icon" aria-hidden="true" class="js-match-insights-provider-1pdva1a eac13zx0">
              <path fill-rule="evenodd" d="M10 3C7 3 6 6 6 6H2.5a.5.5 0 00-.5.5V9h16V6.5a.5.5 0 00-.5-.5H14s-1-3-4-3zm2.5 3h-5s1-1.5 2.5-1.5S12.5 6 12.5 6z" clip-rule="evenodd"></path>
              <path d="M8 11H2v5.5a.5.5 0 00.5.5h15a.5.5 0 00.5-.5V11h-6c0 1-1 2-2 2s-2-1-2-2z"></path>
            </svg>
            <path fill-rule="evenodd" d="M10 3C7 3 6 6 6 6H2.5a.5.5 0 00-.5.5V9h16V6.5a.5.5 0 00-.5-.5H14s-1-3-4-3zm2.5 3h-5s1-1.5 2.5-1.5S12.5 6 12.5 6z" clip-rule="evenodd"></path>{{$job->jobtype}}
          </span>
          <span class=" text-green-800 text-xs font-semibold px-2.5 py-0.5 flex items-center rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FB2C">
              <path d="M640-160v-280h160v280H640Zm-240 0v-640h160v640H400Zm-240 0v-440h160v440H160Z" />
            </svg>{{$job->profiency}}</span>
          <span class=" text-purple-800 text-xs font-semibold px-2.5 py-0.5 flex items-center rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#6c5ce7">
              <path d="M238-120q-19 0-30-15.5t-6-33.5l178-643q4-13 14-20.5t23-7.5q20 0 31 15.5t6 33.5l-20 71h225l25-92q4-13 14.5-20.5T722-840q19 0 30 15.5t6 33.5L580-148q-4 13-14 20.5t-23 7.5q-20 0-31-15.5t-6-33.5l20-71H301l-25 92q-4 13-14.5 20.5T238-120Zm141-400h224l33-120H412l-33 120Zm-55 200h224l33-120H357l-33 120Z" />
            </svg>{{$job->experiencelevel}}</span>
          <span class=" text-yellow-800 text-xs font-semibold px-2.5 flex items-center  py-0.5 rounded"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFD700">
              <path d="M441-120v-86q-53-12-91.5-46T293-348l74-30q15 48 44.5 73t77.5 25q41 0 69.5-18.5T587-356q0-35-22-55.5T463-458q-86-27-118-64.5T313-614q0-65 42-101t86-41v-84h80v84q50 8 82.5 36.5T651-650l-74 32q-12-32-34-48t-60-16q-44 0-67 19.5T393-614q0 33 30 52t104 40q69 20 104.5 63.5T667-358q0 71-42 108t-104 46v84h-80Z" />
            </svg>{{$job->salary}}</span>

        </div>

        
        <div class="mt-4 flex flex-wrap sm:justify-between items-baseline gap-2" >

          <a href="{{URL::to('jobsummary/'.$job->id)}}" class="bg-transparent hover:bg-black text-blue-700 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">Read More</a>
          <span class="text-gray-800 mr-1  ">{{$job->created_at->diffForHumans()}}</span>
        </div>
      </div>
      @endif
      @endforeach

      <!--cardwrapper end-->
    </div><!--grid end-->

  </div><!--main contianer ends end-->

  <!-- a path to jobfeed -->
  <div class="text-base text-center flex justify-around">
    <a href="{{route('jobfeed')}}" class="btn3 items-center  flex transition transform hover:scale-110 px-0 hover:opacity-100 ease-in-out duration-100 mb-4">
    
  Get More
  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#032B44" class="hover:bg-[#fff] bg-transparent rounded-xl ">
        <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
      </svg></a>

    <button onclick="footer()" class="font-semibold text-lg text-center"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#000000" class="hover:text-lime-800 footerArrow">
        <path d="M480-344 240-584l47.33-47.33L480-438.67l192.67-192.66L720-584 480-344Z" />
      </svg></button>
  </div>

  <!-- a path to jobfeed ends-->


  <!-- go back to dashboard -->
  @auth
  @if(session('dashboard.url'))
  <a href="{{ session('dashboard.url') }}" class="bg-gradient-to-r from-cyan-300  to-violet-400 rounded-full shadow-md text-black px-2 fixed bottom-0 right-0 hover:text-gray-500">Back to Dashboard🍇</a>

  @endif
  @endauth

  <!-- footer starts  -->
  @if(session('logoutmessage'))
  <div class=" text-white font-bold py-2 px-4 focus:shadow-outline shadow-blue-500/50 fixed top-0 right-0 bg-indigo-500 rounded-md opacity-2 " id="myMsg">{{ session('logoutmessage') }}

    {{session()->forget('logoutmessage')}}
  </div>

  @endif

  <footer id="footerbtn" class="bg-black text-white font-Roboto max-w-7xl h-auto space-y-4 py-4 sm:py-8">
    <!-- tagline -->

    <section class="m-auto flex flex-col items-center justify-center space-y-4 sm:space-y- ">
      <p class="text-lg font-light sm:text-4xl leading-snug tracking-normal "></p>
      <p class=" text-base leading-snug tracking-normal sm:text-xl">
        Sign up today and get access to exclusive job listings and career
        resources.
      </p>
    </section>
    <!-- tagline ends-->

    <!-- social icons -->

    <section class="flex flex-col flex-wrap  gap-4 overflow-hidden container m-auto py-6 px-2  relative justify-evenly items-center">
      <div class="flex gap-3  w-fit">
        <a href="#" class="w-fit ">
          <svg
            role="img"
            viewBox="0 0 24 24"
            fill="current-color"
            xmlns="http://www.w3.org/2000/svg"
            class="h-10 w-10 rounded-full fill-gray-300 hover:fill-blue-500 trns border hover:border-blue-600 object-cover">
            <title>LinkedIn</title>
            <path
              d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
          </svg>
        </a>

        <a href="#" class="relative  w-fit ">

          <svg
            role="img"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            class="h-10 w-10 rounded-full fill-gray-300 hover:fill-gray-600  trns border hover:border-black">
            <title>X</title>
            <path
              d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" />
          </svg>
        </a>

        <a href="#"
          class="w-fit "><svg
            role="img"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            class="h-10 w-10 rounded-full fill-gray-300 hover:fill-blue-600 trns border hover:border-white">
            <title>Facebook</title>
            <path
              d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647Z" />
          </svg></a>
      </div>

      <div class="rounded-full flex items-center px-2 border sm:px-4 text-center">

        <a href="/signup" class="bg-transparent  text-center font-montserrat opacity-100 hover:opacity-85 duration-75 trns flex-1">Sign Up Now</a>
      </div>



    </section>

    <!-- social icons ends-->


    <section class="container m-auto px-0 sm:px-2 flex">
      <div class=" flex flex-col flex-wrap  w-full px-1 gap-2">
        <div class="flex items-center justify-center gap-[0.4rem] sm:gap-[1rem]">

          <a href="/" class="hover:text-gray-400 hover:underline text-sm sm:text-lg text-nowrap">Home</a>
          <a href="/cv-data" class="hover:text-gray-400 hover:underline text-sm sm:text-lg text-nowrap">Create CV</a>
          <a href="Contact" class="hover:text-gray-400 hover:underline text-sm sm:text-lg text-nowrap">Contact Us</a>
        </div>
        <p class="text-center text-sm md:text-base lg:text-lg xl:text-xl  ">&copy; Project JobPortal 2024. All rights reserved.</p>
      </div>


    </section>
  </footer>

  <!-- acrpti for footer togeling -->
  <script>
    let rotate = false

    function footer() {
      let footer = document.getElementById('footerbtn');
      let footerArrow = document.querySelector('.footerArrow');

      if (rotate) {
        footerArrow.style.transform = 'rotate(45deg)'
        rotate = false
      } else {
        footerArrow.style.transform = 'rotate(0deg)';
        rotate = true
      }
      footerbtn.classList.toggle('hidden');
    }
  </script>

  <!-- acrpti for footer togeling ends -->


  <!-- scrollreveal js library  -->
  <script>
    let cardanimate = {

      reset: true,
      distance: '20px',
      origin: 'bottom',
      duration: 2600,
      opacity: '0.5',

    }

    ScrollReveal().reveal('.card', cardanimate, {
      easing: 'ease-out'
    });
  </script>
  <!-- scrollreveal js library  ends-->




  <!-- js for toggling -->
  <script>
    var menu = document.getElementById("menu");

    function toggleMenu() {
      menu.classList.toggle("hidden");
    }
  </script>


  <!-- logout messsage disapperar -->
  <script>
    const myMsg = document.getElementById('myMsg');


    if (myMsg.innerHTML !== '') {
      setTimeout(() => {

        myMsg.style.display = 'none';
      }, 4000);
    }
  </script>
  <!-- logout messsage disapperar -->

  <!-- script for if press empty filed searh button -->

  <script>
    function searchCheck(event) {
      let searchquery = document.getElementById('searchquery').value;
      // let search=document.getElementById('search').value;
      console.log(searchquery);

      if (!searchquery) {
        console.log('hi');
        event.preventDefault();
        Swal.fire("Empty Search🤔!");
      } else {

        return true;
      }

    }
  </script>
  <!-- script for if press empty filed searh button ends -->

</body>
<script>
  let Element = document.querySelector('.split');

  let String = "Find Your Dream Tech Job";

  let arr = Array.from(String);


  arr.forEach((ele, i) => {

    setTimeout(() => {
      Element.textContent += ele;

    }, 50 * i);


  })
</script>

</html>