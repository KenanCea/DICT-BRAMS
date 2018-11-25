<template>
    <b-card fluid v-if="$gate.isUser()">
        <div>
            <b-row>
                <b-col md="7">
                    <h1>Inhabitant</h1>
                </b-col>
                <b-col md="2">
                    <b-input-group prepend="Show">
                        <b-form-select :options="pageOptions" v-model="perPage" />
                    </b-input-group>
                </b-col>
                <b-col md="3">
                    <b-input-group prepend="Filter">
                        <b-form-input v-model="filter" placeholder="Type to Search" />
                    </b-input-group>
                </b-col>
            </b-row>
            <b-row class="float-right">
                <b-col class="mb-3">
                    <b-btn variant="primary"> Columns <i class="fas fa-columns ml-1"></i> </b-btn>
                </b-col>
                <b-col class="mb-3">
                    <a @click="generate()" class="dropdown-item" href="#"><i class="fas fa-file-pdf mr-2 red"></i>PDF</a>
                    <download-excel class="btn btn-primary" :data="members" name="Inhabitants.xls">
                        Export <i class="fas fa-file-export ml-1"></i>
                    </download-excel>
                    <a @click="generateWord()" class="dropdown-item" href="#"><i class="fas fa-file-word mr-2 blue"></i>Word</a>
                </b-col>
                <b-col class="mb-3">
                    <b-btn @click="newModal" variant="primary"> Add New <i class="fas fa-user-plus ml-1"></i> </b-btn>
                </b-col>
            </b-row>
        </div>
        <div class="trial">
        <b-table hover bordered responsive show-empty :current-page="currentPage" :per-page="perPage" :items="members"
            :fields="fields" :filter="filter" @filtered="onFiltered">
            <template slot="actions" slot-scope="row">
                <b-button variant="outline-info" @click.stop="info(row.item, row.index, $event.target)">
                    <i class="fa fa-eye"></i>
                </b-button>
                <b-button variant="outline-success" @click="editModal(row.item)"><i class="fa fa-edit"></i></b-button>
                <b-button variant="outline-danger" @click="deleteMember(row.item.id)"><i class="fa fa-trash"></i></b-button>
            </template>
            <template slot="row-details" slot-scope="row">
                <b-card>
                    <ul>
                        <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value}}</li>
                    </ul>
                </b-card>
            </template>
        </b-table>
        </div>
        <b-row>
            <b-col md="6" class="my-3">
                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
            </b-col>
        </b-row>
        <b-modal id="modalInfo" @hide="resetModal" :title="modalInfo.title" ok-only>
            <pre>{{ modalInfo.content }}</pre>
        </b-modal>
        <div class="modal bounceIn justify-content-center" id="addinhabitant" tabindex="-1" role="dialog"
            aria-labelledby="addinhabitantTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form @submit.prevent="editmode ? updateMember() : createMember()">
                        <div class="modal-header py-2">
                            <h4 class="modal-title" v-show="!editmode" id="addinhabitantLongTitle"> <i class="fas fa-plus-square blue"></i>
                                ADD
                                NEW MEMBER</h4>
                            <h4 class="modal-title" v-show="editmode" id="addinhabitantLongTitle"><i class="fas fa-pen-square blue"></i>
                                EDIT MEMBER
                            </h4>
                            <button type="button" class="close" data-dismiss="modal"> <i class="fas fa-times mt-2"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first_name">First Name:</label>
                                        <input v-model="form.first_name" type="text" id="first_name" placeholder="First Name"
                                            name="first_name" class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
                                        <has-error :form="form" field="first_name"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Family Name:</label>
                                        <input v-model="form.family_name" type="text" placeholder="Family Name" name="family_name"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('family_name') }">
                                        <has-error :form="form" field="family_name"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Middle Name:</label>
                                        <input v-model="form.middle_name" type="text" placeholder="Middle Name" name="middle_name"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('middle_name') }">
                                        <has-error :form="form" field="middle_name"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Gender:</label>
                                        <select v-model="form.sex" type="text" placeholder="Sex" name="sex" id="sex"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('sex') }">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <has-error :form="form" field="sex"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Age:</label>
                                        <input v-model="form.age" type="text" placeholder="Age" name="age" class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('age') }">
                                        <has-error :form="form" field="age"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dummy:</label>
                                        <input type="text" placeholder="Dummy" name="middle_name" class="form-control">
                                        <!-- <has-error :form="form" field="middle_name"></has-error> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer py-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </b-card>
