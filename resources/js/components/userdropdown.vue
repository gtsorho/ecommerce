<template>
    <div v-show="authenticated">
        <li><a class="dropdown-item" href="#">{{username}}</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Orders</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">LogOut</a></li>
    </div>
    <div v-show="!authenticated">
            <form class="px-4 py-3">
                <div class="mb-3">
                    <label for="exampleDropdownFormEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">New around here? Sign up</a>
            <a class="dropdown-item" href="#">Forgot password?</a>
        </div>
</template>
<script>
import signupModal from '../components/signupModal.vue'
export default {
    components:[
        signupModal
    ],
    props:{
        authenticated:Boolean,
        username:{
            type:String,
            default:".."
        }
    },
    computed:{
        
    }
}
</script>
<style>
    
</style>