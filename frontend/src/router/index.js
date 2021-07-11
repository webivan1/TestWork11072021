import Vue from "vue";
import VueRouter from "vue-router";
import QuoteList from "@/views/QuoteList";
import QuoteCreate from "@/views/QuoteCreate";
import QuoteEdit from "@/views/QuoteEdit";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    component: QuoteList,
  },
  {
    path: "/create",
    component: QuoteCreate,
  },
  {
    path: "/edit/:id",
    component: QuoteEdit,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
