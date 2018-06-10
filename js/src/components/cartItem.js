Vue.component("cart-item", {
    props: {
        item: {
            validator: value => {
                return value != null && value.quantity != null && value.item != null;
            },
            required: true
        }
    },
    computed: {
        totalPrice: function() {
            return (this.item.item.price * this.item.quantity) / 100;
        },
        imgPath: function() {
            return "files/images/" + this.item.item.image;
        },
    },
    methods: {
        add: function() {
            this.item.quantity++;
        },
        remove: function() {
            this.item.quantity--;
            if(this.item.quantity <= 0)
                this.delete();
        },
        delete: function() {
            this.$emit("delete-item", this.item.item.productId);
        }
    },
    template: `
    <div class="item" @click="$emit('show-detailed-view')">
        <div class="item-counter">{{item.quantity}}</div>
        <img class="item-img" v-bind:src="imgPath">
        <div class="item-title-div">
            <div class="item-title">{{item.item.name}}</div>
            <div class="item-money-div">
                <div class="item-sale" v-if="item.item.sale==100">{{item.item.sale - 100}}%</div>
                <div class="item-price">{{item.item.price / 100}}Fr.</div>
            </div>
        </div>
        <div class="item-total">{{totalPrice}}Fr.</div>
        <div class="item-quantity-modifer">
            <img class="item-add" v-on:click.stop="add" src="files/assets/triangle_up.svg">
            <img class="item-remove" v-on:click.stop="remove" src="files/assets/triangle_down.svg">
        </div>
    </div>
    `,
})
