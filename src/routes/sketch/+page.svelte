
<script lang="ts">
     import Sketch from '$lib/Sketch.svelte'

    function disableScroll() {
  document.body.style.overflow = 'hidden';
}

disableScroll();
</script>

<svelte:head>
	<title>Paint</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</svelte:head>

<body>
<main>
<div class="min-h-screen flex flex-col justify-center items-center">
  <div class="w-full sm:w-3/4 lg:w-1/2 flex flex-col justify-center items-center ">
    <Sketch />
  </div>
</div>
</main>
</body>

