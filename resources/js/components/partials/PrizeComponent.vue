<template>
    <!-- Prizes -->
    <div v-if="this.currentPrizeData" class="prize-info">
        <div>Ваш приз : {{ this.currentPrizeData.type_prize.name }}</div>

        <div v-if="currentPrizeData.type_prize.id == 3">
            Ваш предмет {{ currentPrizeData.prize.name }}
        </div>

        <div>Количество : {{ this.currentPrizeData.count }}
            <span v-if="currentPrizeData.type_prize.id == 1">$</span></div>
    </div>
</template>

<script>
export default {
    name: "PrizeComponent",
    props: ["currentPrizeData"]
}
</script>

<style scoped>

</style>
