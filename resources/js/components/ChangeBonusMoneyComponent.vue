<template>
    <div>
        <success-message :message="this.message"></success-message>
        <button class="btn btn-danger" v-on:click="showMoneyWithdraw">Обменять деньги</button>
        <!-- Если на лотерее попались деньги -->
        <div v-if="this.isChangeButtonPressed">
            <div>Номер карты</div>
            <input type="text" class="form-control" required v-bind:value="this.card_number">
            <div>Месяц</div>
            <input type="text" class="form-control" required v-bind:value="this.exp_month">
            <div>Год</div>
            <input type="text" class="form-control" required v-bind:value="this.exp_year">
            <div>CVC</div>
            <input type="text" class="form-control" required v-bind:value="this.cvc">

            <div style="margin-top:1rem">
                <button class="btn btn-primary" v-on:click="this.withDrawBonusFinally">Получить</button>
            </div>
        </div>
    </div>
</template>

<script>
import {changeBonusMoneyRequest} from "../services/bonus_money.service"
import SuccessMessage from "./partials/SuccessMessage";

export default {
    name: "ChangeBonusMoneyComponent",
    data() {
        return {
            isChangeButtonPressed: false,
            card_number: 4242424242424242,
            exp_month: 5,
            exp_year: 2021,
            cvc: 344,
            message: ''
        }
    },
    mounted() {
    },
    components: {
        'success-message': SuccessMessage
    },
    methods: {
        showMoneyWithdraw() {
            this.isChangeButtonPressed = !this.isChangeButtonPressed
        },
        async withDrawBonusFinally() {
            const request = {
                card_number: this.card_number,
                exp_month: this.exp_month,
                exp_year: this.exp_year,
                cvc: this.cvc,
            }
            const response = await changeBonusMoneyRequest(request).catch(alert)
            this.isChangeButtonPressed = !this.isChangeButtonPressed;
            this.message = `Вам перечислено ${response.money} $`
            this.openModalDialog()
        },
        openModalDialog() {
            document.getElementById('exampleModal').style.display = "block"
            document.getElementById("exampleModal").className += "show"
        }
    }
}
</script>

<style scoped>

</style>
