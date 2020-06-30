<template>
  <v-container>
      <v-data-table
        :headers="projectHeaders"
        :items="clientProjects"
        >
      </v-data-table>
  </v-container>
</template>

<script>
export default {
    data: () => ({
        projectHeaders: [
            {text: 'Project Name', align: 'start', value:'project_name'},
            {text: 'Scope', value: 'scope'},
            {text: 'Status', value: 'order_status'},
            {text: 'Actions', sortable: false}
        ]
    }),
}
</script>

<style>

</style>