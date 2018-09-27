<template>
    <div class="container-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Household</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="dropdown float-sm-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addinhabitant"> Add Inhabitant <i class="fas fa-user-plus" fa-fw></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="dropdown float-right">
                                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Export
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
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td>183</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>Approved</td>
                                            <td>Bacon ipsum</td>
                                            <td>Bacon ipsum</td>
                                            <td>Bacon ipsum</td>
                                            <td>Bacon ipsum</td>
                                            <td>
                                                <a href=""><i class="fa fa-eye"></i></a>/
                                                <a href=""><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade justify-content-center" id="addinhabitant" tabindex="-1" role="dialog" aria-labelledby="addinhabitantTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-center" id="addinhabitantLongTitle">Relation to the Head</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mt-2">
                        <div class="input-group mb-3">
                            <select class="custom-select" id="inputGroupSelect02">
                                <option selected>Choose...</option>
                                <option value="1">The Head</option>
                                <option value="2">Father</option>
                                <option value="3">Mother</option>
                                <option value="3">Dauther</option>
                                <option value="3">Son</option>
                                <option value="3">Sister</option>
                                <option value="3">Brother</option>
                                <option value="3">Aunt</option>
                                <option value="3">Uncle</option>
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="inputGroupSelect02">Options</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Okay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }

</script>
