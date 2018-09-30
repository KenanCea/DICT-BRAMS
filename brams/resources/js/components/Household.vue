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
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown button
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
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
                        <h3 class="card-title">Responsive Hover Table</h3>
                        <div class="card-tools">
                          <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                          <tbody><tr>
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
                        </tbody></table>
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
