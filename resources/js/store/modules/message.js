import axios from "axios";

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
    fetchMessages({ commit }, threadId) {
      axios.get(`threads/${threadId}/messages`).then((res) => {
        commit('updateMessages', res.data)
      });
    },
    addMessage({commit, getters}, {threadId, message}) {
      axios.post(`threads/${threadId}/messages`, {body:message}).then(res => {
        console.log(res.data);
        commit('updateMessages', [...getters.messages, res.data]);
      }).catch(e => {
        console.log(e.data)
      });
    },
    removeMessage({ commit, getters }, {threadId, message}) {
      axios.delete(`threads/${threadId}/messages/${message.id}`).then(res => {
        commit('updateMessages', getters.messages.filter(msg => msg.id !== res.data.id))
      });
    },
  },
  mutations: {
    updateMessages(state, messages) {
      state.messages = messages;
    }
  }
}