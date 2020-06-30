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
                <v-switch v-model="form.createAccount" label="Place an order without creating an account."></v-switch>
                <v-form ref="form">
                    <v-row>
                        <v-col cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="form.first_name"
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
                                v-model="form.last_name"
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
                                v-model="form.poc_first_name"
                                label="POC First Name"
                                outlined
                                dense
                                prepend-inner-icon="mdi-book-account-outline"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="form.poc_last_name"
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
                                v-model="form.email"
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
                                v-model="form.phone"
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
                                v-model="form.poc_relationship"
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
                                v-model="form.company_name"
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
                                v-model="form.payment_info"
                                label="Payment Method"
                                outlined
                                dense
                                prepend-inner-icon="mdi-cash-plus"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="form.referred_by"
                                label="Referred By"
                                outlined
                                dense
                                prepend-inner-icon="mdi-account-multiple-check"
                                >
                            </v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col v-if="form.createAccount" cols="12" md="6" sm="6"></v-col>
                        <v-col v-if="!form.createAccount" cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="form.password"
                                label="Password"
                                outlined
                                dense
                                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPassword ? 'text' : 'password'"
                                @click:append="showPassword = !showPassword"
                                prepend-inner-icon="mdi-key"
                                hint="Create a password to access your order."
                                persistent-hint
                                :rules="passwordRules"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col v-if="!form.createAccount" cols="12" md="3" sm="3">
                            <v-text-field
                                v-model="passwordConfirm"
                                label="Password Confirmation"
                                outlined
                                dense
                                :append-icon="showPasswordConfirm ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPasswordConfirm ? 'text' : 'password'"
                                @click:append="showPasswordConfirm = !showPasswordConfirm"
                                prepend-inner-icon="mdi-key"
                                :rules="[passwordConfirmationRule]"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="6" sm="6">
                            <v-textarea
                                v-model="form.client_preferences"
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
                <!-- <v-btn @click="printCreateAccount()">Print</v-btn> -->
                <v-btn @click="submit()" depressed text :disabled="checkOrderButtonDisabler">Add New Client</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
import { mapActions } from 'vuex'
import Vuelidate from 'vuelidate'
import { required, minLength, maxLength } from 'vuelidate/lib/validators'
export default {
    data: () => ({
        showPassword: false,
        showPasswordConfirm: false,
        passwordConfirm: '',
        form: {
            first_name: '',
            last_name: '',
            email: '',
            createAccount: false,
            password: '',   
            company_name: '',
            phone: '',
            role: 'Client',
            poc_first_name: '',
            poc_last_name: '',
            poc_relationship: '',
            client_preferences: '',
            referred_by: '',
            payment_info: '',
        },
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
        submit() {
            if(this.$refs.form.validate()) {
                this.$store.dispatch('clients/addClient', this.form)
                this.$router.push('/users/clients')
            }
        },
        backTo() {
            this.$router.push('/user/clients')
        }
        // printCreateAccount() {
        //     console.log(this.form.createAccount)
        // }
    },
    computed: {
        passwordConfirmationRule() {
            return this.form.password === this.passwordConfirm || "Passwords must match";
        },
        checkOrderButtonDisabler() {
            const fn = this.form.first_name.length;
            const ln = this.form.last_name.length;
            const em = this.form.email.length;
            const ph = this.form.phone.length;
            const cn = this.form.company_name.length;
            const pw = this.form.password.length;
            const pwc = this.passwordConfirm.length

            if(this.form.createAccount == false) {
                if(fn > 0 && ln > 0 && em > 0 && ph > 0 && cn > 0 &&  pw > 0 && pwc > 0) {
                    return false;
                } else {
                    return true
                }
            } else if(this.form.createAccount == true){
                if(fn > 0 && ln > 0 && em > 0 && ph > 0 && cn > 0) {
                    return false;
                } else {
                    return true;
                }
            }
        },
    }
}
</script>

<style>

</style>