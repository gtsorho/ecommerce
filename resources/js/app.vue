<template lang="">
    <Navbar/>
    <router-view></router-view>
    <Footer/>

</template>
<script>
import Navbar from '../js/components/navbar'
import Footer from '../js/components/footer.vue'
export default {
    components:{
        Navbar,
        Footer,
    }
}
</script>
<style>
    a{
        font-weight: 500;
        display: block;
        padding: .5rem 1rem;
        color: #787d82 !important;
        text-decoration: none !important;
        transition: color .15s;
    }
    a:hover {
        color: #198754 !important;
    }
        /* width */
    ::-webkit-scrollbar {
    width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey; 
    border-radius: 10px;
    }
    
    /* Handle */
    ::-webkit-scrollbar-thumb {
    background: #198754; 
    border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: #198754; 
    }
</style>