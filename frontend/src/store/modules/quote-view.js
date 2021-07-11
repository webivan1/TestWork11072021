import http from "@/services/http";

export default {
  namespaced: true,
  state: {
    loader: false,
    error: null,
    quote: null,
  },
  mutations: {
    reset(state) {
      state.loader = false;
      state.error = null;
      state.quote = null;
    },

    startFetching(state) {
      state.loader = true;
      state.error = null;
    },

    stopFetching(state) {
      state.loader = false;
    },

    setError(state, errorMessage) {
      state.error = errorMessage;
    },

    setQuote(state, quote) {
      state.quote = { ...quote };
    },
  },
  actions: {
    async fetch({ commit }, id) {
      commit("startFetching");
      try {
        const { data } = await http.get(`/quote/${id}`);
        commit("setQuote", data);
      } catch (e) {
        commit("setError", e.message);
      } finally {
        commit("stopFetching");
      }
    },
  },
};
