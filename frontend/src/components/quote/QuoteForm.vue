<template>
  <validation-observer v-slot="{ invalid, handleSubmit }">
    <v-form class="form" @submit.prevent="handleSubmit(submit)">
      <v-card class="py-8 px-8">
        <ValidationProvider
          name="Task"
          rules="required|min:5|max:150"
          v-slot="{ errors }"
        >
          <v-text-field
            class="test-task-field"
            v-model="form.task"
            label="Task"
            counter="150"
            :error-messages="errors"
            required
          />
        </ValidationProvider>
        <ValidationProvider
          name="Amount"
          rules="required|decimal|min_value:0|max_value:1000000"
          v-slot="{ errors }"
        >
          <v-text-field
            class="test-amount-field"
            type="number"
            v-model="form.amount"
            label="Amount"
            :error-messages="errors"
            required
          />
        </ValidationProvider>
        <ValidationProvider
          name="Percentage"
          rules="required|integer|min_value:0|max_value:100"
          v-slot="{ errors }"
        >
          <v-text-field
            class="test-percentage-field"
            type="number"
            v-model="form.percentage"
            label="Percentage"
            :error-messages="errors"
            required
          />
        </ValidationProvider>
        <ValidationProvider name="Reference">
          <v-textarea
            class="test-reference-field"
            v-model="form.reference"
            label="Reference"
          />
        </ValidationProvider>

        <v-alert class="test-error" v-if="errorMessage" color="error">{{
          errorMessage
        }}</v-alert>
        <v-alert
          class="test-success"
          v-else-if="successMessage"
          color="success"
          >{{ successMessage }}</v-alert
        >

        <div class="text-right">
          <v-btn
            class="test-submit"
            :loading="loader"
            :disabled="loader"
            type="submit"
            color="primary"
          >
            {{ btnText }}
          </v-btn>
        </div>
      </v-card>
    </v-form>
  </validation-observer>
</template>

<script>
import { ValidationProvider, ValidationObserver, extend } from "vee-validate";
import {
  required,
  max,
  min,
  min_value,
  max_value,
  integer,
} from "vee-validate/dist/rules";

extend("required", { ...required });
extend("integer", { ...integer });
extend("max", { ...max });
extend("min", { ...min });
extend("min_value", { ...min_value });
extend("max_value", { ...max_value });
extend("decimal", {
  validate: (value) => Number.isFinite(+value),
});

export default {
  name: "QuoteForm",
  props: {
    loader: {
      type: Boolean,
      default: false,
    },
    successMessage: String,
    errorMessage: String,
    btnText: {
      type: String,
      default: "Create",
    },
    defaultParams: {
      type: Object,
      default: () => ({}),
    },
  },
  emits: ["on-submit"],
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  created() {
    this.form = { ...this.form, ...this.defaultParams };
  },
  data: () => ({
    form: {
      task: "",
      reference: "",
      amount: "",
      percentage: "",
    },
  }),
  methods: {
    submit() {
      if (!this.loader) {
        this.$emit("on-submit", this.form);
      }
    },
  },
};
</script>

<style scoped>
.form {
  max-width: 600px;
  margin: 0 auto;
}
</style>
