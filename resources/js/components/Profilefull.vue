<template>
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row ml-2">
                    <h1>Barangay Profile</h1>
                </div>
            </div>
        </section>
        <section class="container">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card card-default p-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Barangay Logo</h4>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile03">
                                            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>Barangay Name: </p>
                                    <p>Barangay Code: </p>
                                    <p>Region: </p>
                                    <p>Municipality / City: </p>
                                    <p>Province: </p>
                                    <router-link to="/profilefull" class="text-center">
                                        <p>See more</p>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
    export default {
    }

</script>
