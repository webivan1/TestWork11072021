<template>
  <div>
    <div v-if="quote">
      <heading class="text-center"> Update quote: {{ quote.task }} </heading>

      <quote-form
        @on-submit="handleForm"
        :default-params="formDefaultParams"
        :error-message="formError"
        :success-message="formSuccess"
        btn-text="Update"
        :loader="formLoader"
      />
    </div>
    <div v-else>
      <v-progress-circular v-if="loader" indeterminate color="primary" />
      <v-alert v-else-if="error" color="error">
        {{ error }}
      </v-alert>
    </div>
  </div>
</template>

<script>
import QuoteForm from "@/components/quote/QuoteForm";
import Heading from "@/components/ui/Heading";
import { mapState } from "vuex";

export default {
  name: "QuoteEdit",
  components: { QuoteForm, Heading },
  computed: {
    ...mapState("quoteForm", {
      formLoader: "loader",
      formError: "error",
      formSuccess: "success",
    }),
    ...mapState("quoteView", {
      loader: "loader",
      error: "error",
      quote: "quote",
    }),
    formDefaultParams() {
      if (!this.quote) {
        return {};
      }
      return {
        task: this.quote.task,
        reference: this.quote.reference,
        amount: this.quote.amount,
        percentage: this.quote.percentage,
      };
    },
  },
  async mounted() {
    await this.$store.dispatch("quoteView/fetch", this.$route.params.id);
  },
  destroyed() {
    this.$store.commit("quoteForm/reset");
    this.$store.commit("quoteView/reset");
  },
  methods: {
    async handleForm(form) {
      await this.$store.dispatch("quoteForm/update", {
        form,
        id: this.quote.id,
      });
    },
  },
};
</script>
