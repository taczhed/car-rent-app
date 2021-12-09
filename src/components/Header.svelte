<script>

    import checkLoginStatus from '../Functions/LoginCheck'
    import Popup from "./Popup.svelte";

    const UserInformationPromise = checkLoginStatus()

    const logout = async () => {
        const res = await fetch('./backend/logoutRequest.php', {method: "POST"})
        await window.location.reload(true)
    }

    checkLoginStatus()
</script>

<header>
    <nav class="shadow-lg bg-cray">
        <div class="container mx-auto">
            <div class="flex justify-between">
                <div id="left-bar" class="flex direction-row">
                    <a href="#/" class="text-white text-3xl font-bold">
                        <img src="./assets/logo.png" alt="logo" class="h-16 mt-2">
                    </a>
                    <div class="ml-55">
                        <ul class="self-center text-xl text-black-900 font-bold">

                            {#await UserInformationPromise then user}
                                {#if user.accountType === "admin"}
                                    <li class="p-6 inline-block border-b-4 border-transparent hover:border-black transition duration-150 ease-in">
                                        <a class="p-3 hover:no-underline" href="#/admin">Admin</a>
                                    </li>
                                    <li class="p-6 inline-block border-b-4 border-transparent hover:border-black transition duration-150 ease-in">
                                        <a class="p-3 hover:no-underline" href="#/users">Użytkownicy</a>
                                    </li>
                                {:else}
                                    <li class="p-6 inline-block border-b-4 border-transparent hover:border-black transition duration-150 ease-in">
                                        <a class="p-3 hover:no-underline" href="#/">Samochody</a>
                                    </li>
                                {/if}
                            {/await}

                            {#await UserInformationPromise then user}
                                {#if !user.status}
                                    <li class="p-6 inline-block border-b-4 border-transparent hover:border-black transition duration-150 ease-in">
                                        <a class="p-3 hover:no-underline" href="#/login">Logowanie</a>
                                    </li>
                                {/if}
                            {/await}

                            {#await UserInformationPromise then user}
                                {#if user.accountType === 'default'}
                                    <li class="p-6 inline-block border-b-4 border-transparent hover:border-black transition duration-150 ease-in">
                                        <a class="p-3 hover:no-underline" href="#/userPanel">Panel użytkownika</a>
                                    </li>
                                {/if}
                            {/await}

                            <!--                        <li class="p-6 inline-block border-b-4 border-transparent hover:border-black transition duration-150 ease-in">-->
                            <!--                            <a class="p-3 hover:no-underline" href="#/register">Rejestracja</a>-->
                            <!--                        </li>-->

                        </ul>
                    </div>
                </div>

                {#await UserInformationPromise then user}
                    {#if user.status}
                        <div id="right-bar">
                            <ul class="self-center text-xl text-black-900 font-bold">
                                <li class="px-2 pt-1 inline-block text-sm">{user.user}</li>
                                <li on:click={logout} class="p-6 inline-block border-b-4 border-transparent hover:border-black transition duration-150 ease-in cursor-pointer">Wyloguj</li>
                            </ul>
                        </div>
                    {/if}
                {/await}
            </div>
        </div>
    </nav>
</header>

<style>
    nav {
        background-color: #f7bf50;
    }
</style>