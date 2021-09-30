<script>
	import Router from "svelte-spa-router";
	import Home from "./routes/Home.svelte";
	import NotFound from "./routes/NotFound.svelte";
	import Header from "./components/Header.svelte";
	import Tailwindcss from "./Tailwindcss.svelte";
	import Table from "./routes/Table.svelte";
</script>

<main class="h-screen">
	<Tailwindcss/>
	<Header />
	<Router routes={
	{
		"/": Home,
		"/table": Table,
		"*": NotFound,
	}
	}/>
</main>

<style>
</style>