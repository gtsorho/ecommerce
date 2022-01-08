<template>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col"><component :is="leftSideComponent" @changeComponent='change_Component'></component></div>
            <div class="col summary"> <component :is="rightSideComponent"></component></div>
            <!-- <div class="col"><DetailsForm/></div>
            <div class="col summary"><OrderSummary/></div> -->
        </div>
    </div>
</template>
<script>
import DetailsForm from '../components/detailsForm.vue'
import OrderSummary from '../components/orderSummary.vue'
import ShippingLeft from '../components/shippingLeft.vue'
import ShippingRight from '../components/shippingRight.vue'
export default {
    components:{
        DetailsForm,
        OrderSummary,
        ShippingLeft, 
        ShippingRight

    },
    data() {
        return {
            LeftTab: 'DetailsForm',
            RightTab:'OrderSummary',
        }
    },
    methods:{
        change_Component({leftTab, rightTab}){
            this.LeftTab = leftTab
            this.RightTab = rightTab
        }
    },
    computed: {
        leftSideComponent() {
            return this.LeftTab
        },
        rightSideComponent() {
            return this.RightTab
        }
    }
}
</script>
<style>
    .summary{
        background: linear-gradient(180deg, #f8f9fa, white);
    }
</style>