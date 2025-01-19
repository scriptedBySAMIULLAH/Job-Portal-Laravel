<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Browse Candidates</title>
    @vite('resources/css/app.css')
    @include('errMsg')
</head>


<body class="bg-slate-200 font-body space-y-4">
    <div class="hidden w-[30%]" id="msg">
        <p class="flex items-center justify-center flex-col border bg-red-500 rounded-lg px-4 py-2 text-white font-bold p-2 " id="Msg"> Please enter a search term</p>
    </div>
    <div class="text-center text-base  sm:text-3xl text-[#174b82] font-bold w-full mb-4">
        <h1 class=" user hidden">Hi,{{auth()->user()->name}}</h1>
        <p class="text-4xl  font-Roboto text-[#154981]" id="split"></p>
        <h1>Find your Next Great Hire and connect with top talent</h1>
    </div>



 

        <!-- searching starts -->
        <form action="{{route('candidate_Search_filter')}}" method="post" id="Searchform" class="mb-4  w-full relative  flex flex-wrap    justify-center items-center gap-6">
            @csrf
            <div class="flex sm:flex-row justify-center flex-wrap flex-col items-center">
                <input id="search" type="search" name="searchCandidate" class=" w-full  sm:w-[60%] p-2 pl-6 outline-none  rounded-full sm:focus:w-3/4 focus:ring-1 ring-[#154981] placeholder-slate-500" placeholder="Search by profession,location,skills">

                <button id="btn" type="submit" class="  text-[#174b89] font-semibold bg-gray-100 p-2 rouned-md">Search</button>
            </div>
            

    <div class="wrapper w-full max-w-7xl h-full">

        <!-- filters -->
        <header class=" flex flex-wrap flex-col items-center justify-center gap-[2rem] sm:justify-around sm:flex-row">
            <div class="text-center">
                <label for="experience_level" class="font-normal sm:font-semibold">Experience_level</label>&nbsp;
                <select name="experience_level" id="experience_level" class="p-2 bg-[#b6bdc3] rounded-md hover:border-[#174b89]">
                    <option value="" disabled selected>Experience_level</option>
                    <option value="entry_level">Entry-Level (0-2 years)</option>
                    <option value="junior">Junior/Associate (2-4 years)</option>
                    <option value="mid_level">Mid-Level (4-7 years)</option>
                    <option value="senior">Senior-Level (7-10 years+)</option>
                </select>
            </div>

            <!-- filters ends-->
          
            <!-- search ends -->
        
       
        <!-- filters end -->
    </div>
    </form>

    <main class="h-full grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 place-content-center place-items-center px-4 py-4 max-w-7xl gap-4">
 
            @foreach ( isset($searchResults)?$searchResults:[] as $ele)
        <div class="card flex max-w-[24rem] max-h-64 shadow-2xl rounded-md flex-col items-center flex-wrap justify-center sm:space-y-6 space-y-4 group px-2 sm:px-4 sm:py-4  bg-blue-100 hover:bg-blue-200 ">

            <div class="name_image relative overflow-hidden flex   flex-wrap felx-col  justify-center items-center sm:gap-[1rem] gap-[0.8rem]">
                
                <img src="{{asset('storage/cv_images/'.$ele->img)}}" alt="img" class="sm:w-16 sm:h-16 object-cover sm:rounded-full w-[5rem]  h-[5rem] rounded">
                

                <p class="name text-base font-semibold sm:text-xl font-serif">{{ $ele->name}}</p>


            <div class="profession">
                <p class="text-gray-600 font-serif">{{$ele->profession}}</p>

            </div>

            <div class="yourself ">
                <p class="line-clamp-2 text-base text-gray-700 sm:font-normal basis-[4ch]">{{$ele->yourself}}</p>
            </div>

            <div class="seeProfile relative">
                <button class="bg-teal-700 hover:bg-teal-800 px-4 py-2 rounded-md font-lora text-white">
                    <a href="{{URL::to('browseCandidateCompany/'.$ele->user_id)}}">View</a> </button>
            </div>
        </div>
        </div>
        @endforeach
    </main>

</body>

<script>

     
    let search = document.getElementById('search')
    let msg = document.getElementById('msg')
    let Searchform = document.getElementById('Searchform')
    Searchform.addEventListener('submit', (e) => {

        if (!search.value.trim()) {
            e.preventDefault();
            msg.classList.remove('hidden')
            setTimeout(() => {

                msg.classList.add('hidden')
            }, 5000);

        }
    })
</script>


<script>

       let userName= document.querySelector('.user').innerHTML;
       let arr=Array.from(userName);
       arr.forEach((element,i) => {
    let split = document.getElementById('split')

        setTimeout(() => {
            console.log(element);
            
            split.textContent+= element
            
        }, 500*i);
        
       });
       
</script>

</html>