<template>
  <v-app>
    <v-container>
      <div>
        <v-toolbar color="transparent" flat>
          <v-toolbar-title class="display-1 font-weight-light">
            Clients man, they be crazy!
          </v-toolbar-title>
        </v-toolbar>
      </div>
      <v-row>
        <v-col cols="12" lg="12" md="12" sm="12">
          <ClientTable />
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import ClientTable from "../../../components/ClientTable"
export default {
  components: {
    ClientTable,
  }
}
</script>

<style>

</style>