<script lang="ts">
    import { Realtime } from 'ably';
    import { onMount, onDestroy } from 'svelte';

    let hearts = [];
    let count = 0;
    let backgroundColor = '#080101';
    let showCenterHeart = true;
    let lastTap = 0;

    let realtime: Realtime;
    let channel: any;

    onMount(() => {
        realtime = new Realtime({ authUrl: '/ablyauth' });
        realtime.connection.once('connected', () => {
            alert("you have 15 love limit");
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
            alert('You have 10 remaining love');
        }

        if (count === 10) {
            backgroundColor = 'green';
            channel.publish('state', "state3");
            alert('You have 5 remaining love');
        }

        if (count === 15) {
            backgroundColor = 'red';
            channel.publish('state', "state6");
            hearts = [];
            showCenterHeart = false; // Hide the center heart
            setTimeout(() => {
                backgroundColor = '#080101'; // Reset the background color after a short delay
            }, 100); // Adjust the delay as needed
            alert('You have reached the maximum love limit.');
            window.open("https://instagram.com/kolown", "_blank");
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
<main style="--background-color: {backgroundColor}">
    <div class="count-display text-stone-50"></div>
    {#if showCenterHeart}
        {count}
        <div class="center-heart"></div>

        {#each hearts as heart (heart.id)}
            <div class="heart"></div>
        {/each}
    {/if}
</main>