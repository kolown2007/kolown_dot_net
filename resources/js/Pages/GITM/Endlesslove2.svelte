<script lang="ts">
    import { Realtime } from 'ably';
    import { onMount} from 'svelte';
    import { fly } from 'svelte/transition';

    let showComponent:boolean;
    let count = 0;
    let backgroundColor = '#080101';
    let realtime: Realtime;
    let channel: any;

    onMount(() => {
        realtime = new Realtime({ authUrl: '/ablyauth' });
        realtime.connection.once('connected', () => {
            //alert("you have 15 love limit");
            channel = realtime.channels.get('get-started');
        });
     
    showComponent=true;
    });


    
    let images = Array(15).fill(null).map((_, index) => ({
        id: index,
        url: 'https://kolown.net/assets/gitm/heart.svg'
    }));


    async function handleTap(index: number) {
        count += 1;
        console.log("click:" + count);

        if (count === 5) {
            backgroundColor = 'blue';
            channel.publish('state', "state3");
         
        }

        if (count === 10) {
            backgroundColor = 'green';
            channel.publish('state', "state3");
            
        }

        if (count === 15) {
            backgroundColor = 'red';
            channel.publish('state', "state6");
        
            setTimeout(() => {
                realtime.connection.close();
                backgroundColor = '#080101'; // Reset the background color after a short delay
            }, 100); // Adjust the delay as needed

       
          
          
           // window.open("https://instagram.com/kolown", "_blank");
        }

        // Remove the image at the specified index
        images = images.filter((_, i) => i !== index);

        // Check if the images array is empty
        if (images.length === 0) {
            showComponent = false;
        }

        channel.publish('endless', "love");
    }
</script>


<main class="relative w-screen h-screen overflow-hidden flex justify-center items-center" style="background-color: {backgroundColor}">
    {#if showComponent}
    <div class="grid grid-cols-3 gap-10 px-10 py-10">
    {#each images as image, index (image.id)}
        <!-- svelte-ignore a11y-click-events-have-key-events -->
        <!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
        <!-- svelte-ignore a11y-no-static-element-interactions -->
        <div  out:fly={{ y: -200, duration: 500 }}>
    <!-- svelte-ignore a11y-click-events-have-key-events -->
          <!-- svelte-ignore a11y-img-redundant-alt -->
    
            <img
                src={image.url}
                alt="Image"
                class="w-16"
                on:click={() => handleTap(index)}
            />
        </div>
    {/each}
    </div>
  {/if}
</main>