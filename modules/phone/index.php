<!DOCTYPE html>
<html lang="en">

<?php include '../../layout/head.php'; ?>

<body>
    <div id="q-app">

        <div class="phone-container">

            <div class="full-width q-my-md">
                <q-input filled placeholder="Enter phone number"></q-input>
            </div>

            <div class="phone-buttons">
                <q-btn round outline color="primary" size="lg" label="1"></q-btn>
                <q-btn round outline color="primary" size="lg" label="2"></q-btn>
                <q-btn round outline color="primary" size="lg" label="3"></q-btn>
                <q-btn round outline color="primary" size="lg" label="4"></q-btn>
                <q-btn round outline color="primary" size="lg" label="5"></q-btn>
                <q-btn round outline color="primary" size="lg" label="6"></q-btn>
                <q-btn round outline color="primary" size="lg" label="7"></q-btn>
                <q-btn round outline color="primary" size="lg" label="8"></q-btn>
                <q-btn round outline color="primary" size="lg" label="9"></q-btn>
                <q-btn round outline color="primary" size="lg" label="*"></q-btn>
                <q-btn round outline color="primary" size="lg" label="0"></q-btn>
                <q-btn round outline color="primary" size="lg" label="#"></q-btn>
                <q-btn flat round outline color="primary" icon="history"></q-btn>
                <q-btn round color="primary" size="lg" icon="phone"></q-btn>
                <q-btn flat round outline color="primary" icon="menu"></q-btn>
            </div>

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

                // Your module logic will go here

                return {
                    // Your module data will go here
                };
            },
        });

        app.use(Quasar);
        app.mount("#q-app");
    </script>
</body>

</html>