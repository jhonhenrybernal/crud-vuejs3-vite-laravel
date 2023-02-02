<template>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark"  v-if="$store.getters.getToken != 0">
        <ul class="navbar-nav">
           <li class="nav-item">
                <router-link class="text-white ml-2" :to="{name : 'User' }" v-if="$store.getters.getToken != 0"> Usuarios</router-link>
            </li>
            <li class="nav-item">
                <router-link class="text-white ml-2" :to="{name : 'Roles' }" v-if="$store.getters.getToken != 0"> Roles</router-link>
            </li>
            <li class="nav-item">
                <router-link class="text-white ml-2" :to="{name : 'Product' }" v-if="$store.getters.getToken != 0"> Productos</router-link>
            </li>
            <li class="nav-item">
                <router-link class="text-white ml-2" :to="{name : 'Order' }" v-if="$store.getters.getToken != 0"> Ordenes</router-link>
            </li>
        </ul>
        <button v-if="$store.getters.getToken != 0"  type="button" class="btn btn-dark mt-2" @click="logout">Salir</button>
    </nav>

    <router-view></router-view>

</template>
<script>
    import { useRouter } from "vue-router"
    import { useStore } from 'vuex'
    export default{
        setup(){
            const router = useRouter();
            const store = useStore();

            function logout(){
                store.dispatch('removeToken');
                router.push({name:'Login'})
            }

            return {
                logout
            }
        }
    }
</script>