<template>
  <div>
    <v-dialog v-model="dialog" persistent max-width="800px">
      <v-form>
        <v-card>
          <v-card-title>
            <span class="headline">ADD</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="form.ctc_no"
                    label="Community Tax Certificate Number"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="form.purpose_of_clearance"
                    label="Purpose of clearance"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.ctc_issued_at" label="Issued at" required></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.ctc_issued_on" label="Issued on" required></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog=false">Okay</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Barangay Clearance</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-autocomplete
        v-model="select"
        :items="items"
        :loading="isLoading"
        :search-input.sync="search"
        autofocus
        solo
        flat
        hide-details
        hide-selected
        clearable
        item-text="first_name"
        item-value="API"
        label="Inhabitants"
        placeholder="Start typing to Search"
        return-object
      ></v-autocomplete>
      <v-tooltip attach bottom>
        <template v-slot:activator="{ on }">
          <v-btn text icon color="primary" v-on="on" @click="dialog=true">
            <v-icon color="grey darken-2">mdi-file-document-edit</v-icon>
          </v-btn>
        </template>
        <span>Fill-up form</span>
      </v-tooltip>
      <v-tooltip attach bottom>
        <template v-slot:activator="{ on }">
          <v-btn text icon color="primary" v-on="on">
            <v-icon color="grey darken-2">mdi-printer</v-icon>
          </v-btn>
        </template>
        <span>Print</span>
      </v-tooltip>
      <v-tooltip attach bottom>
        <template v-slot:activator="{ on }">
          <v-btn text icon color="primary" v-on:click="pdf()">
            <v-icon color="grey darken-2">mdi-file-export</v-icon>
          </v-btn>
        </template>
        <span>Export</span>
      </v-tooltip>
      <v-tooltip attach bottom>
        <template v-slot:activator="{ on }">
          <v-btn text icon color="primary" v-on="on">
            <v-icon color="grey darken-2">mdi-refresh</v-icon>
          </v-btn>
        </template>
        <span>Refresh</span>
      </v-tooltip>
    </v-app-bar>
    <v-container grid-list-md text-xs-center id="printForm">
      <v-layout row wrap>
        <v-flex xs4>
          <v-img src="/img/baguio.png" alt="Logo" contain height="100"></v-img>
        </v-flex>
        <v-flex xs4 class="green--text title">
          <p class="mb-0">Republic of the Philippines</p>
          <span v-if="select">{{select.province}}</span>
          <p class="mb-0">BARANGAY AMBIONG</p>
          <p>Aurora Hill, Baguio</p>
        </v-flex>
        <v-flex xs4>
          <v-img src="/img/profile/profile1.png" alt="Logo" contain height="100"></v-img>
        </v-flex>
      </v-layout>
      <v-layout row wrap>
        <v-flex xs12 class="subtitle-1 font-weight-bold">
          <p class="mb-0">Office of the Punong Barangay</p>
          <p>Barangay Clearance</p>
        </v-flex>
      </v-layout>
      <v-layout row wrap>
        <v-flex xs4 class="form-border-right">
          <p class="mb-0">RANDY P. GATI</p>
          <p>Punong Barangay</p>
          <p class="mb-0">BRIAN C. ANTON</p>
          <p>Barangay Kagawad</p>
          <p class="mb-0">ARTHUR T. WILLY</p>
          <p>Barangay Kagawad</p>
          <p class="mb-0">MARTN G. CONTIC</p>
          <p>Barangay Kagawad</p>
          <p class="mb-0">EMILY R. BALLARES</p>
          <p>Barangay Kagawad</p>
          <p class="mb-0">RUDY D. AMISTAD</p>
          <p>Barangay Kagawad</p>
          <p class="mb-0">VICENTE J. ZAPANTA</p>
          <p>Barangay Kagawad</p>
          <p class="mb-0">MODESTO P. COLUMBRES</p>
          <p>Barangay Kagawad</p>
          <p class="mb-0">CYNTHIA G. AMISTAD</p>
          <p>Barangay Secretary</p>
          <p class="mb-0">RONALD C. GOMEZ</p>
          <p>Barangay Treasurer</p>
        </v-flex>
        <v-flex xs8 text-xs-left class="pl-3">
          <p>TO WHOM IT MAY CONCERN:</p>
          <br>
          <p>
            This is to certify that
            <span
              v-if="select"
            >{{select.first_name}} {{select.middle_name}} {{select.last_name}}</span>
            <span v-else>______________________________________________</span>,
            <span v-if="select">{{select.age}}</span>
            <span v-else>________</span> years old,
            <span v-if="select">{{select.citizenship}}</span>
            <span v-else>________________________</span> citizen, a native of
            <span v-if="select">{{select.placeOfBirth_native}}</span>
            <span v-else>________________________</span>, residing at
            <span v-if="select">
              {{select.house_no}}, {{select.purok}}
              {{select.street}}, {{select.barangay}} is a resident of this barangay.
            </span>
          </p>

          <p>
            THIS IS TO CERTIFY FURTHER that the above-named person has neither derogatory records nor pending
            case in this barangay.
          </p>
          <p></p>
          <p>THIS CERTIFICATION is issued upon the request of the above named person for LEGAL INTENT.</p>
          <p></p>
          <p>
            Issued this
            <span v-if="form.ctc_issued_on">{{form.ctc_issued_on}}</span>
            <span v-else>________________________________________</span> at Barangay
            <span v-if="select">
              {{select.house_no}}, {{select.purok}}
              {{select.street}}, {{select.barangay}}
            </span>
          </p>

          <br>
          <div class="text-xs-right text-xs-center">
            <p class="mb-0-5">CERTIFIED AND ISSUED BY:</p>
            <p class="mb-0 mr-5">RANDY P. GATI</p>
            <p class="mb-5 mr-5">Punong Barangay</p>
          </div>

          <p class="mb-0">
            Community Tax Certificate Number:
            <span v-if="form.ctc_no">{{form.ctc_no}}</span>
            <span v-else>____________</span>
          </p>
          <p class="mb-0">
            Issued On:
            <span v-if="form.ctc_issued_on">{{form.ctc_no}}</span>
            <span v-else>____________</span>
          </p>
          <p class="mb-0">
            Issued At:
            <span v-if="form.ctc_issued_at">{{form.ctc_no}}</span>
            <span v-else>____________</span>
          </p>
          <p>
            <br>
          </p>
          <p>Note: Not valid without Barangay Seal</p>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import jsPDF from "jspdf";
