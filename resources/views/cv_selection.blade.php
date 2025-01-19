<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cv-Slection</title>
    <!-- <link rel="stylesheet" href="output.css" /> -->
    @vite('resources/css/app.css')
  </head>
  <body class="bg-cover bg-center bg-no-repeat bg-blend-overlay bg-black/60 shadow-sm" style="background-image: url(https://cdn.pixabay.com/photo/2021/09/15/15/49/resume-6627200_1280.jpg);">
    <fieldset class="grid grid-cols-1 sm:grid-cols-2 max-w-3xl mx-auto place-items-center space-y-2 h-dvh place-content-center border border-white mt-1 sm:mt-2 sm:mb-2 mb:1 rounded-md px-2 gap-2 sm:px-4">
      <legend class="text-center font-bold text-[#0a1f35] text-xl font-montserrat">Please select the layout</legend>

      
      
        <div class="rounded-md border shadow-md sm:p-4  bg-slate-200">
          <input type="radio" name="layout" id="layout1" class="hidden peer">
          <label for="layout1" class="block border peer-checked:border-sky-800">

            <a href="{{URL::to('Layout-Selection/'.'1Column')}}">

            <img src="{{asset('1Column.png')}}" alt=" Iconic" srcset="" class="max-w-64 max-h-64 rounded-md" style="filter: brightness(1.1) contrast(1.1);">
           
          </a>
          <span class="font-semibold text-center font-lora">Iconic</span>
         
          </label>
       
        </div>

        <div class="rounded-md border shadow-md sm:p-4  bg-slate-200">
          <input type="radio" name="layout" id="layout2" class="hidden peer">
          <label for="layout2" class="block border peer-checked:border-sky-800">

            <a href="{{URL::to('Layout-Selection/'.'2Column')}}">
            <img src="{{asset('2Column.png')}}" alt=" Two Column" srcset="" class="max-w- max-h- rounded-md" style="filter: brightness(1.1) contrast(1.1);">
            
          </a>
          <span class="font-semibold text-center font-lora ">Two Column</span>
          </label>
       
        </div>
    </fieldset>




  </body>
</html>
