Vue.component("detailed-view", {
    props: {
        item: {
            type: Object,
            default: function() {
                return {
                    quantity: -1,
                    item: {
                    }
                }
            }
        }
    },
    data: function() {
        return {

        }
    },
    computed: {
        itemImg: function() {
            return "files/images/" + this.item.item.image;
        },
        price: function() {
            return this.item.item.price * (this.item.item.sale / 100) / 100;
        },
    },
    methods: {
        closeDetailedView: function() {
            this.$emit("close-dv");
        },
    },
    template: `
        <div id="detailed-view">
            <div id="dv-parent">
                <img id="dv-img" v-bind:src="itemImg">
                <div id="dv-title-div">
                    <h1 id="dv-title">{{item.item.name}}</h1>
                    <span id="dv-price">{{price}}Fr.</span>
                    <span id="dv-sale" v-if="item.item.sale != 100">{{100 - item.item.sale}}%</span>
                </div>
                <p id="dv-description">{{item.item.description}}</p>
                <button id="dv-close-btn" @click="closeDetailedView"><i class="fas fa-arrow-up"></i></button>
            </div>
        </div>
    `,
})
