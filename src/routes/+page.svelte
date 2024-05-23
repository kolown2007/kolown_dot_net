<script>
  let imageUrl = 'https://kolown.net/server/tradewindsluzon/psp/kolown4.png';
</script>

<style>
  #container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: rgb(46, 43, 45);
  }

  #image {
    width: 300px; /* Adjust the width as per your preference */
  }
</style>

<div id="container">
  <img id="image" src={imageUrl} alt="KOLOWN" />
</div>