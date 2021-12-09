<script>

    export let carId;
    export let user;
    export let brand;
    export let model;
    export let dateFrom;
    export let dateTo;
    export let time;
    export let price;

    const startDay = new Date(dateFrom)
    const endDay = new Date(dateTo)
    let sum = `${(parseInt((endDay - startDay) / (24 * 3600 * 1000)) + 1) * price} zł`


</script>


<tr class="whitespace-nowrap  bg-gray-100">
    <td class="px-6 py-4 text-sm text-gray-500 text-center">{carId}</td>
    <td class="px-6 py-4"><div class="text-sm text-gray-900 text-center">{user}</div></td>
    <td class="px-6 py-4"><div class="text-sm text-gray-900 text-center">{brand}</div></td>
    <td class="px-6 py-4"><div class="text-sm text-gray-500 text-center">{model}</div></td>
    <td class="px-6 py-4 text-sm text-gray-500 text-center">{dateFrom}</td>
    <td class="px-6 py-4 text-sm text-gray-500 text-center">{dateTo}</td>
    <td class="px-6 py-4 text-sm text-gray-500 text-center">{sum}</td>
    <td class="px-6 py-4 text-sm text-gray-500 text-center">{time}</td>
</tr>