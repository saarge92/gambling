export async function getPrizeRequest() {
    const response = await axios.post('prize/generate').catch(alert)
    return response.data
}

export async function withdrawPrizeRequest(prizeInfo) {
    const response = await axios.post(`prize/${prizeInfo.id_type_reward}/get`, {
        count: prizeInfo.count,
        card_number: prizeInfo.card_number,
        exp_month: prizeInfo.exp_month,
        cvc: prizeInfo.cvc,
        physycal_id: prizeInfo.physycal_id,
        address: prizeInfo.address
    }).catch(alert)
    return response.data
}
