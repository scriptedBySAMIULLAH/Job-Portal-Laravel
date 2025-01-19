<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Job</title>
  @Vite('resources/css/app.css')
  <!-- link for choices.js library  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
  <!-- link for choices.js library end  -->
  <!-- link for wyswyg  -->
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css">
  <script>
    CKEDITOR.replace('description');
  </script>
  <!-- link for wyswyg end  -->


  <!-- scipt for wyswyg editior where it is applied -->
</head>

<body class="bg-gradient-to-bl from-slate-100 via-gray-200 to-slate-300">
  <!-- this is the post job section here  -->
  

  <div id="postjob" class=" flex-1 p-4 mt-2 font-lora">

    <h1 class="text-2xl font-bold font-montserrat text-center ">Create Job Listing</h1>
    <div class="border border-black bg-transparent w-fit opacity-70 hover:opacity-100 duration-300 pr-2 ">
      <a href="javascript:history.back()" class="flex items-center font-semibold text-gray-5 rounded00">

        <svg class="w-4 h-4 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>

        Back</a>
    </div>
    <div class="bg-slate-300 max-w-md px-2 py-2 mx-auto space-y-2 border">
      <div class="max-w-md mx-auto px-4 bg-white rounded-lg border border-black shadow-md space-y-4">
        <!-- postjob form Here -->
        <form action="{{route('jobposted')}}" method="post" class="py-2 font-lora">

          @csrf

          <!-- title-->
          <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>

            <input type="text" id="title" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required />
            @error('title')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Job Description</label>
            <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required></textarea>
            @error('description')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>
          <!-- Skills -->
          <div class="mb-4">
            <label for="skills" class="block text-sm font-medium text-gray-700">Skills</label>

            <select id="skills" name="skills[]" multiple class="block w-full height-12  overflow-y-auto">
              @foreach ($skills as $skill)
              <option value="{{ $skill->id }}">{{ $skill->name }}</option>
              @endforeach
            </select>
            @error('skills')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>
          <!-- Proficiency Level -->
          <div class="mb-4">
            <label for="proficiency" class="block text-sm font-medium text-gray-700">Proficiency Level</label>
            <select id="proficiency" name="proficiency" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
              <option value="Beigneer">Beigneer</option>
              <option value="Intermediate">Intermediate</option>
              <option value="Pro">Pro</option>
            </select>
            @error('proficiency')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>
          <!-- Salary -->
          <div class="mb-4">
            <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
            <input type="number" id="salary" name="salary" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" step="0.01" required min="0" />
            @error('salary')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>
          <!-- Gender -->
          <div class="mb-4">
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select id="gender" name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Any">Any</option>
            </select>
            @error('gender')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>
          <!-- Job Type -->
          <div class="mb-4">
            <label for="job-type" class="block text-sm font-medium text-gray-700">Job Type</label>
            <select id="job-type" name="jobtype" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none">
              <option value="Full Time">Full Time</option>
              <option value="Part Time">Part Time</option>
              <option value="Contract">Contract</option>
              <option value="Temporary">Temporary</option>
            </select>
            @error('jobtype')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>
          <!-- Location -->
          <div class="mb-4">
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>

            <select id="location" name="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
              @foreach ($locations as $location)
              <option value="{{ $location->id }}">{{$location->name}}</option>
              @endforeach
            </select>
            @error('location')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>>
            @enderror
          </div>
          <!-- Positions -->
          <div class="mb-4">
            <label for="positions" class="block text-sm font-medium text-gray-700">Number of Positions</label>
            <input type="number" id="positions" name="positions" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" min="0" required />
            @error('positions')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>
          <!-- Age Limit -->
          <div class="mb-4">
            <label for="age-limit" class="block text-sm font-medium text-gray-700">Age Limit</label>
            <input type="number" id="age-limit" name="agelimit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required min="18" />
            @error('agelimit')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>
          <!-- Working Hours -->
          <div class="mb-4">
            <label for="working-hours" class="block text-sm font-medium text-gray-700">Working Hours</label>
            <input type="text" id="working-hours" name="workinghours" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required />
            @error('workinghours')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>
          <!-- Experience Level -->
          <div class="mb-4 ">
            <label for="experience-level" class="block text-sm font-medium text-gray-700">Experience Level</label>
            <select name="experiencelevel" id="experience-level" class="w-full">

              <option value="Entry Level">Entry Level</option>
              <option value="Mid Level">Mid Level</option>
              <option value="Senior Level">SeniorLevel</option>
            </select>
            @error('experiencelevel')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>
          <!-- End Date -->
          <div class="mb-4">
            <label for="ends-on" class="block text-sm font-medium text-gray-700">Application Deadline</label>
            <input type="date" id="ends-on" name="endson" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 outline-none" required />
            @error('endson')
            <p class="text-red-400 font-bold text-lg">{{ $message}}</p>
            @enderror
          </div>
          <!-- Submit Button -->
          <div class="mt-6">
            <button class="btn3 focus:outline-none">
              Post Job
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- this is the post job section here ends -->

</body>
<!-- script for choices.js library -->

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- script for choices.js library end -->

<script>
    new Choices("#skills", {
      removeItemButton: true, // Allows removal of selected item
    });
  </script>

  <!-- heres wyswyg apply on ele -->

<script>
  CKEDITOR.replace('description', {
    enterMode: CKEDITOR.ENTER_BR, // Use <br> instead of <p> on Enter
    shiftEnterMode: CKEDITOR.ENTER_BR, // Use <br> instead of <p> on Shift+Enter
    autoParagraph: false, // Disable automatic paragraph wrapping
    allowedContent: true, // Allow all content (disable automatic filtering)
    removeFormatAttributes: ''
  });
</script>
<!-- heres wyswyg apply end -->

</html>