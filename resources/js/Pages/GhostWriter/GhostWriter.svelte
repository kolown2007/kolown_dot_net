<script>
    import { onMount } from 'svelte';

    let canvas;
    let ctx;
    let currentSlide = 0;
    let slides = [];

    onMount(async () => {
        try {
            // Fetch slide data from the API
            const response = await fetch('https://kolown.net/api/scrape-headline');
            const data = await response.json();
            console.log('Fetched data:', data);

            // Extract the first 5 headlines from the main_headline array
            if (data.main_headline && Array.isArray(data.main_headline)) {
                slides = data.main_headline.slice(0, 5);
                console.log('Slides:', slides);
            } else {
                console.error('main_headline is not an array or does not exist:', data.main_headline);
            }

            // Initialize canvas context
            ctx = canvas.getContext('2d');
            console.log('Canvas context:', ctx);

            // Draw the first slide
            if (slides.length > 0) {
                drawSlide(currentSlide);
            } else {
                console.error('No slides available');
            }
        } catch (error) {
            console.error('Error fetching slides:', error);
        }
    });

    function drawSlide(index) {
        if (ctx && slides[index]) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.font = '30px Arial';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle'; // Set text baseline to middle

            const text = slides[index];
            const textWidth = ctx.measureText(text).width;
            const x = canvas.width / 2;
            const y = canvas.height / 2;

            ctx.fillText(text, x, y);
            console.log('Drawing slide:', slides[index]);
        } else {
            console.error('Cannot draw slide:', index);
        }
    }

    function prevSlide() {
        if (currentSlide > 0) {
            currentSlide--;
            drawSlide(currentSlide);
        }
    }

    function nextSlide() {
        if (currentSlide < slides.length - 1) {
            currentSlide++;
            drawSlide(currentSlide);
        }
    }
</script>

<style>
    canvas {
        border: 1px solid black;
    }
    .controls {
        margin-top: 10px;
    }
</style>

<canvas bind:this={canvas} width="800" height="600"></canvas>
<div class="controls">
    <button on:click={prevSlide}>Previous</button>
    <button on:click={nextSlide}>Next</button>
</div>