export default {
    state () {
        return {
            count: localStorage.getItem('totalQty')
        }
    },
    mutations: {
        increment (state) {
            state.count++
        }
    }
}