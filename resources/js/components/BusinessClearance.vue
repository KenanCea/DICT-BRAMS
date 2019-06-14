<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Business Clearance</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-tooltip attach bottom>
        <template v-slot:activator="{ on }">
          <v-btn text icon color="primary" v-on="on" @click="createBusinessClearanceDialog">
            <v-icon color="grey darken-2">mdi-file-document-edit</v-icon>
          </v-btn>
        </template>
        <span>Fill-up form</span>
      </v-tooltip>
    </v-app-bar>

    <v-dialog v-model="dialogBusinessClearanceForm" scrollable persistent max-width="800px">
      <v-form @submit.prevent="createBusinessClearance">
        <v-card>
          <v-card-title>
            <span class="headline">Issue business clearance</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md class="pa-0">
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formBusinessClearance.first_name" label="First name*"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formBusinessClearance.middle_name" label="Middle name*"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formBusinessClearance.last_name" label="Last name*"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formBusinessClearance.house_no" label="House number*"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formBusinessClearance.purok" label="Purok*"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formBusinessClearance.street" label="Street*"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="formBusinessClearance.control_no" label="Control number*"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBusinessClearance.ctc_no"
                    label="Community tax certificate number*"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBusinessClearance.official_receipt_no"
                    label="Official receipt number*"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBusinessClearance.business_address"
                    label="Business address*"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBusinessClearance.business_trade_name"
                    label="Business trade name*"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="formBusinessClearance.business_application"
                    :items="['New', 'Renewal']"
                    label="Business application*"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="formBusinessClearance.kind_business"
                    label="Kind of business*"
                    :items="['Agriculture', 'Construction', 'Electricity/gas and water', 'Wholesale retail, and trade', 'Transport, storage communications', 'Community Social and personal services', 'Financing Insurance', 'Real States', 'Manufacturing', 'Mining']"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="formBusinessClearance.line_of_business"
                    label="Line of business*"
                    :items="['Poultry/Livestock', 'Nurseries/Flower Growing', 'Breeding Stations', 'Fishponds/Fishpens', 'Vineyards/Mussel Farms', 'Orchards/Vineyards', 'Vegetable Farms', 'Supermarkets', 'Groceries/Dry Goods Stores', 'Sari-sari Stores', 'Banks and Financial/Lending Institutions', 'Auto Supply and Motorports', 'Distributors, Dealers of Various Products', 'Gasoline stations', 'Photo and Record Shops', 'Jewelry Stores', 'Pawnshops', 'General Services/Contractors', 'Beauty Parlors or Barber shops', 'Fitness Gyms', 'Restaurants', 'Insurance/Dealer in Securities', 'Furniture Shops', 'Livestock and Poultry Supplyes Stores', 'Hardware/Electric Supplies', 'Videoke Shops', 'Computer Shops/Internet Cafe', 'Buy and Sell Stations', 'Water Refilling Stations', 'Hotel/Inns', 'Apartment/Boarding House', 'Handicraft', 'Metalcraft', 'Garments', 'Ceramics', 'Food Processing', 'Mining and Quarrying', 'Factories', 'Rice/Corn/Flour/Saw Mills', 'Junkshops']"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBusinessClearance.total_amt_paid"
                    label="Total amount paid*"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md6>
                  <v-select
                    v-model="formBusinessClearance.action_taken"
                    label="Action taken on application*"
                    :items="['Approval', 'Disapproval']"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md6>
                  <v-text-field
                    v-model="formBusinessClearance.reasons_approv_disapprove"
                    label="Reason for approval/disapproval*"
                  ></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <p class="mb-0">* indicates required field</p>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="dialogBusinessClearanceForm = false" text>cancel</v-btn>
            <v-btn color="primary" type="submit" text>Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>

    <v-dialog v-model="dialogBusinessClearance" scrollable max-width="800px">
      <v-card>
        <v-card-title>
          <span class="headline">Issue business clearance</span>
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
                <p>Business Clearance</p>
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
                      <span>{{ formBusinessClearance.business_address ? `${formBusinessClearance.first_name} ${formBusinessClearance.middle_name}. ${formBusinessClearance.last_name}` : '______________________________________________' }},</span>
                      a resident of
                      <span>{{ formBusinessClearance.business_address ? `${formBusinessClearance.house_no} Purok ${formBusinessClearance.purok} ${formBusinessClearance.street}, ${address[0].name}, ${address[0].municipality}, ${address[0].province}` : '________________________________________________' }}</span>
                      establishment at
                      <span
                        v-if="formBusinessClearance.business_address"
                      >{{formBusinessClearance.business_address}}</span>
                      is applying for
                      <span
                        v-if="formBusinessClearance.business_application"
                      >{{formBusinessClearance.business_application}}</span>
                      Business Permit for C.
                    </p>
                    <p>
                      The kind of business applied for is
                      <span
                        v-if="formBusinessClearance.kind_business"
                      >{{formBusinessClearance.kind_business}}</span>
                      under the trade name:
                      <span
                        v-if="formBusinessClearance.business_trade_name"
                      >{{formBusinessClearance.business_trade_name}}</span>
                    </p>
                    <p>
                      The line of business for is
                      <span
                        v-if="formBusinessClearance.line_of_business"
                      >{{formBusinessClearance.line_of_business}}</span>
                    </p>
                    <p>The undersigned recommends for Approval due to the following reasons</p>
                    <p>1. Complied all requirements and,</p>
                    <p>
                      2.
                      <span
                        v-if="formBusinessClearance.reasons_approv_disapprove"
                      >{{formBusinessClearance.reasons_approv_disapprove}}</span>
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
                        v-if="formBusinessClearance.ctc_no"
                      >{{formBusinessClearance.ctc_no}}</span>
                      <span v-else>____________</span>
                    </p>
                    <p class="mb-0">
                      Issued on:
                      <span
                        v-if="formBusinessClearance.created_at"
                      >{{formBusinessClearance.created_at}}</span>
                      <span v-else>____________</span>
                    </p>
                    <p class="mb-0">
                      Issued at:
                      <span>{{ address.length ? `${address[0].name}, ${address[0].municipality}` : '____________' }}</span>
                    </p>
                    <p class="mb-0">
                      Official receipt number:
                      <span
                        v-if="formBusinessClearance.official_receipt_no"
                      >{{formBusinessClearance.official_receipt_no}}</span>
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
          <v-btn color="primary" text @click="clearInput()">Done</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-data-table
      :headers="businessClearanceHeaders"
      :items="businessClearanceIssued"
      :loading="loading"
    >
      <template v-slot:item.action="{ item }">
        <v-btn icon @click="printBusinessClearance(item)">
          <v-icon>mdi-printer</v-icon>
        </v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
    businessClearanceIssued: [],
    user: {},
    address: [],
    officials: [],
    dialogBusinessClearanceForm: false,
    dialogBusinessClearance: false,
    loading: false,
    businessClearanceHeaders: [
      { text: "Control no.", value: "control_no" },
      { text: "Last name", value: "last_name" },
      { text: "First name", value: "first_name" },
      { text: "Middle name", value: "middle_name" },
      { text: "Business address", value: "business_address" },
      { text: "Business trade name", value: "business_trade_name" },
      { text: "Community tax certificate no.", value: "ctc_no" },
      { text: "Official receipt no.", value: "official_receipt_no" },
      { text: "Issued on", value: "created_at" },
      { text: "Actions", value: "action", sortable: false }
    ],
    formBusinessClearance: new Form({
      control_no: "",
      business_address: "",
      business_trade_name: "",
      business_application: "",
      kind_business: "",
      line_of_business: "",
      action_taken: "",
      reasons_approv_disapprove: "",
      ctc_no: "",
      official_receipt_no: "",
      total_amt_paid: "",
      created_at: "",
      inhabitant_id: "",
      last_name: "",
      first_name: "",
      middle_name: "",
      house_no: "",
      purok: "",
      street: ""
    }),
    formUser: new Form({
      logo: ""
    })
  }),
  created() {
    this.getBusinessClearance();
    this.getOfficials();
    this.getAddress();
    this.getUser();
  },

  methods: {
    getBusinessClearance() {
      this.loading = true;
      axios.get("api/getUnregisteredBusinessClearance").then(response => {
        this.businessClearanceIssued = response.data;
        this.loading = false;
      });
    },

    createBusinessClearance() {
      this.formBusinessClearance
        .post("api/createBusinessClearance")
        .then(() => {
          this.dialogBusinessClearanceForm = false;
          toast.fire({
            type: "success",
            title: "Inhabitant has been issued business clearance"
          });
          this.getBusinessClearance();
          this.formBusinessClearance.reset();
        })
        .catch(() => {});
    },

    printBusinessClearance(item) {
      this.dialogBusinessClearance = true;
      this.formBusinessClearance.fill(item);
    },

    createBusinessClearanceDialog() {
      this.formBusinessClearance.reset();
      this.dialogBusinessClearanceForm = true;
    },

    clearInput() {
      this.dialogBusinessClearance = false;
      this.formBusinessClearance.reset();
    },

    getAddress() {
      axios.get("api/address").then(response => {
        this.address = response.data;
      });
    },
    getUser() {
      axios.get("api/user").then(({ data }) => this.formUser.fill(data));
    },
    getOfficials() {
      axios.get("api/officials").then(response => {
        this.officials = response.data;
      });
    },
    getLogo() {
      let logo =
        this.formUser.logo.length > 200
          ? this.formUser.logo
          : "img/profile/" + this.formUser.logo;
      return logo;
    }
  }
};
</script>