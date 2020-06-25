<template>
  <v-app>
    <v-app-bar app color="#4A148C" flat>
        <v-btn @click="home()" color="transparent" depressed fab>
            <v-icon>mdi-arrow-left</v-icon>
        </v-btn>
        <v-spacer></v-spacer>
        <v-toolbar-title>
            <v-divider vertical inset></v-divider>
            <span>Ordering Plans</span>
        </v-toolbar-title>
    </v-app-bar>
    <v-content>
      <div>
        <nuxt />
      </div>
    </v-content>
  </v-app>
</template>

<script>
export default {
  methods: {
    home() {
      this.$router.push('/')
    }
  }
}
</script>

<style>

</style>