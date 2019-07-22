<template>
  <v-app style="background-color:white;">
    <app-print></app-print>
      <v-container id='print' grid-list-md class="pl-0 pr-2 py-2">
        <v-layout row wrap>
          <v-flex xs12 class="black--text title" text-xs-center>
              <br>
              <h2> {{ reportshHeader.name }} ~ {{reportshHeader.municipality}} Barangay Profile Update</h2>
              <p>As of {{currentYear}}</p>
          </v-flex>
          <v-flex xs6>
          <v-card outlined>
          <v-card-text class="pa-0">
                <v-container class="pa-0">
                  <v-layout row text-sm-center justify-center align-center class="ma-0" wrap>
                    <v-flex xs6>
                      <span>Punong Barangay</span>
                    </v-flex>
                    <v-flex xs6 py-3 class="black--text">
                      <div class="headline">{{ punongbarangay.name }}</div>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>
            </v-card>
        </v-flex>
        <v-flex xs6>
        <v-card outlined>
          <v-card-text class="pa-0">
                <v-container class="pa-0">
                  <v-layout row text-sm-center justify-center align-center class="ma-0">
                    <v-flex xs6>
                      <span>Barangay Secretary</span>
                    </v-flex>
                    <v-flex xs6 py-3 class="black--text">
                      <div class="headline">{{brgysecretary.name}}</div>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>
              </v-card>
        </v-flex>
        <v-container grid-list-md text-ms-left>
      <v-layout row wrap>
        <v-flex xs4>
        <v-card-text>
          <p class="text-xs-left"><strong>Total Purok:</strong> </p>
          <p class="text-xs-left"><strong>Total Households:</strong></p>
          <p class="text-xs-left"><strong>Barangay Population:</strong> </p>
          <p class="text-xs-left"><strong>Total Male Residents:</strong></p>
          <p class="text-xs-left"><strong>Total Female Residents:</strong></p>
        </v-card-text>
        </v-flex>
        <v-flex xs2>
        <v-card-text>
            <p class="text-xs-left">{{purok}}</p>
            <p class="text-xs-left"> {{household}}</p>
            <p class="text-xs-left">{{inhabitant}}</p>
            <p class="text-xs-left">{{male}}</p>
            <p class="text-xs-left">{{female}}</p>
        </v-card-text>
        </v-flex>

        
        <v-flex xs4>
        <v-card-text>
          <p class="text-xs-left"><strong>No. of Permanent Residents:</strong></p>
          <p class="text-xs-left"><strong>Registered Voters:</strong></p>
          <p class="text-xs-left"><strong>6 years old and below:</strong></p>
          <p class="text-xs-left"><strong>Senior Citizens:</strong></p>
          <p class="text-xs-left"><strong>Out of School Youth:</strong></p>
          <p class="text-xs-left"><strong>Solo Parents:</strong></p>
          </v-card-text>
        </v-flex>
        <v-flex xs2>
        <v-card-text>
            <p class="text-xs-left">{{statusResidency}}</p>
            <p class="text-xs-left">{{regVoters}}</p>
            <p class="text-xs-left"> {{children}}</p>
            <p class="text-xs-left">{{seniors}}</p>
            <p class="text-xs-left">{{schooling}}</p>
            <p class="text-xs-left">{{soloparent}}</p>
        </v-card-text>
        </v-flex>
      </v-layout>
    </v-container>

      
      
      </v-layout>
    </v-container>
  </v-app>
</template>
<script>
import Print from './SummaryPrint.vue';
export default {
    data(){
        return {
            reportshHeader: {},
            currentYear: '',
            punongbarangay: {},  
            brgysecretary: {},
            purok: "",
            household: "",
            inhabitant: "",
            male: "",
            female: "",
            statusResidency: "",
            regVoters: "",
            children: "",
            seniors: "",
            schooling: "",
            soloparent: "",
        }
    },
    created() {
        this.display();
        this.getCurrentYear();
        this.getPunongBarangay();
        this.getBrgySecretary();
        this.getPuroks();
        this.getHouseholds();
        this.getInhabitants();
        this.getMale();
        this.getFemale();
        this.getStatusResidency();
        this.getRegisteredVoter();
        this.getChildren();
        this.getSeniors();
        this.getOutofSchool();
        this.getSoloParent();
    },
    components:{
            'app-print': Print
        },
    methods: {
        getSoloParent(){
            axios
            .get("api/SoloParent")
            .then(response => {
                this.soloparent = response.data;
            });
        },
        getOutofSchool(){
            axios
            .get("api/OutOfSchool")
            .then(response => {
                this.schooling = response.data;
            });
        },
        getChildren(){
          axios
            .get("api/Children")
            .then(response => {
                this.children = response.data;
            });
        },
        getRegisteredVoter() {
      axios.get("api/RegVoter").then(response => {
        this.regVoters = response.data;
      });
    },
        getStatusResidency() {
            axios
            .get("api/StatusResidency")
            .then(response => {
                this.statusResidency = response.data;
            });
        },
        getFemale() {
            axios
            .get("api/Female")
            .then(response => {
                this.female = response.data;
            });
        },
        getMale() {
            axios
            .get("api/Male")
            .then(response => {
                this.male = response.data;
            });
        },
        getInhabitants() {
      axios.get("api/Inhabitants").then(response => {
        this.inhabitant = response.data;
      });
    },
        getHouseholds() {
      axios.get("api/Households").then(response => {
        this.household = response.data;
      });
    },
        getPuroks() {
      axios.get("api/Puroks").then(response => {
        this.purok = response.data;
      });
    },
        getPunongBarangay() {
            axios
                .get("api/BrgyCaptain")
                .then(response => {
                    this.punongbarangay = response.data[0];
            });
        },
        getBrgySecretary(){
            axios
                .get("api/BrgySecretary")
                .then(response => {
                    this.brgysecretary = response.data[0];
            });
        },
        getSeniors(){
          axios
            .get("api/Seniors")
            .then(response => {
                this.seniors = response.data;
            });
        },
        getCurrentYear() {	
		this.currentYear = (new Date().toDateString());
      },
        display(){
            axios.get('api/header').then(response => {
                    this.reportshHeader = response.data[0] ;
                });
        },
    }
}
</script>
