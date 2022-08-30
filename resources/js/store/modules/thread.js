import axios from "axios";

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
      return thread ? thread.users.length + 1 : 0;
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
    async addThread({commit, getters}) {
      const thread = { name:getters.thread.name, users: _.map(getters.thread.users, 'id') };
      await axios.post('/threads', {
        'name': thread.name,
        'users': thread.users
      }).then(res => {
        console.log(res.data)
        commit('updateThreads', [...getters.threads, res.data]);
      }).catch(e => {
        console.log(e.data)
      })
    },
    async updateThread({ commit, getters }) {
      const thread = { name:getters.thread.name, users: _.map(getters.thread.users, 'id') };
      await axios.patch(`/threads/${getters.thread.id}`, thread).then(res => {
        console.log(res.data);
        commit('updateThreads', getters.threads.map(thr => thr.id === getters.thread.id ? getters.thread : thr));
      })
    },
    async leaveFromThread({commit, getters}) {
      await axios.delete(`/threads/${getters.thread.id}`).then(res => {
        const thread = res.data;
        commit('removeThreadById', thread.id);
      });
    }
  },
  mutations: {
    updateThreads(state, threads) {
      state.threads = threads;
    },
    updateUsers(state, users) {
      state.thread.users = users;
    },
    setThread(state, thread) {
      state.thread = _.cloneDeep(thread);
    },
    pushUserToThread(state, users) {
      state.thread.users.push(users);
    },
    removeUserById(state, id) {
      state.thread.users = state.thread.users.filter(user => user.id !== id);
    },
    removeThreadById(state, id) {
      state.threads = state.threads.filter(thr => thr.id !== id);
    }
  }
}