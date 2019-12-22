<template>
    <div id="homenya">
        <div class="row">
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <i class="icon-docs bg-success p-3 font-2xl mr-3"></i>
                        <div>
                            <div class="text-value-sm text-success">{{summary.page}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Page</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <router-link to="/page" class="btn-block text-muted d-flex justify-content-between align-items-center">
                            <span class="small font-weight-bold">View More</span>
                            <i class="fa fa-angle-right"></i>
                        </router-link>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <i class="icon-menu bg-info p-3 font-2xl mr-3"></i>
                        <div>
                            <div class="text-value-sm text-info">{{summary.menu}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Summary & Menu</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <router-link to="/menu" class="btn-block text-muted d-flex justify-content-between align-items-center">
                            <span class="small font-weight-bold">View More</span>
                            <i class="fa fa-angle-right"></i>
                        </router-link>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <i class="icon-blog bg-primary p-3 font-2xl mr-3"></i>
                        <div>
                            <div class="text-value-sm text-primary">{{summary.news}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">News</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <router-link to="/all-post" class="btn-block text-muted d-flex justify-content-between align-items-center">
                            <span class="small font-weight-bold">View More</span>
                            <i class="fa fa-angle-right"></i>
                        </router-link>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <i class="icon-calendar bg-danger p-3 font-2xl mr-3"></i>
                        <div>
                            <div class="text-value-sm text-danger">{{summary.event}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Event</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <router-link to="/event" class="btn-block text-muted d-flex justify-content-between align-items-center">
                            <span class="small font-weight-bold">View More</span>
                            <i class="fa fa-angle-right"></i>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">Traffic</h4>
                        <div class="small text-muted">{{periode}}</div>
                    </div>

                    <div class="col-sm-7 d-none d-md-block">
                        <!-- <button class="btn btn-primary float-right" type="button">
                            <i class="icon-cloud-download"></i>
                        </button> -->
                        <div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
                            <label class="btn btn-outline-secondary">
                                <input id="option1" type="radio" name="options" autocomplete="off"> Day
                            </label>
                            <label class="btn btn-outline-secondary active">
                                <input id="option2" type="radio" name="options" autocomplete="off" checked=""> Month
                            </label>
                            <label class="btn btn-outline-secondary">
                                <input id="option3" type="radio" name="options" autocomplete="off"> Year
                            </label>
                        </div>
                    </div>
                </div>

                <GChart
                    type="AreaChart"
                    :data="chartData"
                    :options="chartOptions"
                />

            </div>
            <!-- <div class="card-footer">
                <div class="row text-center">
                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">Visits</div>
                        <strong>29.703 Users (40%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">Unique</div>
                        <strong>24.093 Users (20%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            // Array will be automatically processed with visualization.arrayToDataTable function
            periode:'',
            chartData: [],
            chartOptions: {
                chart: {
                    title: 'Traffic',
                    subtitle: '',
                },
                chartArea:{left:100,top:50, right:140, bottom:40,width:"100%",height:"100%"},
                height: 420
                //   ,width: 500
            },
            summary:{
                page:0,
                menu:0,
                news:0,
                event:0
            }
        }
    },
    mounted(){
        this.getDashboard()
        this.getChart()
    },
    methods:{
        getDashboard(){
            axios.get('data/dashboard')
                .then(response => {
                    this.summary={
                        page : response.data.page,
                        menu : response.data.menu,
                        news : response.data.news,
                        event : response.data.event
                    }
                })
        },

        getChart(){
            axios.get('data/access-log')
                .then(response => {
                    this.periode = response.data.bulan
                    this.chartData = response.data.data
                })
        }
    }
}
</script>

