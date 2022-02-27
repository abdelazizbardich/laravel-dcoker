import Vue from 'vue'
import Vuex from 'vuex'
import defaultState from './defaultState';
import axios from "@/axios";
Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    data: defaultState
  },
  mutations: {
    SET_USER_DATA(state,data){
      localStorage.setItem("user",JSON.stringify(data));
      state.data.user = data;
      state.data.user.token = "Bearer "+state.data.user.token
      axios.defaults.headers.common['Authorization'] = "Bearer "+state.data.user.token
    },
    CLEAR_USER_DATA(state){
        localStorage.clear();
        state.data.user = null
    }
  },
  actions:{
    setUserData(store,data){
        store.commit("SET_USER_DATA",data);
    },
    clearUserData(store){
      store.commit("CLEAR_USER_DATA");
    },
    notifier(store,data){
      alert(data.msg);
    }
  },
  getters:{
    getUserData(state){
      return state.data.user || JSON.parse(localStorage.getItem("user"));
    }
  }
})

export default store;