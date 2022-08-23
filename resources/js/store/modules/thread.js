export default {
  namespaced: true,
  state: {
    threads: [],
    thread: {
      name: '',
      users: []
    }
  },
  getters: {
    threads(state) {
      return state.threads
    },
    thread(state) {
      return state.thread
    },
    nameById:(state) => (id) => {
      let thread = state.threads.find(thread => thread.id === id)
      return thread ? thread.name : '';
    },
    membersById:(state) => (id) => {
      let thread = state.threads.find(thread => thread.id === id)
      return thread ? thread.users.length : 0;
    },
    users(state) {
      return state.thread.users;
    }
  },
  actions: {
    async fetchThreads({ commit }) {
      await axios.get("/threads").then((response) => {
        commit('updateThreads', response.data)
      });
    },
    async addThread({commit, getters}, thread) {
      await axios.post('/threads', {
        'name': thread.name,
        'users': thread.users
      }).then(res => {
        console.log(res.data)
        commit('updateThreads', [...getters.threads, res.data]);
      }).catch(e => {
        console.log(e.data)
      })
    }
  },
  mutations: {
    updateThreads(state, threads) {
      state.threads = threads;
    },
    updateUsers(state, users) {
      state.thread.users = users;
    }
  }
}