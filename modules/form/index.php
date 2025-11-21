<!DOCTYPE html>
<html lang="en">

<?php include '../../layout/head.php'; ?>

<body>
    <div id="q-app">

        <div class="q-pa-md">

            <q-form
                @submit="onSubmit"
                @reset="onReset"
                class="q-gutter-md">
                <q-input
                    filled
                    v-model="name"
                    label="Your name *"
                    hint="Name and surname"
                    lazy-rules
                    :rules="[ val => val && val.length > 0 || 'Please type something']"></q-input>

                <q-input
                    filled
                    type="number"
                    v-model="age"
                    label="Your age *"
                    lazy-rules
                    :rules="[
                        val => val !== null && val !== '' || 'Please type your age',
                        val => val > 0 && val < 100 || 'Please type a real age'
                        ]">
                </q-input>

                <q-toggle v-model="accept" label="I accept the license and terms"></q-toggle>

                <div>
                    <q-btn label="Submit" type="submit" color="primary"></q-btn>
                    <q-btn label="Reset" type="reset" color="primary" flat class="q-ml-sm"></q-btn>
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

                const name = ref(null)
                const age = ref(null)
                const accept = ref(false)

                return {
                    name,
                    age,
                    accept,

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

                    onReset() {
                        name.value = null
                        age.value = null
                        accept.value = false
                    }
                }
            }
        });

        app.use(Quasar);
        app.mount("#q-app");
    </script>
</body>

</html>