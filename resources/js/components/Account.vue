<template>
    <div>
        <h2>Account</h2>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile text-center">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" :src="getProfileLogo()" alt="User logo">
                            </div>

                            <h3 class="profile-username">name
                                <!--                                <input type="text" readonly class="form-control-plaintext text-center" v-model="form.name">-->
                            </h3>

                            <input type="text" readonly class="form-control-plaintext text-center text-muted" v-model="form.type">

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Date Created</b> <input type="text" readonly class="form-control-plaintext text-center"
                                        v-model="form.created_at">
                                </li>
                                <li class="list-group-item">
                                    <b>Date Updated</b> <input type="text" readonly class="form-control-plaintext text-center"
                                        v-model="form.created_at">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                                <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Edit</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="activity">
                                    <h3 class="text-center">Display User Activity</h3>
                                </div>
                                <div class="tab-pane active show" id="settings">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-2 control-label">Name</label>

                                            <div class="col-sm-12">
                                                <input type="" v-model="form.username" class="form-control" id="inputName"
                                                    placeholder="Name" :class="{ 'is-invalid': form.errors.has('username') }">
                                                <has-error :form="form" field="username"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-12">
                                                <input type="email" v-model="form.email" class="form-control" id="inputEmail"
                                                    placeholder="Email" :class="{ 'is-invalid': form.errors.has('email') }">
                                                <has-error :form="form" field="email"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-2 control-label">Logo</label>
                                            <div class="col-sm-12">
                                                <input type="file" @change="updateProfile" name="photo" class="form-input">
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="col-sm-12 control-label">Password (leave empty
                                                if not changing)</label>

                                            <div class="col-sm-12">
                                                <input type="password" v-model="form.password" class="form-control" id="password"
                                                    placeholder="Password" :class="{ 'is-invalid': form.errors.has('password') }">
                                                <has-error :form="form" field="password"></has-error>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-12">
                                                <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        id: "",
        username: "",
        email: "",
        password: "",
        type: "",
        photo: "",
        created_at: "",
        updated_at: ""
      })
    };
  },
  created() {
    this.loadInfo();
    Fire.$on("AfterDo", () => {
      this.loadInfo();
    });
  },
  methods: {
    getProfileLogo() {
      let photo =
        this.form.photo.length > 200
          ? this.form.photo
          : "img/profile/" + this.form.photo;
      return photo;
    },
    updateInfo() {
      this.$Progress.start();
      if (this.form.password == "") {
        this.form.password = undefined;
      }
      this.form
        .put("api/profile")
        .then(() => {
          swal("Updated!", "Your profile has been updated.", "success");
          this.$Progress.finish();
          Fire.$emit("AfterDo");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    loadInfo() {
      axios.get("api/profile").then(({ data }) => this.form.fill(data));
    },
    updateProfile(e) {
      let file = e.target.files[0];
      console.log(file);
      let reader = new FileReader();
      if (file["size"] < 1048576) {
        reader.onloadend = file => {
          this.form.photo = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        swal({
          type: "error",
          title: "Oops...",
          text: "You are uploading a large file"
        });
      }
    }
  }
};
</script>
