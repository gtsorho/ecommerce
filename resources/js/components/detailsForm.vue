<template >
    <div class="container-fluid">   
        <form class="row g-5 m-5" novalidate>
        <div class="col-12 mb-5" >
            <h4 class="d-inline"> Contact</h4>
            <p class="text-dark float-end d-inline">Do you have an account?<router-link class="d-inline text-success fw-bold px-1" to="#">Login</router-link></p>
            <input v-model="shipping.contact" type="text" class="form-control" id="inputContact4" placeholder="Email or mobile phone number" required>
        </div>

        <div class="col-md-6">
            <input type="text" v-model="shipping.firstname" class="form-control" id="inputFirstName4" placeholder="Firstname" required>
        </div>
        <div class="col-md-6">
            <input type="text" v-model="shipping.lastname" class="form-control" id="inputLastname4" placeholder="Lastname" required>
        </div>
        <div class="col-12">
            <input type="text" v-model="shipping.address" class="form-control" id="inputAddress" placeholder="Address:1234 Main St" required>
        </div>
        <div class="col-12">
            <input type="text"  v-model="shipping.note" class="form-control" id="inputAddress2" placeholder="Shipping Note(Optional)" required>
        </div>
        <div class="col-md-4">
            <input type="text" v-model="shipping.city"  class="form-control" id="inputCity" placeholder="City" required>
        </div>
        <div class="col-md-4">
            <input type="text" v-model="shipping.gpsAddress" class="form-control" id="inputpostal" placeholder="GPS address" required>
        </div>
        <div class="col-md-4">
            <input type="text" v-model="shipping.region" class="form-control" id="inputRegion" placeholder="Region">
        </div>
        <div class="col-12">
            <div class="form-check">
            <input v-model="shipping.save" class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
                Save this Information for a future Fast CheckOut
            </label>
            </div>
        </div>
        <div class="col-6">
            <router-link :to="{name:'Home', hash:'#category'}">Back to Cart</router-link>
        </div>
        <div class="col-6 text-end">
            <button 
                type="button" class="btn text-end btn-success"
                @click="$emit('changeComponent',{leftTab:'shippingLeft', rightTab:'shippingRight', shippingDetails:shipping })"
                >Go to Shipping
            </button>
        </div>
    </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            shipping:[
                {
                    contact:null,
                    firstname:null,
                    lastname:null,
                    address:null,
                    note:null,
                    city:null,
                    gpsAddress:null,
                    region:null,
                    save:null

                }
            ]
        }
    },
    emits:[
        'changeComponent',
        'editShipment'
    ]
}
</script>
<style scoped>
    .form-control{
        transition: transform .5s; 
    }
        .form-control:active{
        transform: scale(1.05);
    }
</style>