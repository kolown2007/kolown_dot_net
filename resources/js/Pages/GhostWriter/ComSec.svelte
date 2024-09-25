<script lang="ts">
      import { onMount } from 'svelte';
      import { Realtime } from 'ably';
  import Pusher from 'pusher-js';
  import { useForm } from '@inertiajs/svelte'
  let D = new Date().getFullYear();

  let realtime: Realtime;
  let channel: any;
    
  onMount(() => {
        realtime = new Realtime({ authUrl: '/ablyauth' });
        realtime.connection.once('connected', () => {
        channel = realtime.channels.get('ghostwriter');
        });
     

    });

  
   
    let values = useForm ({
           sms:"",
          })
   
//      function submit() {
//      $values.post('/trigger',{
//      preserveScroll: true,
//      onSuccess: () => $values.sms = '',
//    });
//      console.log($values.sms);
   
//    }

function submit() {
    channel.publish('ghostwriter', $values.sms);
    console.log($values.sms);
    $values.sms = '';
  
}

</script>




<main
class="h-screen flex flex-col justify-between items-center px-4 py-4 bg-black text-red-900 font-mono"
>
<div>
    <h1>KoloWn App {D}</h1>
</div>

<div class=" h-screen flex flex-col justify-center">
    <div class="p-4 flex">
        <input
            id="sms"
            type="string"
            placeholder="Type a message"
            bind:value={$values.sms}
            class="w-full max-w-96 px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-red-500"
        />
        <button
            id="send-button"
            class="bg-red-500 text-white px-4 py-2 rounded-r-md hover:bg-red-400 transition duration-300"
            on:click={submit}>Send</button
        >
    </div>

</div>




</main>
