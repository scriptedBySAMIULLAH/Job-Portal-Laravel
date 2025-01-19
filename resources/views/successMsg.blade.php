

@if(session('success'))
  <div class=" text-white font-bold py-2 px-4 focus:shadow-outline fixed top-0 right-0  bg-gradient-to-tr from-green-500 to-green-400 rounded-md  "  id="myMsg">{{session('success') }}</div>
  {{session()->forget('success')}}
  @endif

<!-- flash mesage remover script -->
<script>
  const myMsg = document.getElementById('myMsg');


  if (myMsg && myMsg.innerHTML.trim() !== '') {
    setTimeout(() => {

      myMsg.style.display = 'none';
    }, 4000)
  }
</script>

<!-- flash mesage remover script end -->