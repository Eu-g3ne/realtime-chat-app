import Vue from 'vue'
import Vuex from 'vuex'

import user from './modules/user'
import thread from './modules/thread'
import message from './modules/message'
Vue.use(Vuex);
export default new Vuex.Store({
  modules: {
    user,
    thread,
    message
  }
})