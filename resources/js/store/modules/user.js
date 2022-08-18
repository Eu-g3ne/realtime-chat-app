import axios from "axios"

export default {
  namespaced: true,
  state: {
    user: {}
  },
  getters: {
    authenticated(state) {
      return state.user
    },
    nickname(state) {
      return state.user.nickname
    }
  },
  actions: {
    fetchAuthenticated({ commit }) {
      axios.get('/user').then((res) => {
        commit('setUser', res.data)
      })
    },
    async login({commit}, user) {
      await axios.post('/login', user).then((res) => {
        localStorage.setItem('apiToken', res.data.token);
      })
    },
    async logout({commit}) {
      await axios.post('/logout').then((res) => {
        localStorage.removeItem('apiToken');
        commit('setUser', {});
      })
    }
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    }
  }
}