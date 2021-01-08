export async function getPrize(){
    const response = await axios.post('prize/generate').catch(alert)
    return response.data
}
