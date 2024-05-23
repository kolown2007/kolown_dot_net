<script lang='ts'>
    import { onMount } from "svelte";
    import { connectWebSocket, sendMessage } from "$lib/socket";
    import { fly } from "svelte/transition";
  
    let message = "";
    let sticker = "https://kolown.net/server2/lbc.jpg"
    let showComponent:boolean = true;
  
    let images = [
      "https://kolown.net/server/tradewindsluzon/psp/egg.png?1",
      "https://kolown.net/server/tradewindsluzon/psp/ungga.png?2",
      "https://kolown.net/server/tradewindsluzon/psp/def.png?3",
      "https://kolown.net/server/tradewindsluzon/psp/mano.png?4",
      "https://kolown.net/server/tradewindsluzon/psp/nuno.png?5",
      "https://kolown.net/server/tradewindsluzon/psp/kolown2.png?6",
      "https://kolown.net/server/tradewindsluzon/psp/alien.png?7",
      "https://kolown.net/server/tradewindsluzon/psp/kanu.png?8",
      "https://kolown.net/server/tradewindsluzon/psp/okto.png?9",
      "https://kolown.net/server/tradewindsluzon/psp/bart.png?10",
      "https://kolown.net/server/tradewindsluzon/psp/karayom.png?11",
      "https://kolown.net/server/tradewindsluzon/psp/soika.png?12",
      "https://kolown.net/server/tradewindsluzon/psp/wes.png?13",
      "https://kolown.net/server/tradewindsluzon/psp/kolown3.png?14",
      "https://kolown.net/server/tradewindsluzon/psp/kolown1.png?15",
      "https://kolown.net/server/tradewindsluzon/psp/sampipebomb.png?16",
      "https://kolown.net/server/tradewindsluzon/psp/nemo.png?17",
      "https://kolown.net/server/tradewindsluzon/psp/frank.png?18",
      "https://kolown.net/server/tradewindsluzon/psp/kolown4.png?19",
      
     
      
    ];
  
    onMount(() => {
      connectWebSocket();
    });
  
    async function sendWebSocketMessage(url:any) {
    // Get the last character of the URL and send it as a WebSocket message
  
    const queryString = url.split("?")[1]; 
  
  // Modify the queryString as needed
  // For example, let's add "modified" to it
  const lastCharacter = queryString ;
    try {
      sendMessage(lastCharacter);
  
      // Update the message variable
      message = `Last character sent: ${lastCharacter}`;
    } catch (error) {
      message = "Failed to send message";
    }
  }
  
    function removeImage(index: number) {
      sendWebSocketMessage(images[index]);
      images = images.filter((_, i) => i !== index);
  
      if (images.length === 0) {
        showComponent = false;
        window.location.href = "/sketch"
      }
  
  
    }
  </script>
  
  <main>
    {#if showComponent}
    <div id="images" class="grid grid-cols-3 gap-4 px-10 py-10">
      {#each images as image, index (image)}
        <!-- svelte-ignore a11y-click-events-have-key-events -->
        <!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
        <div in:fly={{ x: 200, duration: 300 }} out:fly={{ y: -200, duration: 500 }}>
          <!-- svelte-ignore a11y-click-events-have-key-events -->
          <!-- svelte-ignore a11y-img-redundant-alt -->
          <img
            src={image}
            alt="Image"
            class="w-64"
            on:click={() => removeImage(index)}
          />
        </div>
      {/each}
    </div>
  {/if}
    
  
  </main>
            <!-- <a href='/sketch'>
        <img src={'https://kolown.net/server2/lbc.jpg'} alt="sticker"> -->