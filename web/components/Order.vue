<template>
    <v-app>
        <span class="bg-wave"></span>
        <div class="mt-5"></div>
        <div class="mt-5"></div>
        <v-container class="mt-5">
            <v-row>
                <v-col cols="12" md="12" sm="12">
                    <div class="text-uppercase text-center display-3 font-weight-light">
                        Ordering Plans
                    </div>
                </v-col>
            </v-row>
            <v-card color="transparent" flat>
                <v-toolbar color="transparent" flat>
                    <v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-divider vertical inset></v-divider>
                        <div class="display-1 text-left font-weight-light">
                            Agent Details
                        </div>
                    </v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-alert 
                        type="info" 
                        color="#4A148C"
                        >
                        <div class="font-weight-bold">
                            Attention!
                        </div>
                        <div class="font-weight-regular">
                            Please enter Agent Information. If you are POC for the agent, you will have a chance to enter your information later. 
                            If you are a homeowner or are not working with an Agent, please enter responsible party's information.
                        </div>
                    </v-alert>
                    <v-row>
                        <v-col cols="12" md="6" sm="6">
                            <v-text-field
                                v-model="form.first_name"
                                label="Agent First Name*"
                                outlined
                                prepend-inner-icon="mdi-book-account"
                                :rules="[requiredInput('agent first name')]"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="6" sm="6">
                            <v-text-field
                                v-model="form.last_name"
                                label="Agent Last Name*"
                                outlined
                                prepend-inner-icon="mdi-book-account"
                                :rules="[requiredInput('agent last name')]"
                                >
                            </v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" md="6" sm="6">
                            <v-text-field
                                v-model="form.email"
                                label="Agent Email*"
                                outlined
                                prepend-inner-icon="mdi-email"
                                :rules="emailRules"
                                >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="6" sm="6">
                            <v-text-field
                                v-model="form.phone"
                                label="Agent Phone Number*"
                                outlined
                                prepend-inner-icon="mdi-cellphone"
                                :rules="[requiredInput('phone number')]"
                                >
                            </v-text-field>
                        </v-col>
                    </v-row>
                    <v-row v-if="!createAccount">
                        <v-col cols="12" md="6" sm="6">
                            <v-text-field
                                v-model="client_credentials.password"
                                label="Password"
                                outlined
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
                        <v-col cols="12" md="6" sm="6">
                            <v-text-field
                                v-model="passwordConfirm"
                                label="Password Confirmation"
                                outlined
                                :append-icon="showPasswordConfirm ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPasswordConfirm ? 'text' : 'password'"
                                @click:append="showPasswordConfirm = !showPasswordConfirm"
                                prepend-inner-icon="mdi-key"
                                :rules="[passwordConfirmationRule]"
                                >
                            </v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" md="12" sm="12">
                            <v-text-field
                                v-model="form.company_name"
                                label="Agent Company*"
                                outlined
                                prepend-inner-icon="mdi-office-building"
                                hint="AGENT INFORMATION OR RESPONSIBLE PARTY (do not enter assistant information here)"
                                persistent-hint
                                :rules="[requiredInput('company name')]"
                                >
                            </v-text-field>
                        </v-col>
                    </v-row>
                    
                    <v-checkbox v-model="createAccount" label="Place an order without creating an account."></v-checkbox>

                    <nuxt-link :to="{ name: 'index' }" style="text-decoration: none;">Already have an account? Sign in here.</nuxt-link>
                    
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn depressed text :disabled="checkOrderButtonDisabler">Create Order</v-btn>
                    </v-card-actions>
                </v-card-text>
            </v-card>
        </v-container>
    </v-app>
</template>

<script>
import Vuelidate from 'vuelidate'
import { required, minLength, maxLength } from 'vuelidate/lib/validators'
export default {
    data: () => ({
        showPassword: false,
        showPasswordConfirm: false,
        passwordConfirm: '',
        createAccount: false,
        form: {
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            company_name: '',
        },
        client_credentials: {
            email: '',
            password: '',
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
    computed: {
        passwordConfirmationRule() {
            return this.client_credentials.password === this.passwordConfirm || "Passwords must match";
        },
        checkOrderButtonDisabler() {
            const fn = this.form.first_name.length;
            const ln = this.form.last_name.length;
            const em = this.form.email.length;
            const ph = this.form.phone.length;
            const cn = this.form.company_name.length;

            if(fn > 0 && ln > 0 && em > 0 && ph > 0 && cn > 0) {
                return false;
            } else {
                return true;
            }
        }
    }
}
</script>

<style>

</style>