<template>
<div class="lg-card">
    <select v-model="atributo" @change="getReporte()">
        <option value="tag">Tag</option>
        <option value="sede">Sede</option>
        <option value="laboratorio">Laboratorio</option>
        <option value="materia">Materia</option>
    </select>
<ul>
    <li v-for="reporte in reportes">{{reporte.nombre}}: {{reporte.cantidad}}</li>
</ul>
</div>
</template>

<script>
    export default {

        data() {
            return {
                reportes: [],
                atributo: 'tag',
            };
        },

        created() {
            this.getReporte();
        },
        methods: {
            getReporte(){
                axios.get('/reportes/ppa?atributo=' + this.atributo)
                    .then(({data}) => {
                        this.reportes = data;
                    });
            }
        }
    }
</script>

<style>

</style>