<template>
  <v-app>
    <v-container>
      <v-layout row wrap>
        <v-card>
          <v-card-title class="pb-0">
            <h1 class="font-weight-light">Household</h1>
            <v-divider class="ma-2" vertical></v-divider>
            <v-spacer></v-spacer>
            <v-text-field v-model="search" prepend-inner-icon="search" label="Search"></v-text-field>
            <v-menu v-model="menu" :close-on-content-click="false" offset-y>
              <v-btn slot="activator" color="primary" dark>Column</v-btn>
              <v-list>
                <v-list-tile v-for="(item, index) in headers" :key="index">
                  <v-switch></v-switch>
                  <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                </v-list-tile>
              </v-list>
              <v-btn flat @click="menu = false">Cancel</v-btn>
              <v-btn color="primary" flat @click="menu = false">Save</v-btn>
            </v-menu>
          </v-card-title>
          <v-dialog v-model="dialog" scrollable>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text>
                <v-container grid-list-md>
                  <v-layout wrap>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.name" label="Dessert name"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>
              <v-divider></v-divider>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="close">Cancel</v-btn>
                <v-btn color="primary" @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-divider></v-divider>
          <v-data-table
            :headers="headers"
            :items="members"
            :search="search"
            item-key="name"
            class="fixed-header"
          >
            <template class="tableData" slot="items" slot-scope="props">
              <td>{{ props.item.id }}</td>
              <td>{{ props.item.first_name }}</td>
              <td>{{ props.item.middle_name }}</td>
              <td>{{ props.item.family_name }}</td>
              <td>{{ props.item.sex }}</td>
              <td>{{ props.item.created_at }}</td>
              <td>{{ props.item.updated_at }}</td>
              <td>{{ props.item.region_barangay }}</td>
              <td>{{ props.item.relation_to_head }}</td>
              <td>{{ props.item.placeOfBirth }}</td>
              <td>{{ props.item.dateOfBirth }}</td>
              <td>{{ props.item.email_add }}</td>
              <td>{{ props.item.mobile_no }}</td>
              <td>{{ props.item.telephone_no }}</td>
              <td>{{ props.item.civilStatus }}</td>
              <td>{{ props.item.citizenship }}</td>
              <td>{{ props.item.religion }}</td>
              <td>{{ props.item.schooling }}</td>
              <td>{{ props.item.Highest_educational_attainment }}</td>
              <td>{{ props.item.familyIncome }}</td>
              <td>{{ props.item.statusOfResidency }}</td>
              <td>{{ props.item.ethnicGroup }}</td>
              <td>{{ props.item.height }}</td>
              <td>{{ props.item.weight }}</td>
              <td>{{ props.item.bloodType }}</td>
              <td>{{ props.item.registeredVoterOfTheBrgy }}</td>
              <td>{{ props.item.previousResidence }}</td>
              <td>{{ props.item.no_of_months_and_year_living_in_this_brgy }}</td>
              <td>{{ props.item.reason_you_left_in_previous_brgy }}</td>
              <td>{{ props.item.reason_you_came_in_this_brgy }}</td>
              <td>{{ props.item.until_when_you_stay_in_this_brgy }}</td>
              <td>{{ props.item.who_accompanied_you_to_transfer_here }}</td>
              <td>
                <v-btn color="primary" class="mx-1" fab small dark @click="deleteMember(props.item.id)">
                  <v-icon>delete</v-icon>
                </v-btn>
                <v-btn color="primary" class="mx-1" fab small dark @click="unarchive(props.item.id)">
                  <v-icon>unarchive</v-icon>
                </v-btn>
              </td>
            </template>
          </v-data-table>
        </v-card>
      </v-layout>
    </v-container>
  </v-app>
