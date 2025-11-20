<!DOCTYPE html>
<html lang="en">

<?php include '../layout/head.php'; ?>

<body>
    <div id="q-app">
        <div class="">
            <div class="q-gutter-y-md">
                <q-tabs
                    v-model="tab"
                    inline-label
                    outside-arrows
                    mobile-arrows
                    align="left"
                    class="bg-primary text-white shadow-2">
                    <q-tab name="mails" icon="mail" label="Mails"></q-tab>
                    <q-tab name="alarms" icon="alarm" label="Alarms"></q-tab>
                    <q-tab name="movies" icon="movie" label="Movies"></q-tab>
                </q-tabs>


                <q-tab-panels v-model="tab" animated keep-alive>
                    <q-tab-panel name="mails">
                        <div class="text-h6">Mails</div>
                        Lorem ipsum 1 dolor sit amet consectetur adipisicing elit.
                    </q-tab-panel>

                    <q-tab-panel name="alarms">
                        <div class="text-h6">Alarms</div>
                        Lorem ipsum 2 dolor sit amet consectetur adipisicing elit.
                    </q-tab-panel>

                    <q-tab-panel name="movies">
                        <div class="text-h6">Movies</div>
                        Lorem ipsum 3 dolor sit amet consectetur adipisicing elit.
                    </q-tab-panel>
                </q-tab-panels>

            </div>
        </div>

    </div>

    <?php include '../layout/scripts.php'; ?>

    <script>
        const {
            createApp,
            ref
        } = Vue;

        const app = createApp({
            setup() {
                const tab = ref('mails');

                return {
                    tab,
                };
            },
        });

        app.use(Quasar);
        app.mount("#q-app");
    </script>
</body>

</html>