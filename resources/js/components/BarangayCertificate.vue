<template>
  <div>
    <v-dialog v-model="dialogBarangayCertificateForm" scrollable persistent max-width="800px">
      <v-form @submit.prevent="createBarangayClearance()">
        <v-card>
          <v-card-title>
            <span class="headline">Issue barangay certificate</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md class="pa-0">
              <v-layout wrap>
                <v-flex xs12 sm6 md6>
                  <v-text-field
                    v-model="formBarangayClearance.control_no"
                    label="Official Receipt Number*"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md6>
                  <v-text-field
                    v-model="formBarangayClearance.ctc_no"
                    label="Community Tax Certificate Number*"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md6>
                  <v-text-field
                    v-model="formBarangayClearance.purpose_of_clearance"
                    label="Purpose of clearance*"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md6>
                  <v-text-field
                    v-model="formBarangayClearance.official_receipt_no"
                    label="Official Receipt Number*"
                  ></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
            <v-card outlined>
              <v-data-table
                :headers="barangayCertificateHeaders"
                :items="barangayCertificateIssued"
                hide-default-footer
              >
                <template v-slot:item.action="{ item }">
                  <v-btn icon @click="printBarangayCertificate(item)">
                    <v-icon>mdi-printer</v-icon>
                  </v-btn>
                </template>
              </v-data-table>
            </v-card>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <p class="mb-0">* indicates required field</p>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="dialogBarangayClearanceForm = false" text>cancel</v-btn>
            <v-btn color="primary" text type="submit">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>

    <v-dialog v-model="dialogBarangayClearance" scrollable persistent max-width="800px">
      <v-card>
        <v-card-title>
          <span class="headline">Issue barangay clearance</span>
          <v-spacer></v-spacer>

          <div class="ml-1">
            <v-tooltip attach bottom>
              <template v-slot:activator="{ on }">
                <v-btn v-on="on" icon>
                  <v-icon>mdi-printer</v-icon>
                </v-btn>
              </template>
              <span>Print</span>
            </v-tooltip>
          </div>
          <div class="ml-1">
            <v-menu :close-on-content-click="false" offset-y max-height="400">
              <template #activator="{ on: menu }">
                <v-tooltip attach bottom>
                  <template #activator="{ on: tooltip }">
                    <v-btn icon v-on="{ ...tooltip, ...menu }">
                      <v-icon>mdi-application-export</v-icon>
                    </v-btn>
                  </template>
                  <span>Export</span>
                </v-tooltip>
              </template>
              <v-list>
                <v-list-item>
                  <v-list-item-icon class="mr-2">
                    <v-icon color="red">mdi-file-pdf</v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title>PDF</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-icon class="mr-2">
                    <v-icon color="blue">mdi-file-word</v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title>Word</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </v-menu>
          </div>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text style="color:black">
          <v-container grid-list-md text-xs-center class="pa-0" id="printForm">
            <v-layout row wrap>
              <v-flex xs3>
                <v-img src="/img/baguio.png" alt="Logo" contain height="100"></v-img>
              </v-flex>
              <v-flex xs6 class="green--text title">
                <p class="mb-0">Barangay Camp Allen</p>
                <p class="mb-0">Republic of the Philippines</p>
                <p class="mb-0">Baguio City</p>
              </v-flex>
              <v-flex xs3>
                <img :src="getLogo()" alt="Logo" contain height="100">
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
                <p class="mb-0">{{ officials.length ? `${officials[0].name}` : 'Not registered'}}</p>
                <p>Punong Barangay</p>
                <p class="mb-0">{{ officials.length ? `${officials[1].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p class="mb-0">{{ officials.length ? `${officials[2].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p class="mb-0">{{ officials.length ? `${officials[3].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p class="mb-0">{{ officials.length ? `${officials[4].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p class="mb-0">{{ officials.length ? `${officials[5].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p class="mb-0">{{ officials.length ? `${officials[6].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p class="mb-0">{{ officials.length ? `${officials[7].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p class="mb-0">{{ officials.length ? `${officials[8].name}` : 'Not registered'}}</p>
                <p>Barangay Secretary</p>
                <p class="mb-0">{{ officials.length ? `${officials[9].name}` : 'Not registered'}}</p>
                <p>Barangay Treasurer</p>
              </v-flex>
              <v-flex xs8 text-xs-left class="pl-3">
                <v-layout row wrap>
                  <v-flex>
                    <p>TO WHOM IT MAY CONCERN:</p>
                    <p>
                      This is to certify that
                      <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].first_name} ${selectedInhabitant[0].middle_name}. ${selectedInhabitant[0].last_name}` : '______________________________________________' }},</span>
                      <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].age}` : '________' }}</span> years old,
                      <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].citizenship}` : '________________________' }}</span> citizen, a native of
                      <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].placeOfBirth_native}` : '________________________' }}</span>, and presently residing at
                      <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].house_no} Purok ${selectedInhabitant[0].purok} ${selectedInhabitant[0].street}, ${address[0].name}, ${address[0].province}` : '________________________________________________' }}</span>
                      and whose signature appears hereunder, has no pending adverse case and deragatory records filed
                      against per available records on file with this office as of the date of issuance thereof.
                    </p>
                  </v-flex>

                  <v-flex xs12>
                    <p>
                      Issued
                      <span
                        v-if="formBarangayClearance.purpose_of_clearance"
                      >{{formBarangayClearance.purpose_of_clearance}}</span>
                      <span v-else>________________________________________</span> purposes.
                    </p>
                  </v-flex>

                  <v-flex xs6>
                    <p class="mb-0">________________________</p>
                    <p class="mb-5">Signature over printed name</p>
                  </v-flex>

                  <v-flex xs12 class="mb-5">
                    <p class="mb-0">
                      Community tax certificate number:
                      <span
                        v-if="formBarangayClearance.ctc_no"
                      >{{formBarangayClearance.ctc_no}}</span>
                      <span v-else>____________</span>
                    </p>
                    <p class="mb-0">
                      Issued on:
                      <span
                        v-if="formBarangayClearance.created_at"
                      >{{formBarangayClearance.created_at}}</span>
                      <span v-else>____________</span>
                    </p>
                    <p class="mb-0">
                      Issued at:
                      <span>{{ selectedInhabitant.length ? `${address[0].name}, ${address[0].municipality}` : '____________' }}</span>
                    </p>
                    <p class="mb-0">
                      Official receipt number:
                      <span
                        v-if="formBarangayClearance.official_receipt_no"
                      >{{formBarangayClearance.official_receipt_no}}</span>
                      <span v-else>____________</span>
                    </p>
                  </v-flex>

                  <v-flex xs6 offset-xs6 class="text-xs-center">
                    <p>CERTIFIED AND ISSUED BY:</p>
                    <p
                      class="mb-0"
                    >{{ officials.length ? `${officials[0].name}` : 'Not registered'}}</p>
                    <p>Punong Barangay</p>
                  </v-flex>

                  <v-flex xs12>
                    <p>Note: Not valid without Barangay Seal</p>
                  </v-flex>
                </v-layout>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" @click="dialogBarangayClearance = false" text>cancel</v-btn>
          <v-btn color="primary" text @click="clear()">Ok</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import Print from './FormsPrint.vue';
export default {
  data: () => ({
    inhabitants: [],
    dialog: false,
    form: new Form({
      name: "",
      age: "",
      citizenship: "",
      barangay: "",
      postal_address: "",
      control_no: "",
      ctc_no: "",
      purpose_of_clearance: "",
      date_issued: "",
      ctc_issued_on: "",
      ctc_issued_at: "",
      inhabitant_id: ""
    }),
    search: null,
    select: {},
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
  components:{
    'app-print': Print
  },
  watch: {
    search(val) {
      if (this.items.length > 0) return;
      if (this.isLoading) return;
      this.isLoading = true;
      axios
        .get("api/inhabitant")
        .then(response => {
          this.inhabitants = response.data;
        })
        .catch(err => {
          console.log(err);
        })
        .finally(() => (this.isLoading = false));
    }
  }
  
};
</script>