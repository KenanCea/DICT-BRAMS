<template>
    <v-dialog
            v-show="show"
            v-model="showLogin"
            persistent max-width="500px"
            :fullscreen="$vuetify.breakpoint.xsOnly">
        <v-btn color="primary" dark slot="activator">Login</v-btn>

        <v-card>
            <v-card-title>
                <span class="headline">Login</span>
            </v-card-title>
            <v-card-text>
                <v-form ref="loginForm" v-model="valid">
                    <v-text-field
                            name="email"
                            label="E-mail"
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
                            min="6"
                            type="password"
                            required
                    ></v-text-field>
                </v-form>
                <v-container grid-list-md text-xs-center>
                    <v-layout row wrap>
                        <v-flex xs12>
                            <a href="/password/reset" color="blue darken-2">
                                Forgot password</a>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-2" flat @click.native="showLogin = false">Close</v-btn>
                <v-btn color="blue darken-2" class="white--text" @click.native="login" :loading="loginLoading">Login</v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
  import * as actions from '../../store/action-types'
  import withSnackbar from '../mixins/withSnackbar'
  export default {
    mixins: [withSnackbar],
    data () {
      return {
        errors: [],
        internalAction: this.action,
        email: '',
        emailRules: [
          (v) => !!v || 'Email is required',
          (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'Email have to be a valid email'
        ],
        password: '',
        passwordRules: [
          (v) => !!v || 'Password is required',
          (v) => v.length >= 6 || 'Password have to be at least 6 characters long'
        ],
        valid: false,
        loginLoading: false
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
      showLogin: {
        get () {
          if (this.internalAction && this.internalAction === 'login') return true
          return false
        },
        set (value) {
          if (value) this.internalAction = 'login'
          else this.internalAction = null
        }
      }
    },
    methods: {
      login () {
        if (this.$refs.loginForm.validate()) {
          this.loginLoading = true
          const credentials = {
            'email': this.email,
            'password': this.password
          }
          this.$store.dispatch(actions.LOGIN, credentials).then(response => {
            this.loginLoading = false
            this.showLogin = false
            window.location = '/home'
          }).catch(error => {
            console.log('HEY:')
            console.log(error.response.data)
            if (error.response && error.response.status === 422) {
              this.showError({
                message: 'Invalid data',
              })
            } else {
              this.showError(error)
            }
            this.errors = error.response.data.errors
          }).then(() => {
            this.loginLoading = false
          })
        }
      },
    }
  }
</script>
