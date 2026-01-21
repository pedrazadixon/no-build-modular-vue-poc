<?php require_once '../../layout/head.php'; ?>

<div id="q-app">
    <div class="q-pa-md">
        <!-- Sección de Filtros -->
        <q-card class="q-mb-md">
            <q-card-section>
                <div class="text-h6 q-mb-md">
                    <q-icon name="filter_alt" class="q-mr-sm"></q-icon>
                    Filtros
                </div>
                <div class="row q-col-gutter-md">
                    <div class="col-12 col-md-4">
                        <q-input
                            filled
                            v-model="filters.fechaInicial"
                            label="Fecha Inicial"
                            mask="date"
                            :rules="['date']"
                            dense>
                            <template v-slot:prepend>
                                <q-icon name="event" class="cursor-pointer"></q-icon>
                            </template>
                            <q-popup-proxy transition-show="scale" transition-hide="scale">
                                <q-date minimal v-model="filters.fechaInicial">
                                    <div class="row items-center justify-end">
                                        <q-btn v-close-popup label="Cerrar" color="primary" flat></q-btn>
                                    </div>
                                </q-date>
                            </q-popup-proxy>
                        </q-input>
                    </div>
                    <div class="col-12 col-md-4">
                        <q-input
                            filled
                            v-model="filters.fechaFinal"
                            label="Fecha Final"
                            mask="date"
                            :rules="['date']"
                            dense>
                            <template v-slot:prepend>
                                <q-icon name="event" class="cursor-pointer"></q-icon>
                            </template>
                            <q-popup-proxy transition-show="scale" transition-hide="scale">
                                <q-date minimal v-model="filters.fechaFinal">
                                    <div class="row items-center justify-end">
                                        <q-btn v-close-popup label="Cerrar" color="primary" flat></q-btn>
                                    </div>
                                </q-date>
                            </q-popup-proxy>
                        </q-input>
                    </div>
                    <div class="col-12 col-md-4">
                        <q-select
                            filled
                            v-model="filters.asesor"
                            :options="asesoresOptions"
                            label="Asesor"
                            emit-value
                            map-options
                            clearable
                            dense>
                            <template v-slot:prepend>
                                <q-icon name="person"></q-icon>
                            </template>
                        </q-select>
                    </div>
                </div>
                <div class="row q-mt-md justify-end q-gutter-sm">
                    <q-btn
                        flat
                        label="Limpiar"
                        color="grey-7"
                        icon="clear"
                        @click="clearFilters">
                    </q-btn>
                    <q-btn
                        unelevated
                        label="Buscar"
                        color="primary"
                        icon="search"
                        @click="searchAgendas">
                    </q-btn>
                </div>
            </q-card-section>
        </q-card>

        <!-- Tabla de Agendas -->
        <q-card>
            <q-card-section>
                <div class="text-h6 q-mb-md">
                    <q-icon name="calendar_month" class="q-mr-sm"></q-icon>
                    Agendas de Asesores
                    <q-badge color="primary" class="q-ml-sm">{{ agendas.length }} registros</q-badge>
                </div>

                <q-table
                    flat
                    bordered
                    :rows="agendas"
                    :columns="columns"
                    row-key="id"
                    :pagination="pagination"
                    @row-contextmenu="onRightClick">

                    <template v-slot:body="props">
                        <q-tr :props="props" @contextmenu.prevent="onRightClick($event, props.row)" class="cursor-pointer">
                            <q-td key="fechaAgenda" :props="props">
                                <q-icon name="event" color="primary" class="q-mr-xs"></q-icon>
                                {{ props.row.fechaAgenda }}
                            </q-td>
                            <q-td key="horaAgenda" :props="props">
                                <q-icon name="schedule" color="orange" class="q-mr-xs"></q-icon>
                                {{ props.row.horaAgenda }}
                            </q-td>
                            <q-td key="asesor" :props="props">
                                <q-chip
                                    :color="getAsesorColor(props.row.asesor)"
                                    text-color="white"
                                    size="sm"
                                    icon="person">
                                    {{ props.row.asesor }}
                                </q-chip>
                            </q-td>
                            <q-td key="estado" :props="props">
                                <q-badge :color="getEstadoColor(props.row.estado)">
                                    {{ props.row.estado }}
                                </q-badge>
                            </q-td>
                        </q-tr>
                    </template>

                    <template v-slot:no-data>
                        <div class="full-width row flex-center text-grey-6 q-pa-lg">
                            <q-icon name="event_busy" size="2em" class="q-mr-sm"></q-icon>
                            No se encontraron agendas
                        </div>
                    </template>
                </q-table>
            </q-card-section>
        </q-card>

        <!-- Menú Contextual -->
        <q-menu
            v-model="showContextMenu"
            :target="contextMenuTarget"
            context-menu
            auto-close>
            <q-list style="min-width: 180px">
                <q-item clickable v-close-popup @click="openAgenda">
                    <q-item-section avatar>
                        <q-icon name="open_in_new" color="primary"></q-icon>
                    </q-item-section>
                    <q-item-section>Abrir Agenda</q-item-section>
                </q-item>

                <q-item clickable v-close-popup @click="closeAgenda">
                    <q-item-section avatar>
                        <q-icon name="event_busy" color="negative"></q-icon>
                    </q-item-section>
                    <q-item-section>Cerrar Agenda</q-item-section>
                </q-item>

                <q-separator></q-separator>

                <q-item clickable v-close-popup @click="callNow">
                    <q-item-section avatar>
                        <q-icon name="phone" color="positive"></q-icon>
                    </q-item-section>
                    <q-item-section>Llamar Ahora</q-item-section>
                    <q-item-section side>
                        <q-icon name="keyboard_arrow_right"></q-icon>
                    </q-item-section>
                </q-item>
            </q-list>
        </q-menu>
    </div>
</div>

<?php require_once '../../layout/scripts.php'; ?>
<script src="<?php echo BASE_URL; ?>modules/agendas/agendas.js?v=<?php echo APP_VERSION; ?>"></script>

<?php require_once '../../layout/footer.php'; ?>