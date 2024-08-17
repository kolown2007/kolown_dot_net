<script lang="ts">
    
    import { Realtime } from 'ably';

    let hearts = [];
    //let count = $state(0);
    let backgroundColor = '#080101';

//    let realtime:Realtime;
let realtime = new Realtime({ authUrl: '/ablyauth' });


        
    realtime.connection.once('connected', function() {
      alert("tap the screen to send love");

    });

    const channel = realtime.channels.get('get-started');
    async function handleTap(event: { clientX: any; clientY: any; }) {
     //count++;
        const { clientX, clientY } = event;
        channel.publish('endless', "love");

        const heart = {
            id: Date.now(),
            x: clientX,
            y: clientY
        };

        hearts = [...hearts, heart];
       
        // Remove the heart after the animation ends
        setTimeout(() => {
            hearts = hearts.filter(h => h.id !== heart.id);
        }, 1000);

    
    }


  
</script>

<style>
    main {
        position: relative;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        background-color: var(--background-color);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    
  .center-heart {
    position: fixed;
    top: 50%;
    left: 50%;
    width: 50px;
    height: 50px;
    background-image: url('/public/storage/assets/gitm/heart.svg'); 

    transform: translate(-50%, -50%);
  }

    .heart {
        position: absolute;
        width: 50px;
        height: 50px;
        background-image: url('/public/storage/assets/gitm/heart.svg'); 
        background-size: cover;
        animation: fade 1s ease-out forwards;
    }

    @keyframes fade {
        0% {
            opacity: 1;
            transform: scale(1);
        }
        100% {
            opacity: 0;
            transform: scale(7);
        }
    }
</style>

<!-- svelte-ignore a11y-click-events-have-key-events -->
<!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
<main onclick={handleTap}   style="--background-color: {backgroundColor}" >
    <div class="center-heart"></div>

    {#each hearts as heart (heart.id)}
        <div
            class="heart"
          
           
        ></div>
    {/each}
</main>