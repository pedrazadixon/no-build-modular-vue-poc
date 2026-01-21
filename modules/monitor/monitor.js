const { createApp } = Vue;

const app = createApp({
  data() {
    return {
      searchQueue: "",
      statusFilter: [],
      soundAlerts: false,
      statusOptions: [
        { label: "Disponible", value: "idle" },
        { label: "En Llamada", value: "talking" },
        { label: "ACW", value: "acw" },
        { label: "Llamada Entrante", value: "talking_in" },
      ],
      columns: [
        { name: "name", label: "Usuario", field: "name", align: "left" },
        { name: "status", label: "Estado", field: "status", align: "center" },
        { name: "callsAnswered", label: "Atendidas", field: "callsAnswered", align: "center" },
        { name: "taskType", label: "Tipo de Tarea", field: "taskType", align: "left" },
        { name: "stateDuration", label: "Duración", field: "stateDuration", align: "center" },
        { name: "latency", label: "Latencia", field: "latency", align: "center" },
        { name: "campaign", label: "Campaña", field: "campaign", align: "left" },
      ],
      queues: [
        {
          id: 1,
          name: "(17) TEL - CALLME INBOUND",
          description: "Cola de llamadas entrantes",
          agentCount: 17,
          idleCount: 8,
          talkingCount: 6,
          acwCount: 3,
          agents: [
            { id: "AG001", name: "Carlos Rodríguez", status: "idle", callsAnswered: 24, taskType: "Inbound", stateDuration: "00:02:15", latency: 1, campaign: "CALLME INBOUND" },
            { id: "AG002", name: "María García", status: "talking", callsAnswered: 31, taskType: "Inbound", stateDuration: "00:05:42", latency: 2, campaign: "CALLME INBOUND" },
            { id: "AG003", name: "Juan Pérez", status: "idle", callsAnswered: 18, taskType: "Inbound", stateDuration: "00:00:45", latency: 1, campaign: "CALLME INBOUND" },
            { id: "AG004", name: "Ana Martínez", status: "acw", callsAnswered: 27, taskType: "Inbound", stateDuration: "00:01:10", latency: 3, campaign: "CALLME INBOUND" },
            { id: "AG005", name: "Luis Sánchez", status: "talking", callsAnswered: 22, taskType: "Inbound", stateDuration: "00:08:30", latency: 1, campaign: "CALLME INBOUND" },
            { id: "AG006", name: "Carmen López", status: "idle", callsAnswered: 29, taskType: "Inbound", stateDuration: "00:00:20", latency: 2, campaign: "CALLME INBOUND" },
            { id: "AG007", name: "Pedro Ramírez", status: "talking_in", callsAnswered: 19, taskType: "Inbound", stateDuration: "00:00:05", latency: 1, campaign: "CALLME INBOUND" },
            { id: "AG008", name: "Laura Torres", status: "idle", callsAnswered: 33, taskType: "Inbound", stateDuration: "00:03:12", latency: 4, campaign: "CALLME INBOUND" },
            { id: "AG009", name: "Diego Fernández", status: "talking", callsAnswered: 25, taskType: "Inbound", stateDuration: "00:04:55", latency: 2, campaign: "CALLME INBOUND" },
            { id: "AG010", name: "Sofia Vargas", status: "acw", callsAnswered: 20, taskType: "Inbound", stateDuration: "00:00:35", latency: 1, campaign: "CALLME INBOUND" },
            { id: "AG011", name: "Roberto Castro", status: "idle", callsAnswered: 28, taskType: "Inbound", stateDuration: "00:01:50", latency: 3, campaign: "CALLME INBOUND" },
            { id: "AG012", name: "Isabel Moreno", status: "talking", callsAnswered: 26, taskType: "Inbound", stateDuration: "00:06:20", latency: 2, campaign: "CALLME INBOUND" },
            { id: "AG013", name: "Fernando Ruiz", status: "idle", callsAnswered: 21, taskType: "Inbound", stateDuration: "00:00:12", latency: 1, campaign: "CALLME INBOUND" },
            { id: "AG014", name: "Patricia Herrera", status: "talking", callsAnswered: 30, taskType: "Inbound", stateDuration: "00:03:45", latency: 5, campaign: "CALLME INBOUND" },
            { id: "AG015", name: "Miguel Jiménez", status: "idle", callsAnswered: 23, taskType: "Inbound", stateDuration: "00:02:30", latency: 1, campaign: "CALLME INBOUND" },
            { id: "AG016", name: "Lucía Ortiz", status: "acw", callsAnswered: 32, taskType: "Inbound", stateDuration: "00:00:55", latency: 2, campaign: "CALLME INBOUND" },
            { id: "AG017", name: "Andrés Navarro", status: "idle", callsAnswered: 17, taskType: "Inbound", stateDuration: "00:04:05", latency: 1, campaign: "CALLME INBOUND" },
          ],
        },
        {
          id: 2,
          name: "(12) TEL - VENTAS OUTBOUND",
          description: "Cola de llamadas salientes de ventas",
          agentCount: 12,
          idleCount: 5,
          talkingCount: 4,
          acwCount: 3,
          agents: [
            { id: "AG018", name: "Gabriela Mendoza", status: "talking", callsAnswered: 15, taskType: "Outbound", stateDuration: "00:07:22", latency: 2, campaign: "VENTAS OUTBOUND" },
            { id: "AG019", name: "Ricardo Silva", status: "idle", callsAnswered: 12, taskType: "Outbound", stateDuration: "00:01:40", latency: 1, campaign: "VENTAS OUTBOUND" },
            { id: "AG020", name: "Elena Romero", status: "acw", callsAnswered: 18, taskType: "Outbound", stateDuration: "00:00:48", latency: 3, campaign: "VENTAS OUTBOUND" },
            { id: "AG021", name: "Javier Gómez", status: "talking", callsAnswered: 14, taskType: "Outbound", stateDuration: "00:05:15", latency: 1, campaign: "VENTAS OUTBOUND" },
            { id: "AG022", name: "Valentina Cruz", status: "idle", callsAnswered: 16, taskType: "Outbound", stateDuration: "00:00:25", latency: 4, campaign: "VENTAS OUTBOUND" },
            { id: "AG023", name: "Sebastián Díaz", status: "talking", callsAnswered: 13, taskType: "Outbound", stateDuration: "00:09:10", latency: 2, campaign: "VENTAS OUTBOUND" },
            { id: "AG024", name: "Carolina Reyes", status: "acw", callsAnswered: 19, taskType: "Outbound", stateDuration: "00:01:05", latency: 1, campaign: "VENTAS OUTBOUND" },
            { id: "AG025", name: "Tomás Flores", status: "idle", callsAnswered: 11, taskType: "Outbound", stateDuration: "00:03:20", latency: 5, campaign: "VENTAS OUTBOUND" },
            { id: "AG026", name: "Daniela Vega", status: "talking", callsAnswered: 17, taskType: "Outbound", stateDuration: "00:04:35", latency: 2, campaign: "VENTAS OUTBOUND" },
            { id: "AG027", name: "Mateo Paredes", status: "idle", callsAnswered: 10, taskType: "Outbound", stateDuration: "00:02:15", latency: 1, campaign: "VENTAS OUTBOUND" },
            { id: "AG028", name: "Camila Rojas", status: "acw", callsAnswered: 20, taskType: "Outbound", stateDuration: "00:00:30", latency: 3, campaign: "VENTAS OUTBOUND" },
            { id: "AG029", name: "Nicolás Pardo", status: "idle", callsAnswered: 9, taskType: "Outbound", stateDuration: "00:05:45", latency: 2, campaign: "VENTAS OUTBOUND" },
          ],
        },
        {
          id: 3,
          name: "(8) TEL - SOPORTE TÉCNICO",
          description: "Cola de soporte técnico",
          agentCount: 8,
          idleCount: 3,
          talkingCount: 3,
          acwCount: 2,
          agents: [
            { id: "AG030", name: "Martín Guzmán", status: "talking", callsAnswered: 22, taskType: "Support", stateDuration: "00:12:45", latency: 1, campaign: "SOPORTE TÉCNICO" },
            { id: "AG031", name: "Paula Castillo", status: "idle", callsAnswered: 18, taskType: "Support", stateDuration: "00:01:10", latency: 2, campaign: "SOPORTE TÉCNICO" },
            { id: "AG032", name: "Felipe Medina", status: "acw", callsAnswered: 25, taskType: "Support", stateDuration: "00:02:20", latency: 3, campaign: "SOPORTE TÉCNICO" },
            { id: "AG033", name: "Adriana Ramos", status: "talking", callsAnswered: 21, taskType: "Support", stateDuration: "00:08:55", latency: 1, campaign: "SOPORTE TÉCNICO" },
            { id: "AG034", name: "Oscar Luna", status: "idle", callsAnswered: 19, taskType: "Support", stateDuration: "00:00:35", latency: 4, campaign: "SOPORTE TÉCNICO" },
            { id: "AG035", name: "Natalia Cortés", status: "talking", callsAnswered: 23, taskType: "Support", stateDuration: "00:15:20", latency: 2, campaign: "SOPORTE TÉCNICO" },
            { id: "AG036", name: "Raúl Aguilar", status: "acw", callsAnswered: 20, taskType: "Support", stateDuration: "00:01:45", latency: 1, campaign: "SOPORTE TÉCNICO" },
            { id: "AG037", name: "Verónica Muñoz", status: "idle", callsAnswered: 17, taskType: "Support", stateDuration: "00:04:10", latency: 5, campaign: "SOPORTE TÉCNICO" },
          ],
        },
      ],
    };
  },
  computed: {
    totalAgents() {
      return this.queues.reduce((acc, q) => acc + q.agentCount, 0);
    },
    totalIdle() {
      return this.queues.reduce((acc, q) => acc + q.idleCount, 0);
    },
    totalTalking() {
      return this.queues.reduce((acc, q) => acc + q.talkingCount, 0);
    },
    totalACW() {
      return this.queues.reduce((acc, q) => acc + q.acwCount, 0);
    },
    filteredQueues() {
      let result = this.queues;

      // Filtrar por búsqueda
      if (this.searchQueue && this.searchQueue.trim() !== "") {
        const search = this.searchQueue.toLowerCase();
        result = result.filter(
          (q) =>
            q.name.toLowerCase().includes(search) ||
            q.description.toLowerCase().includes(search)
        );
      }

      // Filtrar por estado de agentes
      if (this.statusFilter && this.statusFilter.length > 0) {
        result = result
          .map((q) => {
            return {
              id: q.id,
              name: q.name,
              description: q.description,
              agentCount: q.agentCount,
              idleCount: q.idleCount,
              talkingCount: q.talkingCount,
              acwCount: q.acwCount,
              agents: q.agents.filter((a) => this.statusFilter.includes(a.status)),
            };
          })
          .filter((q) => q.agents.length > 0);
      }

      return result;
    },
  },
  methods: {
    getStatusColor(status) {
      const map = { idle: "green", talking: "red", acw: "orange", talking_in: "amber" };
      return map[status] || "grey";
    },
    getStatusLabel(status) {
      const map = { idle: "Disponible", talking: "En Llamada", acw: "ACW", talking_in: "Entrante" };
      return map[status] || status;
    },
    getStatusIcon(status) {
      const map = { idle: "check_circle", talking: "phone_in_talk", acw: "edit_note", talking_in: "phone_callback" };
      return map[status] || "circle";
    },
    getTaskIcon(type) {
      const map = { Inbound: "phone_callback", Outbound: "phone_forwarded", Support: "support_agent" };
      return map[type] || "phone";
    },
    getTaskColor(type) {
      const map = { Inbound: "blue", Outbound: "purple", Support: "teal" };
      return map[type] || "grey";
    },
    getLatencyColor(ms) {
      if (ms <= 2) return "green";
      if (ms <= 4) return "orange";
      return "red";
    },
  },
});

app.use(Quasar).use(DarkModeSync);
app.mount("#q-app");
