<template>
  <v-app>
    <v-container grid-list-md class="pl-0 pr-2 py-2" style="background-color:white;" >
      <v-layout row wrap>
                  <v-flex xs11 class="black--text title" text-xs-right>
                    <v-btn small > <v-icon>mdi-printer</v-icon>
                    Print
                    </v-btn>
                  </v-flex>
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
    <v-flex xs1 py-3>
      <v-spacer></v-spacer>
      </v-flex>
      <v-flex xs3>
      <v-card-text>
        <p class="text-xs-right"><strong>Total Land Area:</strong></p>
        <p class="text-xs-right"><strong>Total Purok:</strong> </p>
        <p class="text-xs-right"><strong>Total Households:</strong></p>
        <p class="text-xs-right"><strong>Barangay Population:</strong> </p>
        <p class="text-xs-right"><strong>Total Male Residents:</strong></p>
        <p class="text-xs-right"><strong>Total Female Residents:</strong></p>
      </v-card-text>
      </v-flex>
       <v-flex xs1>
      <v-card-text>
          <p class="text-xs-left">{{landarea.totalland_area_sqkm}}</p>
          <p class="text-xs-left">{{purok}}</p>
          <p class="text-xs-left"> {{household}}</p>
          <p class="text-xs-left">{{inhabitant}}</p>
          <p class="text-xs-left">{{male}}</p>
          <p class="text-xs-left">{{female}}</p>
      </v-card-text>
      </v-flex>

      
      <v-flex xs4>
      <v-card-text>
        <p class="text-xs-right"><strong>No. of Permanent Residents:</strong></p>
        <p class="text-xs-right"><strong>Registered Voters:</strong></p>
        <p class="text-xs-right"><strong>Total Children below 6 years old:</strong></p>
        <p class="text-xs-right"><strong>Total Senior Citizens:</strong></p>
        <p class="text-xs-right"><strong>Out of School Youth:</strong></p>
        <p class="text-xs-right"><strong>Solo Parents:</strong></p>
        </v-card-text>
      </v-flex>
      <v-flex xs1>
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

export default {
    
    data(){
        return {
            reportshHeader: {},
            currentYear: '',
            punongbarangay: {},  
            brgysecretary: {},
            landarea: {},
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
        this.getLandArea();
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
        getLandArea(){
            axios
                .get("api/LandArea")
                .then(response => {
                    this.landarea = response.data[0];
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
