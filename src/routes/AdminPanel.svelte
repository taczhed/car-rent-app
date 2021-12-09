<script>
    import checkLoginStatus from "../Functions/LoginCheck";
    import AdminPendingTableRow from "../components/AdminPendingTableRow.svelte";
    import AdminActiveTableRow from "../components/AdminActiveTableRow.svelte";
    import AdminPlaceholderTableRow from "../components/AdminPlaceholderTableRow.svelte";
    import AdminArchiveTableRow from "../components/AdminArchiveTableRow.svelte";

    checkLoginStatus('admin')

    const reload = async () => {
        await fetchReservations('Reqested')
        await fetchReservations('Active')
        await fetchReservations('Archive')
    }

    const fetchReservations = async (type) => {
        const res = await fetch(`./backend/fetch${type}Reservations.php`, {method: "GET",})
        const data = await res.json()
        if (type === 'Reqested') reqestedReservations = data
        else if (type === 'Active') activeReservations = data
        console.log('pobieram...')
        return data
    }

    let reqestedReservations = fetchReservations('Reqested')
    let activeReservations = fetchReservations('Active')
    let archiveReservations = fetchReservations('Archive')
</script>

<div class="w-full flex flex-col justify-center align-center">
    <h1 class="text-center text-4xl font-bold p-8 bg-gray-600 text-white">Prośby o wypożyczenie</h1>
    <table class="bg-gray-500">
        <thead class="bg-gray-300"><tr>
            <th class="px-6 py-2 text-xs text-gray-500">Id samochodu</th>
            <th class="px-6 py-2 text-xs text-gray-500">Użytkownik</th>
            <th class="px-6 py-2 text-xs text-gray-500">Marka</th>
            <th class="px-6 py-2 text-xs text-gray-500">Model</th>
            <th class="px-6 py-2 text-xs text-gray-500">Data rozpoczęcia</th>
            <th class="px-6 py-2 text-xs text-gray-500">Data zakończenia</th>
            <th class="px-6 py-2 text-xs text-gray-500">Sumaryczna cena</th>
            <th class="px-6 py-2 text-xs text-gray-500"></th>
        </tr></thead>
        <tbody class="bg-white">
        {#await reqestedReservations}
            <h1>Loading reqestedReservations...</h1>
        {:then res}
            {#if res.length !== 0}
                {#each res as data, i}
                    <AdminPendingTableRow
                        carId={data.carId}
                        user={data.user}
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
                <AdminPlaceholderTableRow/>
            {/if}
        {/await}
        </tbody>
    </table>


    <h1 class="text-center text-4xl font-bold p-8 bg-gray-600 text-white">Aktywne rezerwacje</h1>
    <table class="bg-gray-500">
        <thead class="bg-gray-300"><tr>
            <th class="px-6 py-2 text-xs text-gray-500">Id samochodu</th>
            <th class="px-6 py-2 text-xs text-gray-500">Użytkownik</th>
            <th class="px-6 py-2 text-xs text-gray-500">Marka</th>
            <th class="px-6 py-2 text-xs text-gray-500">Model</th>
            <th class="px-6 py-2 text-xs text-gray-500">Data rozpoczęcia</th>
            <th class="px-6 py-2 text-xs text-gray-500">Data zakończenia</th>
            <th class="px-6 py-2 text-xs text-gray-500">Sumaryczna cena</th>
            <th class="px-6 py-2 text-xs text-gray-500"></th>
        </tr></thead>
        <tbody class="bg-white">
        {#await activeReservations}
            <h1>Loading activeReservations...</h1>
        {:then res}
            {#if res.length !== 0}
                {#each res as data, i}
                    <AdminActiveTableRow
                        carId={data.carId}
                        user={data.user}
                        brand={data.brand}
                        model={data.model}
                        dateFrom={data.dateFrom}
                        dateTo={data.dateTo}
                        price={data.price}
                        reservationId={data.reservationId}
                        reload={reload}
                    />
                {/each}
            {:else}
                <AdminPlaceholderTableRow/>
            {/if}
        {/await}
        </tbody>
    </table>

    <h1 class="text-center text-4xl font-bold p-8 bg-gray-600 text-white">Archiwum zgłoszeń</h1>
    <table class="bg-gray-500">
        <thead class="bg-gray-300"><tr>
            <th class="px-6 py-2 text-xs text-gray-500">Id samochodu</th>
            <th class="px-6 py-2 text-xs text-gray-500">Użytkownik</th>
            <th class="px-6 py-2 text-xs text-gray-500">Marka</th>
            <th class="px-6 py-2 text-xs text-gray-500">Model</th>
            <th class="px-6 py-2 text-xs text-gray-500">Data rozpoczęcia</th>
            <th class="px-6 py-2 text-xs text-gray-500">Data zakończenia</th>
            <th class="px-6 py-2 text-xs text-gray-500">Sumaryczna cena</th>
            <th class="px-6 py-2 text-xs text-gray-500">Czas przerwania zgłoszenia</th>
        </tr></thead>
        <tbody class="bg-white">
        {#await archiveReservations}
            <h1>Loading archiveReservations...</h1>
        {:then res}
            {#if res.length !== 0}
                {#each res as data, i}
                    <AdminArchiveTableRow
                        carId={data.carId}
                        user={data.user}
                        brand={data.brand}
                        model={data.model}
                        dateFrom={data.dateFrom}
                        dateTo={data.dateTo}
                        price={data.price}
                        time={data.time}
                    />
                {/each}
            {:else}
                <AdminPlaceholderTableRow/>
            {/if}
        {/await}
        </tbody>
    </table>
</div>

<style>

</style>