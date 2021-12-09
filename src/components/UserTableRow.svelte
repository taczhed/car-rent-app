<script>
    import Popup from "./Popup.svelte";

    export let carId;
    export let brand;
    export let model;
    export let dateFrom;
    export let dateTo;
    export let reservationId;
    export let reload;

    let isPopUpSuccess = true
    let popUpText = ""
    let isPopUp = false
    const reservationResponse = (isSuccess, text) => {
        isPopUpSuccess = isSuccess
        popUpText = text
        isPopUp = true
        setTimeout(() => isPopUp = false, 2000)
    }

    const accept = async () => {
        let data = new FormData()
        data.append('reservation_id', reservationId)
        data.append('new_status', 'active')
        const res = await fetch('./backend/changeReservationStatus.php', {
            method: "POST",
            body: data
        })
        data = await res.json()
        if (data.result === "success") reservationResponse(true, 'Zaakceptowano rezerwacje!'), reload()
        else reservationResponse(false, 'Błąd rezerwacji!')
    }

    const reject = async () => {
        let data = new FormData()
        data.append('reservation_id', reservationId)
        const res = await fetch('./backend/rejectReservation.php', {
            method: "POST",
            body: data
        })
        data = await res.json()
        if (data.result === "success") reservationResponse(true, 'Poprawnie odwołano rezerwację!'), reload()
        else reservationResponse(false, 'Błąd odwołania rezerwacji!')
    }
</script>


<tr class="whitespace-nowrap  bg-gray-100">
    <td class="px-6 py-4"><div class="text-sm text-gray-900 text-center">{brand}</div></td>
    <td class="px-6 py-4"><div class="text-sm text-gray-500 text-center">{model}</div></td>
    <td class="px-6 py-4 text-sm text-gray-500 text-center">{dateFrom}</td>
    <td class="px-6 py-4 text-sm text-gray-500 text-center">{dateTo}</td>
    <td class="px-6 py-4">
        <button on:click={() => reject()} class="px-4 py-2 text-sm text-white bg-red-700 rounded">Odwołaj rezerwacje</button>
    </td>
</tr>

{#if isPopUp}
    <Popup isSuccess={isPopUpSuccess} popUpText={popUpText}/>
{/if}