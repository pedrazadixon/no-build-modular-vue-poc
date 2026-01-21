const { createApp, ref, reactive } = Vue;

const app = createApp({
  setup() {
    // Filtros
    const filters = reactive({
      fechaInicial: "2026/01/01",
      fechaFinal: "2026/02/16",
      asesor: null,
    });

    // Opciones de asesores para el select
    const asesoresOptions = [
      { label: "Carlos Rodríguez", value: "Carlos Rodríguez" },
      { label: "María García", value: "María García" },
      { label: "Juan Pérez", value: "Juan Pérez" },
      { label: "Ana Martínez", value: "Ana Martínez" },
      { label: "Luis Sánchez", value: "Luis Sánchez" },
    ];

    // Columnas de la tabla
    const columns = [
      {
        name: "fechaAgenda",
        required: true,
        label: "Fecha Agenda",
        align: "left",
        field: "fechaAgenda",
        sortable: true,
      },
      {
        name: "horaAgenda",
        required: true,
        label: "Hora Agenda",
        align: "left",
        field: "horaAgenda",
        sortable: true,
      },
      {
        name: "asesor",
        required: true,
        label: "Asesor",
        align: "left",
        field: "asesor",
        sortable: true,
      },
      {
        name: "estado",
        label: "Estado",
        align: "center",
        field: "estado",
        sortable: true,
      },
    ];

    // Datos mock de agendas
    const agendas = ref([
      {
        id: 1,
        fechaAgenda: "2026-01-21",
        horaAgenda: "09:00",
        asesor: "Carlos Rodríguez",
        estado: "Pendiente",
      },
      {
        id: 2,
        fechaAgenda: "2026-01-21",
        horaAgenda: "10:30",
        asesor: "María García",
        estado: "Confirmada",
      },
      {
        id: 3,
        fechaAgenda: "2026-01-21",
        horaAgenda: "11:00",
        asesor: "Juan Pérez",
        estado: "En progreso",
      },
      {
        id: 4,
        fechaAgenda: "2026-01-22",
        horaAgenda: "08:30",
        asesor: "Ana Martínez",
        estado: "Pendiente",
      },
      {
        id: 5,
        fechaAgenda: "2026-01-22",
        horaAgenda: "14:00",
        asesor: "Luis Sánchez",
        estado: "Confirmada",
      },
      {
        id: 6,
        fechaAgenda: "2026-01-22",
        horaAgenda: "15:30",
        asesor: "Carlos Rodríguez",
        estado: "Cancelada",
      },
      {
        id: 7,
        fechaAgenda: "2026-01-23",
        horaAgenda: "09:00",
        asesor: "María García",
        estado: "Pendiente",
      },
      {
        id: 8,
        fechaAgenda: "2026-01-23",
        horaAgenda: "11:30",
        asesor: "Juan Pérez",
        estado: "Confirmada",
      },
    ]);

    // Paginación
    const pagination = ref({
      sortBy: "fechaAgenda",
      descending: false,
      page: 1,
      rowsPerPage: 10,
    });

    // Menú contextual
    const showContextMenu = ref(false);
    const contextMenuTarget = ref(null);
    const selectedRow = ref(null);

    // Colores para asesores
    const asesorColors = {
      "Carlos Rodríguez": "blue",
      "María García": "purple",
      "Juan Pérez": "teal",
      "Ana Martínez": "pink",
      "Luis Sánchez": "indigo",
    };

    const getAsesorColor = (asesor) => {
      return asesorColors[asesor] || "grey";
    };

    // Colores para estados
    const getEstadoColor = (estado) => {
      const colors = {
        Pendiente: "warning",
        Confirmada: "positive",
        "En progreso": "info",
        Cancelada: "negative",
      };
      return colors[estado] || "grey";
    };

    // Métodos de filtros
    const clearFilters = () => {
      filters.fechaInicial = "";
      filters.fechaFinal = "";
      filters.asesor = null;

      Quasar.Notify.create({
        message: "Filtros limpiados",
        color: "info",
        icon: "clear",
        position: "top",
        timeout: 1500,
      });
    };

    const searchAgendas = () => {
      // Simulación de búsqueda (mockup)
      Quasar.Notify.create({
        message: "Buscando agendas...",
        color: "primary",
        icon: "search",
        position: "top",
        timeout: 1500,
      });
    };

    // Menú contextual
    const onRightClick = (event, row) => {
      event.preventDefault();
      selectedRow.value = row;
      contextMenuTarget.value = event.target;
      showContextMenu.value = true;
    };

    const openAgenda = () => {
      if (selectedRow.value) {
        Quasar.Notify.create({
          message: `Abriendo agenda de ${selectedRow.value.asesor}`,
          color: "primary",
          icon: "open_in_new",
          position: "top-right",
          timeout: 2000,
        });
      }
    };

    const closeAgenda = () => {
      if (selectedRow.value) {
        Quasar.Notify.create({
          message: `Cerrando agenda del ${selectedRow.value.fechaAgenda}`,
          color: "negative",
          icon: "event_busy",
          position: "top-right",
          timeout: 2000,
        });
      }
    };

    const callNow = () => {
      if (selectedRow.value) {
        Quasar.Notify.create({
          message: `Iniciando llamada a ${selectedRow.value.asesor}...`,
          color: "positive",
          icon: "phone",
          position: "top-right",
          timeout: 2000,
        });
      }
    };

    return {
      // Filtros
      filters,
      asesoresOptions,
      clearFilters,
      searchAgendas,

      // Tabla
      columns,
      agendas,
      pagination,
      getAsesorColor,
      getEstadoColor,

      // Menú contextual
      showContextMenu,
      contextMenuTarget,
      onRightClick,
      openAgenda,
      closeAgenda,
      callNow,
    };
  },
});

app.use(Quasar).use(DarkModeSync);
app.mount("#q-app");
