<!DOCTYPE html>
<html lang="en">

<?php include '../../layout/head.php'; ?>

<body>
    <div id="q-app">
        <!-- Your module content will go here -->
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