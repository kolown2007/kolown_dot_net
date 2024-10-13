
<script>

    (function() {
        const script = document.createElement('script');
        script.src = 'https://www.googletagmanager.com/gtag/js?id=G-7NWHWFCK7F';
        script.async = true;
        document.head.appendChild(script);

        script.onload = () => {
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'G-7NWHWFCK7F');
        };
    })();

 
</script>



<header class="flex justify-center  w-full bg-black font-mono ">
    <nav class="flex justify-center max-w-2xl items-center p-6 font-mono">
      <a href="https://kolown.com/" class="text-red-800 mx-2">KoloWn_Archive</a>
      <a href="https://instagram.com/kolown /" class="text-red-800 mx-2">Instagram</a>
    
    </nav>
  </header>


<main class="flex flex-col items-center justify-center text-md min-h-screen bg-black text-red-500 font-mono no-scrollbar">
   


    <h1 class="text-center">Activations</h1>
    &nbsp;
    &nbsp;
    <div class="text-2xl grid grid-cols-1 gap-4 px-3">
        <div class="text-center">
            <a href="https://www.leeumhoam.org/leeum/exhibition/81?params=Y" class="text-2xl font-bold">Ghost_in_the_Machine</a>
            <p>at DreamScreen, Leeum Museum of Art, South Korea</p>
        </div>
    </div>

    <div class ="py-8"> 
        <button 
            class="bg-red-800 text-white py-2 px-4 rounded" 
            on:click={() => window.open("https://instagram.com/kolown", "_blank")}
        >
            Visit Instagram
        </button>
        </div>
</main>




