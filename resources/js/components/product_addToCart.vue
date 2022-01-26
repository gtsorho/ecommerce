<template>
<div class="row justify-content-center ">
    <h3 class="text-capitalize">{{title}}</h3>
    <hr class="text-success">
    <div class="col-auto">
        <h3 class="mt-5 text-center text-success">GH₵{{cal_price}}.00</h3>

        <label for="basic-url" class="form-label text-center">Quantity</label>
        <div class="input-group mb-3">
            <span class="input-group-text"  @click="quantity <= 1 ? quantity= 1 : quantity--">-</span>
            <input v-model="quantity" type="text" style='width:40px;text-align: center;' class="form-control" aria-label="quantity">
            <span class="input-group-text" @click="quantity++" >+</span>
        </div>  
    </div>
    <div class="col-auto  me-0 m-auto">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title ">Shipping<i class="bi mt-1 ms-2 fs-3 text-success bi-truck"></i></h5>
                <p class="card-text">{{shippingDetails}}</p>
            </div>
        </div>

        <button class="btn btn-success my-5"><i class="bi bi-cart-plus me-2 fs-3 text-light"></i>Add to Cart</button>

        <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title">Description</h5>
                <p class="card-text">{{description}}</p>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data() {
        return {
            quantity:1,
        }
    },
    props:{
        price:Number,
        title:String,
        shippingDetails:String,
        description:String
    },
    computed:{
        cal_price(){
            return this.quantity * this.price
        }
    }
}
</script>
<style>
    .input-group-text{
        cursor: pointer;
    }
</style>