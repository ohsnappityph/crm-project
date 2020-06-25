<template>
 <v-app>
    <v-container>
      <div>
        <v-toolbar color="transparent" flat>
          <v-toolbar-title class="display-1 font-weight-light">
            Surveyor? I hardly know her!
          </v-toolbar-title>
        </v-toolbar>
      </div>
      <v-row>
        <v-col cols="12" lg="12" md="12" sm="12">
          <SurveyorTable />
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import SurveyorTable from "../../components/SurveyorTable"
export default {
  components: {
    SurveyorTable,
  }
}
</script>

<style>

</style>