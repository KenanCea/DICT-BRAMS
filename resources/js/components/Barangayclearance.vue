<template>
    <b-card fluid v-if="$gate.isUser()">
        <b-card>
            <b-row class="p-0">
                <b-col md="6">
                    <h1>Barangay Clearance</h1>
                </b-col>
                <b-col md="2">
                    <b-btn variant="primary"> Add New <i class="fas fa-user-plus ml-1"></i> </b-btn>
                </b-col>
                <b-col md="2">
                    <b-btn variant="primary"> Add New <i class="fas fa-user-plus ml-1"></i> </b-btn>
                </b-col>
                <b-col md="2">
                    <b-btn variant="primary"> Add New <i class="fas fa-user-plus ml-1"></i> </b-btn>
                </b-col>
            </b-row>
        </b-card>
        <b-card>
            <b-row class="justify-content-md-center green border-b">
                <b-col md="1" class="p-0"><img class="img-fluid img-circle" src="/img/baguio-logo.png" alt="Baguio logo"></b-col>
                <b-col md="7" class="text-center pt-3">
                    <p class="font-italic mb-1">Republic of the Philippines</p>
                    <h5 class="font-weight-bold mb-1">AMBIONG-BAGUIO BARANGAY</h5>
                    <p class="font-italic">Aurora Hill, Baguio City</p>
                    </b-col>
                <b-col md="1" class="p-0"><img class="img-fluid img-circle" src="/img/profile.png" alt="Baguio logo"></b-col>
            </b-row>
            <b-row class="justify-content-md-center mb-3">
                <b-col class="text-center pt-1">
                <p class="font-italic mb-4">Office of the Punong Barangay</p>
                <h3 class="font-weight-bold">BARANGAY CLEARANCE</h3>
                </b-col>
            </b-row>
            <b-row >
                <b-col md="3" class="border-r text-center">
                    <p class="mb-1 text-uppercase">Randy P. Gati</p>
                    <p class="font-italic green">Punong Barangay</p>
                    <p class="mb-1 text-uppercase">Randy P. Gati</p>
                    <p class="font-italic green">Committee Chairman on Peace and Order</p>
                    <p class="mb-1 text-uppercase">Randy P. Gati</p>
                    <p class="font-italic green">Committee Chairman on Infrastructure Projects and Street/Alley Lights</p>
                    <p class="mb-1 text-uppercase">Randy P. Gati</p>
                    <p class="font-italic green">Committee Chairman on Legal and Research</p>
                    <p class="mb-1 text-uppercase">Randy P. Gati</p>
                    <p class="font-italic green">Committee Chairman on Healt and Sanitation</p>
                    <p class="mb-1 text-uppercase">Randy P. Gati</p>
                    <p class="font-italic green">Committee Chairman on Ways and Means</p>
                    <p class="mb-1 text-uppercase">Randy P. Gati</p>
                    <p class="font-italic green">Committee Chairman on Social Services</p>
                    <p class="mb-1 text-uppercase">Randy P. Gati</p>
                    <p class="font-italic green">Barangay Secretary</p>
                    <p class="mb-1 text-uppercase">Randy P. Gati</p>
                    <p class="font-italic green">Barangay Treasurer</p> 
                    </b-col>
                <b-col md="8" class="border-l ml-1" >
                    <p>TO WHOM IT MAY CONCERN</p>
                    <p>This is to certify____________________________, ________ years old, __________________ citizen
                        , a native of _______________________________ and presently residing at _______________________________
                        and whose signature appears hereunder, has no pending adverse cases and deragatory records filed
                        against __________________ per available records on file with this office as of the date of issuance thereof.
                    </p>
                    <p>Issued _________________________ purposes.</p>
                    <p>Issued this _______ day of ________________ at Ambiong-Baguio Barangay, Baguio City, Philippines</p>
                    <p>(Name Signature of Applicant)</p>
                    <p>Com. tax Cert #:</p>
                    <p>Issued on</p>
                    <p>Issued at</p>
                    <p>OR No.</p>
                    <p>CERTIFIED AND ISSUED BY:</p>
                    <p>RANDY P GATI</p>
                    <p>Punong Barangay</p>
                    <p>Control No.</p>
                    <p>Note: Not valid without Barangay Seal</p>
                </b-col>
            </b-row>
        </b-card>
    </b-card>
</template>

<script>
export default {};
</script>
