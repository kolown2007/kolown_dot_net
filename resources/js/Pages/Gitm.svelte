<script>
   

    import { useForm } from '@inertiajs/svelte'
  
    let D = new Date().getFullYear();
    


   
let values = useForm({
    sms: "",
  });



function submit(value) {
    $values.sms = value;
   
    $values.post('/trigger', {
     
      preserveScroll: true,
          onSuccess: () => $values.sms = '',
      
    });

    console.log($values.sms);
  
  }


   </script>
   
   
   
   <main
       class="h-screen flex flex-col justify-between items-center px-4 py-4 bg-black text-red-900 font-mono"
   >
       <div>
           <h1>KoloWn App {D}</h1>
       </div>
   
       <div class=" h-screen flex flex-col justify-center">
        <div class="p-4 grid grid-cols-2 gap-8"> <!-- Adjust grid-cols-2 to the desired number of columns -->
            <button
                id="send-button-1"
                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-400 transition duration-300"
                 on:click={()=>submit('state1')}>state1</button>

            <button
                id="send-button-2"
                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-400 transition duration-300"
                on:click={() => submit('state2')}>state2</button>

            <!-- Add more buttons as needed -->
            <button
                id="send-button-3"
                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-400 transition duration-300"
                on:click={() => submit('state3')}>state3</button>

            <button
                id="send-button-4"
                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-400 transition duration-300"
                on:click={() => submit('state4')}>state4</button>

                <button
                id="send-button-5"
                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-400 transition duration-300"
                on:click={() => submit('state5')}>state5</button>

            <button
                id="send-button-6"
                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-400 transition duration-300"
                on:click={() => submit('state6')}>state6</button>

        </div>
           
   
       </div>
   
   
   
   
   </main>
   