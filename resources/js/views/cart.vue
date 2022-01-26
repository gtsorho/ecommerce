<template>
<div class="container-fluid ">
    <br>
    <h4 class="text-center my-5">Your Cart Items</h4>
<h6 class="text-center"><router-link :to="{name:'Home', hash:'#category'}">Continue Shopping</router-link></h6>

<div class="table-responsive">
<table class="table align-middle">
    <thead>
        <tr>
        <th scope="col">Product</th>
        <th scope="col">Price</th>
        <th scope="col" class="text-center">Quantity</th>
        <th scope="col" class="text-center">Total</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="item in cart" :key="item.id">
            <td>
                <div class="card mb-3 border-0" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img :src="item.image" class="img-fluid rounded-bottom">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title mb-4">{{item.title}}</h5>
                                <a href="#" class="link-dark text-decoration-none">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td ><h5>GH₵{{item.price}}</h5></td>
            <td class="text-center">
                <div class="input-group mb-3">
                    <span class="input-group-text"  @click="item.quantity <= 1 ? item.quantity= 1 : item.quantity--">-</span>
                    <input v-model="item.quantity"  type="text" style='width:5px;text-align: center;' class="form-control" aria-label="quantity">
                    <span class="input-group-text" @click="item.quantity++, addquantity()">+</span>
                </div>  
            </td>
            <td><h5 class="text-center">GH₵{{item.quantity * item.price}}</h5></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td colspan="2" >
                <h4>Sub-Total <h4 class="float-end mx-3">GH₵{{subTotal}}</h4></h4>
                <p class="text-muted">Tax and Shipping will be calculated later</p>
            </td>
            <td class="text-center"><router-link :to="{name:'Details'}"><button class="btn btn-success">Check Out  </button> </router-link></td>
        </tr>
    </tfoot>
</table>
</div>
</div>
</template>
<script>
import { useRoute } from 'vue-router'
export default {
data() {
    return {
        cart:[
                {   
                    id: 45201,
                    title: 'adidas',
                    quantity: 1,
                    price: 352.00,
                    image: '../images/daniel-storek-JM-qKEd1GMI-unsplash.jpg'
                },
                {   
                    id: 45202,
                    title: 'sweatz collection-pants,tshirt & snaekers',
                    quantity: 1,
                    price: 520.50,
                    discount:450.00,
                    image: '../images/mnz-ToLMORRb97Q-unsplash.jpg'
                }, 
                {   
                    id: 45202,
                    title: 'sweatz collection-pants,tshirt & snaekers',
                    quantity: 1,
                    price: 520.50,
                    discount:450.00,
                    image: '../images/mnz-ToLMORRb97Q-unsplash.jpg'
                },                
                {   
                    id: 45203,
                    title: 'Classic_look for-men',
                    quantity: 1,
                    price: 1055.00,
                    image: '../images/nordwood-themes-Nv4QHkTVEaI-unsplash.jpg'
                },
            ]
        }
    },
    mounted(){
        const route = useRoute()
        console.log(route.query)
        // for password reset
    },
    computed:{
        subTotal(){
            const unit_items = [];
            for (var item of Object.keys(this.cart)) {
                var cart_item = this.cart[item]
                    var unit_total = cart_item.price * cart_item.quantity
                    unit_items.push(unit_total)
        }
        var total = unit_items.reduce((a, b) => a + b, 0) 
        var res = String(total).split(".");
        if(res.length == 1 || (res[1].length < 3)) {
            total = total.toFixed(2);
        }
        return total   
    }
    },
    methods:{
        addquantity(){
            console.log(this.cart)
        }
    }
}
</script>
<style scoped>
    a{
        color: #04b663 !important;
    }
    a:hover{
        color: #212c25 !important;
    }
    .rounded-bottom{
        border-bottom-left-radius: 2.5rem !important;
        border-top-right-radius: 2.5rem;
    }
</style>