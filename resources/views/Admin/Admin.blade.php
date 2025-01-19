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

<body class="text-black bg-slate-300">


  @if (session("UserDeleted"))
  <script>
    Swal.fire('Deleted')
  </script>
  @endif
  @include('Admin.admin_nav');

  <div class="flex items-center  justify-center text-black mt-4 sm:mt-4 mb-0 sm:mb-8">
    <div class="max-w-screen-lg border border-black  mx-auto  overflow-x-auto overflow-y-auto  ">
      <div class="flex justify-evenly items-center ">

        <form action="{{route('Search')}}" method="get">
          @csrf
          <input type="hidden" name="role" value="searchuser">
          <input name="searchuser" type="Search" placeholder="Search users/Filter on role" class="px-4 py-1 outline-none ring-0 rounded-md button placeholder-slate-700" autocomplete="off">
          <button class="button">Search</button>
        </form>

      <!-- verfied and unverified check -->

      <form action="{{route('user_filters')}}" method="get">
          <label for="verfied" class="text-slate-800 font-montserrat">Verfied/Unverified</label>
          <select name="verifiedChk" id="verified" class="rounded-md px-2 py-2 bg-gray-300" onchange="this.form.submit()">
          <option value="#" selected>Select</option>
            <option value="0">Unverified</option>
            <option value="1">Verfied</option>
          </select>
          </form>
             <!-- verfied and unverified check ends-->
      </div>
      <table border="1" class="table-fixed overflow-x-auto min-w-full overflow-y-auto  hover:opacity-100  border-black text-black">
        <thead class="bg-slate-500 text-white">
          <tr class="hover:bg-slate-500">
            <th class="w-1/2 py-3  thfont">Id</th>
            <th class="w-1/6 py-3  thfont">Name</th>
            <th class="w-1/6 py-3  thfont">Email</th>
            <th class="w-1/6 py-3 ">Role</th>
            <th class="w-1/6 py-3  thfont">Status</th>
            <th class="w-1/6 py-3  thfont">Block/Unblock</th>

            <th class="w-1/6 py-3 thfont ">Delete</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($users as $user)
          <tr class="hover:bg-gray-500">
            <td class=" py-3 px-4 text-center">{{ $user->id}}</td>
            <td class=" py-3 px-4 text-center ">{{$user->name}}</td>
            <td class=" py-3 px-4 text-center">{{ $user->email}}</td>
            <td class="py-3 px-4  text-center">{{ $user->role}}</td>
            <td class="py-3 px-4  text-center  ">{{ $user->status}}</td>
            <td class="py-3 px-4  text-center">
              <form action="{{route('Admin_Block_Unblock_User',['id'=>$user->id])}}" method="post">
                @csrf
              

                <button type="submit" id="btn" class="button status">{{ $user->status}}</button>


              </form>

            <td class="py-3 px-4  text-center">
              <form action="{{route('AdminDeleteUser',['id'=>$user->id])}}" method="post">
                @csrf
                @method('Delete')
             
                <button type="submit" class="button opacity-100 hover:opacity-80 duration-150 border hover:border-red-700 hover:bg-red-200">Delete</button>


              </form>


            </td>
          </tr>

          @endforeach

        </tbody>


      </table>
      <p>{{$users->links()}}</p>


    </div>
  </div>
  </div>
</body>
<!-- scr for Block/Unblock -->
<script>


let  Status=document.querySelectorAll('.status');

Status.forEach((ele)=>{

if(ele.textContent=='Block'){
ele.textContent='Unblock';
ele.style.background='rgba(0,200,0,1)'
}

if(ele.textContent=='Active'){
ele.textContent='Block';
ele.style.background='rgba(180,0,0,1)'

}
})

</script>

<!-- scr for Block/Unblock ends-->

</html>