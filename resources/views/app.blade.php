
<!DOCTYPE html>
<html>
  <head>
   <title>KoloWn App</title>
    <meta charset="utf-8" />
    <link rel="icon" href="{{ asset('favicon.svg') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    @inertiaHead
  </head>
  <body>
  <div id="app" data-page="{{ json_encode($page) }}"></div>
    @inertia
  </body>
</html>


  
    