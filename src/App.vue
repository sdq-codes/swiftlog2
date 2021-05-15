<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>
import httpClient from "@/utils/api/httpClient";
export default {
  name: 'App',

  mounted() {
    httpClient.get("settings")
    .then(response => {
      let config = response.data.data.settings.config;
      localStorage.setItem('settings', config)
    })
  },

  components: {}
}
</script>

<style lang="scss">
  @import "styles/ui";
  @import "styles/layout";
  @import "styles/loader";
  @import "styles/theme";
</style>
