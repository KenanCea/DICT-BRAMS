<template>
    <b-card fluid v-if="$gate.isUser()">
        <b-row>
            <b-col md="6" class="my-3">
                <b-form-group horizontal label="Filter" class="mb-0">
                    <b-input-group>
                        <b-form-input v-model="filter" placeholder="Type to Search" />
                        <b-input-group-append>
                            <b-btn :disabled="!filter" @click="filter = ''">Clear</b-btn>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>
            <b-col md="3" class="my-3">
                <b-form-group horizontal label="Show" class="mb-0">
                    <b-input-group>
                        <b-form-select slot="append" :options="pageOptions" v-model="perPage" />
                    </b-input-group>
                </b-form-group>
            </b-col>
            <b-col md="3" class="my-3">
              <b-btn @click="newModal" variant="primary"> Add New </b-btn>
            </b-col>
        </b-row>
        <b-table hover bordered stacked=md show-empty :current-page="currentPage" :per-page="perPage"
            :items="members" :fields="fields" :filter="filter" @filtered="onFiltered">
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
        <b-row>
            <b-col md="6" class="my-3">
                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
            </b-col>
        </b-row>
        <b-modal id="modalInfo" no-fade @hide="resetModal" :title="modalInfo.title" ok-only>
            <pre>{{ modalInfo.content }}</pre>
        </b-modal>
        <div class="modal no-fade justify-content-center" id="addinhabitant" tabindex="-1" role="dialog" aria-labelledby="addinhabitantTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center" v-show="!editmode" id="addinhabitantLongTitle">Add New Member</h4>
                        <h4 class="modal-title text-center" v-show="editmode" id="addinhabitantLongTitle">Edit Member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateMember() : createMember()">
                        <div class="modal-body mt-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>First Name:</label>
                                        <input v-model="form.first_name" type="text" placeholder="First Name" name="first_name" class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
                                        <has-error :form="form" field="first_name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender:</label>
                                        <select v-model="form.sex" type="text" placeholder="Sex" name="sex" id="sex" class="form-control" :class="{ 'is-invalid': form.errors.has('sex') }">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <has-error :form="form" field="sex"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input v-model="form.age" type="text" placeholder="Age" name="age" class="form-control" :class="{ 'is-invalid': form.errors.has('age') }">
                                        <has-error :form="form" field="age"></has-error>
                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <label>Place of Birth:</label>
                                        <input v-model="form.age" type="text" placeholder="Age" name="age" class="form-control" :class="{ 'is-invalid': form.errors.has('age') }">
                                        <has-error :form="form" field="age"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address:</label>
                                        <input v-model="form.email" type="text" placeholder="Email Address" name="email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                        <has-error :form="form" field="email"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Religion:</label>
                                        <input v-model="form.religion" type="text" placeholder="Religion" name="religion" class="form-control" :class="{ 'is-invalid': form.errors.has('religion') }">
                                        <has-error :form="form" field="religion"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Ethnic Group:</label>
                                        <input v-model="form.ethnic" type="text" placeholder="Ethnic" name="ethnic" class="form-control" :class="{ 'is-invalid': form.errors.has('ethnic') }">
                                        <has-error :form="form" field="ethnic"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Dialect:</label>
                                        <input v-model="form.age" type="text" placeholder="Age" name="age" class="form-control" :class="{ 'is-invalid': form.errors.has('age') }">
                                        <has-error :form="form" field="age"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Citizenship:</label>
                                        <input v-model="form.age" type="text" placeholder="Age" name="age" class="form-control" :class="{ 'is-invalid': form.errors.has('age') }">
                                        <has-error :form="form" field="age"></has-error>
                                    </div>
-->

                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Family Name:</label>
                                        <input v-model="form.family_name" type="text" placeholder="Family Name" name="family_name" class="form-control" :class="{ 'is-invalid': form.errors.has('family_name') }">
                                        <has-error :form="form" field="family_name"></has-error>
                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <label>Schooling:</label>
                                        <input v-model="form.middle_name" type="text" placeholder="Middle Name" name="middle_name" class="form-control" :class="{ 'is-invalid': form.errors.has('middle_name') }">
                                        <has-error :form="form" field="middle_name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Highest Educational Attaintment:</label>
                                        <input v-model="form.middle_name" type="text" placeholder="Middle Name" name="middle_name" class="form-control" :class="{ 'is-invalid': form.errors.has('middle_name') }">
                                        <has-error :form="form" field="middle_name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Civil Status:</label>
                                        <input v-model="form.middle_name" type="text" placeholder="Middle Name" name="middle_name" class="form-control" :class="{ 'is-invalid': form.errors.has('middle_name') }">
                                        <has-error :form="form" field="middle_name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Height(cm):</label>
                                        <input v-model="form.middle_name" type="text" placeholder="Middle Name" name="middle_name" class="form-control" :class="{ 'is-invalid': form.errors.has('middle_name') }">
                                        <has-error :form="form" field="middle_name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Weight(kg):</label>
                                        <input v-model="form.middle_name" type="text" placeholder="Middle Name" name="middle_name" class="form-control" :class="{ 'is-invalid': form.errors.has('middle_name') }">
                                        <has-error :form="form" field="middle_name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Blood Type:</label>
                                        <input v-model="form.middle_name" type="text" placeholder="Middle Name" name="middle_name" class="form-control" :class="{ 'is-invalid': form.errors.has('middle_name') }">
                                        <has-error :form="form" field="middle_name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Family Income:</label>
                                        <input v-model="form.middle_name" type="text" placeholder="Middle Name" name="middle_name" class="form-control" :class="{ 'is-invalid': form.errors.has('middle_name') }">
                                        <has-error :form="form" field="middle_name"></has-error>
                                    </div>
-->
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Middle Name:</label>
                                        <input v-model="form.middle_name" type="text" placeholder="Middle Name" name="middle_name" class="form-control" :class="{ 'is-invalid': form.errors.has('middle_name') }">
                                        <has-error :form="form" field="middle_name"></has-error>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-green">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </b-card>
</template>


<script>
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
      fields: [
        {
          key: "id",
          label: "ID",
          sortable: true
        },
        {
          key: "family_name",
          label: "Family Name",
          sortable: true
        },
        {
          key: "first_name",
          label: "First Name",
          sortable: true
        },
        {
          key: "middle_name",
          label: "Middle Name",
          sortable: true
        },
        {
          key: "age",
          label: "Person age",
          sortable: true
        },
        {
          key: "actions",
          label: "Actions",
          'class': 'text-center'
        }
      ],
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
      if (this.$gate.isUser()) {
        axios.get("api/member").then(({ data }) => (this.members = data.data));
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
          this.$Progress.finish();
          Fire.$emit("AfterDo");
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
          this.form
            .delete("api/member/" + id)
            .then(() => {
              swal("Deleted!", "Member has been deleted.", "success");
              Fire.$emit("AfterDo");
            })
            .catch(() => {
              this.$Progress.fail();
              swal("Failed!", "There was something wrong.", "warning");
            });
        }
      });
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
    resetModal() {
      this.modalInfo.title = "";
      this.modalInfo.content = "";
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
