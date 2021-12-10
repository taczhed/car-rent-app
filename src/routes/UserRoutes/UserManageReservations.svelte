<script>
    import checkLoginStatus from "../../Functions/LoginCheck";
    import UserTableRow from "../../components/UserComponents/UserTableRow.svelte";
    import UserPlaceholderTableRow from "../../components/UserComponents/UserPlaceholderTableRow.svelte";

    const reload = async () => {
        await fetchReservations()
    }

    const fetchReservations = async () => {
        const userData = await checkLoginStatus('userPanel')

        let data = new FormData()
        data.append('user_id', userData.id)
        const res = await fetch(`./backend/fetchUserReservations.php`, {method: "POST", body: data})
        data = await res.json()
        reqestedReservations = data
        return data
    }

    let reqestedReservations = fetchReservations()

</script>

<div class="w-full flex flex-col justify-center align-center">
    <h1 class="text-center text-4xl font-bold p-8 bg-gray-600 text-white">Moje rezerwacje</h1>
    <table class="bg-gray-500">
        <thead class="bg-gray-300"><tr>
            <th class="px-6 py-2 text-xs text-gray-500">Status</th>
            <th class="px-6 py-2 text-xs text-gray-500">Marka</th>
            <th class="px-6 py-2 text-xs text-gray-500">Model</th>
            <th class="px-6 py-2 text-xs text-gray-500">Data rozpoczęcia</th>
            <th class="px-6 py-2 text-xs text-gray-500">Data zakończenia</th>
            <th class="px-6 py-2 text-xs text-gray-500">Kosz całkowity</th>
            <th class="px-6 py-2 text-xs text-gray-500"></th>
        </tr></thead>
        <tbody class="bg-white">
        {#await reqestedReservations}
            <h1>Loading reqestedReservations...</h1>
        {:then res}
            {#if res.length !== 0}
                {#each res as data, i}
                    <UserTableRow
                        status={data.status}
                        carId={data.carId}
                        brand={data.brand}
                        model={data.model}
                        dateFrom={data.dateFrom}
                        dateTo={data.dateTo}
                        reservationId={data.reservationId}
                        price={data.price}
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
