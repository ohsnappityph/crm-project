<template>
  <v-container>
      <v-data-table
        :headers="leadHeaders"
        :items="clientLeads"
        >
      </v-data-table>
  </v-container>
</template>

<script>
export default {
    data: () => ({
        leadHeaders: [
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