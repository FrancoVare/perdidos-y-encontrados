<script>
import { Doughnut } from 'vue-chartjs'
    export default {
        extends: Doughnut,
        data() {
            return {
                reportes: [],
                chartData: {labels:[],datasets:[]}
            };
        },
        mounted () {
            // // Overwriting base render method with actual data.
            // this.renderChart(this.chartData);
        },
        watch:{
        },
        created() {
            this.getReporte();
        },
        methods: {
            getReporte(){
                axios.get('/reportes/pe')
                    .then(({data}) => {
                        this.reportes = data;
                        this.chartData = {
                                  labels: this.reportes.map(function(reporte){return reporte[0];}),
                                  datasets: [{
                                              data: this.reportes.map(function(reporte){return reporte[1];}),
                                              backgroundColor:['red','green']
                                             }]
                                };
                        this.renderChart(this.chartData);
                    });
            },
        }
    }
</script>