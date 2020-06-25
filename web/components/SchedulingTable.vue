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
                <v-btn icon>
                    <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
            </v-card-title>
            <v-data-table
                :headers = "schedulingHeaders"
                :items="items"
                :search="search"
                multi-sort
                loading-text="Loading timesheets... Please wait"
                >
                <template v-slot:item.role="{item}">
                    <div class="text-center" align-left>
                        <div class="d-flex">
                            <v-chip class="ma-2" :color="roleCheckColor(item.role)">{{item.role}}</v-chip>
                        </div>
                    </div>
                </template>
                <template v-slot:item.actions="{item}">
                    <div class="text-center" align-left>
                        <div class="d-flex">
                            <v-menu
                                bottom
                                origin="center center"
                                transition="scale-transition"
                                offsetY
                                :close-on-content-click="true"
                                >
                                <template v-slot:activator="{on: menu}">
                                    <v-tooltip bottom>
                                        <template v-slot:activator="{on: tooltip}">
                                            <v-btn
                                                color="primary"
                                                dark
                                                v-on="{...tooltip, ...menu}"
                                                depressed
                                                >
                                                Actions
                                            </v-btn>
                                        </template>
                                        <span>Perform Actions</span>
                                    </v-tooltip>
                                </template>
                                <v-list>
                                    <v-list-item>
                                        <v-btn-toggle borderless>
                                            <v-btn :to="{name: 'scheduling-id', params: {id:item.id}}" icon>
                                                <v-icon color="yellow darken-2">mdi-eye</v-icon>
                                            </v-btn>
                                            <v-dialog v-model="updateScheduling" max-width="465px">
                                                <template v-slot:activator="{on}">
                                                    <v-btn v-on="on" icon>
                                                        <v-icon color="green darken-2">mdi-pencil</v-icon>
                                                    </v-btn>
                                                </template>
                                                <v-card depressed>
                                                    <v-card-title class="headline">Do you want to update this schedule?</v-card-title>
                                                    <v-card-text>
                                                        <small>Click outside to exit this window.</small>
                                                    </v-card-text>
                                                    <v-card-actions>
                                                        <v-btn color="red darken-1" @click="updateScheduling = !updateScheduling" absolute text>No</v-btn>
                                                        <v-spacer></v-spacer>
                                                        <v-btn color="green darken-1" :to="{name:'scheduling-update-id', params: {id:item.id}}" text>Yes</v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>
                                        </v-btn-toggle>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </div>
                    </div>
                </template>
            </v-data-table>
        </v-card>
    </v-app>
</template>

<script>
export default {
    data: () => ({
        search: '',
        updateSchedule: false,
        schedulingHeaders: [
            {text: '#', align: 'start', sortable: false, value: 'id'},
            {text: 'Employee', value: 'name'},
            {text: 'Total Hours Worked', value: 'total_hours_worked'},
            {text: 'Total Hours Off', value: 'total_hours_off'},
            {text: 'Role', value: 'role'},
            {text: 'Actions', align: 'end', sortable: false, value: 'actions'}
        ],
        items: [
            {id: 1, name: 'Admin Boi', total_hours_worked: 8, total_hours_off: 0, role: 'Administrator'},
            {id: 2, name: 'CSM Boi', total_hours_worked: 8, total_hours_off: 0, role: 'Client Services Manager'},
            {id: 3, name: 'DTM Boi', total_hours_worked: 8, total_hours_off: 0, role: 'Design Team Manager'},
            {id: 4, name: 'PA Boi', total_hours_worked: 8, total_hours_off: 0, role: 'Project Architect'},
            {id: 5, name: '3DVisEx Boi', total_hours_worked: 8, total_hours_off: 0, role: '3D Visualization Expert'},
            {id: 6, name: 'BldgSurveyor Boi', total_hours_worked: 8, total_hours_off: 0, role: 'Building Surveyor'},
        ]
    }),
    methods: {
        roleCheckColor(role) {
            if(role === "Administrator") {
                return "purple darken-4"
            } else if(role === "Client Services Manager") {
                return "green darken-3"
            } else if(role === "Design Team Manager") {
                return "deep-orange"
            } else if(role === "Project Architect") {
                return "info"
            } else if(role === "3D Visualization Expert") {
                return "blue-grey"
            } else if(role === "Building Surveyor") {
                return "secondary"
            }
        },
    },
    computed: {
        
    }
}
</script>

<style>

</style>