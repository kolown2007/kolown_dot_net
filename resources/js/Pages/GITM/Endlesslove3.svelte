<script lang="ts">
    import { Realtime } from 'ably';
    import { onMount } from 'svelte';
    import { fly } from 'svelte/transition';

    let showComponent: boolean = true;
    let count = 0;
    let backgroundColor = '#080101';
    let realtime: Realtime;
    let channel: any;

    onMount(() => {
        realtime = new Realtime({ authUrl: '/ablyauth' });
        realtime.connection.once('connected', () => {
        
            channel = realtime.channels.get('get-started');
         
        });

        realtime.connection.on('failed', (err) => {
            console.error('Connection failed:', err);
        });

        showComponent = true;
    });

    let images = Array(10).fill(null).map((_, index) => ({
        id: index,
        url: 'https://kolown.net/assets/gitm/heart.svg'
    }));

    async function handleTap(index: number) {
        count += 1;
        console.log("click:" + count);

        channel.publish('endless', "love");

        let stateStrings = ['state1', 'state2', 'state3', 'state4', 'state5'];
        let randomState = stateStrings[Math.floor(Math.random() * stateStrings.length)];

        // Remove the image at the specified index
        images = images.filter((_, i) => i !== index);

        // Check if the images array is empty
        if (images.length === 0) {
            showComponent = false;

            // Execute the logic when the last heart is tapped
            channel.publish('state', randomState);

            setTimeout(() => {
                realtime.connection.close();
                updateLove();
                backgroundColor = '#080101'; // Reset the background color after a short delay
            }, 100); // Adjust the delay as needed

            // Optionally open a new window
            // window.open("https://instagram.com/kolown", "_blank");
        }
    }

    async function updateLove() {
        try {
            const response = await fetch("/api/updatelove", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    // Add any data you need to send here, if any
                }),
            });

            if (!response.ok) {
                throw new Error("Network response was not ok");
            }

            const data = await response.json();
            console.log("Love count updated:", data);
        } catch (error) {
            console.error("Error updating love count:", error);
        }
    }
</script>

<style>
    .full-screen-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-image: url('https://kolown.net/assets/gitm/love.jpg');
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 10; /* Ensure it is above other content */
    }
</style>

<main class="relative w-screen h-screen overflow-hidden flex justify-center items-center" style="background-color: {backgroundColor}">
    {#if showComponent}
        <div class="grid grid-cols-3 gap-10 px-10 py-10">
            {#each images as image, index (image.id)}
                <div out:fly={{ y: -200, duration: 500 }}>
                    <!-- svelte-ignore a11y-click-events-have-key-events -->
                    <!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
                    <img
                        src={image.url}
                        alt="Heart"
                        class="w-16"
                        on:click={() => handleTap(index)}
                    />
                </div>
            {/each}
        </div>
    {/if}

    {#if !showComponent}
        <div class="full-screen-bg">
            <!-- Your content here -->
            <div class="fixed bottom-3 text-center text-white font-mono">
               
                <p class="text-4xl">Thank you for participating.</p>
            </div>
        </div>
    {/if}
</main>