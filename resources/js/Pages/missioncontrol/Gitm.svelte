<script>
   
   import { Realtime } from 'ably';
   let D = new Date().getFullYear();


var realtime = new Realtime({ authUrl: '/ablyauth' });

realtime.connection.once('connected', function() {
  alert("you are connected");
});

const channel = realtime.channels.get('get-started');


function submit(value) {
    channel.publish('state', value);
    console.log(value);
  }



   </script>
   
   
   
   <main
       class="h-screen flex flex-col justify-between items-center px-4 py-4 bg-black text-red-900 font-mono"
   >
       <div>
           <h1>KoloWn App : Ghost in the Machine {D}</h1>
       </div>
       &nbsp;
       &nbsp;

       <div>
        <p> State1: All Screens visual 1</p>
        <p> State2: All Screens visual 2</p>
        <p> State3: All Screens visual 3</p>
        <p> State4: random visuals</p>
        <p> State5: random visuals</p>
        <p> State6: random visuals</p>

        
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


  
   
   
   
   </main>
   