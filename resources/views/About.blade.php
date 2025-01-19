<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About</title>
  @vite('resources/css/app.css')

  <!-- this is the reveale js library -->
  <script src="https://unpkg.com/scrollreveal"></script>

  <!-- this is the reveale js library ends-->
</head>
<body class="bg-slate-100 font-body card">
            
    
     <div class="h-screen  w-full bg-center bg-cover   bg-black/80 bg-fixed" style="
        background-image: url(https://images.pexels.com/photos/5473956/pexels-photo-5473956.jpeg?auto=compress&cs=tinysrgb&w=600);
      ">
       @include('navbar')
       <br>
      <div class=" card flex flex-col items-center  mt-8 sm:mt-32 hover:animate-pulse   text-white  w-full"><p class="text-lg sm:text-4xl text-center font-bold ">About  Job<span class="text-[#E85A4F] ">Shop</span></p></div>
    </div>
        <br>
      <div class=" card grid sm:grid-cols-2 py-2 gap-2 px-2 sm:px-4 sm:py-4 items-center justify-center">

     

       <p class="text-base sm:text-md lg:text-xl text-slate-800 ">
            Yes there
    are lot of monster job portal their like (indeed,roze.pk,naukri etc..) they are well established not build in 3-4 months take years to make mark in market and indeed they do it but one thing they lag that ‘specificity’ , means a platform having job related to only one industry there should be no mess of jobs on same platform , so we just try to make a job portal specific to one industry which is Tech industry as we are living in a world of machines and technologies. Another reason is, a country like Pakistan where jobs are still posted on walls like this instead of posting on wall, lets post on a ‘Pixels’, Our aim is to make Platform a beigneer frienldy and helps users to connect with each other.
    </p>
        <div class="w-full ">

            <img src="{{asset('pexels-christina-morillo-1181275.jpg')}}" alt="" srcset="" class="object-fill rounded-xl">
        </div>

  
      </div>


      <!-- jobcompany -->

      <div class="space-y-4 rounded-3xl  hover:bg-gray-200 card">
      <div class="flex flex-col items-center space-y-4">
        <strong class=" text-xl sm:text-xl font-bold">Our Product</strong>
        <p class=" text-xl sm:text-3xl font-bold text-[#E85A4F] hover:animate-bounce">561561+</p>
        <p class="text-gray-600">Companies are registerd</p>
      </div>

      <div class="flex flex-col items-center">
        <p class=" text-xl sm:text-3xl font-bold text-[#E85A4F] hover:animate-bounce">543+</p>
        <p class="text-gray-600">Jobs are Posted</p>
      </div>

      <div class="flex flex-col items-center">
        <p class=" text-xl sm:text-3xl font-bold text-[#E85A4F] hover:animate-bounce ">232+</p>
        <p class="text-gray-600">Number of Trustees who use JobShop</p>
      </div>
    </div>
<br>
<div class="flex  justify-center items-center mt-2 sm:mt-4 hover:animate-pulse text-gray-700  w-full"><p class="text-lg sm:text-2xl text-center font-bold ">People Reviews</p></div>
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-4 mt-5  w-full place-content-center ml-3 mx-auto h-full bg-slate-100  group ">
      
      <div class="flex flex-col items-center justify-center   rounded-xl border shadow-md shadow-gray-400 group-hover:border-lime-200 border-x-4 border-y-4 px-2 space-y-4" ><img src="./pexels-christina-morillo-1181271.jpg" alt="" class="rounded-full h-16 w-16 hover:animate-pulse transition transform duration-150 ease-in-out hover:scale-90" >
        <strong>Keoni Reyes</strong> 
      <p class="line-clamp-3 tyext-center text-base  sm:text-lg text-gray-700">A 31-year-old marine biologist, lives in Apra, Guam.Found his job  and he has since dedicated his life to studying marine life and coral reefs. Keoni spends his days scuba diving and conducting underwater photography, capturing the beauty and diversity of marine ecosystems. His dedication to his work led to the discovery of a new species of coral off the coast of Apra, which was named in his honor. When he's not diving, Keoni enjoys kayaking and sharing his underwater adventures through photo exhibitions and educational workshops.</p>
     
   
      </div>
     
            
      <div class="flex flex-col items-center justify-center   rounded-xl border shadow-md shadow-gray-400 group-hover:border-lime-200 border-x-4 border-y-4 px-2 space-y-4" ><img src="./pexels-daroon-20708902.jpg"  alt="" class="rounded-full h-16 w-16 hover:animate-pulse transition transform duration-150 ease-in-out hover:scale-90 " >
        <strong>Bajwa</strong> 
      <p class="line-clamp-3 tyext-center text-base  sm:text-lg text-gray-700">A 31-year-old marine biologist, lives in Apra, Guam.Found his job  and he has since dedicated his life to studying marine life and coral reefs. Keoni spends his days scuba diving and conducting underwater photography, capturing the beauty and diversity of marine ecosystems. His dedication to his work led to the discovery of a new species of coral off the coast of Apra, which was named in his honor. When he's not diving, Keoni enjoys kayaking and sharing his underwater adventures through photo exhibitions and educational workshops.</p>
     
   
      </div>  
      
      <div class="flex flex-col items-center justify-center   rounded-xl border shadow-md shadow-gray-400 group-hover:border-lime-200 border-x-4 border-y-4 px-2 space-y-4" ><img src="./pexels-quentin-chansaulme-423965555-20713221.jpg" alt="" class="rounded-full h-16 w-16 hover:animate-pulse transition transform duration-150 ease-in-out hover:scale-90" >
        <strong>Leilani Cruz</strong> 
      <p class="line-clamp-3 tyext-center text-base  sm:text-lg text-gray-700">A 31-year-old marine biologist, lives in Apra, Guam.Found his job  and he has since dedicated his life to studying marine life and coral reefs. Keoni spends his days scuba diving and conducting underwater photography, capturing the beauty and diversity of marine ecosystems. His dedication to his work led to the discovery of a new species of coral off the coast of Apra, which was named in his honor. When he's not diving, Keoni enjoys kayaking and sharing his underwater adventures through photo exhibitions and educational workshops.</p>
     
   
      </div> 
 
      <div class="flex flex-col items-center justify-center   rounded-xl border shadow-md shadow-gray-400 group-hover:border-lime-200 border-x-4 border-y-4 px-2 space-y-4" ><img src="./pexels-esmatullah-sediqi-227884109-25608432.jpg" alt="" class="rounded-full h-16 w-16 hover:animate-pulse transition transform duration-150 ease-in-out hover:scale-90" >
        <strong>Esmatullah</strong> 
      <p class="line-clamp-3 tyext-center text-base  sm:text-lg text-gray-700">A 31-year-old marine biologist, lives in Apra, Guam.Found his job  and he has since dedicated his life to studying marine life and coral reefs. Keoni spends his days scuba diving and conducting underwater photography, capturing the beauty and diversity of marine ecosystems. His dedication to his work led to the discovery of a new species of coral off the coast of Apra, which was named in his honor. When he's not diving, Keoni enjoys kayaking and sharing his underwater adventures through photo exhibitions and educational workshops.</p>
     
   
      </div> 
      
      </div>
    


</body>
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
</html>