<template>
    <div class="container-wrapper" v-if="$gate.isAdmin()">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col p-0">
                    <h1>Inhabitant</h1>
                </div>
                <div class="col p-0">
                    <div class="float-right">
                        <button class="btn bg-blue" @click="newModal">Add New<i class="fas fa-user-plus fa-fw"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid p-0">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                        <div class="card-header">
                            <div class="dropdown float-right">
                                <button class="btn bg-green dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Export
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"><i class="fas fa-file-pdf mr-2 red"></i>PDF</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-file-excel mr-2 green"></i>Excel</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-file-word mr-2 blue"></i>Word</a>
                                </div>
                            </div>
                            <div class="dropdown float-right mr-2">
                                <button class="btn bg-green dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Registered At</th>
                        <th>Action</th>
                  </tr>


                  <tr v-for="user in users" :key="user.id">

                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.type | uptext}}</td>
                    <td>{{user.created_at | myDate}}</td>

                    <td>
                        <a href="#" @click="editModal(user)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>
                  </tr>
                </tbody></table>
              </div>
              
            </div>
          </div>
          </div>
        </div>

 
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateUser() : createUser()">
                <div class="modal-body">
                     <div class="form-group">
                        <input v-model="form.name" type="text" name="name"
                            placeholder="Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>

                     <div class="form-group">
                        <input v-model="form.email" type="email" name="email"
                            placeholder="Email Address"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>


                    <div class="form-group">
                        <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                            <option value="">Select User Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        <has-error :form="form" field="type"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.password" type="password" name="password" id="password" 
                        placeholder="Password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                </div>

                </form>

                </div>
            </div>
            </div>
    </div>


</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      users: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: ""
      })
    };
  },
  created() {
    this.loadUser();
    Fire.$on("AfterDo", () => {
      this.loadUser();
    });
  },
  methods: {
    loadUser() {
      if (this.$gate.isAdmin()) {
        axios.get("api/user").then(({ data }) => (this.users = data.data));
      }
    },
    updateUser() {
      this.$Progress.start();
      this.form
        .put("api/user/" + this.form.id)
        .then(() => {
          $("#addNew").modal("hide");
          swal("Updated!", "Information has been updated.", "success");
          this.$Progress.finish();
          Fire.$emit("AfterDo");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    deleteUser(id) {
      swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete("api/user/" + id)
            .then(() => {
              swal("Deleted!", "Your file has been deleted.", "success");
              Fire.$emit("AfterDo");
            })
            .catch(() => {
              swal("Failed!", "There was something wronge.", "warning");
            });
        }
      });
    },

    createUser() {
      this.$Progress.start();

      this.form
        .post("api/user")
        .then(() => {
          Fire.$emit("AfterDo");
          $("#addNew").modal("hide");

          toast({
            type: "success",
            title: "User Created in successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {});
    },
    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(user);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    }
  }
};
</script>
