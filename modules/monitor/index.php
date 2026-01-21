<?php require_once '../../layout/head.php'; ?>

<div id="q-app">
    <div class="q-pa-md">
        <!-- Header -->
        <div class="q-mb-md">
            <h5 class="q-my-sm text-h5">Monitor de Agentes en Tiempo Real</h5>
            <p :class="$q.dark.isActive ? 'text-grey-5' : 'text-grey-7'">Monitoreo en vivo del estado de agentes por campaña</p>
        </div>

        <!-- Barra de Control Superior -->
        <q-card class="q-mb-md">
            <q-card-section>
                <div class="row q-col-gutter-md items-center">
                    <div class="col-12 col-md-4">
                        <q-input
                            v-model="searchQueue"
                            outlined
                            dense
                            placeholder="Buscar cola o campaña..."
                            clearable>
                            <template v-slot:prepend>
                                <q-icon name="search"></q-icon>
                            </template>
                        </q-input>
                    </div>
                    <div class="col-12 col-md-4">
                        <q-select
                            v-model="statusFilter"
                            :options="statusOptions"
                            outlined
                            dense
                            label="Filtrar por estado"
                            clearable
                            multiple
                            emit-value
                            map-options>
                            <template v-slot:prepend>
                                <q-icon name="filter_list"></q-icon>
                            </template>
                        </q-select>
                    </div>
                    <div class="col-12 col-md-4">
                        <q-toggle
                            v-model="soundAlerts"
                            label="Alertas sonoras"
                            color="primary"
                            left-label></q-toggle>
                        <q-badge v-if="soundAlerts" color="green" class="q-ml-sm">Activo</q-badge>
                    </div>
                </div>
            </q-card-section>
        </q-card>

        <!-- Resumen de Estados -->
        <div class="row q-col-gutter-md q-mb-md">
            <div class="col-12 col-sm-6 col-md-3">
                <q-card :class="$q.dark.isActive ? 'bg-green-9' : 'bg-green-1'">
                    <q-card-section>
                        <div class="text-h6" :class="$q.dark.isActive ? 'text-green-3' : 'text-green-8'">{{ totalIdle }}</div>
                        <div class="text-caption" :class="$q.dark.isActive ? 'text-grey-5' : 'text-grey-7'">Disponibles</div>
                    </q-card-section>
                </q-card>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <q-card :class="$q.dark.isActive ? 'bg-red-9' : 'bg-red-1'">
                    <q-card-section>
                        <div class="text-h6" :class="$q.dark.isActive ? 'text-red-3' : 'text-red-8'">{{ totalTalking }}</div>
                        <div class="text-caption" :class="$q.dark.isActive ? 'text-grey-5' : 'text-grey-7'">En Llamada</div>
                    </q-card-section>
                </q-card>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <q-card :class="$q.dark.isActive ? 'bg-orange-9' : 'bg-orange-1'">
                    <q-card-section>
                        <div class="text-h6" :class="$q.dark.isActive ? 'text-orange-3' : 'text-orange-8'">{{ totalACW }}</div>
                        <div class="text-caption" :class="$q.dark.isActive ? 'text-grey-5' : 'text-grey-7'">ACW</div>
                    </q-card-section>
                </q-card>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <q-card :class="$q.dark.isActive ? 'bg-blue-9' : 'bg-blue-1'">
                    <q-card-section>
                        <div class="text-h6" :class="$q.dark.isActive ? 'text-blue-3' : 'text-blue-8'">{{ totalAgents }}</div>
                        <div class="text-caption" :class="$q.dark.isActive ? 'text-grey-5' : 'text-grey-7'">Total Agentes</div>
                    </q-card-section>
                </q-card>
            </div>
        </div>

        <!-- Tablas por Campaña -->
        <q-card v-for="(queue, index) in filteredQueues" :key="index" class="q-mb-md">
            <q-expansion-item
                default-opened
                :header-class="$q.dark.isActive ? 'bg-grey-9 q-py-sm' : 'bg-grey-2 q-py-sm'"
                :expand-icon-class="$q.dark.isActive ? 'text-grey-5' : 'text-grey-7'">
                <!-- Header de la campaña -->
                <template v-slot:header>
                    <div class="row items-center full-width">
                        <div class="col-auto q-mr-md">
                            <q-avatar color="primary" text-color="white" size="36px">
                                {{ queue.agentCount }}
                            </q-avatar>
                        </div>
                        <div class="col">
                            <div class="text-subtitle1 text-weight-medium">
                                <q-icon name="phone_in_talk" class="q-mr-xs"></q-icon>
                                {{ queue.name }}
                            </div>
                            <div class="text-caption" :class="$q.dark.isActive ? 'text-grey-5' : 'text-grey-6'">{{ queue.description }}</div>
                        </div>
                        <div class="col-auto">
                            <q-badge color="green" class="q-mr-xs">{{ queue.idleCount }} Disp.</q-badge>
                            <q-badge color="red" class="q-mr-xs">{{ queue.talkingCount }} Llam.</q-badge>
                            <q-badge color="orange">{{ queue.acwCount }} ACW</q-badge>
                        </div>
                    </div>
                </template>

                <!-- Tabla de agentes -->
                <q-table
                    flat
                    dense
                    :rows="queue.agents"
                    :columns="columns"
                    row-key="id"
                    hide-pagination
                    :rows-per-page-options="[0]">
                    <!-- Slot para Usuario -->
                    <template v-slot:body-cell-name="props">
                        <q-td :props="props">
                            <div class="row items-center no-wrap">
                                <q-avatar size="28px" :color="$q.dark.isActive ? 'grey-8' : 'grey-4'" text-color="white" class="q-mr-sm">
                                    <q-icon name="person"></q-icon>
                                </q-avatar>
                                <div>
                                    <div class="text-weight-medium">{{ props.row.name }}</div>
                                    <div class="text-caption font-mono" :class="$q.dark.isActive ? 'text-grey-5' : 'text-grey-6'">ID: {{ props.row.id }}</div>
                                </div>
                            </div>
                        </q-td>
                    </template>

                    <!-- Slot para Estado -->
                    <template v-slot:body-cell-status="props">
                        <q-td :props="props" class="text-center">
                            <q-badge :color="getStatusColor(props.row.status)" class="q-px-sm">
                                <q-icon :name="getStatusIcon(props.row.status)" size="12px" class="q-mr-xs"></q-icon>
                                {{ getStatusLabel(props.row.status) }}
                            </q-badge>
                        </q-td>
                    </template>

                    <!-- Slot para Atendidas -->
                    <template v-slot:body-cell-callsAnswered="props">
                        <q-td :props="props" class="text-center">
                            <span class="font-mono text-weight-medium">{{ props.row.callsAnswered }}</span>
                        </q-td>
                    </template>

                    <!-- Slot para Tipo de Tarea -->
                    <template v-slot:body-cell-taskType="props">
                        <q-td :props="props">
                            <q-icon :name="getTaskIcon(props.row.taskType)" size="18px" :color="getTaskColor(props.row.taskType)" class="q-mr-xs"></q-icon>
                            {{ props.row.taskType }}
                        </q-td>
                    </template>

                    <!-- Slot para Duración -->
                    <template v-slot:body-cell-stateDuration="props">
                        <q-td :props="props" class="text-center">
                            <span class="font-mono text-weight-medium">{{ props.row.stateDuration }}</span>
                        </q-td>
                    </template>

                    <!-- Slot para Latencia -->
                    <template v-slot:body-cell-latency="props">
                        <q-td :props="props" class="text-center">
                            <q-icon name="circle" size="8px" :color="getLatencyColor(props.row.latency)" class="q-mr-xs"></q-icon>
                            <span class="font-mono">{{ props.row.latency }} ms</span>
                        </q-td>
                    </template>

                    <!-- Slot para Campaña -->
                    <template v-slot:body-cell-campaign="props">
                        <q-td :props="props">
                            <q-chip dense square color="blue-1" text-color="blue-9" size="sm">
                                {{ props.row.campaign }}
                            </q-chip>
                        </q-td>
                    </template>
                </q-table>
            </q-expansion-item>
        </q-card>

        <!-- Sin resultados -->
        <q-card v-if="filteredQueues.length === 0" class="q-pa-lg text-center">
            <q-icon name="inbox" size="64px" :color="$q.dark.isActive ? 'grey-7' : 'grey-5'"></q-icon>
            <div class="text-h6 q-mt-md" :class="$q.dark.isActive ? 'text-grey-5' : 'text-grey-6'">No se encontraron resultados</div>
            <div :class="$q.dark.isActive ? 'text-grey-6' : 'text-grey-5'">Intenta ajustar los filtros de búsqueda</div>
        </q-card>
    </div>
</div>

<?php require_once '../../layout/scripts.php'; ?>
<script src="<?php echo BASE_URL; ?>modules/monitor/monitor.js?v=<?php echo APP_VERSION; ?>"></script>

<?php require_once '../../layout/footer.php'; ?>