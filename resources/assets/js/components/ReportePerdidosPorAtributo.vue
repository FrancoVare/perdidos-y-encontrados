<script>
import { HorizontalBar,mixins } from 'vue-chartjs'
    export default {
        extends: HorizontalBar,
        props: ['atributo'],
        mixins:[mixins.reactiveData],
        data() {
            return {
                reportes: [],
                options: {
                    responsive:true,
                    scales : {
                        xAxes : [{
                            ticks : {
                                beginAtZero : true
                            }   
                        }],
                        yAxes: [{
                            stacked: false,
                            categoryPercentage:0.5,
                            ticks: {
                                autoSkip: false
                            }
                        }]
                    }},
            };
        },
        mounted () {
            // Overwriting base render method with actual data.
            this.renderChart(this.chartData,this.options);
        },
        watch:{
            atributo(){
                this.getReporte();
            }
        },
        created() {
            this.getReporte();
        },
        methods: {
            getReporte(){
                axios.get('/reportes/ppa?atributo=' + this.atributo)
                    .then(({data}) => {
                        this.reportes = Object.values(data);
                        this.chartData = {
                                  labels: this.reportes.map(function(reporte){return reporte.nombre;}),
                                  datasets: [{
                                                      label: 'Objetos perdidos por ' + this.atributo,
                                                      backgroundColor: '#6c757d',
                                                      borderColor: '#000000',
                                                      borderWidth: '4',
                                                      data: this.reportes.map(function(reporte){return reporte.cantidad;})
                                                     }]
                                };
                    });
            },
        }
    }
</script>
<!-- 
<style>

</style> -->