<script>
    export let isSuccess;
    export let popUpText;

    let bgColor = isSuccess ? "bg-green-500" : "bg-red-500"
</script>

<div class="w-full bottom-0 fixed">
    <div class="p-8 {bgColor} text-center font-bold text-white text-lg">
        {popUpText}
    </div>
</div>

<style>
</style>