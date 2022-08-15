export default {
  namespaced: true,
  state: {
    user: {}
  },
  getters: {
    authenticated(state) {
      return state.user
    }
  },
  actions: {
    fetchAuthenticated({ commit }) {
      axios.get('/user').then((res) => {
        console.log(res.data)
        commit('setUser', res.data)
      })
    }
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    }
  }
}