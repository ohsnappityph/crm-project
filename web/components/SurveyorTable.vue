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
                :items="allSurveyors"
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
import { mapGetters, mapActions } from 'vuex'
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
    }),
    methods: {
        ...mapActions({fetchAllSurveyors: 'surveyors/fetchAllSurveyors'}),
    },
    computed: {
        ...mapGetters({allSurveyors: 'surveyors/surveyors'}),
    },
    created() {
        this.fetchAllSurveyors()
    }
}
</script>

<style>

</style>