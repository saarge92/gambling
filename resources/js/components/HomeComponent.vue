<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>Розыгрыш призов</div>
                <button class="btn btn-danger" v-on:click="getRandomPrize">Розыграть</button>
                <prize-component :current-prize-data="currentPrizeData"></prize-component>

                <div>
                    <button class="btn btn-success">Снять</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {getPrize} from "../services/prize.service"
import PrizeComponent from "./partials/PrizeComponent";

export default {
    data() {
        return {
            currentPrizeData: null
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
    },
    components: {
        'prize-component': PrizeComponent
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
