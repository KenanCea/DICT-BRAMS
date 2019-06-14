<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Barangay Certificate</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-tooltip attach bottom>
        <template v-slot:activator="{ on }">
          <v-btn text icon color="primary" v-on="on" @click="dialog=true">
            <v-icon color="grey darken-2">mdi-file-document-edit</v-icon>
          </v-btn>
        </template>
        <span>Fill-up form</span>
      </v-tooltip>
    </v-app-bar>

    <v-data-table
      :headers="barangayCertificateHeaders"
      :items="barangayCertificateIssued"
      :loading="loading"
    >
      <template v-slot:item.action="{ item }">
        <v-btn icon @click="printBarangayCertificate(item)">
          <v-icon>mdi-printer</v-icon>
        </v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import Print from "./FormsPrint.vue";
export default {
  data: () => ({
    barangayCertificateIssued: [],
    loading: false,
    barangayCertificateHeaders: [
      { text: "Control no.", value: "control_no" },
      { text: "Community tax certificate no.", value: "ctc_no" },
      { text: "Purpose of clearance", value: "purpose_certification" },
      { text: "Official receipt no.", value: "official_receipt_no" },
      { text: "Ammount paid", value: "amount_paid" },
      { text: "Issued on", value: "created_at" },
      { text: "Actions", value: "action", sortable: false }
    ]
  }),
  created() {
    this.getBarangayCertificate();
  },
  methods: {
    getBarangayCertificate() {
      this.loading = true;
      axios.get("api/getUnregisteredBarangayCertificate/").then(response => {
        this.barangayCertificateIssued = response.data;
        this.loading = false;
      });
    }
  }
};
</script>