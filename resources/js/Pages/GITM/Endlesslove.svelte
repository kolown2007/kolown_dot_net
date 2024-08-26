<script lang="ts">
    import { Realtime } from 'ably';
    import { onMount, onDestroy } from 'svelte';


    let hearts = [];
    let count = 0;
    let backgroundColor = '#080101';
    let showCenterHeart = true;
    let lastmessage: boolean = false;
    let lastTap = 0;

    let realtime: Realtime;
    let channel: any;

    const messages = [
        "double tap the heart to send love",
        "Do robots feel love?",
        "where is the love?",
        "the next love you send will alter the installation",
        "cool right?",
        "think before you click",
        "we are all connected",
        "you are now part of the installation",
        "love is a now a currency",
        "you have 5 love left",     
        "if love is the answer",
        "what is the question?",
        "make love not war",
        "mahal ko kayo",
      
    ];

    

    onMount(() => {
        realtime = new Realtime({ authUrl: '/ablyauth' });
        realtime.connection.once('connected', () => {
            alert("double tap the heart to send love");
        });

        channel = realtime.channels.get('get-started');
        document.addEventListener('touchend', handleDoubleTap);
    });

    onDestroy(() => {
        document.removeEventListener('touchend', handleDoubleTap);
    });

    function handleDoubleTap(event: TouchEvent) {
        const currentTime = new Date().getTime();
        const tapLength = currentTime - lastTap;
        if (tapLength < 300 && tapLength > 0) {
            handleTap();
        }
        lastTap = currentTime;
    }

    async function handleTap() {
        count += 1;
        console.log("Count:" + count);

        if (count === 5) {
            backgroundColor = 'blue';
            channel.publish('state', "state3");
            alert('alter the installation');



        }

        if (count === 10) {
            backgroundColor = 'green';
            channel.publish('state', "state3");
            alert('refresh the installation');
           
        }

        if (count === 15) {
           // updateLove();
            lastmessage = true;
            backgroundColor = 'red';
            channel.publish('state', "state6");
            //hearts = [];
            showCenterHeart = false; // Hide the center heart
            realtime.connection.close();
       
       
            //window.open("https://instagram.com/kolown", "_blank");
        }

        channel.publish('endless', "love");

        const heart = {
            id: Date.now()
        };

        hearts = [...hearts, heart];
       
        // Remove the heart after the animation ends
        setTimeout(() => {
            hearts = hearts.filter(h => h.id !== heart.id);
        }, 1000);
    }



    async function updateLove() {
        try {
            const response = await fetch('/api/updatelove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    // Add any data you need to send here, if any
                })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            console.log('Love count updated:', data);
        } catch (error) {
            console.error('Error updating love count:', error);
        }
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

    .count-display {
        position: absolute;
        top: 100px; /* 100px below the top of the screen */
        left: 50%;
        transform: translateX(-50%);
   
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




<main style="--background-color: {backgroundColor}">
    <div class="count-display text-stone-50"></div>

    {#if count == 0 }
    <div class="count-display text-stone-50">you have 15 love power</div>
{/if}

    {#if count > 0 && count <= messages.length}
    <div class="count-display text-stone-50">{messages[count - 1]}</div>
{/if}

{#if lastmessage === true}
    <div class="count-display text-stone-50">
        <p> You have reached the maximum love limit. </p>
        &nbsp;
        &nbsp;
        &nbsp;
        <p> Ghosts_in_the_Machine </p>
        <p> a love project by: </p>
        <p class="text-2xl font-extrabold"> KoloWn </p>



    </div> 
    
{/if}


    {#if showCenterHeart}
        {count}
        <div class="center-heart"></div>

        {#each hearts as heart (heart.id)}
            <div class="heart"></div>
        {/each}
    {/if}
</main>