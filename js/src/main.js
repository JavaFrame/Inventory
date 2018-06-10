var app = new Vue({
    el: "#app",
    data: {
        cart: {},
        camImg: null,
        barcode: "",
        decoder: null,
        showDetailedView: false,
        detailedItem: undefined,
    },
    methods: {
        addItem: function(code) {
            Api.getItem(code).then(item => {
                let id = "#" + item.productId;
                if(this.cart[id] == undefined) {
                    Vue.set(this.cart, id, {
                        item: item,
                        quantity: 0,
                    });
                }
                this.cart[id].quantity++;
            });

        },
        showDetails: function(productId) {
            let id = "#" + productId;
            let item = this.cart[id];
            if(item == null) return;
            this.detailedItem = item;
            this.showDetailedView = true;
        },
        hideDetails: function() {
            this.showDetailedView = false;
        },
        deleteItem: function(productId) {
            Vue.delete(this.cart, "#" + productId);
        },
        checkOut: function() {
            Api.buyItems(
                Object.values(this.cart).map(item => {
                    return {
                        id: item.item.productId,
                        amount: item.quantity
                    }
                })
            ).then(() => {
                this.cart = {}
            });
        }
    },
    computed: {
        totalPrice: function() {
            return Object.values(this.cart).reduce((acc, item) => acc + item.item.price * item.quantity, 0) / 100;
        }
    },
    mounted: function() {

    }
})


