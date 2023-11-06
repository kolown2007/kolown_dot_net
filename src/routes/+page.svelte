<script lang="ts">
  import { onMount } from "svelte";
  import { connectWebSocket, sendMessage } from "$lib/socket";

  let message = "";

  onMount(() => {
    connectWebSocket();
  });

  async function sendWebSocketMessage(
    msg: string | ArrayBufferLike | Blob | ArrayBufferView
  ) {
    try {
      sendMessage(msg);
      message = `Message sent: ${msg}`;
    } catch (error) {
      message = "Failed to send message";
    }
  }
</script>

<main>
  <!-- <h1 class="py-6 text-lg">Click the image to paste</h1> -->
  <div class="grid grid-cols-3 gap-4 px-10 py-10">
    <!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
    <!-- svelte-ignore a11y-click-events-have-key-events -->
    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/egg.png"
        on:click={() => sendWebSocketMessage("egg")}
        alt="egg"
        class="w-64"
      />
    </div>

    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/ungga.png"
        alt="ungga"
        class="w-64"
      />
    </div>
    <!-- svelte-ignore a11y-click-events-have-key-events -->
    <!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/kolown1.png"
        alt="kolown"
        class="w-64"
      />
    </div>
    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/mano.png"
        alt="mano"
        class="w-64"
      />
    </div>
    <!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
    <!-- svelte-ignore a11y-click-events-have-key-events -->
    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/wes.png"
        alt="wuser"
        class="w-64"
      />
    </div>
    <!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
    <!-- svelte-ignore a11y-click-events-have-key-events -->
    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/kolown2.png"
        on:click={() => sendWebSocketMessage("reload")}
        alt="The project logo"
        class="w-64"
      />
    </div>
    <!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
    <!-- svelte-ignore a11y-click-events-have-key-events -->
    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/def.png"
        on:click={() => sendWebSocketMessage("def")}
        alt="def"
        class="w-64"
      />
    </div>
    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/okto.png"
        alt="okto"
        class="w-64"
      />
    </div>

    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/kanu.png"
        alt="kanu"
        class="w-64"
      />
    </div>
    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/bart.png"
        alt="bart"
        class="w-64"
      />
    </div>
    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/karayom.png"
        alt="karayom"
        class="w-64"
      />
    </div>
    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/soika.png"
        alt="soika"
        class="w-64"
      />
    </div>
    <div>
      <img
        src="https://kolown.net/server/tradewindsluzon/psp/alien.png"
        alt="alien"
        class="w-64"
      />
    </div>
    <div>
      <img src="https://kolown.net/server2/lbc.jpg" alt="lbc" class="w-64" />
    </div>

    <!-- <div class=" flex justify-center items-center data-sveltekit-preload-data">
          <a href="/sketch">
            <img src="https://kolown.net/server2/lbc.jpg" class="justify-center items-center w-64" alt="link">
          </a>
          </div>
      </div> -->
  </div>
</main>
