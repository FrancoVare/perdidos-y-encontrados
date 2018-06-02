<template>
<div class="lg-card" style="text-align: center">
  <h3>Promedio de tiempo perdido</h3>
  <hr>
    <h1>{{this.reporte.promedio}} dias</h1>
</div>
</template>

<script>
    export default {

        data() {
            return {
                reporte: [],
            };
        },

        created() {
            axios.get('/reportes/ptp')
                    .then(({data}) => {
                        this.reporte = data;
                    });
        },
        methods: {

        }
    }
</script>

<style>

</style>