<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact</title>
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
   <!-- /////////////////sweetalert js///////////////////////    -->

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- /////////////////sweetalert js ends//////////////////////    -->

<!-- for sweetalert library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- for sweetalert library ends-->
 
</head>

<body class="font-body   bg-fixed   bg-cover object-cover bg-no-repeat bg-blend-overlay bg-black/80 h-screen bg-center" style="background-image: url(https://img.freepik.com/free-photo/contact-us-customer-support-enquiry-hotline-concept_53876-128047.jpg?size=626&ext=jpg&ga=GA1.1.1760842436.1722613757&semt=ais_hybrid);">

@if(session('success'))
    <script>
        Swal.fire('Thank u for staying in touch');
    </script>
@endif

        <div class=" flex flex-col items-center justify-center h-">
        <div class=" card flex flex-col items-center hover:animate-pulse   text-white w-full"><p class="text-lg sm:text-4xl text-center font-bold ">Contact  Job<span class="text-[#E85A4F] ">Shop</span></p></div>
              <div class=" max-w-lg border border-white rounded mx-auto flex flex-col items-center justify-center px-4 py-4 overflow-hidden  text-black ">
           
                      <form action="{{route('contact_us')}}" method="post" class="space-y-4 flex flex-col justify-center items-center space-x-4 flex-wrap">
                        @csrf


                      <input type="hidden" name="userid" value="{{auth()->id()}}">
                      <div class="flex justify-center items-center gap-4">
                      <label for="subject" class=" text-white font-medium text-lg block">Subject</label>
                      <input type="text" name="subject" id="subject" class="px-4 py-2 rounded bg-transparent border border-white text-white w-full outline-none">
                      </div>


                      <div>
                      <label for="description" class=" text-white font-medium text-lg   ">Message</label>
                      <textarea name="message" id="description" cols="30" rows="10" class="outline-none rounded-md  bg-transparent border border-white text-white"></textarea>
                      </div>

                        <!-- only authrntic user go for it -->
                      <div class="w-full flex justify-center items-center">
                        @if (Auth::check())
                        <button  class=" hover:bg-[#BAFF39] text-white hover:text-black border border-white rounded-md px-[0.5em ] sm:py-2 sm:px-4  border-lime-300">Contact</button>
                        @endif
                      
                      </div>
                      </form>
                      <button  class="btn" id="btn" onclick="NotLogin()">Contact</button>

              </div>

            
        
        </div>
        <div class=" flex flex-col flex-wrap gap-4 w-full place-content-center mx-auto h-full group px-4">

        <div  class="flex text-white font-semibold flex-col items-center justify-center   rounded-xl border shadow-md shadow-gray-400 group-hover:border-lime-200 border-x-4 border-y-4  space-y-4 hover:animate-pulse">
            <p class="text-xl">Our Address</p>
            <p>123 Job Street, Job City, Country</p>
            <p>Phone: +123 456 7890</p>
        </div>

        <!-- social media links -->
        <div  class="flex text-white font-semibold flex-col items-center justify-center   rounded-xl border shadow-md shadow-gray-400 group-hover:border-lime-200 border-x-4 border-y-4 px-2 space-y-4 hover:animate-pulse">
        <a href="https://www.facebook.com" class="hover:text-sky-700 mt-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" width="64" height="35" fill="currentColor">
  <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.81v-9.294H9.692v-3.622h3.118V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.464.098 2.797.142v3.242l-1.92.001c-1.504 0-1.794.715-1.794 1.763v2.311h3.587l-.467 3.622h-3.12V24h6.117C23.407 24 24 23.407 24 22.675V1.325C24 .593 23.407 0 22.675 0z"/>
</svg>
</a>
            <a href="https://www.twitter.com" class="hover:text-sky-200"> <svg xmlns="http://www.w3.org/2000/svg" width="64"
            height="35" fill="currentColor" class="bi bi-twitter"
            viewBox="0 0 16 16">
 
            <path d="M5.026 15c6.038 0 9.341-5.003 
            9.341-9.334 0-.14 0-.282-.006-.422A6.685 
            6.685 0 0 0 16 3.542a6.658 6.658 0 0 
            1-1.889.518 3.301 3.301 0 0 0 1.447-1.817
            6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 
            0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 
            3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 
            0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 
            2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 
            3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 
            2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 
            0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
        </svg></a>
            <a href="https://www.linkedin.com" class="hover:text-blue-700"><svg role="img" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg" width="50" height="35" fill="currentColor">
  <title>LinkedIn</title>
  <path d="M22.23 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.21 0 22.23 0zm-13.85 20.45h-3.7V9h3.7v11.45zM5.32 7.59a2.15 2.15 0 0 1-2.16-2.14c0-1.18.97-2.14 2.16-2.14a2.15 2.15 0 0 1 2.16 2.14c0 1.17-.97 2.14-2.16 2.14zM20.45 20.45h-3.7v-5.58c0-1.33-.02-3.03-1.85-3.03-1.85 0-2.13 1.45-2.13 2.93v5.68h-3.7V9h3.55v1.56h.05c.5-.95 1.72-1.95 3.54-1.95 3.79 0 4.49 2.5 4.49 5.75v6.09z"/>
</svg>
</a>
        </div>  
        </div>
</body>
<script>

function NotLogin() {

       let NotLogin = document.getElementById('btn');
       if(NotLogin) {

         Swal.fire('Please Login First');
       }
       
     }
</script>

 
</html>
