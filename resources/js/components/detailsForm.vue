<template >
    <div class="container-fluid">
        <form class="row g-5 m-5">
        <div class="col-12 mb-5" >
            <h4 class="d-inline"> Contact</h4>
            <p class="text-dark float-end d-inline">Do you have an account?<router-link class="d-inline text-success fw-bold px-1" to="#">Login</router-link></p>
            <input type="text" class="form-control" id="inputContact4" placeholder="Email or mobile phone number">
        </div>

        <div class="col-md-6">
            <input type="text" class="form-control" id="inputFirstName4" placeholder="Firstname">
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" id="inputLastname4" placeholder="Lastname">
        </div>
        <div class="col-12">
            <input type="text" class="form-control" id="inputAddress" placeholder="Address:1234 Main St">
        </div>
        <div class="col-12">
            <input type="text" class="form-control" id="inputAddress2" placeholder="Shipping Note(Optional)">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputCity" placeholder="City">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputpostal" placeholder="Postal Code">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputRegion" placeholder="Region">
        </div>
        <div class="col-12">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
                Save this Information for a future Fast CheckOut
            </label>
            </div>
        </div>
        <div class="col-6">
            <router-link to=''>Back to Cart</router-link>
        </div>
        <div class="col-6 text-end">
            <button 
                type="button" class="btn text-end btn-success"
                @click="$emit('changeComponent',{leftTab:'shippingLeft', rightTab:'shippingRight'})"
                >Go to Shipping
            </button>
        </div>
    </form>
    </div>
</template>
<script>
export default {
    
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