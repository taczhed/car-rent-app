<script>
	import Router from "svelte-spa-router";
	import Home from "./routes/Home.svelte";
	import NotFound from "./routes/NotFound.svelte";
	import Header from "./components/Header.svelte";
	import Tailwindcss from "./Tailwindcss.svelte";
	import Table from "./routes/Table.svelte";
	import Login from "./routes/Login.svelte";
	import Register from "./routes/Register.svelte";
	import AdminPanel from "./routes/AdminRoutes/AdminPanel.svelte";
	import ManageReservations from "./routes/UserRoutes/UserManageReservations.svelte";
	import UserManage from "./routes/AdminRoutes/AdminUserManage.svelte";
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
		"/users": UserManage,
		"*": NotFound,
	}
	}/>
</main>

<style>
</style>