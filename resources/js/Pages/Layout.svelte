<script context="module">
    export { default as layout } from './Layout.svelte'
  </script>
  
  <script>
    export let user
  </script>
  
 <h1>Hello</h1>

  <p>Hello {user.name}, welcome to your first Inertia app!</p>