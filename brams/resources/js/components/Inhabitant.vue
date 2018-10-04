<template>
    <div class="container-wrapper">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col p-0">
                    <h1>Inhabitant</h1>
                </div>
                <div class="col p-0">
                    <div class="dropdown float-right">
                        <button class="btn btn-primary" @click="newModal"> Add Inhabitant <i class="fas fa-user-plus" fa-fw></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="dropdown float-right">
                                <button class="btn bg-green btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Export
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"><i class="fas fa-file-pdf mr-2 red"></i>PDF</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-file-excel mr-2 green"></i>Excel</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-file-word mr-2 blue"></i>Word</a>
                                </div>
                            </div>
                            <div class="dropdown float-right mr-2">
                                <button class="btn bg-green btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Column
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"><i class="fas fa-file-pdf mr-2 red"></i>PDF</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-file-excel mr-2 green"></i>Excel</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-file-word mr-2 blue"></i>Word</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr v-for="member in members" :key="member.id">
                                        <td>{{member.id}}</td>
                                        <td>{{member.first_name}}</td>
                                        <td>{{member.middle_name}}</td>
                                        <td>{{member.family_name}}</td>
                                        <td>{{member.age}}</td>
                                        <td>{{member.sex | uptext}}</td>
                                        <td>{{member.created_at | myDate}}</td>
                                        <td>
                                            <a href="#" @click="editModal(member)"><i class="fa fa-edit blue"></i></a>
                                            <a href="#" @click="deleteMember(member.id)"><i class="fa fa-trash red"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade justify-content-center" id="addinhabitant" tabindex="-1" role="dialog" aria-labelledby="addinhabitantTitle" aria-hidden="true">
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
    </div>
</template>

<script>
export default {
  components: { datatable: Datatable, pagination: Pagination },
  data() {
    return {
      editmode: false,
      members: {},
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
      axios.get("api/member").then(({ data }) => (this.members = data.data));
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
    }
  }
};
</script>
