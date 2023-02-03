<template>
    <div>
          
      <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold tracking-tight text-gray-900">Ordenes</h1>
        </div>
      </header>
      <main>
        <div class="mx-auto max-w-7xl py-1 sm:px-3 lg:px-1" v-if="!openForm">
          <div class="lg:flexlg:justify-between">
              <div class="mt-6 flex lg:mt-5 lg:ml-5">
                  <span class="sm:ml-3">
                      <button type="button" @click="openForm = true" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Nueva orden
                      </button>
                  </span>
              </div>
          </div>
          </div>
          <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8" >
            <table class="shadow-lg bg-white" v-if="!openForm">
                <tr>
                    <th class="bg-blue-100 border text-left px-8 py-4">Nomero de orden</th>
                    <th class="bg-blue-100 border text-left px-8 py-4">fecha de compra</th>
                    <th class="bg-blue-100 border text-left px-8 py-4">Usuario o cliente</th>
                    <th class="bg-blue-100 border text-left px-8 py-4">Valor total</th>
                </tr>
                <tr  v-for="(list,k) in listData" :key="k">
                    <td class="border px-8 py-4" >{{ list.order }}</td>
                    <td class="border px-8 py-4" >{{ list.date_purchase }}</td>
                    <td class="border px-8 py-4" >{{ list.user.name }}</td>
                    <td class="border px-8 py-4" >{{ list.cost }}</td>
                </tr>
            </table>
            <div class="px-4 py-6 sm:px-0"  v-if="openForm">
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <div class="bg-white">
                            <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                                <h2 class="sr-only">Products</h2>
                                <div class="scrolling-contain scrollbar-hide overflow-auto h-80 w-100 bg-gray-90 p-1 no-scrollbar">
                                    <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 overflow-auto">
                                        <a href="#" class="group"  v-for="(list,k) in listDataProduct" :key="k">
                                            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
                                            </div>
                                            <h3 class="mt-4 text-sm text-gray-700">{{list.name}}</h3>
                                            <p class="mt-1 text-lg font-medium text-gray-900">${{list.cost}}</p>
                                            <button @click="selectProductOrder(list)" class="  whitespace-nowrap rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700" type="submit">Seleccionar</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div>
                    <div class="mt-8">
                        <div class="flow-root" v-for="(pre, i) in preOrder" :key="i">
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                            <li class="flex py-6">
                            <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg" alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." class="h-full w-full object-cover object-center">
                            </div>

                            <div class="ml-4 flex flex-1 flex-col">
                                <div>
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <h3>
                                    <a href="#">{{pre.name}}</a>
                                    </h3>
                                    <p class="ml-4">${{pre.cost}}</p>
                                </div>
                                </div>
                                <div class="flex flex-1 items-end justify-between text-sm">
                                <div class="flex">
                                    <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500" @click=" this.preOrder.splice(this.preOrder.indexOf(i), 1);">Remove</button>
                                </div>
                                </div>
                            </div>
                            </li>

                            <!-- More products... -->
                        </ul>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <p>Subtotal</p>
                            <p>${{costTotal}}</p>
                        </div>
                        <div class="flex justify-between text-base font-medium text-gray-900">
                        <p>Fecha de compra</p>
                        <p>

                            <input id="datePreOrder" name="date" type="date" v-model="datePreOrder" autocomplete="email" required="" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Email address" />
                        </p>

                        </div>
                        <div class="mt-6">
                            <a href="#" @click="generateOrder()" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Generar orden</a>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>
      </main>
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" v-if="alert">
   
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!--
                Modal panel, show/hide based on modal state.

                Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
                Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <!-- Heroicon name: outline/exclamation-triangle -->
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Alerta</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">La fecha que esta escogiendo esta mal, debe ser superior a la fecha actual.</p>
                    </div>
                    </div>
                </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button @click="alert = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Entendido!</button>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script >
import moment from 'moment';

  export default {
    data () {
        return {
            listData: [],
            listDataProduct: [],
            preOrder:[],
            preOrderId:[],
            url:'purchase-order',
            id:'',
            name: '',
            cost: '',
            costTotal: 0,
            openForm:false,
            isEdit:false,
            datePreOrder: '',
            alert: false
            
        }   
    },
    methods: {
        async init(){           
            this.token = localStorage.getItem('token')
            await axios.get('/api/'+this.url, {
                headers: {
                Authorization: 'Bearer ' +  this.token 
                }
            }).then(res=>{
                this.listData = res.data.data
            })

            this.token = localStorage.getItem('token')
            await axios.get('/api/product', {
                headers: {
                Authorization: 'Bearer ' +  this.token 
                }
            }).then(res=>{
                this.listDataProduct = res.data.data
            })
        },
        formatDate(value){
            if (value) {
                return moment(String(value)).format('MM/DD/YYYY hh:mm')
            }
        },
        selectProductOrder(list){
            this.costTotal += list.cost
            this.preOrder.push({name:list.name,cost:list.cost})
            this.preOrderId.push(list.id)
        },
        generateOrder(){
            const d1 = new Date();
            const d2 = new Date(this.datePreOrder);
            if (d2 < d1)  {
                this.alert = true
                return
            }
            axios.post('/api/'+this.url,{purchase_order_product:this.preOrderId,date_purchase:this.datePreOrder}, {
                headers: {
                Authorization: 'Bearer ' +  this.token 
                }
            }).then(res=>{
                this.openForm = false
                this.preOrder = []
                this.preOrderId = []
                this.listData = res.data.data

            })
        }
    },
    mounted () {
    // we can implement any method here like
        this.init()
    }
  }
</script>

<style>
/* Hide scrollbar for Chrome, Safari and Opera */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>