<header class="w-full h-16 bg-white drop-shadow-md text-black">
  <div class="container px-4 text-nowrap md:px-6 h-full mx-auto flex justify-between items-center">
    <!-- Logo -->
    <div class="flex items-center space-x-3">
      <span class="text-3xl font-semibold text-gray-800">Job<span class="font-bold text-green-600">Shop</span></span>
      <a class="text-yellow-500 text-2xl font-bold" href="./indexTail.html">🍒</a>
    </div>

    <!-- Menu links -->
    <ul
      id="menu"
      class="hidden space-y-4 fixed top-0 right-0 w-4/5 h-[100vh] px-10 py-10 bg-black text-white rounded-md shadow-lg sm:relative sm:flex sm:w-auto sm:h-auto sm:p-0 sm:bg-transparent sm:shadow-none sm:flex-row sm:space-x-8 sm:text-gray-700 z-20 transition-all"
    >
      <!-- Close button (visible on mobile) -->
      <li class="sm:hidden fixed top-6 right-6">
        <a
          href="#"
          class="text-white text-4xl"
          onclick="toggleMenu()"
        >&times;</a>
      </li>
      <!-- Menu items -->
      <li>
        <a
          class="text-lg opacity-80 hover:opacity-100 transition-all duration-300"
          href="{{route('index')}}"
        >Home</a>
      </li>
      <li>
        <a
          class="text-lg opacity-80 hover:opacity-100 transition-all duration-300"
          href="{{route('cvDataTake')}}"
        >Create CV</a>
      </li>
      <li>
        <a
          class="text-lg opacity-80 hover:opacity-100 transition-all duration-300"
          href="{{route('About')}}"
        >About</a>
      </li>
      <li>
        <a
          class="text-lg opacity-80 hover:opacity-100 transition-all duration-300"
          href="{{route('Contact')}}"
        >Contact Us</a>
      </li>
      <li>
        @guest
        <a
          class="text-lg opacity-80 hover:opacity-100 transition-all duration-300"
          href="{{route('login')}}"
        >Login</a>
        @endguest
      </li>
      <li>
        @guest
        <a
          class="text-lg opacity-80 hover:opacity-100 transition-all duration-300"
          href="{{route('signup')}}"
        >Signup</a>
        @endguest
      </li>
    </ul>

    <!-- Hamburger menu icon (visible on mobile) -->
    <div class="flex items-center sm:hidden">
      <button
        class="text-4xl font-bold opacity-80 hover:opacity-100 transition-all duration-300"
        onclick="toggleMenu()"
      >
        ☰
      </button>
    </div>
  </div>
</header>

<script>
  function toggleMenu() {
    const menu = document.getElementById("menu");
    menu.classList.toggle("hidden");
  }
</script>
