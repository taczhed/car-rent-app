<script>
    import checkLoginStatus from "../Functions/LoginCheck";
    import Popup from "./Popup.svelte";
    import checkToday from "../Functions/CheckToday";

    let isPopUpSuccess = true
    let popUpText = ""
    let isPopUp = false


    export let carId;
    export let foto;
    export let title;
    export let age;
    export let power;
    export let price;

    const today = checkToday()
    let dateFrom = today
    let dateTo = ""

    const UserInformationPromise = checkLoginStatus()
    const reservationResponse = (isSuccess, text) => {
        isPopUpSuccess = isSuccess
        popUpText = text
        isPopUp = true
        setTimeout(() => isPopUp = false, 2000)
    }

    const reservationRequest = async (userObject, carId) => {
            if (dateFrom === "" || dateTo === "") reservationResponse(false, 'Podaj niezbędne daty!')
            else {
                let data = new FormData()
                data.append('user_id', userObject.id)
                data.append('car_id', carId)
                data.append('date_from', dateFrom)
                data.append('date_to', dateTo)
                const res = await fetch('./backend/reservationRequest.php', {
                    method: "POST",
                    body: data
                })
                data = await res.json()
                if (data.result === "success") reservationResponse(true, 'Wysłano zapytanie do administratora!')
                else reservationResponse(false, 'Wystąpił błąd! Spróbuj ponownie później!')
            }
    }

</script>

<div class="w-98 bg-gray-200 m-4 p-6 overflow-hidden shadow-xl">
    <p class="font-bold text-2xl mb-4">{title}</p>
    <img class="w-full object-cover h-52" src={foto} alt={title}>
        <p class="text-xl font-bold my-4">Informacje</p>
        <p class="text-lg">Rok produkcji: {age}</p>
        <p class="text-lg">Moc: {power} km</p>

    <div class="flex align-center justify-between pt-4">
        od
        <input
                min={today}
                max={dateTo}
                type="date"
                class="mx-2"
                bind:value={dateFrom}
        >
        do
        <input
                min={dateFrom}
                type="date"
                class="mx-2"
                bind:value={dateTo}
        >
    </div>

        <div class="flex align-center justify-between pt-4">
            <p class="text-3xl mt-4 font-bold">{price} zł <span class="text-sm mt-4">/ 1 doba</span></p>
                {#await UserInformationPromise then user}
                    {#if user.status}
                        <button on:click={() => reservationRequest(user, carId)} class="text-xs px-4 py-2 bg-cray border-none font-bold">Zapytaj o dostępność</button>
                    {:else}
                        <button on:click={() => location = "/#/login"} class="text-xs px-4 py-2 bg-cray border-none font-bold">Zapytaj o dostępność</button>
                    {/if}
                {/await}
        </div>
</div>

{#if isPopUp}
    <Popup isSuccess={isPopUpSuccess} popUpText={popUpText}/>
{/if}