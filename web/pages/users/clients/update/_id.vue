<template>
    <v-container>
        <div>
            <v-btn @click="backTo()" color="transparent" depressed fab small>
                <v-icon>mdi-arrow-left</v-icon>
            </v-btn>
        </div>
        <v-card color="transparent" flat>
            <v-card-title class="font-weight-light">New Client</v-card-title>
            <v-card-text>
                <v-form ref="form">
                    <v-row>
                        <v-col cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="first_name"
                                label="First Name*"
                                outlined
                                dense
                                prepend-inner-icon="mdi-book-account"
                                :rules="[requiredInput('first name')]"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="last_name"
                                label="Last Name*"
                                outlined
                                dense
                                prepend-inner-icon="mdi-book-account"
                                :rules="[requiredInput('last name')]"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="poc_first_name"
                                label="POC First Name"
                                outlined
                                dense
                                prepend-inner-icon="mdi-book-account-outline"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="poc_last_name"
                                label="POC Last Name"
                                outlined
                                dense
                                prepend-inner-icon="mdi-book-account-outline"
                                >
                            </v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="email"
                                label="Email*"
                                outlined
                                dense
                                prepend-inner-icon="mdi-email"
                                :rules="emailRules"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="phone"
                                label="Phone Number*"
                                outlined
                                dense
                                prepend-inner-icon="mdi-cellphone"
                                :rules="[requiredInput('phone number')]"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="6" sm="6">
                            <v-text-field
                                v-model="poc_relationship"
                                label="POC Relationship"
                                outlined
                                dense
                                prepend-inner-icon="mdi-account-arrow-left"
                                >
                            </v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" md="6" sm="6">
                            <v-text-field
                                v-model="company_name"
                                label="Company*"
                                outlined
                                dense
                                prepend-inner-icon="mdi-office-building"
                                hint="AGENT INFORMATION OR RESPONSIBLE PARTY (do not enter assistant information here)"
                                persistent-hint
                                :rules="[requiredInput('company name')]"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="payment_info"
                                label="Payment Method"
                                outlined
                                dense
                                prepend-inner-icon="mdi-cash-plus"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="referred_by"
                                label="Referred By"
                                outlined
                                dense
                                prepend-inner-icon="mdi-account-multiple-check"
                                >
                            </v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" md="6" sm="6">
                            <v-textarea
                                v-model="client_preferences"
                                label="Preferences"
                                outlined
                                dense
                                prepend-inner-icon="mdi-account-heart"
                                >
                            </v-textarea>
                        </v-col>
                    </v-row>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn @click="submit()" depressed text>Add New Client</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
import { mapGetters, mapActions, mapState } from 'vuex'
import { mapFields } from 'vuex-map-fields'
import { required, minLength, maxLength } from 'vuelidate/lib/validators'
export default {
    data: () => ({
        requiredInput(propertyType) {
            return v => v && v.length > 0 || `You must input the ${propertyType}.`
        },
        emailRules: [
            v => !!v || 'E-mail is required',
            v => !v || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        ],
        passwordRules: [
            v => !!v || 'Password is required',
            v => v.length >= 5 || 'Password must be at least 5 characters',
            v => v.length <= 16 || 'Password should not be more than 16 characters',
            v => v.match(/[A-Z]/g) !== null || 'Password should have at least one uppercase character',
            v => v.match(/[0-9]/g) !== null || 'Password should have at least one number'
        ],
    }),
    methods: {
        ...mapActions({fetchOneClient: 'clients/fetchOneClient,'}),
        submit() {
            if(this.$refs.form.validate()) {
                this.$store.dispatch('clients/updateClient', {id:this.$route.params.id})
                // this.$router.push({ name: 'users-clients-id', params: {id:this.$route.params.id}})
                this.$router.go(-1)
            }
        },
        backTo() {
            this.$router.go(-1)
        }
    },
    computed: {
        ...mapFields('clients', [
            'client.first_name',
            'client.last_name',
            'client.email',
            'client.phone',
            'client.company_name',
            'client.poc_first_name',
            'client.poc_last_name',
            'client.poc_relationship',
            'client.client_preferences',
            'client.referred_by',
            'client.payment_info',
        ]),
    },
    async fetch({ store, params }) {
        await store.dispatch('clients/fetchOneClient', params.id)
    }
}
</script>

<style>

</style>