<script>
    async function getItems() {
        const URL = "./backend/displayCars.php";
        let res = await fetch(URL, {method: "GET"});
        res = await res.json();
        return res;
    }

    const rows = getItems()

</script>

<div class="flex flex-col justify-center align-center">
    <div class="text-center text-4xl block leading-loose">Cars</div>

    <table class="w-3/4 m-auto">
        <tr>
            <th class="border-2 h-10">Id</th>
            <th class="border-2">Marka</th>
            <th class="border-2">Model</th>
            <th class="border-2">Rok</th>
        </tr>

    {#await rows}
        <h1>Loading cars...</h1>
    {:then res}
        {#each res as item, i}
            <tr>
                <td class="border-2 h-12 text-center">{item.id}</td>
                <td class="border-2 text-center">{item.marka}</td>
                <td class="border-2 text-center">{item.model}</td>
                <td class="border-2 text-center">{item.rok}</td>
            </tr>
        {/each}
    {/await}

    </table>

</div>



<style>
</style>