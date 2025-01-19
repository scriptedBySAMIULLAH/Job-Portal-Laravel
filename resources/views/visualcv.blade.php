<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Resume</title>

    <!-- fonts lora and Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- fonts lora and Montserrat  ends-->

    <!-- html2pdf library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <!-- html2pdf library ends-->

    @vite('resources/css/app.css')

    <style>
body {
  font-size:1rem; 
  margin: 0;
  padding: 0;
}


    </style>
</head>

<body class=" bg-slate-100  px-2 rounded-sm  mx-2 w-full h-full fc flex-1 overflow-x-hidden">

   
        <div class="basicBio px-4 bg-gradient-to-tl from-gray-500 via-slate-700 to-gray-800  mb-1  relative">
            <!-- upper div for gap x -->
            <div class="  text-white flex rounded-md  justify-between mx-2  px-2 py-2 items-center bg-blend-overlay opacity-100 ">

                <div class="flex flex-col"> <!-- this div hold all -->
                    <div class="mb-4">
                        <h1 class="text-3xl font-bold font-montserrat">{{$userBio->basicBio->name}}&nbsp;{{$userBio->basicBio->surname}}</h1>
                        <h4 class="from-neutral-400 font-montserrat">{{$userBio->basicBio->profession}}</h4>
                    </div>

                    <div class="fc font-lora space-y-2">
                        <div class="flex gap-4"><strong>Address</strong><span>{{$userBio->basicBio->city_state}}</span></div>
                        <div class="flex gap-4"><strong>Phone</strong><span>{{$userBio->basicBio->phone}}</span></div>
                        <div class="flex gap-4"><strong>Email</strong><span>{{$userBio->basicBio->email}}</span></div>


                    </div>

                </div>

                <div class="">

                    <img src="{{asset('storage/cv_images/'.$userBio->basicBio->img)}}" alt=" " class="w-32 h-32 rounded-md" style="filter:contrast(1.1) brightness(1.05);">
                </div>
            </div>

        </div>

        <!-- basic bioends -->

        <div class="ALL-wrapper inline-block text-gray-600 px-2   flex-col mx-2">
            <div class="mb-2">
                <!-- tag line-->

                <p class="font-lora italic ">
                <h4 class="from-neutral-400 font-lora">{{$userBio->basicBio->yourself}}</h4>
                </p>


            </div>

            <!-- TAG LINE ends -->




            <!--Skills-->

            <div class="mt-2 space-y-1">
                <div class="flex items-center justify-center">
                    <i class="fas fa-laptop-code text-gray-700 text-xl mr-3"></i>
                    <h2 class="font-montserrat font-bold text-xl text-gray-600"> <span class=" border-b-2  border-gray-400 h-4">Skills</span></h2>
                </div>



                <ul class="list-disc">
                    @foreach ($userSkill as $ele)


                    <li>
                        <div class="px-2  w-fit rounded-full bg-gray-300 text-gray-700 font-lora whitespace-nowrap"> {{$ele->skil}}</div>
                    </li>
                  
                        @for ($i=0;$i<$ele->rate_value;$i++)

                            <div class="fas fa-star" style="color: #6B7280;"></div>


                            @endfor

                    @endforeach

                </ul>


            </div>
            <!--Skills ends-->

            <!-- work history -->

            <div class="wrapper-3 mt-2">




                <div class="flex items-center justify-center">
                    <i class="fas fa-briefcase text-gray-700 text-xl mr-2"></i>
                    <h2 class="font-montserrat font-bold text-xl text-gray-600"> <span class=" border-b-2  border-gray-400 h-4">Work history</span> </h2>
                </div>



                @foreach ($userworkHistory as $ele )


                <div class="grid grid-cols-1 space-y-1 mt-4 gap-4 grid-flow-row">

                    <div class="font-lora text-gray-700">
                        <span>-<span>{{ $ele->stdmonthsW}}</span></span><b>,</b><span>{{$ele->endyearsW}}-<span>{{$ele->endmonthsW}}</span></span>
                    </div>
                    <hr class="hidden">
                    <div class="flex gap-4 items-center">

                        <div class="flex items-center gap-3">
                            <i class="fas fa-briefcase"></i>
                            <p class="font-montserrat font-semibold text-gray-700">{{$ele->JobTitle}}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-building"></i>
                            <p class="font-lora text-gray-700">
                                {{$ele->Employer}}
                            </p>
                        </div>

                        <div class="flex items-center gap-3">
                            <i class="fas fa-map-marker-alt"></i>
                            <p class="font-lora text-gray-700">
                                {{$ele->Location}}
                            </p>
                        </div>

                    </div>



                </div>
                @endforeach



            </div>
            <!-- work history ends -->

            <!-- Education starts -->

            <div class="edu-wrapper mt-2 ">
                <div class="flex items-center justify-center mb-2">
                    <i class="fas fa-graduation-cap text-gray-700 text-xl mr-2"></i>
                    <h3 class="font-montserrat font-bold text-xl text-gray-600"> <span class=" border-b-2  border-gray-400 h-4">Education</span></h3>
                </div>




                @foreach ($userEducation as $ele)


                <div class="grid grid-cols-2 space-y-2 grid-flow-row gap-4"><!-- thats grid -->

                    <div class="space-y-2">


                        <div class="">
                            <b class="font-montserrat text-gray-600  ">{{$ele->Degree}}</b>:<b class="font-montserrat text-gray-600  ">{{$ele->fieldstudy}}</b>
                        </div>
                        <div class="flex">
                            <span class="font-lora text-gray-700">{{$ele->schName}}</span>:<span class="font-lora text-gray-700">{{$ele->schlLoc}}</span>

                        </div>



                    </div>
                    <div class="font-lora text-gray-700">
                        <span>{{$ele->GraduationDateYears}}-<span>{{$ele->GraduationDatemonths}}</span></span>
                    </div>
                </div>

                @endforeach


            </div>





            <!-- Education ends -->

            <!-- Projects -->
            <div class="edu-div  mt-2 space-y-2">



                <div class="space-y-2">

                    <div class="flex justify-center items-center">
                        <i class="fas fa-folder-open text-gray-700 text-xl mr-2"></i>
                        <h2 class="font-montserrat font-bold text-xl text-gray-600">
                            <span class=" border-b-2  border-gray-400 h-4">Projects</span>
                        </h2>
                    </div>

                    <div class="" >
                        <div class=" grid gap-2 grid-col-1 justify-evenly grid-rows-1 items-center font-lora ">
                            @if ($userProjects)

                            @foreach ($userProjects as $ele)
                            
                               <div class=" font-semibold inline-block text-gray-700
                                 font-montserrat">{{$ele->techUse}}</div> 
                               <div class=" inline-block text-gray-700  font-lora">{{$ele->projects}}</div> 
                
                            @endforeach
                             

                            @endif
                   
                           
                        </div>
                        

                    </div>

                </div>
            </div>

           
            <button class="font-montserrat font-semibold rounded-md px-2 py-1 bg-blue-700 text-white fixed top-0 right-0 hover:bg-green-500"  id="Download">Download</button>
        </div>
    



</body>

<!-- html to pdf script -->
<script>
    document.getElementById('Download').addEventListener('click', (event) => {

        event.target.className = 'hidden'; //cv pr na show ho button
        let name;
        confirm(name = prompt('Your CV Name please'))

        // console.log(name);

        let ele = document.body;
        const options = {


            filename: `${name}`,
            margin: [0, 0, 0, 0],
            image: {
                type: 'jpeg',
                quality: 0.99
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            },


        };

        html2pdf().from(ele).set(options).save();
    })
</script>

<!-- html to pdf script ends-->

</html>