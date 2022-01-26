<template >
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-md-6"><ProductImage v-bind="product" /></div>
            <div class="col-md-6"><ProductAddToCart v-bind="product" /></div>
        </div>
    </div>
    {{log}}
</template>
<script>
import ProductAddToCart from '../components/product_addToCart.vue'
import ProductImage from '../components/product_image.vue'

export default {
    data() {
        return {
            product:JSON.parse(this.$route.query.productItem)
        }
    },
    components:{
        ProductAddToCart,
        ProductImage
    },
    computed: {
        log(){
            console.log(this.product)
        }
    }
}
</script>
<style scoped>
    .my-5 {
    margin-top: 10rem!important;
    margin-bottom: 3rem!important;
}
</style>