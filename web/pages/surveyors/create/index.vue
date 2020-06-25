<template>
    <v-container>
        <div>
            <v-btn :to="{ name: 'surveyors' }" color="transparent" depressed fab small>
                <v-icon>mdi-arrow-left</v-icon>
            </v-btn>
        </div>
        <v-card color="transparent" flat>
            <v-card-title class="font-weight-light">New Surveyor</v-card-title>
            <v-card-text>
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
                        <v-select
                            v-model="form.surveyor_timezone"
                            label="Timezone*"
                            :items="timezones"
                            outlined
                            dense
                            prepend-inner-icon="mdi-clock"
                            :rules="[requiredInput('timezone')]"
                            >
                        </v-select>
                    </v-col>
                    <v-col cols="12" md="3" sm="3">
                        <v-select
                            v-model="form.surveyor_location"
                            label="Location*"
                            :items="locations"
                            outlined
                            dense
                            prepend-inner-icon="mdi-map-marker"
                            :rules="[requiredInput('location')]"
                            >
                        </v-select>
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
                            v-model="form.surveyor_color_code"
                            label="Surveyor Color Code*"
                            type="color"
                            outlined
                            dense
                            persistent-hint
                            hint="Click here to select color code"
                            @click="showColorPicker = !showColorPicker"
                            :rules="[requiredInput('color code')]"
                            >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" md="6" sm="6">
                        <v-text-field
                            v-model="form.surveyor_address"
                            label="Address*"
                            outlined
                            dense
                            prepend-inner-icon="mdi-home-account"
                            :rules="[requiredInput('address')]"
                            >
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="3" sm="3">
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
                    <v-col cols="12" md="3" sm="3">
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
                    <v-col cols="12" md="3" sm="3">
                        <v-select
                            v-model="form.surveyor_state"
                            label="State*"
                            :items="states"
                            outlined
                            dense
                            prepend-inner-icon="mdi-map"
                            :rules="[requiredInput('state')]"
                            >
                        </v-select>
                    </v-col>
                    <v-col cols="12" md="3" sm="3">
                        <v-text-field
                            v-model="form.surveyor_city"
                            label="City*"
                            outlined
                            dense
                            prepend-inner-icon="mdi-office-building"
                            :rules="[requiredInput('city')]"
                            >
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <v-textarea
                            v-model="form.surveyor_schedule_notes"
                            label="Surveyor Notes"
                            outlined
                            dense
                            prepend-inner-icon="mdi-note-text"
                            >
                        </v-textarea>
                    </v-col>
                    <v-col cols="12" md="3" sm="3">
                        <v-text-field
                            v-model="form.surveyor_zip_code"
                            label="Zip Code*"
                            outlined
                            dense
                            prepend-inner-icon="mdi-map-legend"
                            :rules="[requiredInput('zip code')]"
                            >
                        </v-text-field>
                    </v-col>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn depressed text :disabled="checkOrderButtonDisabler">Add New Surveyor</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
