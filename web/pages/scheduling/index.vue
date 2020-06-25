<template>
  <v-app>
    <v-container>
      <div>
        <v-toolbar color="transparent" flat>
          <v-toolbar-title class="display-1 font-weight-light">
            Work Schedule Timesheets Babyyy!
          </v-toolbar-title>
        </v-toolbar>
      </div>
      <v-row>
        <v-col cols="12" lg="12" md="12" sm="12">
          <SchedulingTable />
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import SchedulingTable from '../../components/SchedulingTable'
export default {
  components: {
    SchedulingTable,
  },
  data: () => ({

  }),
}
</script>

<style>

</style>