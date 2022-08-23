import axios from "axios"

export default {
  namespaced: true,
  state: {
    users: [],
    user: {}
  },
  getters: {
    authenticated(state) {
      return state.user
    },
    nickname(state) {
      return state.user.nickname
    },
    users(state) {
      return state.users
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
    },
    async getByNickname({commit}, nickname) {
      if(nickname !== '') {
        await axios.get('/users', {
          params:{
            'nickname': nickname
          }
        }).then(res => {
          console.log(_.map(res.data.users, 'nickname'));
          commit('setUsers', res.data.users);
        })
      }
    }
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setUsers(state, users) {
      state.users = users;
    }
  }
}