export default {
  namespaced: true,
  state: {
    messages: []
  },
  getters: {
    messages(state) {
      return state.messages
    }
  },
  actions: {
    fetchMessages({ commit }, id) {
      axios.get(`threads/${id}/messages`).then((res) => {
        commit('updateMessages', res.data)
      });
    }
  },
  mutations: {
    updateMessages(state, messages) {
      state.messages = messages;
    }
  }
}