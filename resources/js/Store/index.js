export default {
    state () {
        return {
            totalQty: localStorage.getItem('totalQty'),
            subtotal: localStorage.getItem('subtotal'),
            note: localStorage.getItem('note'),
            voucherId: localStorage.getItem('voucherId'),
            voucherCode: localStorage.getItem('voucherCode'),
            voucherTitle: localStorage.getItem('voucherTitle'),
            items: localStorage.getItem('items') ? JSON.parse(localStorage.getItem('items')) : []
        }
    },
    mutations: {
        increment (state, payload) {
            state.totalQty++;

            let newItem = payload.menu;

            // Check menu exist or not
            var checkItems = state.items.filter(function (item) {
                return item.id === newItem.id;
            });

            if (checkItems.length > 0) {
                // Update qty
                const remapItems = state.items.map(item => {
                    if (item.id === newItem.id) {
                        const c = item;
                        c.qty = item.qty + 1;
                        return c;
                    }

                    return item;
                });

                state.items = remapItems;
            }
            else {
                // Insert new item
                newItem.qty = 1;
                state.items.push(newItem);
            }

            // Count total qty
            let totalQty = 0;
            let subtotal = 0;
            state.items.map(item => {
                totalQty += item.qty;
                subtotal += parseInt(item.selling_price) * totalQty;
            });
            state.totalQty = totalQty;
            state.subtotal = subtotal;
        },
        decrement (state, payload) {
            let newItem = payload.menu;
            let qty = 1;

            if (payload.isRemove) {
                qty = newItem.qty;
            }

            state.totalQty -= qty;

            // Check menu exist or not
            var checkItems = state.items.filter(function (item) {
                return item.id === newItem.id;
            });

            if (checkItems.length) {
                // Update qty
                let m = null;
                const remapItems = state.items.map((item, index) => {
                    if (item.id === newItem.id) {
                        const c = item;
                        c.qty = item.qty - qty;
                        if (c.qty < 1) {
                            m = index;
                        }
                        return c;
                    }

                    return item;
                });

                state.items = remapItems;

                // Remove item
                if (m !== null) {
                    state.items.splice(m, 1);
                }
            }

            // Count total qty
            let totalQty = 0;
            let subtotal = 0;
            state.items.map(item => {
                totalQty += item.qty;
                subtotal += parseInt(item.selling_price) * totalQty;
            });
            state.totalQty = totalQty;
            state.subtotal = subtotal;
        },
        saveItems(state) {
            const parsed = JSON.stringify(state.items);
            localStorage.setItem('items', parsed);
            localStorage.setItem('totalQty', state.totalQty);
            localStorage.setItem('subtotal', state.subtotal);
        }
    },
    getters: {
        getTotalQty: (state) => (id) => {
            let items = state.items;

            let checkItems = items.filter(function (item) {
                return item.id === id;
            });

            if (checkItems.length) {
                return checkItems[0].qty;
            }

            return 0;
        }
    },
    actions: {
        addItem({commit}, menu) {
            commit('increment', menu);
            commit('saveItems');
        },
        removeItem({commit}, menu) {
            commit('decrement', menu);
            commit('saveItems');
        },
        removeItemDirect({commit}, menu) {
            menu.isRemove = true;
            commit('decrement', menu);
            commit('saveItems');
        }
    }
}