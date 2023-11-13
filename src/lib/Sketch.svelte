<script lang="ts">
	import P5 from 'p5-svelte';
  import { onMount,onDestroy } from 'svelte';
  import { connectWebSocket, sendMessage } from '$lib/socket';
  import { fly } from "svelte/transition";

    let width:number = 55;
    let height:number = 55;
    let bg: any;
    let canvas:any;
    let showSketch:boolean = true;
    let buttonLabel:string = "Done";


    
    let message = '';
  
    onMount(() => {
      alert('draw on the sticker and press send')
      connectWebSocket();
   
    });


    async function sendWebSocketMessage(msg: string | ArrayBufferLike | Blob | ArrayBufferView) {
      try {
        sendMessage(msg);
        message = `Message sent: ${msg}`;
      } catch (error) {
        message = 'Failed to send message';
      }
    }


	const sketch = (p5:any) => {

        p5.preload =() => {
            bg = p5.loadImage('https://kolown.net/server2/lbc.jpg');
            bg.p5.resize(320,0)
        }

		p5.setup = () => {
			canvas = p5.createCanvas(320,213.6);
     
            p5.background(bg);
            p5.strokeWeight(10)
		};

		p5.draw = () => {
			


            if (p5.mouseIsPressed) {
		p5.stroke("black");
    p5.line(p5.mouseX, p5.mouseY, p5.pmouseX, p5.pmouseY);
  }
		};

	};


    function sendDataToServer() {
    // convert the canvas image to a data URL
    const dataURL = canvas.canvas.toDataURL();

    // send the data URL to the PHP server
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/server/tradewindsluzon/tw.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
 
    xhr.onload = function() {
    if (xhr.status === 200) {
      // Handle a successful response from the server
      const response = JSON.parse(xhr.responseText);
      console.log(response.status); // 'success'
      console.log(response.message); // 'Image processing is complete'
      console.log(response.filename); // 'Image processing is complete'
      sendWebSocketMessage('process:' + response.filename);
      // You can update the UI or take further action based on the response
    } else {
      // Handle errors or non-200 HTTP responses
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };


    xhr.send('imageData=' + dataURL);
   
  
    showSketch = false;


   
  }

  
</script>



  {#if showSketch}
    {#key showSketch} <!-- Add the #key directive to properly transition in and out -->
      <div in:fly={{ x: 200, duration: 300 }} out:fly={{ y: -200, duration: 900 }} class="flex flex-col items-center">
        <P5 {sketch} />

       <div class ='py-10'>
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded" id="buttonsave" on:click={sendDataToServer}>
           Send Sticker
          </div>
      </div>
    {/key}
  {:else}
  <!-- Render a different component or content when showComponent is false -->
  <div>
    <p>Thanks</p>


<div class ='py-4'>
  <a href="https://instagram.com/kolown">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">Follow us on IG</button>
  </a>

</div>

<div class ='py-4'>
  <a href="https://kolown.substack.com/">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">Subsribe on Substack</button>
  </a>
</div>
  


  </div>
{/if}
