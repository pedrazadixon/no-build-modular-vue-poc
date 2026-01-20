 <?php /* libs */ ?>
 <script src="https://cdn.jsdelivr.net/npm/vue@3.5.24/dist/vue.global.prod.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/quasar@2.18.6/dist/quasar.umd.prod.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/mobx@6.15.0/dist/mobx.umd.production.min.js"></script>

 <?php /* cross-window dependency sharing */ ?>
 <script src="<?php echo BASE_URL; ?>assets/js/crossWindowBridge.js?v=<?php echo APP_VERSION; ?>"></script>

 <?php /* stores */ ?>
 <script src="<?php echo BASE_URL; ?>assets/js/stores/AppStore.js?v=<?php echo APP_VERSION; ?>"></script>
 <script src="<?php echo BASE_URL; ?>assets/js/stores/CounterStore.js?v=<?php echo APP_VERSION; ?>"></script>
 <script src="<?php echo BASE_URL; ?>assets/js/stores/TabsStore.js?v=<?php echo APP_VERSION; ?>"></script>

 <?php /* helpers */ ?>
 <script src="<?php echo BASE_URL; ?>assets/js/useMobxStore.js?v=<?php echo APP_VERSION; ?>"></script>
 <script src="<?php echo BASE_URL; ?>assets/js/DarkModeSync.js?v=<?php echo APP_VERSION; ?>"></script>