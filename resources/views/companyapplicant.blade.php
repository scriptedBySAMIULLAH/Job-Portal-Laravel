<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Applicants</title>
  @vite('resources/css/app.css')
  <!-- link for Cv -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- link for Cv ends -->

</head>
<div class="max-w-sm">
@include('errMsg')
</div>
<body class="bg-slate-200">
  <h1 class="heading text-center ">Applicants</h1>
  <!-- Jobseekers Applications -->

  <div id="Applications" class="flex-1 p-4  mt-2">
    <div class="flex justify-between">
      
    <div class="border border-black bg-transparent w-fit opacity-70 hover:opacity-100 duration-300 pr-2 ">
      <a href="javascript:history.back()" class="flex items-center font-semibold text-gray-5 rounded00">

        <svg class="w-4 h-4 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>

        Back</a>

        </div>

        <div>
       
        <form action="{{route('companyapplicant')}}" method="get" id="status" class="applicants ">
            <div class="flex space-x-2 items-center">
            <p class="font-bold text-gray-700">Sort by</p>
          
              <select name="sortStatus" class="   px-3 py-1  text-gray-900 bg-white border border-gray-700 rounded p-2 focus:border-blue-500 hover:bg-gray-100"
              onchange="this.form.submit()">
              <option value="" >Select Status</option>
                <option value="Pending" {{request('sortStatus')=='Pending'?'selected':''}}>Pending</option>
                <option value="Shortlisted" {{request('sortStatus')=='Shortlisted'?'selected':''}} >Shortlisted</option>
                <option value="Rejected"  {{request('sortStatus')=='Rejected'?'selected':''}}>Rejected</option>
                <option value="Accepted"  {{request('sortStatus')=='Accepted'?'selected':''}}>Accepted</option>
              </select>
<input type="reset" value="Reset" class="px-3 py-1 text-gray-900 bg-white border border-gray-700 rounded hover:bg-gray-100 focus:outline-none">
            </form>
            </div>
        </div>
      

     
    </div>
    <div class="w-full p-2 sm:p-4  ">
      <div class="grid container gap-4 sm:gap-6 mx-auto sm:grid-cols-2 place-content-center place-items-center">
        @foreach ($jobapplicants as $eachrecord)
        <div class="card flex flex-col space-y-2 sm:space-y-4 p-4 shadow-xl sm:p-6  rounded-md hover:bg-white  flex-1">
          <div class="flex gap-4 sm:gap-6 items-center">
            <img src="{{asset('storage/'.$eachrecord->jobseeker->picture)}}" alt="applicant_image" class="h-16 w-16 rounded-full" />

            <div class="">
              <h2 class="text-lg font-semibold text-gray-700">{{$eachrecord->jobseeker->user->name}}</h2>
              <p class="text-gray-700">{{$eachrecord->jobseeker->user->email}}</p>
              <p class="text-gray-700 font-bold">{{$eachrecord->jobseeker->user->basicBio->profession??' '}}</p>
             
            </div>

          </div>

          <p class="text-gray-600 text-sm"><span>Applied on:</span> {{ $eachrecord->created_at->toFormattedDateString()}}</p>

          <p class="text-gray-700 text-sm">Job Title:{{$eachrecord->jobs->jobtitle}}</p>
          <div class="flex gap-4 items-center mb-4">
            <p class="font-Roboto text-sm text-gray-800">Status</p>
            <form action="{{route('changeStatus')}}" method="get" id="status-{{$eachrecord->id}}" class="applicants ">
              <input type="hidden" name="id" value="{{$eachrecord->id}}">
              <label for="status"> </label>
              <select name="status" class="statusColor   px-3 py-1  text-gray-900 bg-white border border-gray-300 rounded p-2 focus:border-blue-500 hover:bg-gray-100" onchange="applicantFunction('{{$eachrecord->id}}')">
                <option value="Pending" {{$eachrecord->status=='Pending' ? 'selected' :' '}}>Pending</option>
                <option value="Shortlisted" {{$eachrecord->status=='Shortlisted' ? 'selected' :' '}}>Shortlisted</option>
                <option value="Rejected" {{$eachrecord->status==='Rejected' ? 'selected' :' '}}>Rejected</option>
                <option value="Accepted" {{$eachrecord->status==='Accepted' ? 'selected' :' '}}>Accepted</option>
              </select>

            </form>
          </div>
          <div class="space-x-2 flex">
            <a href="{{asset('storage/'.$eachrecord->cv)}}" class="px-2 py-1 rounded-md shadow-sm text-white bg-green-400 hover:bg-green-500 ">View Cv</a>

            <a href="{{route('jobsummary',['id'=>$eachrecord->jobs->id])}}" class="px-2 py-1 rounded-md shadow-sm  bg-blue-400 hover:bg-blue-500 text-white"> View Job</a>


            <button class="px-2 py-1 rounded-md appDlt shadow-sm text-white bg-red-400 hover:bg-red-500" data-id="{{$eachrecord->id}}">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff">
                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
              </svg></button>
          </div>


        </div>
        @endforeach
      </div>

    </div>
   @if (!request('sortStatus'))
   <p>{{$jobapplicants->links()}}</p>
   @endif
   
 
  </div>
  <!-- Jobseekers Applications ends -->
</body>

@include('successMsg')




<!-- color on status -->
<script>

  
  let statusColor = document.querySelectorAll('.statusColor');

  // console.log(statusColor.value);

  statusColor.forEach((ele) => {
    // console.log(ele.value);

    if (ele.value === 'Pending') {
      ele.style.background = 'rgba(211, 211, 211, 1)'
      // console.log('heeeeeeeeeeeee');
    } else if (ele.value === 'Rejected')

    {
      ele.style.background = 'rgba(255,0,0,0.5)'
      // console.log('hooooooo');

    } else if (ele.value === 'Shortlisted') {

      ele.style.background = 'rgba(0, 128, 128, 0.5)'
    } else if (ele.value === 'Accepted') {

      ele.style.background = 'rgba(0, 255, 0, 0.5)'
    } else {

      console.log('heeeeeeehhiiieeeeee');
    }
    // console.log(statusColor);

  })
</script>
<!-- color on status end -->



<!-- a logic for the status -->
<script>
  function applicantFunction(id) {

    let form = document.getElementById('status-' + id)
    // form
    // console.log(new FormData(form));
    form.submit();
  }
</script>
<!-- a logic for the status ends-->

<!-- fro deleting applicant -->

<script>
  let appDlt = document.querySelectorAll('.appDlt');
  appDlt.forEach((ele) => {

    ele.addEventListener('click', function() {

      let appid = this.getAttribute('data-id');
      console.log(appid);
      fetch(`delApp/${appid}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      }).then(response => {

        if (!response.ok) {

          throw new Error('something Fishy Fishy🐟');
        }
        return response.json();
      }).then(data => {
        // as it comes as array entires or obj
        const [status, msg] = data;

        alert('Success');

        ele.closest('.card').remove();
      }).catch(err => {

        alert('Error to Delete');
      });



    });
  })
</script>
<!-- fro deleting applicant ends -->

</html>