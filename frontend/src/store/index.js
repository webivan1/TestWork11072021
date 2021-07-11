import Vue from "vue";
import Vuex from "vuex";
import quoteList from "@/store/modules/quote-list";
import quoteForm from "@/store/modules/quote-form";
import quoteView from "@/store/modules/quote-view";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    quoteList,
    quoteForm,
    quoteView,
  },
});
