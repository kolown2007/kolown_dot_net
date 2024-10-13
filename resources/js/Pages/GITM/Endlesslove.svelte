<script lang="ts">
    import { Realtime } from 'ably';
    import { onMount } from 'svelte';
    import { fly } from 'svelte/transition';

    let showComponent: boolean = true;
    let count: number = 0;
    let backgroundColor: string = '#080101';
    let realtime: Realtime;
    let channel: any;

    onMount((): void => {
        let gtmId: string = 'G-VP97YYDPP0';
        (window as any).dataLayer = (window as any).dataLayer || [];
        function gtag(...args: any[]): void {
            (window as any).dataLayer.push(args);
        }
        gtag('js', new Date());
        gtag('config', gtmId);
        const s: HTMLScriptElement = document.createElement('script');
        s.src = `https://www.googletagmanager.com/gtm.js?id=${gtmId}`;
        document.head.append(s);

        realtime = new Realtime({ authUrl: '/ablyauth' });
        realtime.connection.once('connected', () => {
            channel = realtime.channels.get('get-started');
            fetch('/api/kolown_bot');
        });

        realtime.connection.on('failed', (err: any) => {
            console.error('Connection failed:', err);
        });

        alert("click the hearts to interact with the installation");

        showComponent = true;
    });

    let images = Array(10).fill(null).map((_, index) => ({
        id: index,
        url: 'https://kolown.net/assets/gitm/heart.svg'
    }));

    async function handleTap(index: number): Promise<void> {
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
            // channel.publish('state', randomState);

            setTimeout(() => {
                realtime.connection.close();
                updateLove();
                backgroundColor = '#080101'; // Reset the background color after a short delay

              
                  window.location.href = "/";
            
              
            }, 100); // Adjust the delay as needed

         
        }
    }




    async function updateLove(): Promise<void> {
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


</main>