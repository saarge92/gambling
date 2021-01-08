export async function getPrizeRequest() {
    const response = await axios.post('prize/').catch(alert)
    return response.data
}

export async function withdrawPrizeRequest(prizeInfo) {
    const response = await axios.post(`prize/${prizeInfo.id_type_reward}/reward`, {
        count: prizeInfo.count,
        card_number: prizeInfo.card_number,
        exp_month: prizeInfo.exp_month,
        exp_year: prizeInfo.exp_year,
        cvc: prizeInfo.cvc,
        physycal_id: prizeInfo.physycal_id,
        address: prizeInfo.address
    }).catch(alert)
    return response.data
}
