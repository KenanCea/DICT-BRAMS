<template>
  <div>
    <v-app-bar
      id="navbar"
      dense
      flat
      app
      :color="selected.length ? 'blue lighten-5 blue--text' : 'white'"
    >
      <v-toolbar-title>

        <span v-if="selected.length">
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" icon color="primary" @click="selected = []">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </template>
            <span>Clear selected</span>
          </v-tooltip>
        </span>

        <span>{{ selected.length ? `#${selected[0].house_no} ${selected[0].street}, ${address[0].name}, ${address[0].municipality}, ${address[0].province}, Philippines` : 'Inhabitants' }}</span>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <v-flex xs12 sm6 md2>
        <v-text-field
          :color="selected.length ? 'primary' : ''"
          v-model="search"
          v-show="searchInput"
          label="Search"
          single-line
          hide-details
          autofocus
        ></v-text-field>
      </v-flex>

      <v-tooltip bottom>
        <template v-slot:activator="{ on }">
          <v-btn :color="selected.length ? 'primary' : ''" v-on="on" text icon @click="toggle()">
            <v-icon>mdi-magnify</v-icon>
          </v-btn>
        </template>
        <span>Search</span>
      </v-tooltip>

      <div v-if="!selected.length">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="toggle()">
              <v-icon>mdi-home-plus</v-icon>
            </v-btn>
          </template>
          <span>Add New Household</span>
        </v-tooltip>
      </div>

      <div v-if="!selected.length">
        <v-menu :close-on-content-click="false" offset-y max-height="400">
          <template #activator="{ on: menu }">
            <v-tooltip bottom>
              <template #activator="{ on: tooltip }">
                <v-btn icon color="primary" v-on="{ ...tooltip, ...menu }">
                  <v-icon>mdi-table-column</v-icon>
                </v-btn>
              </template>
              <span>Column Visibility</span>
            </v-tooltip>
          </template>
          <v-list>
            <v-list-item v-for="(item, index) in headers" :key="index">
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

      <div v-if="selected.length">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" v-if="selected.length" icon color="primary">
              <v-icon>mdi-account-plus</v-icon>
            </v-btn>
          </template>
          <span>Add New Inhabitant</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" v-if="selected.length" icon color="primary">
              <v-icon>mdi-file-plus</v-icon>
            </v-btn>
          </template>
          <span>Issue Barangay Clearance</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" v-if="selected.length" icon color="primary">
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
          </template>
          <span>Edit</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" v-if="selected.length" icon color="primary">
              <v-icon>mdi-archive</v-icon>
            </v-btn>
          </template>
          <span>Archive</span>
        </v-tooltip>
      </div>
    </v-app-bar>

    <v-dialog v-model="dialogHousehold" persistent scrollable max-width="800px">
      <v-form @submit.prevent="editmode ? updateHousehold() : createHousehold()">
        <v-card>
          <v-card-title>
            <span class="headline" v-show="!editmode">Add Household</span>
            <span class="headline" v-show="editmode">Edit Household Information</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.solo_parent"
                    :items="['no','Death of spouse','Imprisonment of spouse of at least 1 year','Mental/physical incapacity of spouse','Legal or de facto separation from spouse for at least 1 year','Abandonment of spouse for at least 1 year','Unmarried mother/father who preferred to keep the child instead of others carrying him/her','Any other person who solely provides parental care and support to a child provided he/she is duly licensed foster parent of DSWD','Any family member who assumes the responsibility as head of the family as a result of death, abandonment, absence for at least one year','others']"
                    label="Solo Parent"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.solo_parent_others" label="Solo Parent Others"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-menu
                    v-model="calendarSurvey"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    eager
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-model="form.dateOfSurvey"
                        label="Date of Survey"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="form.dateOfSurvey"
                      no-title
                      color="primary"
                      @input="calendarSurvey = false"
                    ></v-date-picker>
                  </v-menu>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.familysize" type="number" label="Family Size"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.house_no" type="number" label="House Number"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.email_address" label="Email Address"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.purok" type="number" label="Purok"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.placeOfOrigin" label="Place of Origin"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.mobile_no" label="Mobile Number"></v-text-field>
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
                  <v-select
                    v-model="form.dialects"
                    :items="['Bicolano','Bontoc','Cebuano','English','Ibaloi','Ibanag','Ifugao','Ilocano','Itneg','Kalinga','Kankana-ey','Pampangan','Pangasinan','Tagalog','Waray-waray','Panggalatok','Visaya','Kapangpangan']"
                    label="Dialects"
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
                  <v-text-field
                    v-model="form.status_of_ownership_house_others"
                    label="Status of Ownership-House Others"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.status_of_ownership_lot"
                    :items="['Owned','Rented','Caretaker','Others']"
                    label="Status of Ownership-Lot"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="form.status_of_ownership_lot_others"
                    label="Status of Ownership-Lot Others"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.type_of_dwelling_structure"
                    :items="['Permanent Concrete','Semi Permanent','Temporary']"
                    label="Type of Dwelling Structure"
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.lighting_source"
                    :items="['Electricity','Solar','Petromax','Kerosene']"
                    label="Lighting Source"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.sources_of_info"
                    :items="['Television','Radio','Newspaper','Others']"
                    label="Sources of Info"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="form.sources_of_info_others"
                    label="Sources of Info Others"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.communication_services"
                    :items="['Cell sites/Net','Internet','Telephone','Postal services','others']"
                    label="Communication Services"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="form.communication_services_others"
                    label="Communication Services Others"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.means_of_transportation"
                    :items="['PU jeep',' Taxi','Tricycle','PU bus','Private car','others']"
                    label="Means of Transportation"
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="form.means_of_transportation_others"
                    label="Means of Transportation Others"
                  ></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog=false">Cancel</v-btn>
            <v-btn color="blue darken-1" text type="submit">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>

    <v-data-table
      v-model="selected"
      v-bind:headers="filteredHeaders"
      :items="households"
      :search="search"
      :loading="loading"
      item-key="id"
      show-select
      single-select
    >
      <template v-slot:items="props">
        <td v-if="showColumn('id')">{{ props.item.id }}</td>
        <td v-if="showColumn('house_no')">{{ props.item.house_no }}</td>
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
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      households: [],
      inhabitants: [],
      address: [],
      dialogHousehold: false,
      editmode: false,
      selected: [],
      searchInput: false,
      calendarSurvey: false,
      search: "",
      form: new Form({
        id: "",
        solo_parent: "",
        solo_parent_others: "",
        dateOfSurvey: "",
        familysize: "",
        house_no: "",
        purok: "",
        street: "",
        type_of_dwelling_structure: "",
        placeOfOrigin: "",
        ethnic_group: "",
        email_address: "",
        mobile_no: "",
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
      headers: [
        { text: "House Number", value: "house_no", selected: true },
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
        { text: "Familysize", value: "familysize" },
        { text: "PlaceOfOrigin", value: "placeOfOrigin" },
        { text: "Mobile no", value: "mobile_no" },
        { text: "Dialects", value: "dialects" },
        {
          text: "Status of ownership house others",
          value: "status_of_ownership_house_others"
        },
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
      ]
    };
  },

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
    this.getHouseholds();
    this.getAddress();
  },

  methods: {
    getHouseholds() {
      this.loading = true;
      axios.get("api/household").then(response => {
        this.households = response.data;
        this.loading = false;
      });
    },
    getAddress() {
      axios.get("api/address").then(response => {
        this.address = response.data;
      });
    },
    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    },
    toggle: function() {
      this.searchInput = !this.searchInput;
      this.autofucos;
    }
  }
};
</script>