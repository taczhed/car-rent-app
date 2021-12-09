<script>
    import Popup from "../Popup.svelte";

    export let userId;
    export let email;
    export let accountType;
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

    const promote = async () => {
        let data = new FormData()
        data.append('user_id', userId)
        const res = await fetch('./backend/promoteUser.php', {
            method: "POST",
            body: data
        })
        data = await res.json()
        if (data.result === "success") reservationResponse(true, `Awansowano użytkownika ${email}!`), reload()
        else reservationResponse(false, 'Błąd awansowania!')
    }

</script>


<tr class="whitespace-nowrap  bg-gray-100">
    <td class="px-6 py-4 text-sm text-gray-500 text-center">{userId}</td>
    <td class="px-6 py-4"><div class="text-sm text-gray-900 text-center">{email}</div></td>
    <td class="px-6 py-4"><div class="text-sm text-gray-900 text-center">{accountType}</div></td>
    <td class="px-6 py-4 flex justify-center">
        <button on:click={() => promote()} class="px-4 py-2 text-sm text-white bg-green-700 rounded" disabled={accountType === 'admin'}>Awansuj na administratora!</button>
    </td>
</tr>

{#if isPopUp}
    <Popup isSuccess={isPopUpSuccess} popUpText={popUpText}/>
{/if}