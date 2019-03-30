<template>
  <div class="elevation-1">
    <v-dialog v-model="dialog" persistent scrollable max-width="800px">
      <v-form @submit.prevent="editmode ? updateHousehold() : createHousehold()">
        <!-- <v-card>
          <v-card-title>
            <span class="headline" v-show="!editmode">ADD</span>
            <span class="headline" v-show="editmode">EDIT</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.house_number" label="House Number"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.barangay" label="Barangay"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.email_address" label="Email Address"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.purok" label="Purok"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.place_of_origin" label="Place of Origin"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.mobile_number" label="Mobile Number"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.street" label="Street"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.ethnic_group"
                    :items="['Bicol','Bisaya','Boholano','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kankanaey','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zamboagueno/Chavacano','N/A']"
                    label="Ethnic Group"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.telephone_no" label="Telephone No."></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.status_of_ownership_house"
                    :items="['Owned','Rented','Caretaker','Others']"
                    label="Status of Ownership-House"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.status_of_ownership_lot"
                    :items="['Owned','Rented','Caretaker','Others']"
                    label="Status of Ownership-Lot"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.type_of_dwelling_structure"
                    :items="['Permanent Concrete','Semi Permanent','Temporary']"
                    label="Type of Dwelling Structure"
                  ></v-select>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="dialog=false">Cancel</v-btn>
            <v-btn color="blue darken-1" flat type="submit">Save</v-btn>
          </v-card-actions>
        </v-card>-->

        <v-tabs centered v-model="tabs" icons-and-text>
          <v-tabs-slider color="primary"></v-tabs-slider>
          <v-tab h-ref="tab-1" ripple>
            Household Information
            <v-icon>home</v-icon>
          </v-tab>
          <v-tab ripple>
            Head Information
            <v-icon>person</v-icon>
          </v-tab>
          <v-tab ripple>
            Educational Information
            <v-icon>school</v-icon>
          </v-tab>
          <v-tab ripple>
            Environment Information
            <v-icon>nature_people</v-icon>
          </v-tab>
          <v-tab ripple>
            Health Information
            <v-icon>local_hospital</v-icon>
          </v-tab>
        </v-tabs>

        <v-tabs-items v-model="tabs">
          <v-tab-item value="0">
            <v-card flat>
              <v-card-text> sdsddsdsds</v-card-text>
            </v-card>
          </v-tab-item>
        </v-tabs-items>

      </v-form>
    </v-dialog>

    <v-dialog v-model="dialog1" max-width="800px">
      <v-card>
        <v-card-title>INHABITANTS</v-card-title>
        <v-data-table :headers="headers1" :items="householdInfo" class="elevation-1">
          <template v-slot:items="props">
            <td>{{ props.item.first_name }}</td>
            <td>{{ props.item.middle_name }}</td>
            <td>{{ props.item.last_name }}</td>
            <td>{{ props.item.relation_to_the_head }}</td>
          </template>
        </v-data-table>
      </v-card>
    </v-dialog>

    <v-toolbar flat color="white">
      <v-toolbar-title>HOUSEHOLD</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-menu :close-on-content-click="false" offset-y max-height="400px">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark v-on="on">Columns</v-btn>
        </template>
        <v-list>
          <v-list-tile v-for="(item, index) in headers" :key="index">
            <v-switch
              color="green"
              v-bind:label="item.text"
              v-model="item.selected"
              :value="item.selected"
            ></v-switch>
          </v-list-tile>
        </v-list>
      </v-menu>
      <v-btn color="primary" dark @click="newDialog()">New</v-btn>
    </v-toolbar>

    <v-data-table v-bind:headers="filteredHeaders" :items="households" :loading="loading">
      <template v-slot:items="props">
        <td v-if="showColumn('id')">{{ props.item.id }}</td>
        <td v-if="showColumn('house_number')">{{ props.item.house_number }}</td>
        <td v-if="showColumn('barangay')">{{ props.item.barangay }}</td>
        <td v-if="showColumn('email_address')">{{ props.item.email_address }}</td>
        <td v-if="showColumn('purok')">{{ props.item.purok }}</td>
        <td v-if="showColumn('place_of_origin')">{{ props.item.place_of_origin }}</td>
        <td v-if="showColumn('mobile_number')">{{ props.item.mobile_number }}</td>
        <td v-if="showColumn('street')">{{ props.item.street }}</td>
        <td v-if="showColumn('ethnic_group')">{{ props.item.ethnic_group }}</td>
        <td v-if="showColumn('telephone_no')">{{ props.item.telephone_no }}</td>
        <td
          v-if="showColumn('status_of_ownership_house')"
        >{{ props.item.status_of_ownership_house }}</td>
        <td v-if="showColumn('status_of_ownership_lot')">{{ props.item.status_of_ownership_lot }}</td>
        <td
          v-if="showColumn('type_of_dwelling_structure')"
        >{{ props.item.type_of_dwelling_structure }}</td>
        <td v-if="showColumn('actions')">
          <v-icon small class="mr-2" @click="showHousehold(props.item.id)">remove_red_eye</v-icon>
          <v-icon small class="mr-2" @click="editDialog(props.item)">edit</v-icon>
          <v-icon small @click="archiveHousehold(props.item.id)">archive</v-icon>
        </td>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
    headers: [
      { text: "id", value: "id" },
      { text: "House Number", value: "house_number", selected: true },
      { text: "Barangay", value: "barangay", selected: true },
      { text: "Email Address", value: "email_address", selected: true },
      { text: "Purok", value: "purok", selected: true },
      { text: "Place of Origin", value: "place_of_origin", selected: true },
      { text: "Mobile Number", value: "mobile_number", selected: true },
      { text: "Street", value: "street", selected: true },
      { text: "Ethnic Group", value: "ethnic_group", selected: true },
      { text: "Telephone No.", value: "telephone_no", selected: true },
      {
        text: "Status of Ownership-House",
        value: "status_of_ownership_house",
        selected: true
      },
      {
        text: "Status of Ownership-Lot",
        value: "status_of_ownership_lot",
        selected: true
      },
      {
        text: "Type of Dwelling Structure",
        value: "type_of_dwelling_structure",
        selected: true
      },
      { text: "Actions", value: "actions", sortable: false, selected: true }
    ],
    headers1: [
      {
        text: "First name",
        value: "first_name"
      },
      {
        text: "Middle name",
        value: "middle_name"
      },

      {
        text: "Last name",
        value: "last_name"
      },
      {
        text: "Relation to The Head",
        value: "relation_to_the_head"
      }
    ],
    households: [],
    householdInfo: [],
    loading: false,
    dialog: false,
    dialog1: false,
    editmode: false,
    form: new Form({
      id: "",
      house_number: "",
      barangay: "",
      email_address: "",
      purok: "",
      place_of_origin: "",
      mobile_number: "",
      street: "",
      ethnic_group: "",
      telephone_no: "",
      status_of_ownership_house: "",
      status_of_ownership_lot: "",
      type_of_dwelling_structure: ""
    })
  }),

  computed: {
    filteredHeaders() {
      return this.headers.filter(h => h.selected);
    },

    filteredItems() {
      return this.items.map(item => {
        let filtered = Object.assign({}, item);
        this.headers.forEach(header => {
          if (!header.selected) delete filtered[header.value];
        });
        return filtered;
      });
    }
  },

  created() {
    this.getHousehold();
  },

  methods: {
    getHousehold() {
      this.loading = true;
      axios.get("api/household").then(response => {
        this.households = response.data;
        this.loading = false;
      });
    },

    showHousehold(id) {
      axios.get("api/household/" + id).then(response => {
        this.householdInfo = response.data;
        this.dialog1 = true;
      });
    },

    createHousehold() {
      this.form
        .post("api/household")
        .then(() => {
          this.dialog = false;
          this.getHousehold();
        })
        .catch(() => {});
    },

    updateHousehold() {
      this.form
        .put("api/household/" + this.form.id)
        .then(() => {
          this.dialog = false;
        })
        .catch(() => {});
    },

    editDialog(households) {
      this.editmode = true;
      this.form.reset();
      this.dialog = true;
      this.form.fill(households);
    },

    newDialog() {
      this.editmode = false;
      this.form.reset();
      this.dialog = true;
    },

    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    }
  }
};
</script>
