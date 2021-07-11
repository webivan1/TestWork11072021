<template>
  <div>
    <heading class="text-center"> Create an quote </heading>

    <quote-form
      @on-submit="handleForm"
      :error-message="error"
      :success-message="success"
      :loader="loader"
    />
  </div>
</template>

<script>
import Heading from "@/components/ui/Heading";
import QuoteForm from "@/components/quote/QuoteForm";
import { mapState } from "vuex";

export default {
  name: "QuoteCreate",
  components: { QuoteForm, Heading },
  computed: mapState("quoteForm", {
    loader: "loader",
    error: "error",
    success: "success",
  }),
  destroyed() {
    this.$store.commit("quoteForm/reset");
  },
  methods: {
    async handleForm(form) {
      await this.$store.dispatch("quoteForm/create", form);
    },
  },
};
</script>
