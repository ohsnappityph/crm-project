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
                <v-btn :to="{name: 'users-clients-create'}" text depressed>
                    <v-icon left>mdi-plus</v-icon>
                    New Client
                </v-btn>
                <v-btn icon>
                    <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-data-table
                    :headers="clientHeaders"
                    :items="allClients"
                    :search="search"
                    multi-sort
                    loading-text="Loading clients... Please wait"
                    >
                    <template v-slot:item.email_verified_at="{item}">
                        <v-icon v-if="isActivated(item.email_verified_at) == true" color="green">mdi-account-check</v-icon>
                        <v-icon v-if="isActivated(item.email_verified_at) == false" color="red">mdi-account-cancel</v-icon>
                    </template>
                    <template v-slot:item.name="{item}">
                        <div>
                            {{item.first_name + ' ' + item.last_name}}
                        </div>
                    </template>
                    <template v-slot:item.actions="{item}">
                        <v-btn :to="{name: 'users-clients-id', params: {id:item.id}}" icon>
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
        clientHeaders: [
            {text: 'Activated', align: 'start', sortable: false, value: 'email_verified_at'},
            {text: 'Name', value: 'name'},
            {text: 'Email', value: 'email'},
            {text: 'Phone Number', value: 'phone'},
            {text: 'Company', value: 'company_name'},
            {text: 'Created', value: 'created_at'},
            {text: 'Actions', sortable: false, value: 'actions'},
        ],
    }),
    methods: {
        isActivated(dateActivated) {
            if(dateActivated != null) {
                return true
            } else {
                return false
            }
        },
        ...mapActions({fetchAllClients: 'clients/fetchAllClients'}),
    },
    computed: {
        ...mapGetters({allClients: 'clients/clients'}),
    },
    created() {
        this.fetchAllClients()
    },
}
</script>

<style>

</style>