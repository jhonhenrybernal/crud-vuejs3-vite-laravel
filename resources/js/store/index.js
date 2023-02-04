import { createStore } from 'vuex'

const store = createStore({


    state: {
        //define variables
        token : localStorage.getItem('token') || 0,
        role : localStorage.getItem('role') || 0,
        getUserIn:false,
        getRolesIn:false,
        getClientIn:false,
        getProductIn:false,
        getOrderIn:false
   },

    mutations:{
        // update variable value
        UPDATE_TOKEN(state,payload){
            state.token = payload
        },
        UPDATE_ROLE(state,payload){
            state.role = payload
        },

        //variales role
        UPDATE_GETUSERIN(state,payload){
            state.getUserIn = payload
        },
        UPDATE_GETROLESIN(state,payload){
            state.getRolesIn = payload
        },
        UPDATE_GETCLIENTIN(state,payload){
            state.getClientIn = payload
        },
        UPDATE_GETPRODUCTIN(state,payload){
            state.getProductIn = payload
        },
        UPDATE_GETORDERIN(state,payload){
            state.getOrderIn = payload
        },
    },

    actions:{
        // action to be performed
        setToken(context,payload){
            localStorage.setItem('token',payload)
            context.commit('UPDATE_TOKEN',payload)
        },
        setRole(context,payload){
            localStorage.setItem('role',payload)
            context.commit('UPDATE_ROLE',payload)
        },
        removeToken(context){
            localStorage.removeItem('token');
            context.commit('UPDATE_TOKEN', 0);
        },
        removeRole(context){
            localStorage.removeItem('role');
            context.commit('UPDATE_ROLE', 0);
        },

        setUserIn(context,payload){
            context.commit('UPDATE_GETUSERIN',payload);
        },
        removeGetuserin(context,payload){
            context.commit('UPDATE_GETUSERIN',false);
        },
        setRolesIn(context,payload){
            context.commit('UPDATE_GETROLESIN',payload);
        },
        removeRolesIn(context,payload){
            context.commit('UPDATE_GETROLESIN',false);
        },
        setClientIn(context,payload){
            context.commit('UPDATE_GETCLIENTIN',payload);
        },
        removeClientIn(context,payload){
            context.commit('UPDATE_GETCLIENTIN',false);
        },
        setProductIn(context,payload){
            context.commit('UPDATE_GETPRODUCTIN',payload);
        },
        removeProductIn(context,payload){
            context.commit('UPDATE_GETPRODUCTIN',false);
        },
        setOrderIn(context,payload){
            context.commit('UPDATE_GETORDERIN',payload);
        },
        removeOrderIn(context,payload){
            context.commit('UPDATE_GETORDERIN',false);
        },

    },

    getters:{
        // get state variable value
        getToken: function(state){
            return state.token
        },
        getRole: function(state){
            return state.role
        },

        getUserIn(state){
            return state.getUserIn
        },
        getRolesIn(state){
            return state.getRolesIn
        },
        getClientIn(state){
            return state.getClientIn
        },
        getProductIn(state){
            return state.getProductIn
        },
        getOrderIn(state){
            return state.getOrderIn

        },
    }

})

export default store;