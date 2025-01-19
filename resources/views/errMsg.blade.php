@if(session("err"))
    <p  class="flex items-center justify-center flex-col border bg-red-500 rounded-lg px-4 py-2 text-white font-bold p-2 font-body" id="Msg"> {{session("err")}} </p>
    {{session()->forget('err')}}
  @endif

    
<!-- flash mesage remover script -->
<script>
  const myMsg = document.getElementById('Msg');


  if (myMsg.innerHTML !== '') {
    setTimeout(() => {

      myMsg.style.display = 'none';
    }, 4000)
  }
</script>

<!-- flash mesage remover script end -->