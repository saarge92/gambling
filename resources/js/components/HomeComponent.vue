<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>Розыгрыш призов</div>
                <button class="btn btn-danger" v-on:click="getRandomPrize">Розыграть</button>
                <prize-component :current-prize-data="currentPrizeData"></prize-component>

                <div v-if="this.currentPrizeData" style="margin-top:1rem">
                    <button class="btn btn-success" v-on:click="handleWithdrawPressed">Снять</button>
                </div>

                <div v-if="withdrawPressed" class="prize-get-info">

                    <!-- Если на лотерее выбран предмет -->
                    <div v-if="this.currentPrizeData.type_prize.id == 3">
                        <div>Укажите адрес</div>
                        <div>
                            <input type="text" class="form-control" v-bind="this.address">
                        </div>
                    </div>

                    <!-- Если на лотерее попались деньги -->
                    <div v-if="this.currentPrizeData.type_prize.id == 1">
                        <div>Номер карты</div>
                        <input type="text" class="form-control" v-bind:value="this.card_number">
                        <div>Месяц</div>
                        <input type="text" class="form-control" v-bind:value="this.exp_month">
                        <div>Год</div>
                        <input type="text" class="form-control" v-bind:value="this.exp_year">
                        <div>CVC</div>
                        <input type="text" class="form-control" v-bind:value="this.cvc">

                    </div>

                    <div style="margin-top:1rem">
                        <button class="btn btn-primary" v-on:click="this.getPrizeFinallyPressed">Получить</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import {getPrizeRequest, withdrawPrizeRequest} from "../services/prize.service"
import PrizeComponent from "./partials/PrizeComponent";

export default {
    data() {
        return {
            currentPrizeData: null,
            card_number: 4242424242424242,
            exp_month: 3,
            exp_year: 2023,
            cvc: 200,
            physycal_id: null,
            withdrawPressed: false,
            address: null
        }
    },
    async mounted() {
        await this.getRandomPrize();
    },
    methods: {
        async getRandomPrize() {
            this.currentPrizeData = await getPrizeRequest()
            console.log(this.currentPrizeData)
        },
        async withdrawPrize() {
            const request = {
                id_type_reward: this.currentPrizeData.type_prize.id,
                count: this.currentPrizeData.count,
                card_number: this.card_number,
                exp_month: this.exp_month,
                exp_year: this.exp_year,
                cvc: this.cvc,
                physycal_id: this.currentPrizeData.type_prize.id == 3 ? this.currentPrizeData.prize.id : null,
                address: this.address
            }
            await withdrawPrizeRequest(request).catch(alert)
        },
        async handleWithdrawPressed() {
            if (this.currentPrizeData.type_prize.id != 2) {
                this.withdrawPressed = !this.withdrawPressed
            } else {
                await this.withdrawPrize()
            }
        },
        async getPrizeFinallyPressed() {
            await this.withdrawPrize().catch((error) => {
                alert(error.message)
                return;
            })
            this.withdrawPressed = !this.withdrawPressed
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

.prize-get-info {
    margin-top: 1.5rem
}
</style>