import html2canvas from "html2canvas";
export default {
  data: () => ({
    inhabitants: [],
    dialog: false,
    form: new Form({
      control_no: "",
      ctc_no: "",
      purpose_of_clearance: "",
      date_issued: "",
      ctc_issued_on: "",
      ctc_issued_at: "",
      inhabitant_id: ""
    }),
    search: null,
    select: null,
    isLoading: false
  }),
  computed: {
    items() {
      return this.inhabitants.map(entry => {
        const first_name =
          entry.first_name.length > this.descriptionLimit
            ? entry.first_name.slice(0, this.descriptionLimit) + "..."
            : entry.first_name;
        return Object.assign({}, entry, {
          first_name
        });
      });
    }
  },
  watch: {
    search(val) {
      if (this.items.length > 0) return;
      if (this.isLoading) return;
      this.isLoading = true;
      axios
        .get("api/form")
        .then(response => {
          this.inhabitants = response.data;
        })
        .catch(err => {
          console.log(err);
        })
        .finally(() => (this.isLoading = false));
    }
  },
  methods: {
    pdf() {
      html2canvas(document.getElementById("printForm")).then(canvas => {
        let pdf = new jsPDF("p", "mm", "letter");
        pdf.addImage(canvas.toDataURL("image/png"), "PNG", 0, 0, 205, 248);
        pdf.save("BarangayClearance.pdf");
      });
    }
  }
};
</script>