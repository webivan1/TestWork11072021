<template>
  <v-app-bar app color="primary" dark>
    <v-container class="d-flex justify-end">
      <v-btn
        v-for="(link, index) of menu"
        :key="index"
        :to="link.url"
        text
        class="ml-5"
      >
        {{ link.text }}
      </v-btn>
    </v-container>
  </v-app-bar>
</template>

<script>
export default {
  name: "Navigation",
  props: {
    menu: {
      type: Array,
      required: true,
    },
  },
};
</script>
