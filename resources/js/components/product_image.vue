<template>
    <div class="card" style="width: 100%; ">
        <img :src="image" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-text text-center my-4">{{something}}</h5>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        image:String,
        something:String
    }
}
</script>
<style  >
    
</style>