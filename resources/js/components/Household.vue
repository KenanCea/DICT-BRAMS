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
            <v-btn @click="dialog1 = true" absolute dark fab top right color="blue darken-3">
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
          <v-dialog v-model="dialog1" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-form @submit.prevent="editmode ? updateMember() : createMember()">
              <v-card tile>
                <v-toolbar fixed card dark color="blue darken-3">
                  <v-btn icon dark @click="dialog1 = false">
                    <v-icon>close</v-icon>
                  </v-btn>
                  <v-toolbar-title v-show="!editmode">New Member</v-toolbar-title>
                  <!-- <v-toolbar-title v-show="!editmode">EDIT MEMBER</v-toolbar-title> -->
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
            item-key="name"
            class="fixed-header"
          >
            <template class="tableData" slot="items" slot-scope="props">
              <td v-if="showColumn('id')">{{ props.item.id }}</td>
              <td v-if="showColumn('hhold_number')">{{ props.item.hhold_number }}</td>
              <td v-if="showColumn('solo_parent')">{{ props.item.solo_parent }}</td>
              <td v-if="showColumn('solo_parent_yes')">{{ props.item.solo_parent_yes }}</td>
              <td v-if="showColumn('purok_hhold')">{{ props.item.purok_hhold }}</td>
              <td v-if="showColumn('street')">{{ props.item.street }}</td>
              <td v-if="showColumn('barangay')">{{ props.item.barangay }}</td>
              <td v-if="showColumn('sources_of_info')">{{ props.item.sources_of_info }}</td>
              <td
                v-if="showColumn('sources_of_info_specify_others')"
              >{{ props.item.sources_of_info_specify_others }}</td>
              <td
                v-if="showColumn('communication_services')"
              >{{ props.item.communication_services }}</td>
              <td
                v-if="showColumn('communication_services_others')"
              >{{ props.item.communication_services_others }}</td>
              <td v-if="showColumn('energy_source')">{{ props.item.energy_source }}</td>
              <td
                v-if="showColumn('means_of_transportation')"
              >{{ props.item.means_of_transportation }}</td>
              <td v-if="showColumn('house_pic')">{{ props.item.house_pic }}</td>
              <td v-if="showColumn('born_alive_reg')">{{ props.item.born_alive_reg }}</td>
              <td v-if="showColumn('date_born_reg')">{{ props.item.date_born_reg }}</td>
              <td v-if="showColumn('born_alive_unreg')">{{ props.item.born_alive_unreg }}</td>
              <td v-if="showColumn('date_born_unreg')">{{ props.item.date_born_unreg }}</td>
              <td v-if="showColumn('born_dead_reg')">{{ props.item.born_dead_reg }}</td>
              <td v-if="showColumn('date_dead_reg')">{{ props.item.date_dead_reg }}</td>
              <td v-if="showColumn('born_dead_unreg')">{{ props.item.born_dead_unreg }}</td>
              <td v-if="showColumn('date_dead_unreg')">{{ props.item.still_birth_reg }}</td>
              <td v-if="showColumn('date_sbirth_reg')">{{ props.item.date_sbirth_reg }}</td>
              <td v-if="showColumn('still_birth_unreg')">{{ props.item.still_birth_unreg }}</td>
              <td v-if="showColumn('date_sbirth_unreg')">{{ props.item.date_sbirth_unreg }}</td>
              <td v-if="showColumn('no_dead_child')">{{ props.item.no_dead_child }}</td>
              <td v-if="showColumn('cause_of_death_ch')">{{ props.item.cause_of_death_ch }}</td>
              <td v-if="showColumn('no_of death_ad')">{{ props.item.no_of_death_ad }}</td>
              <td v-if="showColumn('cause_of_death')">{{ props.item.cause_of_death }}</td>
              <td v-if="showColumn('created_at')">{{ props.item.created_at }}</td>
              <td v-if="showColumn('updated_at')">{{ props.item.updated_at }}</td>
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
    search: "",
    dialog: false,
    dialog1: false,
    menu: false,
    exports: [{ title: "Word" }, { title: "PDF" }, { title: "Excel" }],
    headers: [
      { text: "ID", value: "id", width: "100px", title: "ID", selected: true },
      {
        text: "Household number",
        value: "hhold_number",
        width: "200px",
        title: "Household number",
        selected: true
      },
      {
        text: "Middle name",
        value: "solo_parent",
        width: "200px",
        title: "Middle name",
        selected: true
      },
      {
        text: "Family name",
        value: "solo_parent_yes",
        width: "200px",
        title: "Family name",
        selected: true
      },
      {
        text: "Sex",
        value: "solo_parent_others",
        width: "100px",
        title: "Sex"
      },
      {
        text: "Created at",
        value: "purok_hhold",
        width: "200px",
        title: "Created at"
      },
      {
        text: "Updated at",
        value: "street",
        width: "200px",
        title: "Updated at"
      },
      {
        text: "Region",
        value: "barangay",
        width: "200px",
        title: "Region"
      },
      {
        text: "Relation to Head",
        value: "sources_of_info",
        width: "200px",
        title: "Relation to Head"
      },
      {
        text: "Place of Birth",
        value: "sources_of_info_specify_others",
        width: "200px",
        title: "Place of Birth"
      },
      {
        text: "Date of Birth",
        value: "communication_services",
        width: "200px",
        title: "Date of Birth"
      },
      {
        text: "Email Address",
        value: "communication_services_others",
        width: "200px",
        title: "Email Address"
      },
      {
        text: "Mobile Number",
        value: "energy_source",
        width: "200px",
        title: "Mobile Number"
      },
      {
        text: "Telephone Number",
        value: "means_of_transportation",
        width: "200px",
        title: "Telephone Number"
      },
      {
        text: "Civil Status",
        value: "house_pic",
        width: "200px",
        title: "Civil Status"
      },
      {
        text: "Citizenship",
        value: "born_alive_reg",
        width: "200px",
        title: "Citizenship"
      },
      {
        text: "Religion",
        value: "date_born_reg",
        width: "200px",
        title: "Religion"
      },
      {
        text: "Schooling",
        value: "born_alive_unreg",
        width: "200px",
        title: "Schooling"
      },
      {
        text: "Highest Educational Attainment",
        value: "date_born_unreg",
        width: "200px",
        title: "Highest Educational Attainment"
      },
      {
        text: "Family Income",
        value: "born_dead_reg",
        width: "200px",
        title: "Family Income"
      },
      {
        text: "Status Of Residency",
        value: "date_dead_reg",
        width: "200px",
        title: "Status Of Residency"
      },
      {
        text: "Ethnic Group",
        value: "born_dead_unreg",
        width: "200px",
        title: "Ethnic Group"
      },
      {
        text: "Height",
        value: "date_dead_unreg",
        width: "100px",
        title: "Height"
      },
      {
        text: "Weight",
        value: "still_birth_reg",
        width: "100px",
        title: "Weight"
      },
      {
        text: "Blood Type",
        value: "date_sbirth_reg",
        width: "200px",
        title: "Blood Type"
      },
      {
        text: "Registered Voter of the Barangay",
        value: "still_birth_unreg",
        width: "200px",
        title: "Registered Voter of the Barangay"
      },
      {
        text: "Previous Residence",
        value: "date_sbirth_unreg",
        width: "200px",
        title: "Previous Residence"
      },
      {
        text: "No. of months and year living in this Brgy",
        value: "no_dead_child",
        width: "200px",
        title: "No. of months and year living in this Brgy"
      },
      {
        text: "Reason you left in previous brgy",
        value: "cause_of_death_ch",
        width: "200px",
        title: "Reason you left in previous brgy"
      },
      {
        text: "Reason you came in this brgy",
        value: "no_of_death_ad",
        width: "200px",
        title: "Reason you came in this brgy"
      },
      {
        text: "Until when you stay in this brgy",
        value: "cause_of_death",
        width: "200px",
        title: "Until when you stay in this brgy"
      },
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
    })
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
    createMember() {
      this.$Progress.start();
      this.form
        .post("api/member")
        .then(() => {
          Fire.$emit("AfterDo");
          $("#addinhabitant").modal("hide");
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
          $("#addinhabitant").modal("hide");
          swal("Updated!", "Member has been updated.", "success");
          Fire.$emit("AfterDo");
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
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
    updateMember() {
      this.$Progress.start();
      this.form
        .put("api/member/" + this.form.id)
        .then(() => {
          $("#addinhabitant").modal("hide");
          swal("Updated!", "Member has been updated.", "success");
          this.$Progress.finish();
          Fire.$emit("AfterDo");
        })
        .catch(() => {
          this.$Progress.fail();
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