<template>
    <!--
      This example requires updating your template:
  
      ```
      <html class="h-full bg-gray-50">
      <body class="h-full">
      ```
    -->
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md space-y-8">
        <div>
          <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
          <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Prueba técnica</h2>
          <p class="mt-2 text-center text-sm text-gray-600">
            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Aveoline</a>
          </p>
        </div>
        <div role="alert" v-if="alert">
          <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Alerta
          </div>
          <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <p>{{ messageError }}</p>
          </div>
        </div>
        <form class="mt-8 space-y-6" @submit="login">
          <input type="hidden" name="remember" value="true" />
          <div class="-space-y-px rounded-md shadow-sm">
            <div>
              <label for="email-address" class="sr-only">Email address</label>
              <input id="email-address" name="email" type="email" v-model="form.login" autocomplete="email" required="" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Email address" />
            </div>
            <div>
              <label for="password" class="sr-only">Password</label>
              <input id="password" name="password" type="password"  v-model="form.password" autocomplete="current-password" required="" class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Password" />
            </div>
          </div>
          <div>
            <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
              </span>
              Acceder
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
<script setup>
    import { reactive,ref } from 'vue'
    import { useRouter } from "vue-router"
    import { useStore } from 'vuex'
    const router = useRouter()
    const store = useStore()
    
    const form = {
    login: "",
    password: "",
    };
    let loading = ref(false);
    let errorMsg = ref("");
    
    let alert = ref(false);;
    let messageError = ref("");

    function login(ev) {
    ev.preventDefault();
    loading.value = true;
    axios.post('/api/login',form).then(res=>{
        loading.value = false;
        if(res.data.success){
            store.dispatch('setToken',res.data.data.token);
            store.dispatch('setRole',res.data.data.role);

            switch (res.data.data.role) {
              case 'usuario':
              store.dispatch('setUserIn',false)
              store.dispatch('setRolesIn',false)
              store.dispatch('setClientIn',false)
              store.dispatch('setProductIn',true)
              store.dispatch('setOrderIn',true)
              router.push({name:'Product'})
                break;
              case 'administrador':
              store.dispatch('setUserIn',true)
              store.dispatch('setRolesIn',true)
              store.dispatch('setClientIn',true)
              store.dispatch('setProductIn',true)
              store.dispatch('setOrderIn',true)
              router.push({name:'User'})
                break;
              case 'cliente':
              store.dispatch('setUserIn',false)
              store.dispatch('setRolesIn',false)
              store.dispatch('setClientIn',false)
              store.dispatch('setProductIn',false)
              store.dispatch('setOrderIn',true)
              router.push({name:'Order'})
                break;
              default:
                store.dispatch('setUserIn',true)
                store.dispatch('setRolesIn',true)
                store.dispatch('setClientIn',true)
                store.dispatch('setProductIn',true)
                store.dispatch('setOrderIn',true)
                router.push({name:'User'})
                break;
            }
        }else{
          messageError.value = res.data.data;
          alert.value = true 
          setTimeout(() => {
            alert.value = false 
          }, 3000);
        }
    })
    }
</script>