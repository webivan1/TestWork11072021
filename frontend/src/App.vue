<template>
  <v-app>
    <navigation
      :menu="[
        { url: '/', text: 'View list' },
        { url: '/create', text: 'Create' },
      ]"
    />

    <v-main>
      <v-container class="py-10">
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import Navigation from "@/components/ui/Navigation";
export default {
  name: "App",
  components: { Navigation },
};
</script>
