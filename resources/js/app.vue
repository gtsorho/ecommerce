<template lang="">
    <Navbar/>
    <router-view></router-view>
    <Footer/>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <SignupModal/>
    </div>
</template>
<script>
import Navbar from '../js/components/navbar'
import Footer from '../js/components/footer.vue'
import SignupModal from '../js/components/signupModal.vue'
export default {
    components:{
        SignupModal,
        Navbar,
        Footer,
    },
}
</script>
<style>
/* @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap'); */
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap');

    a, h1,h2,h3,h4,h5,h6,p,button,th, label, span,td,div,legend {
        /* font-family: 'Nunito', sans-serif !important; */
        font-family: 'Montserrat', sans-serif !important;
    }
    a{
        font-weight: 500;
        display: block;
        padding: .5rem 1rem;
        color:  #198754 !important;
        text-decoration: none !important;
        transition: color .15s;
    }
    a:hover {
        color: #787d82 !important;
    }
        /* width */
    ::-webkit-scrollbar {
    width: 7px;
    height: 7px;
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
