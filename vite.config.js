// vite.config.js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { svelte } from "@sveltejs/vite-plugin-svelte"; // added this line

export default defineConfig({
plugins: [
laravel({
input: ["resources/css/app.css", "resources/js/app.js"],
refresh: true,
}),
svelte({}), // added this line
],
});