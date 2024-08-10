<script>
    
    import * as Ably from 'ably';

    let hearts = [];
    let clickCount = 0;
    let backgroundColor = '#080101';

  /* Set up a Realtime client that authenticates with the local web server auth endpoint */
  var realtime = new Ably.Realtime({ authUrl: '/auth' });

  realtime.connection.once('connected', function() {
    alert("hello");
  });

    async function handleTap(event) {
        const { clientX, clientY } = event;


     
        const channel = realtime.channels.get('get-started');
        channel.publish('first', "love");

        const heart = {
            id: Date.now(),
            x: clientX,
            y: clientY
        };

        hearts = [...hearts, heart];
        clickCount += 1;

        if (clickCount >= 10) {
            backgroundColor = 'blue';
        }

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

    .heart {
        position: absolute;
        width: 50px;
        height: 50px;
        background-image: url('https://icons.iconarchive.com/icons/designbolts/free-valentine-heart/256/Heart-icon.png'); /* Replace with your heart image URL */
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
            transform: scale(2);
        }
    }
</style>

<!-- svelte-ignore a11y-click-events-have-key-events -->
<!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
<main on:click={handleTap} style="--background-color: {backgroundColor}">
    {#each hearts as heart (heart.id)}
        <div
            class="heart"
           
        ></div>
    {/each}
</main>