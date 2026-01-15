<?php require_once '../../layout/head.php'; ?>

<div id="q-app">
    <div class="q-pa-md">
        <div class="q-gutter-md">
            <q-btn label="Confirm" color="primary" @click="confirm"></q-btn>
        </div>
    </div>
</div>

<?php require_once '../../layout/scripts.php'; ?>

<script>
    const {
        createApp,
        ref
    } = Vue;

    const app = createApp({
        setup() {
            const confirm = () => {
                parentQuasar.Dialog.create({
                    title: 'Confirm',
                    message: 'Would you like to turn on the wifi?',
                    cancel: true,
                    persistent: false,
                }).onOk(() => {
                    console.log('>>>> OK')
                }).onOk(() => {
                    console.log('>>>> second OK catcher')
                }).onCancel(() => {
                    console.log('>>>> Cancel')
                }).onDismiss(() => {
                    console.log('I am triggered on both OK and Cancel')
                })
            };

            return {
                confirm
            };
        },
    });

    app.use(Quasar).use(DarkModeSync);
    app.mount("#q-app");
</script>

<?php require_once '../../layout/footer.php'; ?>