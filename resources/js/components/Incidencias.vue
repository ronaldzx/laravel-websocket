<template>
  <div>
    <headerContent-component
      v-bind:padre="this.$route.params.padre"
      v-bind:hijo="this.$route.params.hijo"
      v-bind:icono="this.$route.params.icono"
    ></headerContent-component>
    <v-container>
      <v-data-table :headers="headers" :items="incidencias">
        <template v-slot:top>
          <v-toolbar flat color="white">
            <v-toolbar-title>Alerta de incidencia delincuencial</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
          </v-toolbar>
        </template>
        <template v-slot:item.descripcion="props">
          <v-edit-dialog
            :return-value.sync="props.item.descripcion"
            @save="save(props.item)"
            @cancel="cancel"
            @open="open"
            @close="close"
          >
            {{ props.item.descripcion }}
            <template v-slot:input>
              <v-text-field v-model="props.item.descripcion" label="Editar" single-line counter></v-text-field>
            </template>
          </v-edit-dialog>
        </template>
        <template v-slot:item.fecha="{ item }">
          <span>{{formatDate(item.fecha)}}</span>
        </template>
        <template v-slot:item.tiempo="{ item }">
          <span>{{formatTime(item.fecha)}}</span>
        </template>
      </v-data-table>

      <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
        {{ snackText }}
        <v-btn text @click="snack = false">Close</v-btn>
      </v-snackbar>
    </v-container>
  </div>
</template>

<script>
import moment from "moment";
import Echo from "laravel-echo";
window.Pusher = require("pusher-js");
export default {
  mounted() {
    this.obtenerIncidencias();
    window.Echo = new Echo({
      broadcaster: "pusher",
      key: "ATDXSD1514",
      wsHost: window.location.hostname,
      encrypted: false,
      wsPort: 6001,
      wssPort: 6001,
      disableStats: true,
      forceTLS: false,
      encrypted: false
    });
    window.Echo.channel("home").listen("NewMessage", e => {
      console.log(e);
      this.obtenerIncidencias();
    });
  },
  data() {
    return {
      snack: false,
      snackColor: "",
      snackText: "",
      // max25chars: v => v.length <= 25 || "Input too long!",
      pagination: {},
      headers: [
        { text: "N°", value: "id" },
        { text: "Fecha", value: "fecha" },
        { text: "Dirección", value: "direccion" },
        { text: "Descripción", value: "descripcion" },
        { text: "Hora real de la incidencia", value: "tiempo" }
      ],
      incidencias: []
    };
  },
  methods: {
    formatDate(value) {
      return moment(value).format("DD/MM/YYYY");
    },
    formatTime(value) {
      return moment(value).format("h:mm:ss");
    },
    obtenerIncidencias() {
      axios
        .get("/obtener-incidencias")
        .then(response => {
          this.incidencias = response.data;
        })
        .catch(error => {});
    },
    save(e) {
      axios
        .post("/editar-descripcion", {
          id: e.id,
          descripcion: e.descripcion
        })
        .then(response => {
          this.snack = true;
          this.snackColor = "success";
          this.snackText = "Guardado";
        })
        .catch(error => {
          console.log(error);
        });
    },
    cancel() {
      this.snack = true;
      this.snackColor = "error";
      this.snackText = "Cancelado";
    },
    open() {
      this.snack = true;
      this.snackColor = "info";
      this.snackText = "Editar";
    },
    close() {
      // console.log("Dialog closed");
    }
  }
};
</script>