</template>
<script>
import menu from "./api/menu";
export default {
  data: () => ({
    search: "",
    menu: false,
    exports: [{ title: "Word" }, { title: "PDF" }, { title: "Excel" }],
    dialog: false,
    headers: [
      { text: "ID", value: "id", width: "100px", title: "ID" },
      {
        text: "First name",
        value: "first_name",
        width: "200px",
        title: "First name"
      },
      {
        text: "Middle name",
        value: "middle_name",
        width: "200px",
        title: "Middle name"
      },
      {
        text: "Family name",
        value: "family_name",
        width: "200px",
        title: "Family name"
      },
      { text: "Sex", value: "sex", width: "100px", title: "Sex" },
      {
        text: "Created at",
        value: "created_at",
        width: "200px",
        title: "Created at"
      },
      {
        text: "Updated at",
        value: "updated_at",
        width: "200px",
        title: "Updated at"
      },
      {
        text: "Region",
        value: "region_barangay",
        width: "200px",
        title: "Region"
      },
      {
        text: "Relation to Head",
        value: "relation_to_head",
        width: "200px",
        title: "Relation to Head"
      },
      {
        text: "Place of Birth",
        value: "placeOfBirth",
        width: "200px",
        title: "Place of Birth"
      },
      {
        text: "Date of Birth",
        value: "dateOfBirth",
        width: "200px",
        title: "Date of Birth"
      },
      {
        text: "Email Address",
        value: "email_add",
        width: "200px",
        title: "Email Address"
      },
      {
        text: "Mobile Number",
        value: "mobile_no",
        width: "200px",
        title: "Mobile Number"
      },
      {
        text: "Telephone Number",
        value: "telephone_no",
        width: "200px",
        title: "Telephone Number"
      },
      {
        text: "Civil Status",
        value: "civilStatus",
        width: "200px",
        title: "Civil Status"
      },
      {
        text: "Citizenship",
        value: "citizenship",
        width: "200px",
        title: "Citizenship"
      },
      {
        text: "Religion",
        value: "religion",
        width: "200px",
        title: "Religion"
      },
      {
        text: "Schooling",
        value: "schooling",
        width: "200px",
        title: "Schooling"
      },
      {
        text: "Highest Educational Attainment",
        value: "Highest_educational_attainment",
        width: "200px",
        title: "Highest Educational Attainment"
      },
      {
        text: "Family Income",
        value: "familyIncome",
        width: "200px",
        title: "Family Income"
      },
      {
        text: "Status Of Residency",
        value: "statusOfResidency",
        width: "200px",
        title: "Status Of Residency"
      },
      {
        text: "Ethnic Group",
        value: "ethnicGroup",
        width: "200px",
        title: "Ethnic Group"
      },
      {
        text: "Height",
        value: "height",
        width: "200px",
        title: "Height"
      },
      {
        text: "Weight",
        value: "weight",
        width: "200px",
        title: "Weight"
      },
      {
        text: "Blood Type",
        value: "bloodType",
        width: "200px",
        title: "Blood Type"
      },
      {
        text: "Registered Voter of the Barangay",
        value: "registeredVoterOfTheBrgy",
        width: "200px",
        title: "Registered Voter of the Barangay"
      },
      {
        text: "Previous Residence",
        value: "previousResidence",
        width: "200px",
        title: "Previous Residence"
      },
      {
        text: "No. of months and year living in this Brgy",
        value: "no_of_months_and_year_living_in_this_brgy",
        width: "200px",
        title: "No. of months and year living in this Brgy"
      },
      {
        text: "Reason you left in previous brgy",
        value: "reason_you_left_in_previous_brgy",
        width: "200px",
        title: "Reason you left in previous brgy"
      },
      {
        text: "Reason you came in this brgy",
        value: "reason_you_came_in_this_brgy",
        width: "200px",
        title: "Reason you came in this brgy"
      },
      {
        text: "Until when you stay in this brgy",
        value: "until_when_you_stay_in_this_brgy",
        width: "200px",
        title: "Until when you stay in this brgy"
      },
      {
        text: "Accompanied you to transfer here",
        value: "who_accompanied_you_to_transfer_here",
        width: "200px",
        title: "Accompanied you to transfer here"
      },
      {
        text: "Actions",
        value: "name",
        sortable: false,
        fixed: true,
        width: "200px",
        title: "Actions"
      }
    ],
    members: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    },
    defaultItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    }
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Inhabitant" : "Edit Item";
    }
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  created() {
    this.loadMember();
    Fire.$on("AfterDo", () => {
      this.loadMember();
    });
  },
  methods: {
    loadMember() {
      this.$Progress.start();
      axios.get("api/member/archived").then(({ data }) => {
        this.members = data.data;
        this.$Progress.finish();
      });
    },
    deleteMember(id) {
      swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          axios
            .delete("api/member/" + id)
            .then(() => {
              swal("Deleted!", "Member has been deleted.", "success");
              Fire.$emit("AfterDo");
              this.$Progress.finish();
            })
            .catch(() => {
              this.$Progress.fail();
              swal("Failed!", "There was something wrong.", "warning");
            });
        }
      });
    },
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    }, 
    unarchive(id) {
      swal({
        title: "Are you sure?",
        text: "This will return the member to the Inhabitant",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          axios
            .post("api/member/archived/"+ id )
            .then(() => {
              swal("Unarchived!", "Member has been returned.", "success");
              Fire.$emit("AfterDo");
              this.$Progress.finish();
            })
            .catch(() => {
              this.$Progress.fail();
              swal("Failed!", "There was something wrong.", "warning");
            });
        }
      });
    },
    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    },
  }
};
</script>