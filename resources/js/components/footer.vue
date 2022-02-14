<template>
<hr>
    <div class=" footer-container ">
        <footer class="pt-2 mx-5">
            <div class="row">
                <div class="col-4">
                    <h2>LOGO</h2>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                </div>
            <div class="col  col-md-6">
                <h5>Pages</h5>
                <ul class="nav flex-column ">
                    <li class="nav-item">
                        <router-link class="ps-0" :to="{name:'Home', hash:'#home'}">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ps-0" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Catigories<i class="bi bi-chevron-down ms-1"></i></a>
                    </li>
                    <li class="nav-item">
                        <router-link class="ps-0"  :to="{name:'Home', hash:'#contact'}">Contact</router-link>
                    </li>
                </ul>
            </div>

            <div class="col col-md-6">
                <address>
                    <h5>Contact us</h5>
                <ul class="nav flex-column ">
                <li class="nav-item mb-2"><p class="p-0 fw-bolder text-success">Phone</p></li>
                <li class="nav-item mb-2"><p class="p-0 text-muted">+233 50 892 4141</p></li>
                <li class="nav-item mb-2"><p class="p-0 text-muted">+233 54 406 9203 </p></li>
                <li class="nav-item mb-2"><p class="p-0 fw-bolder text-success">Email</p></li>
                <li class="nav-item mb-2"><p class="p-0 text-muted">info@stores.com</p></li>
                </ul>
                </address>
            </div>
            <div class="col col-md-6 offset-1">
                <form >
                <h5>Subscribe to our newsletter</h5>
                <p>Monthly digest of whats new and exciting from us.</p>
                <div class="d-flex w-100 gap-2">
                    <label for="newsletter1" class="visually-hidden">Email address</label>
                    <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                    <button class="btn btn-success" type="button">Subscribe</button>
                </div>
                </form>
            </div>
            </div>

            <div class="d-flex justify-content-between pt-2 mt-4 border-top">
            <p>&copy; 2021 Company, Inc. All rights reserved.</p>
            <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-dark" href="#"><i class="bi fs-3 bi-facebook"></i></a></li>
                <li class="ms-3"><a class="link-dark" href="#"><i class="bi fs-3 bi-twitter"></i></a></li>
                <li class="ms-3"><a class="link-dark" href="#"><i class="bi fs-3 bi-instagram"></i></a></li>
            </ul>
            </div>
        </footer>
    </div>
</template>
<script>
export default {
    
}
</script>
<style scope>
.footer-container ul {
    line-height: 0.25rem!important;
}
/* .footer-container{
        box-shadow:0 -6px 7px 0 rgb(0 0 0 / 10%), 0 -10px 13px 0 rgb(0 0 0 / 10%);
} */
    
</style>