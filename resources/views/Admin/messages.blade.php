<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>messages</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- /////////////////sweetalert js///////////////////////    -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- /////////////////sweetalert js ends//////////////////////    -->

    <!-- for sweetalert library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- for sweetalert library ends-->
</head>

<body class=" font-body flex flex-col  bg-cover bg-no-repeat bg-center bg-blend-overlay bg-black/70" style="background-image: url(https://cdn.pixabay.com/photo/2014/07/01/15/40/balloon-381334_1280.png);">
    @if(session('success'))
    <script>
        Swal.fire('Thank you for Contacting');
    </script>
    @endif
  
    <strong class="text-4xl font-bold text-center text-white">Messages</strong>
    <a href="javascript:history.back()" class="text-white font-Roboto font-bold"><-Back</a>
    <div class="grid  grid-cols-1 sm:grid-cols-3 gap-4  mt-4 ">

        <!-- loop -->

        @foreach ($allMessages as $message)

        <div class=" card min-h-64 transition transform hover:scale-105 gap-4 flex flex-wrap   shadow-lg rounded-lg sm:px-2   text-black  ">

            <div class="bg-white rounded-md px-2">


                <span class="text-base sm:text-lg" id="user">{{$message->Usermessage->name}}</span>




                <p class=" text-base sm:text-lg font-normal   ">
                <p class="text-blue-700"> {{$message->Usermessage->email}}</p>

                </p>

                <span class="font-bold">Role &nbsp; {{$message->Usermessage->role}}</span>





                <p class="w-full text-gray-800"><span class="font-semibold">Subject</span> &nbsp;&nbsp;{{$message->subject}}</p>



                <div class="flex flex-col items-center justify-between  ">
                    <p>{{$message->message}}</p>
                    <p class="text-gray-600"> {{$message->created_at->toFormattedDateString()}}</p>




                    <form action="{{route('Admin_messages-delete',['id'=>$message->id])}}" method="post" class="flex ">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="fixed bottom-0 right-[0.9rem] hover:text-red-600">Delete</button>


                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>



</body>

</html>