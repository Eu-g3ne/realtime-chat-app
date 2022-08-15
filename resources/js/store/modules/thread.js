export default {
  namespaced: true,
  state: {
    threads: []
  },
  getters: {
    threads(state) {
      return state.threads
    }
  },
  actions: {
    fetchThreads({ commit }) {
      axios.get("/threads").then((response) => {
        commit('updateThreads', response.data)
      });
    }
  },
  mutations: {
    updateThreads(state, threads) {
      state.threads = threads;
    }
  }
}