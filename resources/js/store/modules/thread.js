export default {
  namespaced: true,
  state: {
    threads: []
  },
  getters: {
    threads(state) {
      return state.threads
    },
    nameById:(state) => (id) => {
      let thread = state.threads.find(thread => thread.id === id)
      return thread ? thread.name : '';
    },
    membersById:(state) => (id) => {
      let thread = state.threads.find(thread => thread.id === id)
      return thread ? thread.participants.length : 0;
    },
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