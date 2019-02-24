<template>
<v-app>
    <b-card fluid v-if="$gate.isUser()">
        <div class="">
            <b-row>
                <b-col md="9">
                    <h1>Barangay Clearance</h1>
                </b-col>
                <b-col md="3">
                    <b-input-group>
                        <b-input-group-prepend is-text>
                            <i class="fas fa-search-plus"></i>
                        </b-input-group-prepend>
                        <b-form-input placeholder="Search Inhabitant" />
                    </b-input-group>
                </b-col>
            </b-row>
        </div>
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
            <b-row>
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
                <b-col md="8" class="border-l ml-1">
                    <p>TO WHOM IT MAY CONCERN:</p>
                    <div class="p-1">
                        <p>This is to certify <input type="text" class="m-1" />, <input type="text" class="m-1" />
                            years old, <input type="text" class="m-1" /> citizen
                            , a native of <input type="text" class="m-1" /> and presently residing at <input type="text" />
                            and whose signature appears hereunder, has no pending adverse cases and deragatory records
                            filed
                            against <input type="text" class="m-1" /> per available records on file with this office as
                            of the date of issuance thereof.
                        </p>
                    </div>
                    <div class="pb-5">
                        <p class="m-0">Issued <input type="text" class="m-1" /> purposes.</p>
                        <p>Issued this <input type="text" class="m-1" /> day of <input type="text" class="m-1" /> at
                            Ambiong-Baguio Barangay, Baguio City, Philippines</p>
                    </div>
                    <div>
                        <p>(Name Signature of Applicant)</p>
                        <p class="m-0">Com. tax Cert #:<input type="text" class="m-1" /></p>
                        <p class="m-0">Issued on:<input type="text" class="m-1" /></p>
                        <p class="m-0">Issued at:<input type="text" class="m-1" /></p>
                        <p class="m-0">OR No.:<input type="text" class="m-1" /></p>
                    </div>
                    <div class="text-center float-right">
                        <p>CERTIFIED AND ISSUED BY:</p>
                        <p class="font-weight-bold m-0">RANDY P. GATI</p>
                        <p>Punong Barangay</p>
                    </div>
                </b-col>
            </b-row>
        </b-card>
        <div class="float-right">
            <button type="button" class="btn btn-secondary">Reset</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form">Next</button>
        </div>
        <!-- modal -->
        <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-body">
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
                        <b-row>
                            <b-col md="3" class="border-r text-center">
                                <p class="mb-1 text-uppercase">Randy P. Gati</p>
                                <p class="font-italic green">Punong Barangay</p>
                                <p class="mb-1 text-uppercase">Randy P. Gati</p>
                                <p class="font-italic green">Committee Chairman on Peace and Order</p>
                                <p class="mb-1 text-uppercase">Randy P. Gati</p>
                                <p class="font-italic green">Committee Chairman on Infrastructure Projects and
                                    Street/Alley Lights</p>
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
                            <b-col md="8" class="border-l ml-1">
                                <p>TO WHOM IT MAY CONCERN:</p>
                                <div class="p-1">
                                    <p>This is to certify -----, --
                                        years old, ----- citizen
                                        , a native of ----- and presently residing at
                                        -----
                                        and whose signature appears hereunder, has no pending adverse cases and
                                        deragatory records filed
                                        against ----- per available records on file with
                                        this office as of the date of issuance thereof.
                                    </p>
                                </div>
                                <div class="pb-5">
                                    <p class="m-0">Issued ----- purposes.</p>
                                    <p>Issued this ----- day of -----
                                        at Ambiong-Baguio Barangay, Baguio City, Philippines</p>
                                </div>
                                <div>
                                    <p>(Name Signature of Applicant)</p>
                                    <p class="m-0">Com. tax Cert #:-----</p>
                                    <p class="m-0">Issued on:-----</p>
                                    <p class="m-0">Issued at:-----</p>
                                    <p class="m-0">OR No.:-----</p>
                                </div>
                                <div class="text-center float-right">
                                    <p>CERTIFIED AND ISSUED BY:</p>
                                    <p class="font-weight-bold m-0">RANDY P. GATI</p>
                                    <p>Punong Barangay</p>
                                </div>
                            </b-col>
                        </b-row>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Export</button>
                    </div>
                </div>
            </div>
        </div>
    </b-card>
    </v-app>
</template>
<script>
export default {
  data() {
    return {
      form: new Form({
        first_name: "",
        family_name: "",
        middle_name: "",
        age: ""
      })
    };
  }
};
</script>