<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Company Info</title>
  @vite('resources/css/app.css')


  <!-- /////////////////sweetalert js///////////////////////    -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- /////////////////sweetalert js ends//////////////////////    -->

  <!-- for sweetalert library -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- for sweetalert library ends-->
</head>

<body class="font-body bg-slate-100 ">
  <div class="border border-black bg-transparent w-fit opacity-70 hover:opacity-100 duration-300 pr-2 mt-4">
    <a href="javascript:history.back()" class="flex items-center font-semibold text-gray-5 rounded00">

      <svg class="w-4 h-4 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>

      Back</a>
  </div>

  <div class="w-full  flex justify-center flex-col items-center rounded-md  sm:px-6 ">

    <div class="max-w-xl border border-black mx-auto p-2 rounded-md sm:px-8  sm:space-y-2 space-y-4 bg-white backdrop-blur-lg bg-opacity-25">
      <div class="flex px-2 justify-evenly items-center gap-2 sm:gap-6 backdrop-blur-2xl backdrop-brightness-50 bg-gradient-to-r from-gray-200 via-gray-400 to-gray-600/30 rounded-md ">
        <div class="flex items-center gap-2">
          <img class="object-cover h-16 w-16 rounded-full" src="{{asset('storage/'.$CompanInfo->picture)}}" alt="" srcset="" />
          <p class="font-semibold">{{$CompanInfo->companyname}}</p>
        </div>
        <p class="flex font-semibold text-gray-700 basis-1/4"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#12A">
            <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
          </svg>{{$CompanInfo->User->name}}</p>
        <!-- ratings -->
        <div class="flex items-center">

          @if ($companyRating===0)


          <p class="text-gray-700">No Rating Yet!</p>
          </svg>
          @endif
          <!-- @php
          
          $totalRating = ($companyRating * 100) / 5;
          @endphp -->


          @if ($companyRating)
          <div class="flex items-center">
        <div class="flex text-yellow-500">
            @for ($i = 1; $i <= 5; $i++)
                <svg class="w-5 h-5 {{ $i <= $companyRating ? 'fill-current' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.431 8.25 1.194-5.956 5.792 1.408 8.192L12 18.896l-7.37 3.87 1.408-8.192-5.956-5.792 8.25-1.194z"/></svg>
            @endfor
        </div>
        <!-- <span class="ml-2 text-gray-700">{{ number_format($totalRating, 0) }}%</span> -->
    </div>

          @endif
          <p class="flex justify-center text-gray-600">/{{$companycount}}</p>
        </div>
      </div>
      <!-- description -->
      <div class="text-base space-y-1 flex-1">
        <span class="font-semibold ">About</span>
        <p>
          {{$CompanInfo->description}}
        </p>
      </div>
      <!-- description ends -->

      <!-- tags -->
      <div class="flex justify-evenly flex-1 items-center text-sm sm:text-base gap-2">
        <span class="inline-block px-2 py-2 bg-transparent  hover:bg-slate-300  border border-black font-medium text-center rounded-md shadow-lg text-gray-800">Type:&nbsp;{{$CompanInfo->company_type}} </span>
        <span class="inline-block px-2 py-2 bg-transparent  hover:bg-slate-300 border border-black font-medium text-center rounded-md shadow-lg text-gray-800">Employees:&nbsp;{{$CompanInfo->numberofemployees}}</span>
        <span class="inline-block px-2 py-2 bg-transparent border hover:bg-slate-300  border-black font-medium text-center rounded-md shadow-lg text-gray-800">Location:&nbsp;{{$companyLocationName}} </span>

      </div><!-- tags ends-->

      <!-- weburl -->
      <div class=" font-bold hover:underline flex "><a href="{{$CompanInfo->websiteurl}}" class="flex text-blue-800 mt-1 sm:mt-2 hover:text-blue-400">Visit Website<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#12A" class="hover:text-blue-400">
            <path d="M440-280H280q-83 0-141.5-58.5T80-480q0-83 58.5-141.5T280-680h160v80H280q-50 0-85 35t-35 85q0 50 35 85t85 35h160v80ZM320-440v-80h320v80H320Zm200 160v-80h160q50 0 85-35t35-85q0-50-35-85t-85-35H520v-80h160q83 0 141.5 58.5T880-480q0 83-58.5 141.5T680-280H520Z" />
          </svg></a>

      </div>

      <!-- weburl ends-->
      <div class="text-blue-800 flex flex-row-reverse hover:text-gray-400">
        <p>{{$CompanInfo->companyemail}}</p>
      </div>

      <div class=" flex flex-row-reverse justify-center space-y-4">
        <form action="{{route('RateCompany')}}" method="post">
          @csrf
          <input type="hidden" name="companyid" value="{{$CompanInfo->id}}">
          <div class=" flex  gap-6  justify-evenly items-center ">
            <label for="ratings" class="text-gray-700 block">Rate a Company</label>
            <select name="ratings" id="ratings" class="bg-slate-300 text-center flex items-center justify-center rounded-lg px-4">
              <option value="1">⭐</option>
              <option value="2">⭐⭐</option>
              <option value="3">⭐⭐⭐</option>
              <option value="4">⭐⭐⭐⭐</option>
              <option value="5">⭐⭐⭐⭐⭐</option>
            </select>
            @if (Auth::check() && Auth::User()->role==='jobseeker')
            <!-- <button type="submit" class="bg-trasnparent p-2 hover:bg-black"></button> -->
            <button type="submit" class="btn3">Rate</button>
            @endif
            <!-- //if not login Show -->
            <a href=javascript:void(0); onclick="notLoginRate()" type="disabled" class="btn3">Rate</a>

          </div>
        </form>
      </div>





    </div>

  </div>
</body>

<!-- if user not login then rate -->
<script>
  function notLoginRate() {
    Swal.fire('Please Login First')


  }
</script>
<!-- if user not login then rate -->

@if (session('alreadyRated'))
<script>
  Swal.fire('You already rated 🤔');
</script>
@endif


@if (session('Rated'))
<script>
  Swal.fire('Thanks,For Your valuable Feedback😊');
</script>
@endif


</html>