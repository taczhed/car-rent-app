<script>
	import Router from "svelte-spa-router";
	import Home from "./routes/Home.svelte";
	import NotFound from "./routes/NotFound.svelte";
	import Header from "./components/Header.svelte";
	import Tailwindcss from "./Tailwindcss.svelte";
	import Table from "./routes/Table.svelte";
	import Login from "./routes/Login.svelte";
	import Register from "./routes/Register.svelte";
	import AdminPanel from "./routes/AdminPanel.svelte";
	import ManageReservations from "./routes/ManageReservations.svelte";
</script>

<main class="h-screen">
	<Tailwindcss/>
	<Header />
	<Router routes={
	{
		"/": Home,
		"/table": Table,
		"/login": Login,
		"/register": Register,
		"/admin": AdminPanel,
		"/userPanel": ManageReservations,
		"*": NotFound,
	}
	}/>
</main>

<style>
</style>