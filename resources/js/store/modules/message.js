import axios from "axios";
import _ from "lodash";

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
        commit('setMessages', res.data)
      });
    },
    addMessage({ commit, getters }, {threadId, message}) {
      axios.post(`threads/${threadId}/messages`, {body:message}).then(res => {
        commit('setMessages', [...getters.messages, res.data]);
      }).catch(e => {
        console.log(e.data)
      });
    },
    updateMessage({ commit, getters }, {threadId, message}) {
      axios.patch(`threads/${threadId}/messages/${message.id}`, {body: message.body}).then(res => {
        const message = _.cloneDeep(res.data);
        commit('setMessages', getters.messages.map(msg => msg.id === message.id ? message : msg));
      }).catch(e => {
        console.log(e);
      });
    },
    removeMessage({ commit, getters }, {threadId, message}) {
      axios.delete(`threads/${threadId}/messages/${message.id}`).then(res => {
        commit('setMessages', getters.messages.filter(msg => msg.id !== res.data.id))
      }).catch(e => {
        console.log(e);
      });
    },
  },
  mutations: {
    setMessages(state, messages) {
      state.messages = messages;
    }
  }
}