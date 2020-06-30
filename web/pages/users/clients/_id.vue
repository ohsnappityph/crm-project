<template>
    <v-container>
        <div>
            <v-btn @click="backTo()" color="transparent" depressed fab small>
                <v-icon>mdi-arrow-left</v-icon>
            </v-btn>
        </div>
        <v-card>
            <v-card-title>
                <div class="display-1">Client Details</div>
                <v-spacer></v-spacer>
                <v-btn :to="{name: 'users-clients-update-id', params: {id}}" text depressed>
                    <v-icon left>mdi-pencil</v-icon>
                    Edit
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-tabs v-model="tab">
                    <v-tab v-for="item in items" :key="item.tab">
                        {{ item.tab }}
                    </v-tab>
                </v-tabs>
                <v-row>
                    <v-col cols="12" md="12" sm="12">
                        <v-tabs-items v-model="tab">
                            <v-tab-item>
                                <v-row>
                                    <v-col cols="12" md="3" sm="3">
                                        <div>First Name</div>
                                        <div>{{showClient.first_name}}</div>
                                    </v-col>
                                    <v-col cols="12" md="3" sm="3">
                                        <div>Last Name</div>
                                        <div>{{showClient.last_name}}</div>
                                    </v-col>
                                    <v-col cols="12" md="3" sm="3">
                                        <div>POC First Name</div>
                                        <div>{{showClient.poc_first_name}}</div>
                                    </v-col>
                                    <v-col cols="12" md="3" sm="3">
                                        <div>POC Last Name</div>
                                        <div>{{showClient.poc_last_name}}</div>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" md="3" sm="3">
                                        <div>Email</div>
                                        <div>{{showClient.email}}</div>
                                    </v-col>
                                    <v-col cols="12" md="3" sm="3">
                                        <div>Phone Number</div>
                                        <div>{{showClient.phone}}</div>
                                    </v-col>
                                    <v-col cols="12" md="6" sm="6">
                                        <div>POC Relationship</div>
                                        <div>{{showClient.poc_relationship}}</div>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" md="6" sm="6">
                                        <div>Company</div>
                                        <div>{{showClient.company_name}}</div>
                                    </v-col>
                                    <v-col cols="12" md="3" sm="3">
                                        <div>Payment Method</div>
                                        <div>{{showClient.payment_info}}</div>
                                    </v-col>
                                    <v-col cols="12" md="3" sm="3">
                                        <div>Referred By</div>
                                        <div>{{showClient.referred_by}}</div>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" md="6" sm="6">
                                        <div>Preferences</div>
                                        <div>{{showClient.client_preferences}}</div>
                                    </v-col>
                                    <v-col cols="12" md="6" sm="6">
                                        <div>Client ID</div>
                                        <div>{{showClient.id}}</div>
                                    </v-col>
                                </v-row>
                            </v-tab-item>
                            <v-tab-item><ClientProjects /></v-tab-item>
                            <v-tab-item><ClientLeads /></v-tab-item>
                        </v-tabs-items>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
import ClientProjects from '../../../components/ClientProjects'
import ClientLeads from '../../../components/ClientLeads'
import { mapGetters, mapActions, mapState} from 'vuex'
export default {
    components: {
        ClientProjects,
        ClientLeads,
    },
    data () {
        return {
            tab: null,
            items: [
                {tab: 'Details'},
                {tab: 'Projects'},
                {tab: 'Leads'},
            ],
            id: this.$route.params.id,
        }
    },
    methods: {
        ...mapActions({fetchOneClient: 'clients/fetchOneClient'}),
        backTo() {
            this.$router.push('/users/clients')
        }
    },
    computed: {
        ...mapGetters({showClient: 'clients/client'})
    },
    async fetch({store, params}) {
        await store.dispatch('clients/fetchOneClient', params.id)
    },
    created() {
        console.log(this.$route.params.id)
    }
}
</script>

<style>

</style>