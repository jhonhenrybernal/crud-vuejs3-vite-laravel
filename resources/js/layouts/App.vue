
<template>
    <div >
      <Disclosure as="nav" class="bg-gray-800"   v-if="$store.getters.getToken != 0">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" >
          <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
              </div>
              <div class="md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <router-link class="text-gray-300 hover:bg-gray-700 hover:text-white" :to="{name : 'User' }" v-if="$store.getters.getToken != 0"> Usuarios</router-link>
                    <router-link class="text-gray-300 hover:bg-gray-700 hover:text-white" :to="{name : 'Roles' }" v-if="$store.getters.getToken != 0"> Roles</router-link>
                    <router-link class="text-gray-300 hover:bg-gray-700 hover:text-white" :to="{name : 'Client' }" v-if="$store.getters.getToken != 0"> Clientes</router-link>
                    <router-link class="text-gray-300 hover:bg-gray-700 hover:text-white" :to="{name : 'Product' }" v-if="$store.getters.getToken != 0"> Productos</router-link>
                    <router-link class="text-gray-300 hover:bg-gray-700 hover:text-white" :to="{name : 'Order' }" v-if="$store.getters.getToken != 0"> Ordenes</router-link>                 
                </div>
              </div>
            </div>
            <button
              as="a"
              @click="logout"
              class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 cursor-pointer"
              >Salir
            </button>
          </div>
        </div>
      </Disclosure>
      <router-view></router-view>
    </div>
    
  </template>
  
  <script setup>
  import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
  import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'
  import { useRouter } from "vue-router"
  import { useStore } from 'vuex'
  const router = useRouter();
    const store = useStore();

    function logout(){
        store.dispatch('removeToken');
        router.push({name:'Login'})
    }
  
  const user = {
    name: 'Tom Cook',
    email: 'tom@example.com',
    imageUrl:
      'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
  }
  const navigation = [
    { name: 'Dashboard', href: '#', current: true },
    { name: 'Team', href: '#', current: false },
    { name: 'Projects', href: '#', current: false },
    { name: 'Calendar', href: '#', current: false },
    { name: 'Reports', href: '#', current: false },
  ]
  const userNavigation = [
    { name: 'Your Profile', href: '#' },
    { name: 'Settings', href: '#' },
    { name: 'Sign out', href: '#' },
  ]
  </script>
  
<!--   <template>

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

</template> -->