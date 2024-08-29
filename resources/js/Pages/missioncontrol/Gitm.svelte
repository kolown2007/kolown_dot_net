<script>
   
   import { Realtime } from 'ably';
   import { onMount } from 'svelte';
   let D = new Date().getFullYear();
   let audience;
   let devices;
   let channel;

   


   onMount(async () => {
        try {
            const realtime = new Realtime({ authUrl: '/api/ablyauth' });

            realtime.connection.once('connected', function() {
                alert("you are connected");
            });

            const channelOpts = { params: { occupancy: 'metrics' } };
            channel = realtime.channels.get('get-started', channelOpts);

            await channel.subscribe('[meta]occupancy', (message) => {
                console.log('occupancy: ', message.data.metrics);
                audience = message.data.metrics.publishers;

                devices = message.data.metrics.subscribers - message.data.metrics.publishers;
  
            });

       

                    

         
        } catch (error) {
            console.error('Error connecting to server:', error);
        }
    });


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
     
       <div> <a href ="https://kolown.com/docs/gitm" > Docs </a></div>
       &nbsp;

       <div> 
        <p class ="text-slate-200 font-bold"> Online Stats</p>
        
        <p>endlessLove:{audience}</p>
         <p>GITM app:{devices}</p>
       
    
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
   