<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span>{{ selected.length ? `#${selected[0].house_no} ${selected[0].street}, ${address[0].name}, ${address[0].municipality}, ${address[0].province}` : 'Households' }}</span>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <span v-if="selected.length">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="selected = []">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </template>
          <span>Clear selected</span>
        </v-tooltip>
      </span>

      <v-divider v-if="selected.length" class="ml-1" inset vertical></v-divider>

      <div v-if="selected.length" class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" v-if="selected.length" icon @click="createInhabitant(selected[0].id)">
              <v-icon>mdi-account-plus</v-icon>
            </v-btn>
          </template>
          <span>Add new inhabitant</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length" class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" v-if="selected.length" icon @click="showInhabitants(selected[0].id)">
              <v-icon>mdi-account-network</v-icon>
            </v-btn>
          </template>
          <span>View inhabitants</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length" class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" v-if="selected.length" icon @click="editDialog(selected[0])">
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
          </template>
          <span>Edit household</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length" class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" v-if="selected.length" icon @click="archive(selected[0].id)">
              <v-icon>mdi-archive</v-icon>
            </v-btn>
          </template>
          <span>Archive household</span>
        </v-tooltip>
      </div>

      <div class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="newDialog()">
              <v-icon>mdi-home-plus</v-icon>
            </v-btn>
          </template>
          <span>Add new household</span>
        </v-tooltip>
      </div>

      <div class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon>
              <v-icon>mdi-folder-account</v-icon>
            </v-btn>
          </template>
          <span>View all inhabitants</span>
        </v-tooltip>
      </div>

      <v-divider class="ml-1" inset vertical></v-divider>

      <div class="ml-1">
        <v-menu :close-on-content-click="false" offset-y max-height="400">
          <template #activator="{ on: menu }">
            <v-tooltip bottom>
              <template #activator="{ on: tooltip }">
                <v-btn icon v-on="{ ...tooltip, ...menu }">
                  <v-icon>mdi-table-column-width</v-icon>
                </v-btn>
              </template>
              <span>Column visibility</span>
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

      <v-flex xs12 sm6 md2 ml-1>
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
      <v-form @submit.prevent="editmode ? updateHousehold() : createHousehold()">
        <v-card>
          <v-card-title>
            <span class="headline" v-show="!editmode">Add household</span>
            <span class="headline" v-show="editmode">Edit household information</span>
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
                    required
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
                  <v-text-field v-model="form.house_no" mask="####" label="House Number"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.email_address" label="Email Address"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.purok" mask="###" label="Purok"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.placeOfOrigin" label="Place of Origin"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.mobile_no" mask="###########" label="Mobile Number"></v-text-field>
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
                  <v-text-field
                    v-model="form.telephone_no"
                    mask="###########"
                    label="Telephone No."
                  ></v-text-field>
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
                    v-model="form.type_of_dwelling"
                    :items="['Permanent Concrete','Semi Permanent','Temporary']"
                    label="Type of Dwelling "
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
            <v-btn color="blue darken-1" text @click="dialogHousehold=false">Cancel</v-btn>
            <v-btn color="blue darken-1" text type="submit">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>

    <v-dialog v-model="dialogInhabitants" scrollable max-width="800px">
      <v-card>
        <v-card-title>
          <span class="title">Inhabitants</span>
        </v-card-title>
        <v-card-text class="pa-0">
          <v-data-table :headers="headersInhabitants" :items="inhabitantsList">
            <template v-slot:items="props">
              <td>{{ props.item.first_name }}</td>
              <td>{{ props.item.middle_name }}</td>
              <td>{{ props.item.last_name }}</td>
              <td>{{ props.item.relation_to_the_head }}</td>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-data-table
      v-model="selected"
      v-bind:headers="filteredHeaders"
      :items="households"
      :search="search"
      :loading="loading"
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
        <td v-if="showColumn('means_of_transportation_others')">{{ props.item.means_of_transportation_others }}</td>
        <td v-if="showColumn('sources_of_info')">{{ props.item.sources_of_info }}</td>
        <td v-if="showColumn('sources_of_info_others')">{{ props.item.sources_of_info_others }}</td>
        <td v-if="showColumn('telephone_no')">{{ props.item.telephone_no }}</td>
        <td v-if="showColumn('means_of_transportation')">{{ props.item.means_of_transportation }}</td>
        <td v-if="showColumn('communication_services')">{{ props.item.communication_services }}</td>
        <td v-if="showColumn('communication_services_others')">{{ props.item.communication_services_others }}</td>
        
        <td v-if="showColumn('type_of_dwelling')">{{ props.item.type_of_dwelling }}</td>
        <td
          v-if="showColumn('status_of_ownership_house')"
        >{{ props.item.status_of_ownership_house }}</td>
        <td
          v-if="showColumn('status_of_ownership_house_others')"
        >{{ props.item.status_of_ownership_house_others }}</td>
        <td v-if="showColumn('status_of_ownership_lot')">{{ props.item.status_of_ownership_lot }}</td>
        <td v-if="showColumn('status_of_ownership_lot_others')">{{ props.item.status_of_ownership_lot_others }}</td>
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
      dialogInhabitants: false,
      inhabitantsList: [],
      editmode: false,
      selected: [],
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
        {
          text: "House Number",
          value: "house_no",
          selected: true
        },
        { text: "Purok", value: "purok", selected: true },
        { text: "Street", value: "street", selected: true },
        { text: "Familysize", value: "familysize", selected: true },
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
    showInhabitants(id) {
      axios.get("api/household/" + id).then(response => {
        this.inhabitantsList = response.data;
        this.dialogInhabitants = true;
      });
    },
    createHousehold() {
      this.form
        .post("api/household")
        .then(() => {
          this.dialogHousehold = false;
          this.getHouseholds();
          toast.fire({
            type: "success",
            title: "Household has been created"
          });
        })
        .catch(() => {});
    },
    updateHousehold() {
      this.form
        .put("api/household/" + this.form.id)
        .then(() => {
          this.dialogHousehold = false;
          this.getHouseholds();
          toast.fire({
            type: "success",
            title: "Household has been edited"
          });
        })
        .catch(() => {});
    },
    archive(id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "Inhabitants in this household will also be archived!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, archive it!"
        })
        .then(result => {
          if (result.value) {
            axios.post("api/households/archived/" + id).then(response => {
              swal.fire("Archived!", "Household has been archived.", "success");
              this.getHouseholds();
              this.selected.splice([0]);
            });
          }
        });
    },
    newDialog() {
      this.editmode = false;
      this.form.reset();
      this.dialogHousehold = true;
    },
    editDialog(households) {
      this.editmode = true;
      this.form.reset();
      this.dialogHousehold = true;
      this.form.fill(households);
    },
    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    }
  }
};
</script>