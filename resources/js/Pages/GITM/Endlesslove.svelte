<script>
    import { Realtime } from "ably";
    import { onMount, onDestroy } from "svelte";
    import * as Tone from "tone";

    let hearts = [];
    let count = 0;
    let backgroundColor = "#080101";
    let showCenterHeart = true;
    let lastmessage = false;
    let lastTap = 0;
    let isconnected = false;
    let lovebg = "https://kolown.net/assets/gitm/love.jpg";

    let realtime;

    let channel;

    //music notes
    const synth = new Tone.Synth().toDestination();
    const notes = ["C4", "D4", "E4", "F4", "G4", "A4", "B4"];

    const messages = [
        "You have 9 love credits left",
        "the next love you send will alter the installation",
        "cool right?",
        "Do robots feel love?",
        "look around and double tap",
        "you are now part of the installation",
        "we are all connected",
        "think before you click",
        "Hello, We are KoloWn, this is your last two love credits",
        "",
    ];

    onMount(() => {
        //analytics
        const script = document.createElement("script");
        script.src = "https://www.googletagmanager.com/gtag/js?id=G-VP97YYDPP0";
        script.async = true;
        document.head.appendChild(script);

        script.onload = () => {
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());
            gtag("config", "G-VP97YYDPP0");
        };

        //realtime

        realtime = new Realtime({ authUrl: "/ablyauth" });
        realtime.connection.once("connected", () => {
            alert(
                "You have 10 love credits.",
            );
        });

        realtime.connection.on("connected", () => {
         isconnected = true;
        });

        channel = realtime.channels.get("get-started");

        document.addEventListener("touchend", handleDoubleTap);
      
    });

    onDestroy(() => {
        document.removeEventListener("touchend", handleDoubleTap);
    });

    //accessory functions

    function handleDoubleTap(event) {
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

    //sound component
      playRandomNote();

      //vibration
      navigator.vibrate(200);

        if (count === 1) {
            channel.publish("endless", "love");
        }

        if (count === 2) {
            channel.publish("endless", "love");
        }

        if (count === 3) {
            backgroundColor = "blue";
            alert("alter the installation");
            channel.publish("state", "state3");
        }

        if (count === 4) {
            channel.publish("endless", "love");
        }

        if (count === 5) {
            channel.publish("endless", "love");
        }

        if (count === 6) {
            channel.publish("endless", "love");
        }

        if (count === 7) {
            channel.publish("endless", "love");
        }

        if (count === 8) {
            backgroundColor = "green";
            alert("refresh the installation");
            channel.publish("state", "state1");
           
        }

        if (count === 9) {
            channel.publish("endless", "love");
        }

        if (count === 10) {
            updateLove();
            lastmessage = true;
            channel.publish("state", "state4");
            showCenterHeart = false; // Hide the center heart
            realtime.connection.close();
            synth.dispose();

         
        }

  

        const heart = {
            id: Date.now(),
        };

        hearts = [...hearts, heart];

        // Remove the heart after the animation ends
        setTimeout(() => {
            hearts = hearts.filter((h) => h.id !== heart.id);
        }, 1000);
    }

    //random sound function
    function getRandomNote() {
        const randomIndex = Math.floor(Math.random() * notes.length);
        return notes[randomIndex];
    }

    function playRandomNote() {
        const randomNote = getRandomNote();
        synth.triggerAttackRelease(randomNote, "8n");
    }

    //ajax function
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

<!-- svelte-ignore a11y-click-events-have-key-events -->
<!-- svelte-ignore a11y-no-noninteractive-element-interactions -->

<main style="--background-color: {backgroundColor}" class="font-mono">
    <div class="count-display text-stone-50"></div>

    {#if count == 0}
        <div class="count-display text-stone-50">Double tap to send love</div>
    {/if}

    {#if count > 0 && count <= messages.length}
        <div class="count-display text-stone-50">{messages[count - 1]}</div>
    {/if}

    {#if count === 10}
    <div class="background" style="background-image: url({lovebg});"></div>
{/if}

    {#if lastmessage === true}

<div class= "full-screen-bg"> 

    <div class="fixed bottom-0 left-0 right-0 flex justify-center items-center p-4  text-slate-50">
        <div class="text-center">
            <p class="text-4xl">You have reached the maximum love limit.</p>
            <p class="text-4xl">Thank you for participating.</p>
        </div>
    </div>

    </div>

    {/if}

    {#if isconnected && showCenterHeart}
        {count}
        <div class="center-heart"></div>

        {#each hearts as heart (heart.id)}
            <div class="heart"></div>
        {/each}
    {/if}
</main>

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
        background-image: url("/public/storage/assets/gitm/heart.svg");
        transform: translate(-50%, -50%);
    }

    .heart {
        position: absolute;
        width: 50px;
        height: 50px;
        background-image: url("/public/storage/assets/gitm/heart.svg");
        background-size: cover;
        animation: fade 1s ease-out forwards;
    }

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
