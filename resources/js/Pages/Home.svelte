<script>
   let D = new Date().getFullYear();;
   let msg =''
   function sms(){
      alert("message sent")
      msg = '';
   }
  
</script>

 <main class = "h-screen flex flex-col justify-between items-center px-4 py-4 bg-black text-red-900 font-mono ">
    <div>
      <h1 >KoloWn App {D} </h1> 
    </div>

    <div class =" h-screen flex flex-col justify-center">
      <div class="p-4  flex ">
         <input id="user-input" type="text" placeholder="Type a message" bind:value={msg} class="w-full max-w-96 px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-red-500">
         <button id="send-button" class="bg-red-500 text-white px-4 py-2 rounded-r-md hover:bg-red-400 transition duration-300" on:click={sms}>Send</button>
     </div>
    </div>
 </main>

 <!-- flex flex-col justify-center -->