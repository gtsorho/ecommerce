<template lang="">
    <nav class="navbar  navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand ms-5" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-center mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <router-link :to="{name:'Home', hash:'#home'}">Home</router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Catigories<i class="bi bi-chevron-down ms-1"></i></a>
                </li>
                <li class="nav-item">
                    <router-link  :to="{name:'Home', hash:'#contact'}">Contact</router-link>

                </li>
            </ul>
            <div class=" mx-5">
            <ul class="navbar-nav  mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <router-link :to="{name:'Home'}"><i class="bi bi-person fs-2 text text-success mx-3"></i></router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'Cart'}"><i class="bi bi-cart4 fs-2 text text-success"></i></router-link>
                </li>
            </ul>
            
            
            </div>
            
            <!-- <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
    </nav>

    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title text-center" id="offcanvasBottomLabel"> Categories <i class="bi text-success fs-3 bi-tags"></i></h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            <div class="container">
                <div class="row row-cols-4 row-cols-lg-5 row-cols-sm-2 g-2 g-lg-3">
                    <div class="col" v-for="(category, index) in categories" :key="index" data-bs-dismiss="offcanvas">
                        <div class="p-3">
                            <router-link  :to="{name:'Home', hash:'#category'}"><h5 class="text-capitalize cart-text" >{{category}}</h5></router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            categories:[
                'shoes', 'trousers', 'shoes', 'furniture', 'kitchen', 'ladies', 'children', 'heels', 'bags', 'shorts', 'electronics', 'phones','shoes', 'trousers', 'shoes', 'furniture', 'kitchen', 'ladies', 'children', 'heels', 'bags', 'shorts', 'electronics', 'phones'
            ]
        }
    },
};
</script>
<style scoped>
.cart-text{
    transition: transform .2s; /* Animation */
}
.cart-text:hover{
    color: #198754;
    transform: scale(1.05);
    cursor: pointer;
}

</style>