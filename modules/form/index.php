<!DOCTYPE html>
<html lang="en">

<?php include '../../layout/head.php'; ?>

<body>
    <div id="q-app">

        <div class="q-pa-md">

            <q-form
                @submit="onSubmit"
                class="q-gutter-md">

                <q-input
                    filled
                    v-model="name"
                    label="Your name *"
                    hint="Name and surname">
                </q-input>

                <q-input
                    filled
                    v-model="email"
                    label="Email *"
                    type="email">
                </q-input>

                <q-input
                    filled
                    type="number"
                    v-model="age"
                    label="Your age *">
                </q-input>

                <q-input
                    filled
                    v-model="phone"
                    label="Phone number"
                    mask="(###) ### - ####">
                </q-input>

                <q-input
                    filled
                    v-model="address"
                    label="Address">
                </q-input>

                <q-input
                    filled
                    v-model="bio"
                    label="Bio"
                    type="textarea"
                    rows="6">
                </q-input>

                <q-slider
                    v-model="experienceYears"
                    :min="0"
                    :max="50"
                    :step="1"
                    label
                    label-always
                    markers>
                </q-slider>
                <div class="text-caption">Years of Experience: {{experienceYears}}</div>

                <q-rating
                    v-model="skillLevel"
                    size="2em"
                    :max="5"
                    color="primary">
                </q-rating>
                <div class="text-caption">Skill Level</div>

                <q-toggle v-model="newsletter" label="Subscribe to newsletter"></q-toggle>

                <q-toggle v-model="notifications" label="Receive notifications"></q-toggle>

                <q-checkbox v-model="terms" label="I agree to terms and conditions"></q-checkbox>

                <q-checkbox v-model="privacy" label="I have read the privacy policy"></q-checkbox>

                <q-toggle v-model="accept" label="I accept the license and terms"></q-toggle>

                <q-option-group
                    v-model="preferredContact"
                    :options="contactOptions"
                    label="Preferred contact method"
                    color="primary">
                </q-option-group>

                <q-btn-toggle
                    v-model="theme"
                    :options="themeOptions"
                    color="primary">
                </q-btn-toggle>

                <div>
                    <q-btn label="Submit" type="submit" color="primary"></q-btn>
                </div>
            </q-form>

        </div>

    </div>

    <?php include '../../layout/scripts.php'; ?>

    <script>
        const {
            createApp,
            ref
        } = Vue;

        const app = createApp({

            setup() {
                initializeApp();

                const name = ref(null)
                const email = ref(null)
                const age = ref(null)
                const phone = ref(null)
                const address = ref(null)
                const website = ref(null)
                const interests = ref([])
                const bio = ref(null)
                const experienceYears = ref(0)
                const skillLevel = ref(3)
                const newsletter = ref(false)
                const notifications = ref(false)
                const terms = ref(false)
                const privacy = ref(false)
                const accept = ref(false)
                const preferredContact = ref('email')
                const theme = ref('light')

                const countryOptions = ['USA', 'Canada', 'Mexico', 'Spain', 'Argentina', 'Colombia', 'Chile', 'Peru']
                const genderOptions = ['Male', 'Female', 'Other', 'Prefer not to say']
                const occupationOptions = ['Developer', 'Designer', 'Manager', 'Student', 'Teacher', 'Engineer', 'Other']
                const interestOptions = ['Technology', 'Sports', 'Music', 'Art', 'Travel', 'Reading', 'Gaming', 'Cooking']
                const contactOptions = [{
                        label: 'Email',
                        value: 'email'
                    },
                    {
                        label: 'Phone',
                        value: 'phone'
                    },
                    {
                        label: 'SMS',
                        value: 'sms'
                    }
                ]
                const themeOptions = [{
                        label: 'Light',
                        value: 'light'
                    },
                    {
                        label: 'Dark',
                        value: 'dark'
                    },
                    {
                        label: 'Auto',
                        value: 'auto'
                    }
                ]

                return {
                    name,
                    email,
                    age,
                    phone,
                    address,
                    website,
                    interests,
                    bio,
                    experienceYears,
                    skillLevel,
                    newsletter,
                    notifications,
                    terms,
                    privacy,
                    accept,
                    preferredContact,
                    theme,
                    countryOptions,
                    genderOptions,
                    occupationOptions,
                    interestOptions,
                    contactOptions,
                    themeOptions,

                    onSubmit() {
                        if (accept.value !== true) {
                            window.parentQuasar.Notify.create({
                                color: 'red-5',
                                textColor: 'white',
                                icon: 'warning',
                                message: 'You need to accept the license and terms first'
                            })
                        } else {
                            window.parentQuasar.Notify.create({
                                color: 'green-4',
                                textColor: 'white',
                                icon: 'cloud_done',
                                message: 'Submitted'
                            })
                        }
                    },
                }
            }
        });

        app.use(Quasar);
        app.mount("#q-app");
    </script>
</body>

</html>