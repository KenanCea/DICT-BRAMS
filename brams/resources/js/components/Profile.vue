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
                                    <div class="image text-center"> <img src="/img/profile.png" alt="User Image" style="width:200px"> </div>
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
        <section class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Position</th>
                                            <th>Name</th>
                                            <th>Start Term</th>
                                            <th>End Term</th>
                                        </tr>
                                        <tr>
                                            <td>Punong Barangay</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>11-7-2014</td>
                                        </tr>
                                        <tr>
                                            <td>Kagawad</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>11-7-2014</td>
                                        </tr>
                                        <tr>
                                            <td>Kagawad</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>11-7-2014</td>
                                        </tr>
                                        <tr>
                                            <td>Kagawad</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>11-7-2014</td>
                                        </tr>
                                        <tr>
                                            <td>Kagawad</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>11-7-2014</td>
                                        </tr>
                                        <tr>
                                            <td>Kagawad</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>11-7-2014</td>
                                        </tr>
                                        <tr>
                                            <td>Kagawad</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>11-7-2014</td>
                                        </tr>
                                        <tr>
                                            <td>Barangay Secretary</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>11-7-2014</td>
                                        </tr>
                                        <tr>
                                            <td>Barangay Treasurer</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>11-7-2014</td>
                                        </tr>
                                        <tr>
                                            <td>SK Chairman</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>11-7-2014</td>
                                        </tr>

                                    </tbody>
                                </table>
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
        mounted() {
            console.log('Component mounted.')
        }
    }

</script>
