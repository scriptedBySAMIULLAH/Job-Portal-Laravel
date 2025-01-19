<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mr.Admin</title>
    @vite('resources/css/app.css')
      <!-- for sweetalert library -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- for sweetalert library ends-->
    
</head>

@if (session('JobDeleted'))
  <script>
    Swal.fire('Deleted')
  </script>
  @endif
<body class="text-black bg-slate-300">
@include('Admin.admin_nav')

<div class="flex items-center  justify-center   mt-6 mb-8">
        <div class="max-w-screen-lg border border-black mx-auto">
      <div class="flex justify-end">
         <form action="{{route('Search')}}" method="get">

      <input type="hidden" name="role" value="searchqueryJob">
        <input name="searchquery" type="Search" placeholder="Search Jobs" class="px-4 py-1 outline-none ring-0 rounded-md button placeholder-slate-700 hover:placeholder-gray-800" autocomplete="off">
      <button class="button text-black">Search</button>
      </form> 
      
      </div>
      
        <table border="1" class="table-fixed overflow-x-auto min-w-full overflow-y-auto  hover:opacity-100 border-black">
    <thead class="bg-slate-500 text-white">
        <tr>
            <th class="w-1/2 py-2 ">Id</th>
            <th class="w-1/6 py-2 " >Jobtitle</th>
            <th class="w-1/2 py-2 ">Created at</th>
            <th class="w-1/6 py-2 ">User Name</th>
            <th class="w-1/6 py-2 ">Salary</th>
            <th class="w-1/6 py-2 whitespace-nowrap">Company</th>
            <th class="w-1/6 py-2 ">View</th>
            <th class="w-1/6 py-2 ">Delete</th>
        </tr>
    </thead>
    <tbody>

            @foreach ($jobs as $job)
                
           
    <tr  class="hover:bg-slate-500">
            <td class=" py-3 px-4 text-center ">{{$job->id}}</td>
            <td class=" py-3 px-4 text-center ">{{$job->jobtitle}}</td>
            <td class=" py-3 px-4 text-center text-nowrap">{{$job->created_at->toFormattedDateString()}}</td>
            <td class="py-3 px-4  text-center">{{$job->User->name}}</td>
            <td class="py-3 px-4  text-center">{{$job->salary}}</td>
            <td class="py-3 px-4  text-center">{{$job->User->companyinfo->companyname}}</td>  
            <td class="py-3 px-4  text-center"><a  href="{{URL::to('jobsummary/'.$job->id)}}" class="button  hover:bg-blue-400 hover:border-blue-300">View</a></td>
            <td class="py-3 px-4  text-center">
            <form action="{{route('AdminDeleteJob',['id'=>$job->id])}}" method="post">
                @csrf
                @method('DELETE')

                <button type="submit" class="button opacity-100 hover:opacity-80 duration-150 border hover:border-red-700 hover:bg-red-200">Delete</button>
              </form>

         
        </tr>
       
  
        @endforeach
    </tbody>
   

</table>

<p >{{$jobs->links()}}</p>
       
        </div>
        
        </div>
</body>

</html>