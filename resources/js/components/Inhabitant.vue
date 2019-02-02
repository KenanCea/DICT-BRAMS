<template>
  <v-app>
    <v-container>
      <v-layout row wrap>
        <v-card>
          <v-card-title class="pb-0">
            <h1 class="font-weight-light">Inhabitant</h1>
            <v-divider class="ma-2" vertical></v-divider>
            <v-spacer></v-spacer>
            <v-text-field v-model="search" prepend-inner-icon="search" label="Search"></v-text-field>
            <v-menu offset-y>
              <v-btn slot="activator" flat color="blue darken-3" dark>Export</v-btn>
              <v-list>
                <v-list-tile v-for="(item, index) in exports" :key="index">
                  <button @click="exporting(item.title)">
                    <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                  </button>
                </v-list-tile>
              </v-list>
            </v-menu>
            <v-btn dark @click="dialog = true" flat color="blue darken-3">Column</v-btn>
            <v-btn @click="dialog1 = true" absolute dark fab top right color="indigo">
              <v-icon>add</v-icon>
            </v-btn>
          </v-card-title>
          <v-dialog v-model="dialog" scrollable persistent no-click-animation max-width="450px">
            <v-card>
              <v-card-title>Select Column</v-card-title>
              <v-divider></v-divider>
              <v-card-text style="height: 300px;" class="pt-0">
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
              </v-card-text>
              <v-divider></v-divider>
              <v-card-actions>
                <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-dialog v-model="dialog1" max-width="500px">
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>
              <v-card-text>
                <v-container grid-list-md>
                  <v-layout wrap>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.first_name" label="First name"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.middle_name" label="Middle name"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.family_name" label="Family name"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.sex" label="Sex"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.region_barangay" label="Region"></v-text-field>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
                <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-divider></v-divider>
          <v-data-table
            v-bind:headers="filteredHeaders"
            :items="members"
            :search="search"
            item-key="name"
            class="fixed-header"
          >
            <template class="tableData" slot="items" slot-scope="props">
              <td v-if="showColumn('id')">{{ props.item.id }}</td>
              <td v-if="showColumn('first_name')">{{ props.item.first_name }}</td>
              <td v-if="showColumn('middle_name')">{{ props.item.middle_name }}</td>
              <td v-if="showColumn('family_name')">{{ props.item.family_name }}</td>
              <td v-if="showColumn('sex')">{{ props.item.sex }}</td>
              <td v-if="showColumn('created_at')">{{ props.item.created_at }}</td>
              <td v-if="showColumn('updated_at')">{{ props.item.updated_at }}</td>
              <td v-if="showColumn('region_barangay')">{{ props.item.region_barangay }}</td>
              <td v-if="showColumn('relation_to_head')">{{ props.item.relation_to_head }}</td>
              <td v-if="showColumn('placeOfBirth')">{{ props.item.placeOfBirth }}</td>
              <td v-if="showColumn('dateOfBirth')">{{ props.item.dateOfBirth }}</td>
              <td v-if="showColumn('email_add')">{{ props.item.email_add }}</td>
              <td v-if="showColumn('mobile_no')">{{ props.item.mobile_no }}</td>
              <td v-if="showColumn('telephone_no')">{{ props.item.telephone_no }}</td>
              <td v-if="showColumn('civilStatus')">{{ props.item.civilStatus }}</td>
              <td v-if="showColumn('citizenship')">{{ props.item.citizenship }}</td>
              <td v-if="showColumn('religion')">{{ props.item.religion }}</td>
              <td v-if="showColumn('schooling')">{{ props.item.schooling }}</td>
              <td
                v-if="showColumn('Highest_educational_attainment')"
              >{{ props.item.Highest_educational_attainment }}</td>
              <td v-if="showColumn('familyIncome')">{{ props.item.familyIncome }}</td>
              <td v-if="showColumn('statusOfResidency')">{{ props.item.statusOfResidency }}</td>
              <td v-if="showColumn('ethnicGroup')">{{ props.item.ethnicGroup }}</td>
              <td v-if="showColumn('height')">{{ props.item.height }}</td>
              <td v-if="showColumn('weight')">{{ props.item.weight }}</td>
              <td v-if="showColumn('bloodType')">{{ props.item.bloodType }}</td>
              <td
                v-if="showColumn('registeredVoterOfTheBrgy')"
              >{{ props.item.registeredVoterOfTheBrgy }}</td>
              <td v-if="showColumn('previousResidence')">{{ props.item.previousResidence }}</td>
              <td
                v-if="showColumn('no_of_months_and_year_living_in_this_brgy')"
              >{{ props.item.no_of_months_and_year_living_in_this_brgy }}</td>
              <td
                v-if="showColumn('reason_you_left_in_previous_brgy')"
              >{{ props.item.reason_you_left_in_previous_brgy }}</td>
              <td
                v-if="showColumn('reason_you_came_in_this_brgy')"
              >{{ props.item.reason_you_came_in_this_brgy }}</td>
              <td
                v-if="showColumn('until_when_you_stay_in_this_brgy')"
              >{{ props.item.until_when_you_stay_in_this_brgy }}</td>
              <td
                v-if="showColumn('who_accompanied_you_to_transfer_here')"
              >{{ props.item.who_accompanied_you_to_transfer_here }}</td>
              <td v-if="showColumn('actions')">
                <v-btn color="blue" class="mx-1" fab small dark @click="editItem(props.item)">
                  <v-icon>remove_red_eye</v-icon>
                </v-btn>
                <v-btn color="green" class="mx-1" fab small dark @click="editItem(props.item)">
                  <v-icon>edit</v-icon>
                </v-btn>
                <v-btn color="red" class="mx-1" fab small dark @click="deleteMember(props.item.id)">
                  <v-icon>delete</v-icon>
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
import * as jsPDF from "jspdf";
import * as autoTable from "jspdf-autotable";
import htmlDocx from "html-docx-js/dist/html-docx";
import saveAs from "file-saver";
export default {
  data: () => ({
    search: "",
    dialog: false,
    dialog1: false,
    menu: false,
    exports: [{ title: "Word" }, { title: "PDF" }, { title: "Excel" }],
    headers: [
      { text: "ID", value: "id", width: "100px", title: "ID", selected: true },
      {
        text: "First name",
        value: "first_name",
        width: "200px",
        title: "First name",
        selected: true
      },
      {
        text: "Middle name",
        value: "middle_name",
        width: "200px",
        title: "Middle name",
        selected: true
      },
      {
        text: "Family name",
        value: "family_name",
        width: "200px",
        title: "Family name",
        selected: true
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
        value: "actions",
        sortable: false,
        fixed: true,
        width: "200px",
        title: "Actions",
        align: "center",
        selected: true
      }
    ],
    members: [],
    editedIndex: -1,
    form: new Form({
      id: "",
      first_name: "",
      family_name: "",
      middle_name: "",
      age: "",
      sex: ""
    }),
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
    },
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
    this.loadMember();
    Fire.$on("AfterDo", () => {
      this.loadMember();
    });
  },
  methods: {
    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
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
          this.form
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
    loadMember() {
      this.$Progress.start();
      axios.get("api/member").then(({ data }) => {
        this.members = data.data;
        this.$Progress.finish();
      });
    },
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog1 = true;
    },
    deleteItem(item) {
      const index = this.desserts.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.desserts.splice(index, 1);
    },
    exporting(name) {
      var copy = document.getElementsByClassName(
        "v-datatable v-table theme--light"
      )[0];
      var content = copy.cloneNode(true);
      //remove unnecessary columns
      for (
        var ctr = 0;
        content.getElementsByTagName("TR")[ctr] != null;
        ctr++
      ) {
        content.getElementsByTagName("TR")[ctr].lastChild.remove();
      }
      //remove "arrow up" tag
      for (
        var ctr = 0;
        content.getElementsByTagName("TH")[ctr] != null;
        ctr++
      ) {
        content
          .getElementsByTagName("TH")
          [ctr].removeChild(content.getElementsByTagName("I")[0]);
      }
      if (name == "PDF") {
        var doc = new jsPDF("landscape", "pt");
        var trial = doc.autoTableHtmlToJson(content);
        doc.setFontSize(10);
        doc.text(340, 50, "Republic of the Philippines");
        doc.text(
          270,
          70,
          "Department of Information and Communications Technology"
        );
        doc.text(330, 90, "Cordillera Administrative Region");
        doc.setFontSize(20);
        doc.text(350, 115, "Inhabitants");
        doc.autoTable(trial.columns, trial.data, {
          startY: 130
        });
        doc.save("trial" + ".pdf");
      }
      if (name == "Word") {
        var headings =
          "<div style='text-align: center'>Republic of the Philippines<br>Department of Information and Communications Technology<br>Cordillera Administrative Region<br>";
        var title = "<span style='font-size:30'>Inhabitant</div>";
        content.style.width = "100%";
        content.style.borderCollapse = "collapse";
        content.getElementsByTagName("TR")[0].style.backgroundColor = "#5c85d6";
        content.getElementsByTagName("TR")[0].style.color = "white";
        for (
          var ctr = 0;
          content.getElementsByTagName("TR")[ctr] != null;
          ctr++
        ) {
          if (ctr % 2 == 1) {
            content.getElementsByTagName("TR")[ctr].style.backgroundColor =
              "#f2f2f2";
          }
        }
        var elem = document.createElement("Table");
        elem.appendChild(content);
        var converted = htmlDocx.asBlob(headings + title + elem.innerHTML, {
          orientation: "landscape"
        });
        saveAs(converted, "test.docx");
      }
    }
  }
};
</script>