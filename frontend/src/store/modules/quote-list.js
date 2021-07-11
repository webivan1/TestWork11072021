import http from "@/services/http";

export default {
  namespaced: true,
  state: {
    loader: false,
    error: undefined,
    data: {
      total: 0,
      models: [],
      perPage: 0,
      currentPage: 1,
      countPages: 0,
    },
  },
  mutations: {
    startFetching(state) {
      state.loader = true;
      state.error = undefined;
    },

    stopFetching(state) {
      state.loader = false;
    },

    setError(state, errorMessage) {
      state.error = errorMessage;
    },

    setPaginationData(state, data) {
      state.data = { ...data };
    },
  },
  actions: {
    async fetchList({ state, commit }, page) {
      if (state.loader) {
        return;
      }

      commit("startFetching");

      try {
        const data = await http
          .get(`/quote?currentPage=${page}`)
          .then(({ data }) => data);

        commit("setPaginationData", data);
      } catch (e) {
        commit("errorMessage", e.message);
      } finally {
        commit("stopFetching");
      }
    },

    async deleteItem({ state, commit }, id) {
      if (state.loader) {
        return;
      }

      commit("startFetching");

      try {
        await http.delete(`/quote/${id}`);
      } catch (e) {
        commit("errorMessage", e.message);
      } finally {
        commit("stopFetching");
      }
    },
  },
  getters: {
    isLastPage({ data: { countPages, currentPage } }) {
      return currentPage >= countPages;
    },
  },
};
