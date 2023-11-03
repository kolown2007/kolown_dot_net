<script lang="ts">
	import P5 from 'p5-svelte';
	let width = 55;
	let height = 55;
    let bg: any;
    let canvas:any;


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
      // handle response from server
    };
    xhr.send('imageData=' + dataURL);
    alert("sent");
    window.location.href = "https://kolown.net"
  }





</script>


<P5 {sketch} />
<div class ="justify-center py-4">


<button  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="buttonsave" on:click={sendDataToServer}>Send Sticker</button>

</div>