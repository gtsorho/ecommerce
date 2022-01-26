<template>
<br>
    <div class="container-fluid mt-5">
        <div class="row"> 
            <div class="col-md-6">
                <div class="container">
                        <ul class="nav nav-tabs mt-3">
                        <li class="nav-item">
                            <a class="nav-link text-success"  @click="this.LeftTab = 'DetailsForm'; this.RightTab = 'OrderSummary'" :class="{active:activeDet}"  href="#">Detials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success" :class="{active:activeShip}" href="#">Shipping</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success" :class="{active:activePay}" href="#">Payment</a>
                        </li>
                    </ul> 
                </div >
                <keep-alive>
                    <component :is="leftSideComponent" 
                        v-bind="currentProps"
                        @changeComponent='change_Component'
                        @editDetails="change_details"
                        >
                    </component>
                </keep-alive>
            </div>   
            <keep-alive>
                <component :is="rightSideComponent"></component>
            </keep-alive>
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
import PaymentLeft from '../components/paymentLeft.vue'
import PaymentRight from '../components/paymentRight.vue'
export default {
    components:{
        DetailsForm,
        OrderSummary,
        ShippingLeft, 
        ShippingRight,
        PaymentLeft,
        PaymentRight

    },
    data() {
        return {
            activeDet: false,
            activeShip:false,
            activePay:false,
            LeftTab: 'DetailsForm',
            RightTab:'OrderSummary',
            shippingDetails: null
        }
    },
    methods:{
        change_details({leftTab, rightTab}){
            console.log([this.LeftTab, this.RightTab])
            this.LeftTab = leftTab
            this.RightTab = rightTab
        },
        change_Component({leftTab, rightTab, shippingDetails}){
            this.LeftTab = leftTab
            this.RightTab = rightTab
            this.shippingDetails = shippingDetails
        }
    },
    computed: {
        leftSideComponent() {
            console.log(this.LeftTab)
            switch (this.LeftTab) {
                case 'DetailsForm':
                    this.activeShip = false
                    this.activeDet = true
                    this.activePay = false
                    break;
                case 'shippingLeft':
                    this.activeShip = true
                    this.activeDet = false
                    this.activePay = false
                    break;
                case 'PaymentLeft':
                    this.activeShip = false
                    this.activeDet = false
                    this.activePay = true
                    break;
            }
            return this.LeftTab
        },
        rightSideComponent() {
            return this.RightTab
        },
        currentProps() {
            if (this.LeftTab === 'shippingLeft') {
                // console.log(this.shippingDetails)
                return { ShippingLeft_details: this.shippingDetails }
            }
                if (this.LeftTab === 'PaymentLeft') {
                // console.log(this.shippingDetails)
                return { ShippingLeft_details: this.shippingDetails }
            }
        }
    }
}
</script>
<style scoped>
    .summary{
        background: linear-gradient(180deg, #f8f9fa, white);
    }
</style>