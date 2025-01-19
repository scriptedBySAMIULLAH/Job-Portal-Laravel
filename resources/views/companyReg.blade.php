<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registration</title>
    @vite('resources/css/app.css')
    <!-- /////////////////sweetalert js///////////////////////    -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- /////////////////sweetalert js ends//////////////////////    -->

    <!-- for sweetalert library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- for sweetalert library ends-->

</head>

<body class=" font-body bg-slate-200">

    <div class="max-w-lg  mx-auto  sm:mt-1 bg-white p-6 rounded-lg shadow-md    ">
        <h2 class="text-2xl font-bold mb-5">🚀 Company Registration 🌟</h2>
        @if(session('error'))
        <p class="text-red-500 text-xs italic">{{ session('error') }}</p>
        @endif
        <form action="{{route('register')}}" method="POST" enctype="multipart/form-data" id="regFormCompany" autocomplete="off">
            @csrf
            <input type="hidden" name="userid" value="{{$userid}}">
            <input type="hidden" name="role" value="company">
            <!-- logoCompany  -->

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700" for="company_logo">Company Logo</label>
                <input type="file" id="company_logo" name="picture" class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer focus:outline-none" autocomplete="off" value="{{old('picture')}}" required>
                @error('picture')
                <p class="text-red-600 text-base italic">{{ $message . "Only allowed jpeg,png,gif" }}</p>
                @enderror
            </div>

            <label for="company_name" class="block mb-2">Company Name</label>
            <input type="text" id="company_name" name="company_name" class="w-full px-3 py-2 border rounded mb-4" autocomplete="off" value="{{old('company_name')}}" required>
            @error('company_name')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror



            <label for="email" class="block mb-2">Company Email</label>
            <input type="email" id="email" name="company_email" class="w-full px-3 py-2 border rounded mb-4" autocomplete="off" value="{{old('company_email')}}" required>

            @error('company_email')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror

            <label for="phone_number" class="block mb-2">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" class="w-full px-3 py-2 border rounded mb-4" autocomplete="off" placeholder="0000-0000000" value="{{old('phone_number')}}" required>
            @error('phone_number')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror


            <select id="location" name="location_id" class="w-full px-3 py-2 border rounded mb-4">
                @foreach ($locations as $location)
                <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>


            <label for="company_type">Company Type</label>
            <select name="company_type" id="company_type" class="form-control">
                <option value="startup">Startup</option>
                <option value="medium">Medium</option>
                <option value="enterprise">Enterprise</option>
            </select>

            <label for="web_url" class="block mb-2">Website URL</label>
            <input type="url" id="web_url" name="web_url" class="w-full px-3 py-2 border rounded mb-4" autocomplete="off" value="{{old('web_url')}}" required>
            @error('web_url')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror

            <label for="employees_count" class="block mb-2">Number of Employees</label>
            <input type="number" id="employees_count" name="employees_count" class="w-full px-3 py-2 border rounded mb-4" autocomplete="off" value="{{old('employees_count')}}" required>
            @error('employees_count')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
            <label for="description" class="block mb-2">Description</label>
            <textarea id="description" name="description" rows="4" class="w-full px-3 py-2 border rounded mb-4" placeholder="Tell more about your Company
            
            " autocomplete="off" value="{{old('description')}}" required>
           </textarea>@error('description')
            <p class="text-red-500 text-base italic">{{ $message }}</p> @enderror
            <div class="flex justify-around">

                <button type="submit" class="hover:bg-black text-[#E85A4F] border border-black px-4 py-2 rounded " onclick="checkReg(event)">Register</button>
                <button type="reset" class="hover:bg-black text-[#E85A4F] border border-black px-4 py-2 rounded ">Reset</button>
            </div>

        </form>

        <!-- show some errors vaidations  another way to show errors-->
        <!-- @if ($errors->any())
    


<ul class="text-red  text-base">
      @foreach ($errors->all() as $err)


    <li>{{$err}}</li>
    @endforeach
</ul>

@endif

  

 -->

    </div>

</body>
<!-- check empty -->
<script>
    function checkReg(e) {

        let regFormCompany = document.getElementById('regFormCompany');
        if (!regFormCompany.checkValidity()) {

            e.preventDefault();
            Swal.fire('Some fields are Empty 🤔');
        } else {

            return true;
        }

    }
</script>

<!-- check empty ends-->

</html>