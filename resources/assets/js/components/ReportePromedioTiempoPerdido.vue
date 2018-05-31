<template>
<div class="lg-card">
    En un total de {{this.reporte.cantidad}} items, el promedio de tiempo que permanecen perdidos es de {{this.reporte.promedio}} dias.
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