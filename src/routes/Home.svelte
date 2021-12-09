<script>
import Card from "../components/Card.svelte";
import checkLoginStatus from "../Functions/LoginCheck";

checkLoginStatus('home')

const fetchCars = async () => {
    const res = await fetch('./backend/displayCars.php', {method: "GET",})
    const data = await res.json()
    return data
}

const carsArray = fetchCars()

</script>

<h1 class="text-center text-4xl font-bold m-8">Oferta</h1>

<div class="w-full flex flex-row justify-center align-center flex-wrap">

    {#await carsArray}
        <h1>Loading cars...</h1>
    {:then res}
        {#each res as car, i}
            <Card
                carId={car.car_id}
                foto={car.img}
                title={`${car.brand} ${car.model}`}
                age={car.year}
                power={car.power}
                price={car.price}
            />
        {/each}
    {/await}

</div>

<style>
</style>