import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    token: ''
  },
  mutations: {
    setToken: function (state, val) {
      this.state.token = val
    }
  },
  actions: {
  },
  modules: {
  },
  getters: {
    token: state => {
      return state.token
    }
  }
})
