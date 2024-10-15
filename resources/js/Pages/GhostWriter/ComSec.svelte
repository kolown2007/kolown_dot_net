<script lang="ts">
    import { onMount } from 'svelte';
    import { Realtime } from 'ably';
    import { useForm } from '@inertiajs/svelte'

  let D = new Date().getFullYear();
  let errorMessage = '';

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
   



          async function submit() {
        const message = $values.sms.trim();

        // Validate that the input contains only one word
        if (message.split(' ').length > 1) {
            errorMessage = 'Please enter only one word.';
            alert(errorMessage);
        } else {
            // Clear any previous error message
            errorMessage = '';

            // Publish the message to the channel
            channel.publish('message', message);
            console.log(message);

            // Send the submitted text to the server using fetch
            try {
                const response = await fetch('/api/ghostwritermessage', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ content: message }),
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                console.log('Message sent to server successfully:', data);
            } catch (error) {
                console.error('Error sending message to server:', error);
            }

            // Clear the input field
            $values.sms = '';
        }
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
            placeholder="1 word only"
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
