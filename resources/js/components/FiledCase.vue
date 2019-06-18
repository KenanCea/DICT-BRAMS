<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Filed Cases</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn depressed color="primary" @click="dialogFiledCasesForm = true">
        Fill-up form
        <v-icon right dark>mdi-file-document-edit</v-icon>
      </v-btn>
    </v-app-bar>
    <v-dialog v-model="dialogFiledCasesForm" scrollable persistent max-width="800px">
      <v-form @submit.prevent="createFiledCases">
        <v-card>
          <v-card-title>
            <span class="headline">Issue filed cases</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md class="pa-0">
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formFiledCases.control_no" label="Control number*"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formFiledCases.respondent" label="Respondent*"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="formFiledCases.case"
                    label="Case*"
                    :items="['Collecting sum of money', 'Estafa', 'Malicius Mischief', 'Physical Injury', 'Physical Injury with Robbery', 'Theft', 'Threat', 'Unjust Vexation', 'Murder', 'Rape', 'Children in Conflict of the law']"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="formFiledCases.type_of_case"
                    label="Type of case*"
                    :items="['Criminal', 'Civil', 'Others']"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formFiledCases.complainant" label="Complainant*"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formFiledCases.co_complainant" label="Co-complainant*"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="formFiledCases.action_taken_on_settled"
                    label="Action taken on settled*"
                    :items="['Arbitration', 'Conciliation', 'Mediation']"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="formFiledCases.action_taken_on_unsettled"
                    label="Action taken on unsettled*"
                    :items="['Repudiation', 'Withdrawn', 'Pending case', 'Case dismissed', 'Case certified', 'Referred to concerned agencies']"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formFiledCases.remarks" label="Remarks*"></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <p class="mb-0">* indicates required field</p>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="dialogFiledCasesForm = false" text>cancel</v-btn>
            <v-btn color="primary" type="submit" text>Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>
    <v-data-table :headers="filedCasesHeaders" :items="filedCasesIssued" :loading="loading">
      <template v-slot:item.action="{ item }">
        <v-btn icon @click="printFiledCases(item)">
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
    filedCasesIssued: [],
    loading: false,
    dialogFiledCasesForm: false,
    filedCasesHeaders: [
      { text: "Control no.", value: "control_no" },
      { text: "Respondent", value: "respondent" },
      { text: "Case", value: "case" },
      { text: "Complainant", value: "complainant" },
      { text: "Co_complainant", value: "co_complainant" },
      { text: "Issued on", value: "created_at" }
    ],
    formFiledCases: new Form({
      control_no: "",
      respondent: "",
      case: "",
      type_of_case: "",
      complainant: "",
      co_complainant: "",
      action_taken_on_settled: "",
      action_taken_on_unsettled: "",
      remarks: "",
      created_at: ""
    })
  }),
  created() {
    this.getFiledCases();
  },
  methods: {
    getFiledCases() {
      this.loading = true;
      axios.get("api/getUnregisteredFiledCases/").then(response => {
        this.filedCasesIssued = response.data;
        this.loading = false;
      });
    },
    createFiledCases() {
      this.formFiledCases
        .post("api/createFiledCases")
        .then(() => {
          this.dialogFiledCasesForm = false;
          toast.fire({
            type: "success",
            title: "Unregistered inhabitant has been issued filed case"
          });
          this.getFiledCases();
          this.formFiledCases.reset();
        })
        .catch(() => {});
    }
  }
};
</script>