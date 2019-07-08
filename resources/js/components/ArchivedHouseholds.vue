<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span>{{ selected.length ? `#${selected[0].house_no} ${selected[0].street}, ${address[0].name}, ${address[0].municipality}` : 'Households' }}</span>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <span v-if="selected.length">
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="selected = []">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </template>
          <span>Clear selected</span>
        </v-tooltip>
      </span>

      <div v-if="selected.length">
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="editHouseholdDialog(selected[0])">
              <v-icon>mdi-eye</v-icon>
            </v-btn>
          </template>
          <span>Edit household</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length" class="ml-1">
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="restore(selected[0].id)">
              <v-icon>mdi-package-up</v-icon>
            </v-btn>
          </template>
          <span>Restore household</span>
        </v-tooltip>
      </div>

      <v-divider class="mx-1" inset vertical></v-divider>

      <div class="ml-1">
        <v-menu :close-on-content-click="false" offset-y max-height="400">
          <template #activator="{ on: menu }">
            <v-tooltip attach bottom>
              <template #activator="{ on: tooltip }">
                <v-btn icon v-on="{ ...tooltip, ...menu }">
                  <v-icon>mdi-table-column-width</v-icon>
                </v-btn>
              </template>
              <span>Column visibility</span>
            </v-tooltip>
          </template>
          <v-list>
            <v-list-item v-for="(item, index) in headersHouseholds" :key="index">
              <v-switch
                color="green"
                v-bind:label="item.text"
                v-model="item.selected"
                :value="item.selected"
              ></v-switch>
            </v-list-item>
          </v-list>
        </v-menu>
      </div>

      <v-flex xs2 ml-1>
        <v-text-field
          v-model="search"
          flat
          outlined
          single-line
          hide-details
          height="32"
          append-icon="mdi-magnify"
          label="Search"
        ></v-text-field>
      </v-flex>
    </v-app-bar>

    <v-dialog v-model="dialogHousehold" persistent scrollable max-width="800px">
      <v-form ref="householdForm" v-model="validhouseholdForm">
        <v-card>
          <v-card-title>
            <span class="headline">Household</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md pa-0>
              <v-layout wrap>
                <v-flex xs12 md4>
                  <v-text-field v-model="householdForm.room_no" label="Room number" readonly></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field v-model="householdForm.house_no" label="House number*" readonly></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field v-model="householdForm.purok" label="Purok*" readonly></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field v-model="householdForm.street" label="Street*" readonly></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.telephone_no"
                    label="Telephone number"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.dateOfSurvey"
                    label="Date of survey*"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.placeOfOrigin"
                    label="Place of origin*"
                    readonly
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field v-model="householdForm.ethnic_group" label="Ethnic group*" readonly></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field v-model="householdForm.dialects" label="Dialects*" readonly></v-text-field>
                </v-flex>
                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.Total_family_income"
                    label="Total family income"
                    readonly
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.Final_family_income"
                    label="Final family income"
                    readonly
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 md4>
                  <v-text-field v-model="householdForm.solo_parent" label="Solo parent*" readonly></v-text-field>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.solo_parent === 'Others'">
                  <v-text-field
                    v-model="householdForm.solo_parent_others"
                    label="Solo parent others"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.status_of_ownership_house"
                    label="Status of ownership-house*"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.status_of_ownership_house === 'Others'">
                  <v-text-field
                    v-model="householdForm.status_of_ownership_house_others"
                    label="Status of ownership-house others"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.status_of_ownership_lot"
                    label="Status of ownership-lot*"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.status_of_ownership_lot === 'Others'">
                  <v-text-field
                    v-model="householdForm.status_of_ownership_lot_others"
                    label="Status of ownership-lot others"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.type_of_dwelling_structure"
                    label="Type of dwelling structure*"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.type_of_dwelling"
                    label="Type of dwelling*"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.lighting_source"
                    label="Lighting source*"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.sources_of_info"
                    label="Sources of info*"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.sources_of_info === 'Others'">
                  <v-text-field
                    v-model="householdForm.sources_of_info_others"
                    label="Sources of info others"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.communication_services"
                    label="Communication services*"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.communication_services === 'Others'">
                  <v-text-field
                    v-model="householdForm.communication_services_others"
                    label="Communication services others"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.means_of_transportation"
                    label="Means of transportation*"
                    readonly
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.means_of_transportation === 'Others'">
                  <v-text-field
                    v-model="householdForm.means_of_transportation_others"
                    label="Means of transportation others"
                    readonly
                  ></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <p class="mb-0">* indicates required field</p>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialogHousehold=false">Cancel</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>

    <v-data-table
      v-model="selected"
      v-bind:headers="filteredHeaders"
      :items="households"
      :search="search"
      :loading="loadingHouseholds"
      show-select
      single-select
    >
      <template v-slot:items="props">
        <td v-if="showColumn('id')">{{ props.item.id }}</td>
        <td v-if="showColumn('house_no')">{{ props.item.house_no }}</td>
        <td v-if="showColumn('solo_parent')">{{ props.item.solo_parent }}</td>
        <td v-if="showColumn('solo_parent_others')">{{ props.item.solo_parent_others }}</td>
        <td v-if="showColumn('dateOfSurvey')">{{ props.item.dateOfSurvey }}</td>
        <td v-if="showColumn('placeOfOrigin')">{{ props.item.placeOfOrigin }}</td>
        <td v-if="showColumn('email_address')">{{ props.item.email_address }}</td>
        <td v-if="showColumn('mobile_no')">{{ props.item.mobile_no }}</td>
        <td v-if="showColumn('dialects')">{{ props.item.dialects }}</td>
        <td v-if="showColumn('purok')">{{ props.item.purok }}</td>
        <td v-if="showColumn('place_of_origin')">{{ props.item.place_of_origin }}</td>
        <td v-if="showColumn('mobile_number')">{{ props.item.mobile_number }}</td>
        <td v-if="showColumn('street')">{{ props.item.street }}</td>
        <td v-if="showColumn('lighting_source')">{{ props.item.lighting_source }}</td>
        <td v-if="showColumn('ethnic_group')">{{ props.item.ethnic_group }}</td>
        <td v-if="showColumn('Total_family_income')">{{ props.item.Total_family_income }}</td>
        <td v-if="showColumn('Final_family_income')">{{ props.item.Final_family_income }}</td>
        <td
          v-if="showColumn('means_of_transportation_others')"
        >{{ props.item.means_of_transportation_others }}</td>
        <td v-if="showColumn('remarks')">{{ props.item.remarks }}</td>
        <td v-if="showColumn('sources_of_info')">{{ props.item.sources_of_info }}</td>
        <td v-if="showColumn('sources_of_info_others')">{{ props.item.sources_of_info_others }}</td>
        <td v-if="showColumn('telephone_no')">{{ props.item.telephone_no }}</td>
        <td v-if="showColumn('means_of_transportation')">{{ props.item.means_of_transportation }}</td>
        <td v-if="showColumn('communication_services')">{{ props.item.communication_services }}</td>
        <td
          v-if="showColumn('communication_services_others')"
        >{{ props.item.communication_services_others }}</td>

        <td v-if="showColumn('type_of_dwelling')">{{ props.item.type_of_dwelling }}</td>
        <td
          v-if="showColumn('status_of_ownership_house')"
        >{{ props.item.status_of_ownership_house }}</td>
        <td
          v-if="showColumn('status_of_ownership_house_others')"
        >{{ props.item.status_of_ownership_house_others }}</td>
        <td v-if="showColumn('status_of_ownership_lot')">{{ props.item.status_of_ownership_lot }}</td>
        <td
          v-if="showColumn('status_of_ownership_lot_others')"
        >{{ props.item.status_of_ownership_lot_others }}</td>
        <td
          v-if="showColumn('type_of_dwelling_structure')"
        >{{ props.item.type_of_dwelling_structure }}</td>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      Table: "Households",
      Orientation: "landscape",
      households: [],
      address: [],
      selected: [],
      dialogHousehold: false,
      search: "",
      menuSettled: false,
      menuHeight: false,
      householdForm: new Form({
        id: "",
        solo_parent: "",
        solo_parent_others: "",
        dateOfSurvey: "",
        familysize: "",
        room_no: "",
        house_no: "",
        purok: "",
        street: "",
        Total_family_income: "",
        Final_family_income: "",
        type_of_dwelling_structure: "",
        placeOfOrigin: "",
        ethnic_group: "",
        telephone_no: "",
        dialects: "",
        status_of_ownership_house: "",
        status_of_ownership_house_others: "",
        status_of_ownership_lot: "",
        status_of_ownership_lot_others: "",
        type_of_dwelling: "",
        lighting_source: "",
        sources_of_info: "",
        sources_of_info_others: "",
        communication_services: "",
        communication_services_others: "",
        means_of_transportation: "",
        means_of_transportation_others: ""
      }),
      headersHouseholds: [
        {
          text: "House Number",
          value: "house_no",
          selected: true
        },
        { text: "Purok", value: "purok", selected: true },
        { text: "Street", value: "street", selected: true },
        { text: "Email Address", value: "email_address" },
        { text: "Place of Origin", value: "place_of_origin" },
        { text: "Mobile Number", value: "mobile_number" },
        { text: "Ethnic Group", value: "ethnic_group" },
        { text: "Telephone No.", value: "telephone_no" },
        { text: "Solo parent", value: "solo_parent" },
        { text: "Solo parent others", value: "solo_parent_others" },
        { text: "DateOfSurvey", value: "dateOfSurvey" },
        { text: "PlaceOfOrigin", value: "placeOfOrigin" },
        { text: "Mobile no", value: "mobile_no" },
        { text: "Dialects", value: "dialects" },
        {
          text: "Status of ownership house others",
          value: "status_of_ownership_house_others"
        },
        { text: "Total Family Income", value: "Total_family_income" },
        { text: "Final Family Income", value: "Final_family_income" },
        {
          text: "Status of ownership lot others",
          value: "status_of_ownership_lot_others"
        },
        { text: "Type of dwelling", value: "type_of_dwelling" },
        { text: "Lighting source", value: "lighting_source" },
        { text: "Sources of info", value: "sources_of_info" },
        { text: "Sources of info others", value: "sources_of_info_others" },
        { text: "Communication services", value: "communication_services" },
        {
          text: "Communication services others",
          value: "communication_services_others"
        },
        { text: "Means of transportation", value: "means_of_transportation" },
        { text: "Remarks", value: "remarks", selected: true },
        {
          text: "Means of transportation others",
          value: "means_of_transportation_others"
        },
        {
          text: "Status of Ownership-House",
          value: "status_of_ownership_house"
        },
        {
          text: "Status of Ownership-Lot",
          value: "status_of_ownership_lot"
        },
        {
          text: "Type of Dwelling Structure",
          value: "type_of_dwelling_structure"
        },
        { text: "id", value: "id" }
      ],
      headersInhabitants: [
        { text: "First name", value: "first_name" },
        { text: "Middle name", value: "middle_name" },
        { text: "Last name", value: "last_name" },
        { text: "Relation to The Head", value: "relation_to_the_head" }
      ]
    };
  },
  computed: {
    filteredHeaders() {
      return this.headersHouseholds.filter(h => h.selected);
    },

    filteredItems() {
      return this.items.map(item => {
        let filtered = Object.assign({}, item);
        this.headersHouseholds.forEach(header => {
          if (!header.selected) delete filtered[header.value];
        });
        return filtered;
      });
    }
  },

  created() {
    this.getHouseholds();
    this.getAddress();
  },

  methods: {
    getHouseholds() {
      this.loadingHouseholds = true;
      axios.get("api/archivedHousehold").then(response => {
        this.households = response.data;
        this.loadingHouseholds = false;
      });
    },
    getAddress() {
      axios.get("api/address").then(response => {
        this.address = response.data;
      });
    },
    restore(id) {
      swal
        .fire({
          title: "Restore?",
          text: "Only the household will be restored!",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, restore it!"
        })
        .then(result => {
          if (result.value) {
            axios.post("api/households/restore/" + id).then(response => {
              toast.fire({
                type: "success",
                title: "archived Household has been restored."
              });
              this.getHouseholds();
              this.selected.splice([0]);
            });
          }
        });
    },
    showColumn(col) {
      return this.headersHouseholds.find(h => h.value === col).selected;
    },
    editHouseholdDialog(households) {
      this.householdForm.reset();
      this.dialogHousehold = true;
      this.householdForm.fill(households);
    }
  }
};
</script>