import http from "@/services/http";

export default {
  namespaced: true,
  state: {
    loader: false,
    error: null,
    success: null,
  },
  mutations: {
    reset(state) {
      state.loader = false;
      state.error = null;
      state.success = null;
    },

    startFetching(state) {
      state.loader = true;
      state.error = null;
      state.success = null;
    },

    stopFetching(state) {
      state.loader = false;
    },

    setError(state, errorMessage) {
      state.error = errorMessage;
    },

    setSuccess(state, successMessage) {
      state.success = successMessage;
    },
  },
  actions: {
    async create({ commit, state: { loader } }, formData) {
      if (loader) {
        return;
      }

      commit("startFetching");

      try {
        const params = new URLSearchParams({ ...formData });

        const {
          data: { status, quote },
        } = await http.post("/quote", params);

        if (status === "ok") {
          commit("setSuccess", `You have added ${quote.task}`);
        } else {
          throw new Error("Error create");
        }
      } catch (e) {
        commit("setError", e.message);
      } finally {
        commit("stopFetching");
      }
    },

    async update({ commit, state: { loader } }, { id, form }) {
      if (loader) {
        return;
      }

      commit("startFetching");

      try {
        const params = new URLSearchParams({ ...form });

        const {
          data: { status, quote },
        } = await http.post(`/quote/${id}`, params);
        if (status === "ok") {
          commit("setSuccess", `You have updated ${quote.task}`);
        } else {
          throw new Error("Error update");
        }
      } catch (e) {
        commit("setError", e.message);
      } finally {
        commit("stopFetching");
      }
    },
  },
};
