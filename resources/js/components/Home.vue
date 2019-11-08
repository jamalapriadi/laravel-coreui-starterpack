<template>
    <div id="homenya">
        <!-- <div class="row">
            <div class="col-lg-6">
                <div class="card card-default">
                    <div class="card-header">Chart</div>
                    <div class="card-body">
                        <GChart
                            type="ColumnChart"
                            :data="chartData"
                            :options="chartOptions"
                        />
                    </div>
                </div>
            </div>
        </div> -->
        
        <div class="card card-default">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
        // Array will be automatically processed with visualization.arrayToDataTable function
        chartData: [
            ['Year', 'Sales', 'Expenses', 'Profit'],
            ['2014', 1000, 400, 200],
            ['2015', 1170, 460, 250],
            ['2016', 660, 1120, 300],
            ['2017', 1030, 540, 350]
        ],
        chartOptions: {
            chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            }
        }
        }
    }
}
</script>

