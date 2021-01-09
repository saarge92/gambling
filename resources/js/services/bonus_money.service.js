export async function changeBonusMoneyRequest(data) {
    const response = await axios.post('/bonus/money', data)
    return response.data
}
