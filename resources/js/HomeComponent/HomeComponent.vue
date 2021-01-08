<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>Розыгрыш призов</div>
                <button class="btn btn-danger" v-on:click="getRandomPrize">Розыграть</button>
                <!-- Prizes -->
                <div v-if="currentPrizeData" class="prize-info">
                    <div>Ваш приз : {{this.currentPrizeData.type_prize.name}}</div>
                    <div v-if="currentPrizeData.prize && currentPrizeData.type_prize.id == 3">
                        Ваш предмет {{currentPrizeData.prize.name}}
                    </div>
                    <div>Количество : {{this.currentPrizeData.count}}
                        <span v-if="currentPrizeData.type_prize == 2">$</span> </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {getPrize} from "../services/prize.service"

export default {
    data() {
        return {
            currentPrizeData: {}
        }
    },
    async mounted() {
        await this.getRandomPrize();
    },
    methods: {
        async getRandomPrize() {
            this.currentPrizeData = await getPrize()
            console.log(this.currentPrizeData)
        }
    }
}
</script>

<style>
.prize-info {
    font-size: 1rem;
    margin-top: 1rem;
    letter-spacing: .1rem;
}
</style>
