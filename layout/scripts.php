<!-- libs -->
<script src="https://cdn.jsdelivr.net/npm/vue@3.5.24/dist/vue.global.prod.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quasar@2.18.6/dist/quasar.umd.prod.js"></script>
<script src="https://cdn.jsdelivr.net/npm/mobx@6.15.0/dist/mobx.umd.production.min.js"></script>

<!-- cross-window dependency sharing -->
<script src="<?php echo BASE_URL; ?>assets/js/crossWindowBridge.js?<?php echo time(); ?>"></script>

<!-- stores -->
<script src="<?php echo BASE_URL; ?>assets/js/stores/AppStore.js?<?php echo time(); ?>"></script>
<script src="<?php echo BASE_URL; ?>assets/js/stores/CounterStore.js?<?php echo time(); ?>"></script>
<script src="<?php echo BASE_URL; ?>assets/js/stores/TabsStore.js?<?php echo time(); ?>"></script>

<!-- helpers -->
<script src="<?php echo BASE_URL; ?>assets/js/useMobxStore.js?<?php echo time(); ?>"></script>
<script src="<?php echo BASE_URL; ?>assets/js/initialize.js?<?php echo time(); ?>"></script>