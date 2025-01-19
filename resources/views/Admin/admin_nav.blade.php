<nav>

    <ul class=" flex flex-col items-center sm:flex  sm:flex-row justify-evenly bg-black text-yellow-600  sm:py-6 space-y-4   sm:space-y-0 h-full  sm:h-[25px] px-4  rounded-md shadow-md text-sm sm:text-base sm:font-medium">

      <li class="hover:bg-gray-700 hover:rounded-md px-2"><a href="{{route('AdminIndex')}}">Users</a>
    </li>
      <li class="hover:bg-gray-700 hover:rounded-md px-2"><a href="{{route('adminjobs')}}">Jobs</a>
    </li>
      <li class="hover:bg-gray-700 hover:rounded-md px-2"><span class="hover:bg-gray-700 hover:rounded-md px-2"><a href="{{route('Admin_messages')}}">User Messages</a></li>

      <li class="hover:bg-gray-700 hover:rounded-md px-2"><span class="hover:bg-gray-700 hover:rounded-md px-2"><a href="{{route('add_skill_show')}}">Add Skill</a></li>

      <li class="hover:bg-white hover:rounded-md px-1">

        <form action="{{route('Logout')}}" method="post">
          @csrf
          <button class="flex  py-1 px-2 text-red-500 hover:text-red-400">Logout</button>
        </form>

      </li>
      <li class="hover:bg-gray-700 hover:rounded-md px-2 text-indigo-500 "><span class="text-white hover:text-gray-800">Hello</span>,{{auth()->user()->name}}</li>


    </ul>

  </nav>