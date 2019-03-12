<template>
  <v-app>
    <v-container>
      <!-- <v-layout row wrap> -->
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
          <v-tooltip left>
          <template v-slot:activator="{ on }">
            <v-btn @click="newModal" absolute dark fab top right color="indigo" v-on="on">
              <v-icon>add</v-icon>
            </v-btn>
          </template>
          <span>Add Inhabitant</span>
          </v-tooltip>
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
        <v-dialog v-model="dialog1" fullscreen hide-overlay>
          <v-form @submit.prevent="editmode ? updateMember() : createMember()">
            <v-card tile>
              <v-toolbar fixed card dark color="blue darken-3">
                <v-btn icon dark @click="dialog1 = false">
                  <v-icon>close</v-icon>
                </v-btn>
                <v-card-title>
                  <span class="headline">{{ formTitle }}</span>
                </v-card-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                  <v-btn dark flat type="submit">Save</v-btn>
                </v-toolbar-items>
              </v-toolbar>
              <v-card-text>
                <v-container grid-list-md class="mt-5">
                  <v-layout wrap>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.first_name" label="First name"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.family_name" label="Family name"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.middle_name" label="Middle name"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-select :items="sex" label="Sex"></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.schooling" label="Schooling"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.dateOfBirth" label="Date of Birth"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.region_barangay" label="Region"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.relation_to_head" label="Relation to head"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.placeOfBirth" label="Place of Birth"></v-text-field>
                    </v-flex>
                    <v-text-field
                      v-model="form.Highest_educational_attainment"
                      label="Highest Educational Attainment"
                    ></v-text-field>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.email_add" label="Email Address"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-select :items="civilStatus" label="Civil Status"></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.mobile_no" label="Mobile No"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.telephone_no" label="Telephone no"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.citizenship" label="Citizenship"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.religion" label="Religion"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.height" label="Height"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.weight" label="Weight"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.familyIncome" label="Family Income"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-select :items="statusOfResidency" label="Civil Status"></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.ethnicGroup" label="Ethnic Group"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.height" label="Height"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.weight" label="Weight"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-select :items="bloodType" label="Blood Type"></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.mem_pic" label="Mem Pic"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="form.previousResidence" label="Previous Residence"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="form.no_of_months_and_year_living_in_this_brgy"
                        label="No of months and year living in this brgy"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="form.reason_you_left_in_previous_brgy"
                        label="Reason you left in previous brgy"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="form.reason_you_came_in_this_brgy"
                        label="Reason you came in this brgy"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="form.until_when_you_stay_in_this_brgy"
                        label="Until when you stay in this brgy"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="form.who_accompanied_you_to_transfer_here"
                        label="Who accompanied you to transfer here"
                      ></v-text-field>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>
            </v-card>
          </v-form>
        </v-dialog>
        <v-divider></v-divider>
        <v-data-table
          v-bind:headers="filteredHeaders"
          :items="members"
          :search="search"
          :loading="loading"
          item-key="name"
          class="fixed-header elevation-1"
        >
          <div class="text-xs-center">
            <v-progress-circular :size="50" color="primary" indeterminate></v-progress-circular>
          </div>
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
              <v-btn color="green" class="mx-1" fab small dark @click="editModal(props.item)">
                <v-icon>edit</v-icon>
              </v-btn>
              <v-btn color="red" class="mx-1" fab small dark @click="deleteMember(props.item.id)">
                <v-icon>delete</v-icon>
              </v-btn>
            </td>
          </template>
        </v-data-table>
      </v-card>
      <!-- </v-layout> -->
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
    members: [],
    dialog: false,
    dialog1: false,
    menu: false,
    loading: true,
    sex: ["female", "male"],
    bloodType: ["A", "B", "O", "AB"],
    registeredVoterOfTheBrgy: ["yes", "no"],
    civilStatus: [
      "single",
      "married",
      "widow",
      "separated",
      "common-law",
      "complicated"
    ],
    statusOfResidency: [
      "permanent",
      "live-in relative",
      "boarder",
      "buss resident",
      "moved out",
      "deceased"
    ],
    exports: [{ title: "Word" }, { title: "PDF" }, { title: "Excel" }],
    headers: [
      { text: "ID", value: "id", title: "ID", selected: false },
      {
        text: "First name",
        value: "first_name",
        title: "First name",
        selected: true
      },
      {
        text: "Middle name",
        value: "middle_name",
        title: "Middle name",
        selected: true
      },
      {
        text: "Family name",
        value: "family_name",
        title: "Family name",
        selected: true
      },
      { text: "Sex", value: "sex", title: "Sex" },
      {
        text: "Created at",
        value: "created_at",
        title: "Created at"
      },
      {
        text: "Updated at",
        value: "updated_at",
        title: "Updated at"
      },
      {
        text: "Region",
        value: "region_barangay",
        title: "Region"
      },
      {
        text: "Relation to Head",
        value: "relation_to_head",
        title: "Relation to Head"
      },
      {
        text: "Place of Birth",
        value: "placeOfBirth",
        title: "Place of Birth"
      },
      {
        text: "Date of Birth",
        value: "dateOfBirth",
        title: "Date of Birth"
      },
      {
        text: "Email Address",
        value: "email_add",
        title: "Email Address"
      },
      {
        text: "Mobile Number",
        value: "mobile_no",
        title: "Mobile Number"
      },
      {
        text: "Telephone Number",
        value: "telephone_no",
        title: "Telephone Number"
      },
      {
        text: "Civil Status",
        value: "civilStatus",
        title: "Civil Status"
      },
      {
        text: "Citizenship",
        value: "citizenship",
        title: "Citizenship"
      },
      {
        text: "Religion",
        value: "religion",
        title: "Religion"
      },
      {
        text: "Schooling",
        value: "schooling",
        title: "Schooling"
      },
      {
        text: "Highest Educational Attainment",
        value: "Highest_educational_attainment",
        title: "Highest Educational Attainment"
      },
      {
        text: "Family Income",
        value: "familyIncome",
        title: "Family Income"
      },
      {
        text: "Status Of Residency",
        value: "statusOfResidency",
        title: "Status Of Residency"
      },
      {
        text: "Ethnic Group",
        value: "ethnicGroup",
        title: "Ethnic Group"
      },
      {
        text: "Height",
        value: "height",
        title: "Height"
      },
      {
        text: "Weight",
        value: "weight",
        title: "Weight"
      },
      {
        text: "Blood Type",
        value: "bloodType",
        title: "Blood Type"
      },
      {
        text: "Registered Voter of the Barangay",
        value: "registeredVoterOfTheBrgy",
        title: "Registered Voter of the Barangay"
      },
      {
        text: "Previous Residence",
        value: "previousResidence",
        title: "Previous Residence"
      },
      {
        text: "No. of months and year living in this Brgy",
        value: "no_of_months_and_year_living_in_this_brgy",
        title: "No. of months and year living in this Brgy"
      },
      {
        text: "Reason you left in previous brgy",
        value: "reason_you_left_in_previous_brgy",
        title: "Reason you left in previous brgy"
      },
      {
        text: "Reason you came in this brgy",
        value: "reason_you_came_in_this_brgy",
        title: "Reason you came in this brgy"
      },
      {
        text: "Until when you stay in this brgy",
        value: "until_when_you_stay_in_this_brgy",
        title: "Until when you stay in this brgy"
      },
      {
        text: "Accompanied you to transfer here",
        value: "who_accompanied_you_to_transfer_here",
        title: "Accompanied you to transfer here"
      },
      {
        text: "Actions",
        value: "actions",
        title: "Actions",
        align: "center",
        sortable: false,
        fixed: true,
        selected: true
      }
    ],
    form: new Form({
      id: "",
      first_name: "",
      family_name: "",
      middle_name: "",
      age: "",
      sex: "",
      citizenship: "",
      mobile_no: "",
      created_at: "",
      updated_at: "",
      region_barangay: "",
      relation_to_head: "",
      placeOfBirth: "",
      dateOfBirth: "",
      email_add: "",
      telephone_no: "",
      civilStatus: "",
      religion: "",
      schooling: "",
      Highest_educational_attainment: "",
      familyIncome: "",
      statusOfResidency: "",
      ethnicGroup: "",
      height: "",
      weight: "",
      bloodType: "",
      registeredVoterOfTheBrgy: "",
      previousResidence: "",
      no_of_monthsno_of_months_and_year_living_in_this_brgy: "",
      reason_you_left_in_previous_brgy: "",
      reason_you_came_in_this_brgy: "",
      until_when_you_stay_in_this_brgy: "",
      who_accwho_accompanied_you_to_transfer_here: ""
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
    this.loadMember();
    Fire.$on("AfterDo", () => {
      this.loadMember();
    });
  },
  methods: {
    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    },
    createMember() {
      this.$Progress.start();
      this.form
        .post("api/member")
        .then(() => {
          Fire.$emit("AfterDo");
          dialog1 = false;
          swal("Created!", "Member has been created.", "success");
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    updateMember() {
      this.$Progress.start();
      this.form
        .put("api/member/" + this.form.id)
        .then(() => {
          Fire.$emit("AfterDo");
          dialog1 = false;
          swal("Updated!", "Member has been updated.", "success");
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
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
          this.loading = true;
          this.form
            .delete("api/member/" + id)
            .then(() => {
              swal("Deleted!", "Member has been deleted.", "success");
              Fire.$emit("AfterDo");
              this.loading = false;
            })
            .catch(() => {
              this.loading = false;
              swal("Failed!", "There was something wrong.", "warning");
            });
        }
      });
    },
    loadMember() {
      this.loading = true;
      axios.get("api/member").then(({ data }) => {
        this.members = data.data;
        this.loading = false;
      });
    },
    editModal(member) {
      this.editmode = true;
      this.form.reset();
      this.dialog1 = true;
      this.form.fill(member);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      this.dialog1 = true;
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