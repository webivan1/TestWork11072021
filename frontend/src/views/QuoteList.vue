<template>
  <div>
    <heading>Quotes</heading>

    <div class="d-flex justify-space-between mb-8">
      <p>Total: {{ data.total }}</p>
      <v-btn to="/create">Create</v-btn>
    </div>

    <v-alert class="mb-8" v-if="error" type="error">
      {{ error }}
    </v-alert>

    <v-data-table
      :headers="settings"
      :loading="loader"
      loading-text="Loading... Please wait"
      :items="data.models"
      :items-per-page="data.perPage"
      :server-items-length="data.total"
      :footer-props="{ disableItemsPerPage: true, disablePagination: loader }"
      disable-sort
      disable-filtering
      class="elevation-1"
      @update:page="fetch"
    >
      <template v-slot:item.actions="{ item }">
        <v-btn :disabled="loader" icon :to="'/edit/' + item.id" class="mr-1">
          <v-icon small> mdi-pencil </v-icon>
        </v-btn>
        <v-btn :disabled="loader" icon @click="deleteItem(item.id)">
          <v-icon small> mdi-delete </v-icon>
        </v-btn>
      </template>
      <template v-slot:body.append="{ headers }">
        <tr>
          <td colspan="2" />
          <td>
            <b>{{ totalAmount }}</b>
          </td>
          <td />
          <td :colspan="headers - 5">
            <b>{{ totalCost }}</b>
          </td>
        </tr>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import { mapState } from "vuex";
import Heading from "@/components/ui/Heading";

export default {
  name: "QuoteList",
  components: { Heading },
  data: () => ({
    settings: [
      { text: "Id", value: "id" },
      { text: "Task", value: "task" },
      { text: "Amount", value: "amount" },
      { text: "Percentage (%)", value: "percentage" },
      { text: "Cost", value: "cost" },
      { text: "Reference", value: "reference" },
      { text: "Actions", value: "actions" },
    ],
  }),
  created() {
    this.fetch();
  },
  computed: {
    ...mapState("quoteList", {
      loader: "loader",
      error: "error",
      data: "data",
    }),
    totalAmount() {
      return this.data.models
        .reduce((acc, { amount }) => {
          return acc + amount;
        }, 0)
        .toLocaleString();
    },
    totalCost() {
      return this.data.models
        .reduce((acc, { cost }) => {
          return acc + cost;
        }, 0)
        .toLocaleString();
    },
  },
  methods: {
    fetch(curPage = 1) {
      this.$store.dispatch("quoteList/fetchList", curPage);
    },

    async deleteItem(id) {
      if (confirm("Are you sure?")) {
        await this.$store.dispatch("quoteList/deleteItem", id);
        await this.fetch(this.data.currentPage);
      }
    },
  },
};
</script>
