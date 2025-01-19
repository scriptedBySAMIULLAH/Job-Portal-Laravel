<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Skill</title>
    @vite('resources/css/app.css')
</head>

        @include('successMsg')


        @include('errMsg')
        
<body class="bg-slate-300  flex justify-center items-center flex-wrap flex-col h-screen gap-8">
        <a href="javascript:history.back()" class="text-blue-700 font-Roboto font-bold"><-Back</a>
   <h2 class="font-montserrat font-bold">Add any Skill you want</h2>
       
         
    
                    
                    <form action="{{route('add_skill')}}" method="post"  class="max-w-lg rounded-md shadow-md border border-black mx-auto space-y-6 px-4 py-2">
                        @csrf
                                    
                        <label for="skill" class="block text-gray-700 font-montserrat">Skills</label>

                            <div id="container" >
                             
                            <input type="text" name="skills[]" id="skill" class="inpt" required >
                          
                            </div>
                            <button type="submit" class="rounded-full px-2  border border-black bt4">Add</button>

                    </form>

                    <div>
                            <button type="button" onclick="addMore()" class="bt4">Add more</button>
                    </div>






              




        <script>

                function addMore(){


                     let container=document.getElementById('container');
                    
                    const newDiv=document.createElement('div');

                    newDiv.innerHTML=`
                       
                    <div class="flex gap-2 mt-4">
                             <button type="button" onclick="del(this)" id="btn" class="text-xl text-red-700">x</button> 

                            <input type="text" name="skills[]" id="skill" class="inpt" required >
                          
                    </div>`;

                    container.appendChild(newDiv);
                }


                function del(ele){
                   ele.parentElement.remove() ;

                }
        </script>
</body>
</html>