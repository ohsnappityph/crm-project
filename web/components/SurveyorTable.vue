<template>
  <v-app>
      <v-card>
          <v-card-title>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                placeholder="Search the table here"
                single-line
                hide-details
                solo
                dense
                >
            </v-text-field>
            <v-spacer></v-spacer>
            <v-btn :to="{name: 'surveyors-create'}" text depressed>
                <v-icon left>mdi-plus</v-icon>
                New Surveyor
            </v-btn>
            <v-btn icon>
                <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
          </v-card-title>
          <v-card-text>
              <v-data-table
                :headers="surveyorHeaders"
                :items="items"
                :search="search"
                multi-sort
                loading-text="Loading clients... Please wait"
                >
                <template v-slot:item.surveyor_color_code="{item}">
                    <v-icon :color="item.surveyor_color_code">mdi-checkbox-blank-circle</v-icon>
                </template>
                <template v-slot:item.name="{item}">
                    <div>
                        {{item.first_name + ' ' + item.last_name}}
                    </div>
                </template>
                <template v-slot:item.actions="{item}">
                    <v-btn :to="{name: 'surveyors-id', params: {id:item.id}}" icon>
                        <v-icon color="yellow darken-2">mdi-eye</v-icon>
                    </v-btn>
                </template>
            </v-data-table>
          </v-card-text>
      </v-card>
  </v-app>
</template>

<script>
export default {
    data: () => ({
        search: '',
        surveyorHeaders: [
            {text:"#", sortable: false, align: 'start', value:"id"},
            {text:"Color Code", value:"surveyor_color_code"},
            {text:"Name", value:"name"},
            {text:"Location", value:"surveyor_location"},
            {text:"Created", value:"created_at"},
            {text:"Actions", sortable: false, value:"actions"},
        ],
        items: [
            {id: 1, surveyor_color_code:"#4A148C", first_name:"Jizni", last_name:"Corrine", surveyor_location:"Iligan", created_at:"10-19-2020"},
            {id: 2, surveyor_color_code:"#4A148C", first_name:"Enzzo", last_name:"Ostia", surveyor_location:"Iligan", created_at:"05-31-2020"}
        ]
    }),
}
</script>

<style>

</style>