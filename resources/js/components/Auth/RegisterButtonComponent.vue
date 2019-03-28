<template>
    <v-dialog
            fullscreen
            v-if="show"
            v-model="showRegister"
            persistent>
        <v-btn slot="activator">Register</v-btn>
        <v-card>
            <v-card-title>
                <span class="headline">User registration</span>
            </v-card-title>
            <v-card-text>
                <v-form ref="registrationForm" v-model="valid">
                    <v-text-field
                            label="User name"
                            v-model="name"
                            :rules="nameRules"
                            required
                    ></v-text-field>
                    <v-text-field
                            label="Email"
                            v-model="email"
                            :rules="emailRules"
                            :error="errors['email']"
                            :error-messages="errors['email']"
                            required
                    ></v-text-field>
                    <v-text-field
                            name="password"
                            label="Password"
                            v-model="password"
                            :rules="passwordRules"
                            hint="At least 6 characters"
                            :error="errors['email']"
                            :error-messages="errors['email']"
                            required
                            min="6"
                            type="password"
                    ></v-text-field>
                    <v-text-field
                            name="password"
                            label="Password confirmation"
                            v-model="passwordConfirmation"
                            :rules="passwordRules"
                            hint="At least 6 characters"
                            min="6"
                            type="password"
                            required
                            :error="errors['password']"
                            :error-messages="errors['password']"
                    ></v-text-field>
                </v-form>
                <a href="/login" color="blue darken-2">
                    I already have an user
                </a>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click.native="showRegister = false">Close</v-btn>
                <v-btn :loading="registerLoading" color="blue darken-1" class="white--text" @click.native="register">Register</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</template>

<style scoped>
    .facebook {
        width: 20px;
    }
</style>

<script>
  import * as actions from '../../store/action-types'
  import withSnackbar from '../mixins/withSnackbar'
  export default {
    mixins: [withSnackbar],
    data () {
      return {
        errors: [],
        internalAction: this.action,
        name: '',
        nameRules: [
          (v) => !!v || 'User name is mandatory'
        ],
        email: '',
        emailRules: [
          (v) => !!v || 'Mail is mandatory',
          (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'Email have to be valid'
        ],
        password: '',
        passwordRules: [
          (v) => !!v || 'Password is mandatory',
          (v) => v.length >= 6 || 'Password at least have to be 6 characters'
        ],
        passwordConfirmation: '',
        valid: false,
        registerLoading: false
      }
    },
    props: {
      action: {
        type: String,
        default: null
      },
      show: {
        type: Boolean,
        default: true
      }
    },
    computed: {
      showRegister: {
        get () {
          if (this.internalAction && this.internalAction === 'register') return true
          return false
        },
        set (value) {
          if (value) this.internalAction = 'register'
          else this.internalAction = null
        }
      },
    },
    methods: {
      register () {
        if (this.$refs.registrationForm.validate()) {
          this.registerLoading = true
          const user = {
            'name': this.name,
            'email': this.email,
            'password': this.password,
            'password_confirmation': this.passwordConfirmation,
          }
          this.$store.dispatch(actions.REGISTER, user).then(response => {
            this.registerLoading = false
            this.showRegister = false
            window.location = '/home'
          }).catch(error => {
            if (error.response && error.response.status === 422) {
              this.showError({
                message: 'Invalid data'
              })
            } else {
              this.showError(error)
            }
            this.errors = error.response.data.errors
          }).then(() => {
            this.registerLoading = false
          })
        }
      },
    }
  }
</script>
