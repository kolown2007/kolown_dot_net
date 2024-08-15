<script>
   

   let D = new Date().getFullYear();
   import { router } from '@inertiajs/svelte'


  let values = {
  email: null
  }



function handleSubmit() {
    router.post('/api/allowedemail', values)
    values.email = null;
  }







   </script>
   
   
   
   <main
       class="h-screen flex flex-col justify-between items-center px-4 py-4 bg-black text-red-900 font-mono"
   >
       <div>
           <h1>KoloWn App {D}</h1>
       </div>
   
     

   
       <div class=" h-screen flex flex-col justify-center">
            
            <form on:submit|preventDefault={handleSubmit}>
                <input id="email" bind:value={values.email} placeholder="allowed user">
                <button type="submit">Submit</button>

              </form>
   
       </div>
   
   
   
   
   </main>
   