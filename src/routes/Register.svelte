<script>
import Popup from "../components/Popup.svelte";

let isPopUp = false
let popUpText
let isPopUpSuccess

let email = ""
let password = ""
let secPassword = ""

const registerHandler = async () => {

    if (email !== "" && password !== "" && secPassword !== "" && password === secPassword && email.includes('@')) {
        let data = new FormData()
        data.append('email', email)
        data.append('password', password)

        const res = await fetch('./backend/registerRequest.php', {
            method: "POST",
            body: data
        })

        data = await res.json()
        if (data.result === 'Błąd! Istnieje osoba o podanym adresie e-mail!') registerValidation(false, data.result)
        else registerValidation(true, data.result), setTimeout(() => location = "/#/login", 2000)
    }
    else if (password !== secPassword) registerValidation(false, 'Sprawdź poprawność haseł!')
    else registerValidation(false, 'Sprawdź poprawność wprowadzonych danych!')
}

    const registerValidation = (isSuccess, text) => {
        isPopUpSuccess = isSuccess
        popUpText = text
        isPopUp = true
        setTimeout(() => isPopUp = false, 2000)
    }

</script>

<div class="flex flex-col justify-center align-center w-1/2 mx-auto p-12">

    <h1 class="text-center text-3xl font-bold mb-8">Rejestracja</h1>

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

        <div class="w-full mb-8">
            <label class="font-bold">Hasło: </label>
            <input
                    class="w-full mt-2 p-2"
                    type="password"
                    id="password"
                    placeholder="Wpisz swoje hasło..."
                    bind:value={password}
            >
        </div>

        <div class="w-full">
            <label class="font-bold">Powtórz hasło: </label>
            <input
                    class="w-full mt-2 p-2"
                    type="password"
                    id="second-password"
                    placeholder="Wpisz ponownie swoje hasło..."
                    bind:value={secPassword}
            >
        </div>
    </form>

    <div class="mt-4 text-xs w-full flex justify-end align-center">
        Jeśli posiadasz już konto użytkownika,&nbsp;<a href="#/login">zaloguj się</a>!
    </div>

    <div class="w-full flex justify-center align-center">
        <button on:click={registerHandler} class="mt-6 px-16 py-4 bg-cray font-bold" >Zarejestruj!</button>
    </div>


</div>

{#if isPopUp}
    <Popup isSuccess={isPopUpSuccess} popUpText={popUpText}/>
{/if}

<style>
</style>