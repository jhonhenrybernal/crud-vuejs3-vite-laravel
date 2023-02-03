<template>
    <div>
          
      <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold tracking-tight text-gray-900">Productos</h1>
        </div>
      </header>
      <main>
        <div class="mx-auto max-w-7xl py-1 sm:px-3 lg:px-1" v-if="!openForm">
          <div class="lg:flexlg:justify-between">
              <div class="mt-6 flex lg:mt-5 lg:ml-5">
                  <span class="sm:ml-3">
                      <button type="button" @click="openForm = true, isEdit = false" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Nuevo
                      </button>
                  </span>
              </div>
          </div>
          </div>
          <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8" >
            <table class="shadow-lg bg-white" v-if="!openForm">
                <tr>
                    <th class="bg-blue-100 border text-left px-8 py-4">Nombre</th>
                    <th class="bg-blue-100 border text-left px-8 py-4">Costo</th>
                    <th class="border px-8 py-4" >Acción</th>
                </tr>
                <tr  v-for="(list,k) in listData" :key="k">
                    <td class="border px-8 py-4" >{{ list.name }}</td>
                    <td class="border px-8 py-4" >{{ list.cost }}</td>
                    <td>
                        <button @click="editData(list,k)" class="ml-8 inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700" type="submit">EDIT</button>
                        <button @click="deleteData(list,k)" class="ml-8 inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700" type="submit">Delete</button>
                    </td>
                </tr>
            </table>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8"  v-if="openForm">
            <div class="mt- md:col-span-3 md:mt-2">
                <form  v-on:submit="addData">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                        <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" v-model="name" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>
                        <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Costo</label>
                    <input type="number" name="name" id="name" v-model="cost" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Guardar</button>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>
      </main>
    </div>
</template>
<script >
import moment from 'moment';

  export default {
    data () {
        return {
            listData: [],
            url:'product',
            id:'',
            name: '',
            cost: '',
            openForm:false,
            isEdit:false,
            token:''
            
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
        },
        editData(list){
            this.id =  list.id
            this.name = list.name
            this.cost = list.cost
            this.openForm = true;
            this.isEdit = true
        },
        formatDate(value){
            if (value) {
                return moment(String(value)).format('MM/DD/YYYY hh:mm')
            }
        },
        addData(){
            this.openForm = false;
            var data = {
                    name: this.name,
                    cost: this.cost,
                }
            if (this.isEdit) {
                axios.put('/api/'+this.url+'/'+this.id,data, {
                    headers: {
                    Authorization: 'Bearer ' +  this.token 
                    }
                }).then(res=>{
                    this.listData = res.data.data
                    this.init()
                })
            }else{
                axios.post('/api/'+this.url,data, {
                    headers: {
                    Authorization: 'Bearer ' +  this.token 
                    }
                }).then(res=>{
                    this.listData = res.data.data
                    this.init()
                })
            }
        },
        roles(role){
         return this.listRole.find(f=>f.id ==role)
        },
        deleteData(data){
            axios.delete('/api/'+this.url+'/'+data.id, {
            headers: {
            Authorization: 'Bearer ' +  this.token 
            }
        }).then(res=>{
            this.init()
        })
        }
    },
    mounted () {
    // we can implement any method here like
        this.init()
    }
  }
</script>