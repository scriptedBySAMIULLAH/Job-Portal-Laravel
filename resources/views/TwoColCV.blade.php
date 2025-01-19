<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-column CV</title>
    @vite('resources/css/app.css')
       <!-- html2pdf library -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<!-- html2pdf library ends-->
</head>

<body class="bg-gray-100 font-Roboto p-2">
    <main class=" h-full flex border border-red-800 rounded-sm max-w-3xl mx-auto">

        <aside class="border bg-[#063970] w-[25%] flex-1 border-y-white px-2 text-white">
            <div class="mb-4">

                <h1 class="font-bold text-xl">{{$userBio->basicBio->name}}&nbsp;{{$userBio->basicBio->surname}}</h1>
                <h4 class=" text-base text-gray-300">{{$userBio->basicBio->profession}}</h4>
            </div>

            <div class="bg-transparent shadow-md mb-4">
                <h3 class="font-semibold">
                    Contact
                </h3>
            </div>

            <div class="fc mb-4">


                <div class="mb-2">
                    <span class="font-semibold bg-transparent shadow-sm block">Address</span>
                    <p class="text-base">{{$userBio->basicBio->city_state}}</p>
                </div>


                <div class="mb-2">
                    <span class="font-semibold bg-transparent shadow-sm block">Phone</span>
                    <p class="text-base">{{$userBio->basicBio->phone}}</p>
                </div>


                <div class="mb-2">

                    <span class="font-semibold bg-transparent shadow-sm block">E-mail</span>
                    <p class="text-base">{{$userBio->basicBio->email}}</p>

                </div>

            </div>
            <!-- image -->


            <div>
                <h3 class="font-semibold">

                    Skills
                </h3>
            </div>


            <div class="grid grid-cols-2 grid-flow-row space-y-4">
                <ul class="list-disc">
                    @foreach ($userSkill as $ele)

                    <li class="ml-[1rem] ">
                       
                        <p class="text-base">{{$ele->skil}}</p>
                        <p class="text-base ">{{$ele->rate_value}}/5</p>
                      
                        </li>
                   
                    @endforeach
                </ul>
            

            </div>

        </aside>


        <section class="border  flex-2 w-[70%] px-4 ">

            <div class="mb-4">

                <p class="text-gray-700 text-base">{{$userBio->basicBio->yourself}}</p>
            </div>


            <div class="text-[#063970] py-2 border-t-2  border-b-2  border-gray-300 pt-2 mb-2">

                <strong class="font-semibold">Work History</strong>
            </div>

            <div class="grid grid-cols-2 grid-flow-row mb-4">


                @foreach ($userworkHistory as $ele )

                <div class="mb-2 ">


                    <span class="text-base text-gray-500">{{ $ele->stdmonthsW}}</span>
                    <span class="text-base text-gray-500">{{$ele->stdyearsW}}</span>
                    <span class="text-base text-gray-500">{{$ele->endmonthsW}}</span>
                    <span class="text-base text-gray-500">{{$ele->endyearsW}}</span>

                </div>


                <div class="mb-2 flex gap-2">
                    <span>{{$ele->JobTitle}}</span>
                    <span> {{$ele->Employer}}</span>
                    <span> {{$ele->Location}}</span>

                </div>
                @endforeach
            </div>

            <div class="text-[#063970] py-2 border-t-2  border-b-2  border-gray-300 pt-2 mb-2">

                <strong class="font-semibold">Education</strong>
            </div>


            <div class="grid grid-cols-2 grid-flow-row mb-4">

            @foreach ($userEducation as $ele)

                <div class="mb-2 ">


                    <span class="text-base text-gray-500">{{$ele->GraduationDateYears}}</span>
                    <span class="text-base text-gray-500">{{$ele->GraduationDatemonths}}</span>


                </div>


                <div class="grid grid-cols-2 grid-flow-row  w-full">
                    <span class="text- w-fit">{{$ele->schName}}</span>
                    <span class="text-base w-fit">{{$ele->schlLoc}}</span>
                    <span class="text-base w-fit">{{$ele->fieldstudy}}</span>
                    <span class="text-base w-fit">{{$ele->Degree}}</span>

                </div>
                @endforeach

            </div>


            <div class="text-[#063970] py-2 border-t-2  border-b-2  border-gray-300 pt-2 mb-2">

                <strong class="font-semibold">Projects</strong>
            </div>

            <div class="grid grid-cols-2 grid-flow-row">
            @if ($userProjects)

                <label for="techUse" class="block font-semibold text-gray-700">Technology use</label>
                <label for="Projects" class="block font-semibold text-gray-700">Description</label>
                @foreach ($userProjects as $ele)
                <P id="techUse">{{$ele->techUse}}</P>
              
                <P id="Projects">{{$ele->projects}}</P>
                @endforeach
            @endif
            </div>


        </section>


       
    </main>

    <button class="font-montserrat font-semibold rounded-md px-2 py-1 bg-blue-700 text-white fixed top-0 right-0 hover:bg-green-500" id="btn">Download</button>
</body>

<script>

        document.getElementById('btn').addEventListener('click',(event)=>{

          

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






        });



</script>

</html>