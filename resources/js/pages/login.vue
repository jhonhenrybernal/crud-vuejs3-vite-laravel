<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 mt-4">

                <h2>Login</h2>

                <p class="text-danger" v-if="error">{{ error }}</p>

                <form @submit.prevent="login">
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" v-model="form.login">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" v-model="form.password">
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import { reactive,ref } from 'vue'
    import { useRouter } from "vue-router"
    import { useStore } from 'vuex'
    export default{
        setup(){
            const router = useRouter()
            const store = useStore()

            let form = reactive({
                login: '',
                password: ''
            });
            let error = ref('')

            const login = async() =>{
                await axios.post('/api/login',form).then(res=>{
                    console.log(res.data)
                    if(res.data.success){
                        store.dispatch('setToken',res.data.data.token);
                        router.push({name:'Dashboard'})
                    }else{
                        error.value = res.data.message;
                    }
                })
            }
            return{
                form,
                login,
                error
            }
        }
    }
</script>