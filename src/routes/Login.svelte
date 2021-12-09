<script>

    import Popup from "../components/Popup.svelte";
    import checkLoginStatus from "../Functions/LoginCheck";

    checkLoginStatus('login')

    let isPopUp = false
    let popUpText
    let isPopUpSuccess

    let email = ""
    let password = ""

    const loginHandler = async () => {
        if (email && password) {
            let data = new FormData()
            data.append('email', email)
            data.append('password', password)

            const res = await fetch('./backend/loginRequest.php', {
                method: "POST",
                body: data
            })

            data = await res.json()

            if (data.result === 'success') {
                location = '/'
            } else registerValidation(false, 'Zły login lub hasło!')
        } else registerValidation(false, 'Jedno z pól formularza pozostało puste!')
    }

    const registerValidation = (isSuccess, text) => {
        isPopUpSuccess = isSuccess
        popUpText = text
        isPopUp = true
        setTimeout(() => isPopUp = false, 2000)
    }

</script>

<div class="flex flex-col justify-center align-center w-1/2 mx-auto p-12">

    <h1 class="text-center text-3xl font-bold mb-8">Logowanie</h1>

    <form>
        <div class="w-full mb-8">
            <label class="font-bold">Adres e-mail: </label>
            <input
                class="w-full mt-2 p-2"
                type="email" id="email"
                placeholder="Wpisz swój adres e-mail..."
                bind:value={email}
            >
        </div>

        <div class="w-full">
            <label class="font-bold">Hasło: </label>
            <input
                class="w-full mt-2 p-2"
                type="password"
                id="password"
                placeholder="Wpisz swoje hasło..."
                bind:value={password}
            >
        </div>

        <div class="mt-4 text-xs w-full flex justify-end align-center">
            Jeśli nie masz konta użytkownika,&nbsp;<a href="#/register">zarejestruj się</a>!
        </div>

        <div class="w-full flex justify-center align-center">
            <button on:click={loginHandler} class="mt-6 px-16 py-4 bg-cray font-bold" >Zaloguj</button>
        </div>
    </form>


</div>

{#if isPopUp}
    <Popup isSuccess={isPopUpSuccess} popUpText={popUpText}/>
{/if}

<style>
</style>