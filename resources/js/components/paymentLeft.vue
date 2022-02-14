<template>
    <br>
    <div class="my-5 py-5">
        <div class="card w-75 mx-auto">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="card-text text-muted">Contact:</td>
                            <td class="card-text ">{{ShippingLeft_details.contact}}
                                <span role="button" class=" edit fw-normal text-success float-end" @click="$emit('editDetails', {leftTab:'DetailsForm', rightTab:'OrderSummary'})">Edit</span>
                            </td>
                        </tr>
                        <tr class="border-top success">
                            <td class="card-text text-muted">Address:</td>
                            <td class="card-text ">
                                {{ShippingLeft_details.firstname}} {{ShippingLeft_details.lastname}} |
                                {{ShippingLeft_details.address}},{{ShippingLeft_details.city}}
                                <span role="button" class=" edit fw-normal text-success float-end" @click="$emit('editDetails', {leftTab:'DetailsForm', rightTab:'OrderSummary'})">Edit</span>
                            </td>
                        </tr>
                        <tr class="border-top success">
                            <td class="card-text text-muted">Method:</td>
                            <td class="card-text ">
                                {{ShippingLeft_details.shippingMethod}}
                                <span role="button" class=" edit fw-normal text-success float-end" @click="$emit('editDetails', {leftTab:'shippingLeft', rightTab:'shippingRight'})">Edit</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
            <div class="card w-75 mt-4 mx-auto border-0">
            <div class="card-body ps-0">
            <h2 class="my-3">Payment</h2>
            </div>
            </div>

            <div class="card w-75 mx-auto">
                <div class="card-body">

                </div>
            </div>
            <br>
            <div class="container" style="padding-inline: 12%;">
                <button 
                    type="button" class="btn text-end btn-success float-end"
                    @click="$emit()"
                    >Pay Now
                </button>
            </div>  
    </div>
</template>
<script>
export default {
    emits:[
        'changeComponent',
        'editDetails'
    
    ],
    props:[
        'ShippingLeft_details'
    ],
    data() {
        return {
            shippingMethod:"Standard shipping",
        }
    },
    computed:{
        setMethod(){
            this.ShippingLeft_details['shippingMethod'] = this.shippingMethod
            console.log(this.ShippingLeft_details)
        }
    }
}
</script>
<style scoped>
.edit:hover{
        color: rgb(61, 61, 61) !important;
    }
.form-check-input:checked {
    background-color: #198754 !important;
    border-color: #198754 !important;
} 
</style>