</template>
<script>
import * as jsPDF from 'jspdf';
import * as autoTable from 'jspdf-autotable';
import htmlDocx from 'html-docx-js/dist/html-docx';
import saveAs from 'file-saver';
const members = [];
export default {
  data() {
    return {
      members: members,
      currentPage: 1,
      perPage: 5,
      totalRows: members.length,
      pageOptions: [5, 10, 25, 50],
      filter: null,
      modalInfo: {
        title: "",
        content: ""
      },
      fields: {
        id: {
          label: "No.",
          sortable: true
        },
        first_name: {
          label: "First name",
          sortable: true
        },
        family_name: {
          label: "Family name",
          sortable: true
        },
        middle_name: {
          label: "Middle name",
          sortable: true
        },
        age: {
          label: "Age",
          sortable: true
        },
        sex: {
          label: "Gender",
          sortable: true
        },
        actions: {
          label: "Actions",
          class: "text-center pt-1 px-0"
        }
      },
      editmode: false,
      form: new Form({
        id: "",
        first_name: "",
        family_name: "",
        middle_name: "",
        age: "",
        sex: ""
      })
    };
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
      if (this.$gate.isUser()) {
        axios.get("api/member").then(({ data }) => {
          this.members = data.data;
          this.$Progress.finish();
        });
      }
    },
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
    resetModal() {
      this.modalInfo.title = "";
      this.modalInfo.content = "";
    },
    editModal(member) {
      this.editmode = true;
      this.form.reset();
      $("#addinhabitant").modal("show");
      this.form.fill(member);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addinhabitant").modal("show");
    },
    onFiltered(filteredItems) {
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    info(item, index, button) {
      this.modalInfo.title = `Row index: ${index}`;
      this.modalInfo.content = JSON.stringify(item, null, 2);
      this.$root.$emit("bv::show::modal", "modalInfo", button);
    },
    show() {
      this.$modal.show("hello-world");
    },
    generate(){ 
        var trial = this
        var columns = [
            {title: "First Name", dataKey: "first_name"},
            {title: "Middle Name", dataKey: "middle_name"},
            {title: "Last Name", dataKey:"family_name"},
            {title: "Age", dataKey:"age"},
            {title: "Gender", dataKey:"sex"},
            {title: "Date Created", dataKey:"created_at"},
        ];
        var doc = new jsPDF('p','pt');
        doc.setFontSize(10);
        doc.text(240, 50, 'Republic of the Philippines');
        doc.text(170, 70, 'Department of Information and Communications Technology');
        doc.text(230, 90, 'Cordillera Administrative Region');
        doc.setFontSize(20);
        doc.text(250, 115, 'Inhabitants');
        doc.autoTable(columns, trial.members,{
            startY: doc.autoTableEndPosY() + 130}
            );
        doc.save("trial" + '.pdf');
    },
    generateWord(){
        var headings = "<div style='text-align: center'>Republic of the Philippines<br>Department of Information and Communications Technology<br>Cordillera Administrative Region<br>";
        var title = "<span style='font-size:30'>Inhabitant</div>";
        var copy = document.getElementsByClassName("trial")[0];
        var content = copy.cloneNode(true);
        content.getElementsByTagName("TABLE")[0].style.width = "100%";
        content.getElementsByTagName("TABLE")[0].style.borderCollapse = "collapse";
        content.getElementsByTagName("TR")[0].style.backgroundColor = "#5c85d6";
        content.getElementsByTagName("TR")[0].style.color = "white";
        for(var ctr=0; content.getElementsByTagName("TR")[ctr]!=null ;ctr++){
            if(ctr%2==1){
                content.getElementsByTagName("TR")[ctr].style.backgroundColor = "#f2f2f2";
            }
            content.getElementsByTagName("TR")[ctr].lastChild.remove();
        }
        var converted = htmlDocx.asBlob(headings + title + content.innerHTML);
        saveAs(converted, 'test.docx');

        //first word generation 
        /*var content = document.getElementsByClassName("card-body table-responsive p-0")[0];
        var copy = content.cloneNode(true);
        content.getElementsByTagName("TABLE")[0].style.width = "100%";
        content.getElementsByTagName("TABLE")[0].style.borderCollapse = "collapse";
        content.getElementsByTagName("TR")[0].style.backgroundColor = "#5c85d6";
        content.getElementsByTagName("TR")[0].style.color = "white";
        for(var ctr=0; content.getElementsByTagName("TR")[ctr]!=null ;ctr++){
            if(ctr%2==1){
                content.getElementsByTagName("TR")[ctr].style.backgroundColor = "#f2f2f2";
            }
            content.getElementsByTagName("TR")[ctr].lastChild.remove();
        }
        var headings = "<div style='text-align: center'>Republic of the Philippines<br>Department of Information and Communications Technology<br>Cordillera Administrative Region<br>";
        var title = "<span style='font-size:30'>Inhabitant</div>";
        var converted = htmlDocx.asBlob(headings + title + content.innerHTML);
        saveAs(converted, 'test.docx');
        document.getElementsByClassName("card-body table-responsive p-0")[0].children[0].remove();
        document.getElementsByClassName("card-body table-responsive p-0")[0].appendChild(copy);*/


        /*var headings = "<div style='text-align: center'>Republic of the Philippines<br>Department of Information and Communications Technology<br>Cordillera Administrative Region<br>";
        var title = "<span style='font-size:30'>Inhabitant</div>";
        var content = document.getElementsByClassName("trial")[0].innerHTML;
        alert(content);
        var converted = htmlDocx.asBlob(headings + title + content);
        saveAs(converted, 'test.docx');*/

        /* fail(data content display code)
        var table = "<table style='width:100%;border-collapse:collapse'>";
        var headers ="<tbody><tr style='background-color:#5c85d6'>";
        var headersTitle1 = "<th>First Name</th> <th>Middle Name</th> <th>Last Name</th>";
        var headersTitle2 = "<th>Age</th> <th>Gender</th> <th>Date Created</th>";
        var data = "</tr><tr v-for='member in members' :key='member.id'>";
        var dataContent1 = "<td>{{member.first_name}}</td> <td>{{member.middle_name}}</td> <td>{{member.family_name}}</td>";
        var dataContent2 = "<td>{{member.age}}</td> <td>{{member.sex | uptext}}</td> <td>{{member.created_at | myDate}}</td>";
        var tableEnd = "</tr></tbody></table>";
        var content = headings + title + table + headers + headersTitle1 + headersTitle2 + data + dataContent1 + dataContent2 + tableEnd;
        */
    }
  },
  computed: {
    sortOptions() {
      return this.fields.filter(f => f.sortable).map(f => {
        return {
          text: f.label,
          value: f.key
        };
      });
    }
  }
};
</script>
