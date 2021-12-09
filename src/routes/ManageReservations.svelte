<script>
    import checkLoginStatus from "../Functions/LoginCheck";
    import UserTableRow from "../components/UserTableRow.svelte";
    import AdminPlaceholderTableRow from "../components/AdminPlaceholderTableRow.svelte";
    import UserPlaceholderTableRow from "../components/UserPlaceholderTableRow.svelte";

    const reload = async () => {
        await fetchReservations('User')
    }

    const fetchReservations = async (type) => {
        const userData = await checkLoginStatus('userPanel')
        let data = new FormData()
        data.append('user_id', userData.id)
        const res = await fetch(`./backend/fetch${type}Reservations.php`, {method: "POST", body: data})
        data = await res.json()
        if (type === 'User') reqestedReservations = data
        console.log('pobieram...')
        return data
    }

    let reqestedReservations = fetchReservations('User')

</script>

<div class="w-full flex flex-col justify-center align-center">
    <h1 class="text-center text-4xl font-bold p-8 bg-gray-600 text-white">Moje rezerwacje</h1>
    <table class="bg-gray-500">
        <thead class="bg-gray-300"><tr>
            <th class="px-6 py-2 text-xs text-gray-500">Marka</th>
            <th class="px-6 py-2 text-xs text-gray-500">Model</th>
            <th class="px-6 py-2 text-xs text-gray-500">Data rozpoczęcia</th>
            <th class="px-6 py-2 text-xs text-gray-500">Data zakończenia</th>
            <th class="px-6 py-2 text-xs text-gray-500"></th>
        </tr></thead>
        <tbody class="bg-white">
        {#await reqestedReservations}
            <h1>Loading reqestedReservations...</h1>
        {:then res}
            {#if res.length !== 0}
                {#each res as data, i}
                    <UserTableRow
                        carId={data.carId}
                        brand={data.brand}
                        model={data.model}
                        dateFrom={data.dateFrom}
                        dateTo={data.dateTo}
                        reservationId={data.reservationId}
                        reload={reload}
                    />
                {/each}
            {:else}
                <UserPlaceholderTableRow/>
            {/if}
        {/await}
        </tbody>
    </table>
</div>
