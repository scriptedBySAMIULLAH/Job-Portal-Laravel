<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JobFeed</title>
  @vite('resources/css/app.css')
  <!-- for sweetalert library -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- for sweetalert library ends-->

  <!-- this is the reveale js library -->
  <script src="https://unpkg.com/scrollreveal"></script>

  <!-- this is the reveale js library ends-->

</head>

<body class="font-body">
  @include('navbar')

  <!-- nav bar js -->
  <div class="container mx-auto">

    @include('errMsg')
  </div>


  <!-- search and locations  start here -->
  <div>

    <div class="w-full px-8 sm:px-10  sm:h-16 md:h-32 gap-1 sm:gap-2 border flex  space-y-4 sm:space-y-0 flex-col items-center justify-center flex-wrap  ">
      <div class="w-[17rem] sm:sm:w-[30rem] flex items-center border border-black shadow-bottom   rounded flex-wrap bg-slate-100">

        <form action="{{route('jobfeed')}}" method="get" class="flex items-center justify-center">
        
          <input type="search" name="searchquery" id="searchquery" class=" px-1 sm:px-4  py-2  bg-slate-100 rounded w-[15rem] sm:w-[25rem] inline-flex items-center outline-none focu:ring ring-indigo-400 text-sm sm:font-normal sm:text-base" placeholder="Search Job title/skills/companies">
      </div>


      <div class="w-[17rem] sm:sm:w-[25rem] inline-flex items-center border border-black shadow-bottom bg-slate-100"> 
        <!-- location -->
        <label for="locations"></label>

        <select name="location" id="location" class="pl-[4rem] sm:pl-[8rem] pr-[2rem]  sm:pr-[5rem]  h-[35px] overflow-y-auto  bg-slate-100 text-sm">
          <option value="" class="text-slate-400">Location</option>
          @foreach ( $locations as $loc)

          <option value="{{$loc->id}}">{{$loc->name}}</option>
          @endforeach
        </select>
          <!-- location ends -->
       <button type="submit" class="bt4" onclick=" checkempty(event)">Search</button>
          </form>
        
      </div>

    </div>
  </div>
  <!-- search and locations  start  ends here -->





  <!-- cards -->
  <br>



  <div class="px-2 sm:container mx-auto py-4">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 overflow-hidden ">
      @foreach ($jobs as $job )
      @if (!\Carbon\Carbon::now()->greaterThan($job->endson))


      <div class="card flex flex-col flex-wrap  px-2 py-1  shadow-lg rounded-lg    text-black border  border-pink-900  space-y-2 group bg-white hover:bg-slate-200">



        <div class="flex gap-1  mb-0">
          <img src="{{asset('storage/'.$job->User->companyinfo->picture)}}" alt="NoLogo" srcset="" class="object-cover rounded-md h-6   w-6 ">
          <!-- company svg -->
          <h3 class="text-lg text-blue-500 flex items-center hover:text-blue-400 underline"> <a href="{{route('CompanInfo',['id'=>$job->User->companyinfo->id])}}" class="text-base text-blue-700 mt-1 flex items-center  hover:text-blue-500 underline"> {{$job->User->companyinfo->companyname}}<svg xmlns="http://www.w3.org/2000/svg" focusable="false" role="img" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" class=" css-r5jz5s eac13zx0 h-4 w-6" class="underline">
                <path d="M14.504 3a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h3.085l-9.594 9.594a.5.5 0 000 .707l.707.708a.5.5 0 00.707 0l9.594-9.595V9.5a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-6a.5.5 0 00-.5-.5h-6z"></path>
                <path d="M5 3.002a2 2 0 00-2 2v13.996a2 2 0 001.996 2.004h14a2 2 0 002-2v-6.5a.5.5 0 00-.5-.5h-1a.5.5 0 00-.5.5v6.5L5 18.998V5.002L11.5 5a.495.495 0 00.496-.498v-1a.5.5 0 00-.5-.5H5z"></path>
              </svg></a></h3>

        </div>
        <h2 class="text-xl text-black ">{{$job->jobtitle}}</h2>
        <p class="text-green-800 flex"> <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="24px" fill="#032B49 " class=" ">
            <path d="M480-301q99-80 149.5-154T680-594q0-90-56-148t-144-58q-88 0-144 58t-56 148q0 65 50.5 139T480-301Zm0 101Q339-304 269.5-402T200-594q0-125 78-205.5T480-880q124 0 202 80.5T760-594q0 94-69.5 192T480-200Zm0-320q33 0 56.5-23.5T560-600q0-33-23.5-56.5T480-680q-33 0-56.5 23.5T400-600q0 33 23.5 56.5T480-520ZM200-80v-80h560v80H200Zm280-520Z" class="text-2xl" />
          </svg>{{$job->location->name}}</p>
        <p class="line-clamp-3">{{$job->description}}</p>


        <div class="flex flex-1 flex-wrap gap-1 sm:gap-2 justify-around text-base sm:text-lg">

          <!-- jobtype -->
          <span class="inline-flex justify-center items-center   px-1 rounded-sm text-sm   text-blue-800"><svg xmlns="http://www.w3.org/2000/svg" focusable="false" height="20px" role="img" fill="currentColor" viewBox="0 0 20 20" data-testid="section-icon" aria-hidden="true" class="js-match-insights-provider-1pdva1a eac13zx0">
              <path fill-rule="evenodd" d="M10 3C7 3 6 6 6 6H2.5a.5.5 0 00-.5.5V9h16V6.5a.5.5 0 00-.5-.5H14s-1-3-4-3zm2.5 3h-5s1-1.5 2.5-1.5S12.5 6 12.5 6z" clip-rule="evenodd"></path>
              <path d="M8 11H2v5.5a.5.5 0 00.5.5h15a.5.5 0 00.5-.5V11h-6c0 1-1 2-2 2s-2-1-2-2z"></path>
            </svg>
            <path fill-rule="evenodd" d="M10 3C7 3 6 6 6 6H2.5a.5.5 0 00-.5.5V9h16V6.5a.5.5 0 00-.5-.5H14s-1-3-4-3zm2.5 3h-5s1-1.5 2.5-1.5S12.5 6 12.5 6z" clip-rule="evenodd"></path>{{$job->jobtype}}
          </span>

          <!-- jobtypends -->
          <!--  profiency-->

          <span class="inline-flex justify-center items-center   px-1 rounded-sm text-sm   text-green-900 "><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FB2C">
              <path d="M640-160v-280h160v280H640Zm-240 0v-640h160v640H400Zm-240 0v-440h160v440H160Z" />
            </svg>{{$job->profiency}}</span>

          <!-- profiency ends -->
          <!-- experiencelevel -->
          <span class="inline-flex justify-center items-center   px-1 rounded-sm text-sm    text-purple-800"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#6c5ce7">
              <path d="M238-120q-19 0-30-15.5t-6-33.5l178-643q4-13 14-20.5t23-7.5q20 0 31 15.5t6 33.5l-20 71h225l25-92q4-13 14.5-20.5T722-840q19 0 30 15.5t6 33.5L580-148q-4 13-14 20.5t-23 7.5q-20 0-31-15.5t-6-33.5l20-71H301l-25 92q-4 13-14.5 20.5T238-120Zm141-400h224l33-120H412l-33 120Zm-55 200h224l33-120H357l-33 120Z" />
            </svg>{{$job->experiencelevel}}</span>
          <!-- experiencelevel ends -->

          <!-- salary -->
          <span class="inline-flex justify-center items-center   px-1 rounded-sm text-sm   text-yellow-80 ">💰{{$job->salary}}</span>

          <!-- salary ends-->

        </div>


        <div class="flex px-4 items-center justify-evenly gap-1">

          <a href="{{route('jobsummary',['id'=>$job->id])}}" class="rounded-md px-2 hover:text-white bg-transparent border border-purple-800 text-gray-600 transition transform duration-150 ease-in-out hover:scale-90   hover:bg-black">ReadMore</a>
          <p class="text-slate-500 inline-block text-nowrap">{{$job->created_at->toFormattedDateString()}}</p>
        </div>

      </div>
      @endif
      @endforeach

      <!-- paginate -->
      @if (!$searchquery)
      <p classs="flex justify-center bg-white shadow-md">{{ $jobs->links() }}</p>
      @endif
      <!-- paginate ends-->
    </div>
  </div>
  <!-- cards ends -->

  <!-- scroll js libraary  -->
  <script>
    let animatecard = {
      reset: true,
      origin: 'top',
      duration: '2600',
      distance: '16px',
      opacity: '0.5'

    }

    ScrollReveal().reveal('.card', animatecard, {
      easing: ':ease-in'
    })
  </script>
  <!-- scroll js libraary  ends-->

  <!-- navscrpt -->
  <script>
    var menu = document.getElementById("menu");

    function toggleMenu() {
      menu.classList.toggle("hidden");
    }
  </script>
  <!-- navscrpt ends-->
  <!-- ////////////////////////check that user cant submit empty form///////////////// -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function checkempty(event) {

      let search = document.getElementById('searchquery').value;
      let loc = document.getElementById('location').value;
      console.log(search);
      console.log(loc);
      if (search === '' && (loc === '' || loc === '#')) {
        event.preventDefault();
        Swal.fire("Empty Search🤔!");//for empty

      } else if (search === '') {
        event.preventDefault();

      } else if ((loc === '' || loc === '#')) {
        event.preventDefault();

      } else {
        return true //this tells that if search not empty go and search

      }
      return true

    }
  </script>


</body>
<!-- search invalid msg dissapperae -->
<script>
  let mymsg = document.getElementById('mymsg');

  if (mymsg) {


    setTimeout(() => {
      mymsg.style.display = 'none'


    }, 5000)
  }
</script>
<!-- search invalid msg dissapperae -->

</html>