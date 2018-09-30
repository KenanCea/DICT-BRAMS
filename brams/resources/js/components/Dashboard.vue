<template>
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-cyan">
                            <div class="inner">
                                <h3>1109</h3>
                                <p>Total Inhabitants</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-indigo">
                            <div class="inner">
                                <h3>252</h3>
                                <p>Total Households</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-pink">
                            <div class="inner">
                                <h3>5</h3>
                                <p>Total Purok / Sitio</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-street-view"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