import Vuelidate from 'vuelidate'
import { required, minLength, maxLength } from 'vuelidate/lib/validators'
export default {
    data: () => ({
        showPassword: false,
        showPasswordConfirm: false,
        passwordConfirm: '',
        showColorPicker: false,
        form: {
            first_name: '',
            last_name: '',
            email: '',
            role: 'Building Surveyor',
            password: '',
            surveyor_timezone: '',
            surveyor_location: '',
            surveyor_address: '',
            surveyor_state: '',
            surveyor_city: '',
            surveyor_zip_code: '',
            surveyor_schedule_notes: '',
            surveyor_color_code: '',
        },
        timezones: [
            'America/Adak',
            'America/Anchorage',
            'America/Anguilla',
            'America/Antigua',
            'America/Araguaina',
            'America/Argentina/Buenos_Aires',
            'America/Argentina/Catamarca',
            'America/Argentina/Cordoba',
            'America/Argentina/Jujuy', 
            'America/Argentina/La_Rioja',
            'America/Argentina/Mendoza',
            'America/Argentina/Rio_Gallegos', 
            'America/Argentina/Salta',
            'America/Argentina/San_Juan',
            'America/Argentina/San_Luis',
            'America/Argentina/Tucuman',
            'America/Argentina/Ushuaia',
            'America/Aruba',
            'America/Asuncion',
            'America/Atikokan',
            'America/Bahia',
            'America/Bahia_Banderas',
            'America/Barbados',
            'America/Belem',
            'America/Belize',
            'America/Blanc-Sablon',
            'America/Boa_Vista',
            'America/Bogota',
            'America/Boise',
            'America/Cambridge_Bay',
            'America/Campo_Grande',
            'America/Cancun',
            'America/Caracas',
            'America/Cayenne',
            'America/Cayman',
            'America/Chicago',
            'America/Chihuahua',
            'America/Costa_Rica',
            'America/Creston',
            'America/Cuiaba',
            'America/Curacao',
            'America/Danmarkshavn',
            'America/Dawson',
            'America/Dawson_Creek',
            'America/Denver',
            'America/Detroit',
            'America/Dominica',
            'America/Edmonton',
            'America/Eirunepe',
            'America/El_Salvador',
            'America/Fort_Nelson',
            'America/Fortaleza',
            'America/Glace_Bay',
            'America/Goose_Bay',
            'America/Grand_Turk',
            'America/Grenada',
            'America/Guadeloupe',
            'America/Guatemala',
            'America/Guayaquil',
            'America/Guyana',
            'America/Halifax',
            'America/Havana',
            'America/Hermosillo',
            'America/Indiana/Indianapolis',
            'America/Indiana/Knox',
            'America/Indiana/Marengo',
            'America/Indiana/Petersburg',
            'America/Indiana/Tell_City',
            'America/Indiana/Vevay',
            'America/Indiana/Vincennes',
            'America/Indiana/Winamac',
            'America/Inuvik',
            'America/Iqaluit',
            'America/Jamaica',
            'America/Juneau',
            'America/Kentucky/Louisville',
            'America/Kentucky/Monticello',
            'America/Kralendijk',
            'America/La_Paz',
            'America/Lima',
            'America/Los_Angeles',
            'America/Lower_Princes',
            'America/Maceio',
            'America/Managua',
            'America/Manaus',
            'America/Marigot',
            'America/Martinique',
            'America/Matamoros',
            'America/Mazatlan',
            'America/Menominee',
            'America/Merida',
            'America/Metlakatla',
            'America/Mexico_City',
            'America/Miquelon',
            'America/Moncton',
            'America/Monterrey',
            'America/Montevideo',
            'America/Montserrat',
            'America/Nassau',
            'America/New_York',
            'America/Nipigon',
            'America/Nome',
            'America/Noronha',
            'America/North_Dakota/Beulah',
            'America/North_Dakota/Center',
            'America/North_Dakota/New_Salem',
            'America/Nuuk',
            'America/Ojinaga',
            'America/Panama',
            'America/Pangnirtung',
            'America/Paramaribo',
            'America/Phoenix',
            'America/Port-au-Prince',
            'America/Port_of_Spain',
            'America/Porto_Velho',
            'America/Puerto_Rico',
            'America/Punta_Arenas',
            'America/Rainy_River',
            'America/Rankin_Inlet',
            'America/Recife',
            'America/Regina',
            'America/Resolute',
            'America/Rio_Branco',
            'America/Santarem',
            'America/Santiago',
            'America/Santo_Domingo',
            'America/Sao_Paulo',
            'America/Scoresbysund',
            'America/Sitka',
            'America/St_Barthelemy',
            'America/St_Johns',
            'America/St_Kitts',
            'America/St_Lucia',
            'America/St_Thomas',
            'America/St_Vincent',
            'America/Swift_Current',
            'America/Tegucigalpa',
            'America/Thule',
            'America/Thunder_Bay',
            'America/Tijuana',
            'America/Toronto',
            'America/Tortola',
            'America/Vancouver',
            'America/Whitehorse',
            'America/Winnipeg',
            'America/Yakutat',
            'America/Yellowknife',
        ],
        locations: [
            'West Coast',
            'San Francisco',
            'Los Angeles',
            'San Diego',
            'California',
            'Charleston',
            'Chicago',
            'Dallas',
            'Houston',
            'Seattle',
            'Miami',
            'New Jersey',
            'New York City',
            'Philadelphia',
            'Phoenix',
        ],
        states: [
            'Alabama',
            'Alaska',
            'Arizona',
            'Arkansas',
            'California',
            'Colorado',
            'Connecticut',
            'Delaware',
            'Florida',
            'Georgia',
            'Hawaii',
            'Idaho',
            'Illinois',
            'Indiana',
            'Iowa',
            'Kansas',
            'Kentucky',
            'Louisiana',
            'Maine',
            'Maryland',
            'Massachusetts',
            'Michigan',
            'Minnesota',
            'Mississippi',
            'Missouri',
            'Montana',
            'Nebraska',
            'Nevada',
            'New Hampshire',
            'New Jersey',
            'New Mexico',
            'New York',
            'North Carolina',
            'North Dakota',
            'Ohio',
            'Oklahoma',
            'Oregon',
            'Pennsylvania',
            'Rhode Island',
            'South Carolina',
            'South Dakota',
            'Tennessee',
            'Texas',
            'Utah',
            'Vermont',
            'Virginia',
            'Washington',
            'West Virginia',
            'Wisconsin',
            'Wyoming',
        ],
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
        
    },
    computed: {
        passwordConfirmationRule() {
            return this.form.password === this.passwordConfirm || "Passwords must match";
        },
        checkOrderButtonDisabler() {
            const fn = this.form.first_name.length;
            const ln = this.form.last_name.length;
            const em = this.form.email.length;
            const tz = this.form.surveyor_timezone.length;
            const lc = this.form.surveyor_location.length;
            const ad = this.form.surveyor_address.length;
            const st = this.form.surveyor_state.length;
            const ct = this.form.surveyor_city.length;
            const zc = this.form.surveyor_zip_code.length;
            const cc = this.form.surveyor_color_code.length;

            if(fn > 0 && ln > 0 && em > 0 && tz > 0 && lc > 0 && ad > 0 && st > 0 && ct > 0 && zc > 0 && cc > 0) {
                return false;
            } else {
                return true;
            }
        }
    },
}
</script>

<style>

</style>