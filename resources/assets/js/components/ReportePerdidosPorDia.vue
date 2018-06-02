<script>
import { Bubble } from 'vue-chartjs'
    export default {
        extends: Bubble,
        data() {
            return {
                reportes: [],
                chartData: {labels:[],datasets:[]},
                options: {
                    responsive:true,
                    maintainAspectRatio:false,
                    legend: {
                        display: false
                    },
                    layout:{
                        padding:{
                            top:21,
                            right:21,
                        }
                    },
                    scales:{
                        xAxes: [{
                            ticks: {
                                min: 0,
                                max: 23,
                                callback: function(value, index, values) {
                                    if(value == -1) return '';
                                  return value+'hs';
                                },
                                autoSkip: false,
                                fixedStepSize:1,
                                padding: 15,
                              },
                        }],
                        yAxes: [{
                            gridLines:{
                                // offsetGridLines:true,
                            },
                            ticks: {
                                min:1,
                                max:7,
                                reverse:true,
                                callback: function(value, index, values) {
                                  var ret = '';
                                  switch(value){
                                    case 1:
                                        ret = 'Lunes';
                                        break;
                                    case 2:
                                        ret = 'Martes';
                                        break;
                                    case 3:
                                        ret = 'Miércoles';
                                        break;
                                    case 4:
                                        ret = 'Jueves';
                                        break;
                                    case 5:
                                        ret = 'Viernes';
                                        break;
                                    case 6:
                                        ret = 'Sábado';
                                        break;
                                    case 7:
                                        ret = 'Domingo';
                                        break;
                                  }
                                  return ret;
                                },
                                autoSkip: false,
                                fixedStepSize:1,
                                padding: 15,
                              }
                        }]
                    },
                    tooltips:{
                        callbacks:{
                            label: function(item,data){
                                var text = data.datasets[item.datasetIndex].data[item.index].value;
                                var ret = '';
                                  switch(data.datasets[item.datasetIndex].data[item.index].y){
                                    case 1:
                                        ret = 'Lunes';
                                        break;
                                    case 2:
                                        ret = 'Martes';
                                        break;
                                    case 3:
                                        ret = 'Miércoles';
                                        break;
                                    case 4:
                                        ret = 'Jueves';
                                        break;
                                    case 5:
                                        ret = 'Viernes';
                                        break;
                                    case 6:
                                        ret = 'Sábado';
                                        break;
                                    case 7:
                                        ret = 'Domingo';
                                        break;
                                  }
                                if(text>1) text = text + ' objetos perdidos, ';
                                else text = text + ' objeto perdido, ';
                                return ' '+text +' '+ret +' '+ data.datasets[item.datasetIndex].data[item.index].x+'hs';
                            }
                        }
                    },
                    elements: {
                        point: {
                          radius: function(context) {
                            var circGrande = context.chart.width/50.0 -1;
                            var circChico = circGrande /4.0;
                            var maxValue = Math.max.apply(Math,context.dataset.data.map(x=> x.value));
                            var a = (circGrande - circChico) / (maxValue - 1);
                            var b = circChico - a;
                            return context.dataset.data[context.dataIndex].value * a + b;
                          }
                        }
                      }
                }
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
                axios.get('/reportes/ppd')
                    .then(({data}) => {
                        this.reportes = data;
                        this.chartData = {
                                  labels: 'Perdidos por dia',
                                  datasets: [{
                                              label:['Perdidos por dia'],
                                              data: this.reportes,
                                              backgroundColor: 'red',
                                             }]
                                };
                        this.renderChart(this.chartData,this.options);
                    });
            },
        }
    }
</script>