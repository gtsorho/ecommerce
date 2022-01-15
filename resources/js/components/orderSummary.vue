<template >
<div class="col summary "> 
<br>
<div class="container px-5 my-5  tableFixHead">
    <table class="table table-fixed align-middle "> 
    <thead class="bg-light">
        <tr><th class="border-bottom-0" colspan="4"><h3>Order Summary</h3></th></tr>
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
                <div class="card mb-3 border-0 bg-transparent" style="max-width: 340px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img :src="item.image" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body ">
                                <h5 class="card-title mb-4">{{item.title}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td ><h5>GH₵{{item.price}}</h5></td>
            <td class="text-center">
                <div class="input-group mb-3">
                    <input v-model="item.quantity" disabled type="text" style='width:5px;text-align: center;' class="form-control" aria-label="quantity">
                </div>  
            </td>
            <td><h5 class="text-center">GH₵{{item.quantity * item.price}}</h5></td>
        </tr>
    </tbody>
    <tfoot class="bg-white">
        <tr>
            <td class="border-bottom-0"></td>
            <td colspan="3" class="border-bottom-0" >
                <h4>Sub-Total <h4 class="float-end mx-3">GH₵{{subTotal}}</h4></h4>
                <p class="text-muted text-end">Shipping will be calculated next</p>
            </td>
        </tr>
    </tfoot>
</table>
</div>
</div>
</template>
<script>
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
}
</script>
<style scoped >
    hr{
        display: none;
    }

    .tableFixHead          { overflow: auto; height: 5in; }
    .tableFixHead thead, .tableFixHead h3  { position: sticky; top: 0; z-index: 1; }
    .tableFixHead tfoot { position: sticky; bottom: 0; z-index: 1; }

    /* body{
        overflow-x: hidden;
    } */
</style>