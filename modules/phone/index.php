<!DOCTYPE html>
<html lang="en">

<?php include '../../layout/head.php'; ?>

<body>
    <div id="q-app">


        <div style="display: flex; justify-content: space-between; align-items: center;" class="q-px-md q-py-sm">
            <div class="text-h6">Telephony</div>
            <div>
                <q-btn round flat icon="keyboard_double_arrow_right" @click="toggleRightDrawer">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                        <path d="M300-640v320l160-160-160-160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm440-80h120v-560H640v560Zm-80 0v-560H200v560h360Zm80 0h120-120Z" />
                    </svg> -->
                </q-btn>



            </div>
        </div>

        <div class="phone-container">

            <div class="full-width q-my-md">
                <q-input filled placeholder="Enter phone number" v-model="phoneNumber"></q-input>
            </div>

            <div class="phone-buttons">
                <q-btn round outline color="primary" size="lg" label="1" @click="phoneNumber += '1'"></q-btn>
                <q-btn round outline color="primary" size="lg" label="2" @click="phoneNumber += '2'"></q-btn>
                <q-btn round outline color="primary" size="lg" label="3" @click="phoneNumber += '3'"></q-btn>
                <q-btn round outline color="primary" size="lg" label="4" @click="phoneNumber += '4'"></q-btn>
                <q-btn round outline color="primary" size="lg" label="5" @click="phoneNumber += '5'"></q-btn>
                <q-btn round outline color="primary" size="lg" label="6" @click="phoneNumber += '6'"></q-btn>
                <q-btn round outline color="primary" size="lg" label="7" @click="phoneNumber += '7'"></q-btn>
                <q-btn round outline color="primary" size="lg" label="8" @click="phoneNumber += '8'"></q-btn>
                <q-btn round outline color="primary" size="lg" label="9" @click="phoneNumber += '9'"></q-btn>
                <q-btn round outline color="primary" size="lg" label="*" @click="phoneNumber += '*'"></q-btn>
                <q-btn round outline color="primary" size="lg" label="0" @click="phoneNumber += '0'"></q-btn>
                <q-btn round outline color="primary" size="lg" label="#" @click="phoneNumber += '#'"></q-btn>
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

                const {
                    rightDrawerOpen,
                    toggleRightDrawer
                } = useMobxStore(
                    window.globalStore.appStore,
                    ['rightDrawerOpen', 'toggleRightDrawer']
                );

                const phoneNumber = ref('');
                return {
                    phoneNumber,
                    toggleRightDrawer,
                };
            },
        });

        app.use(Quasar);
        app.mount("#q-app");
    </script>
</body>

</html>