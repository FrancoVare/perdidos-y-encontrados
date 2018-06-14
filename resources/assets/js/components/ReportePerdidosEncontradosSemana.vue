<template>
<div class="lg-card" style="text-align: center">
    <p>Esta semana se perdieron <font style="font-weight: bold">{{reporte[0][1]}}</font> objetos y se encontraron <font style="font-weight: bold">{{reporte[1][1]}}</font></p>
</div>
</template>

<script>
    export default {

        data() {
            return {
                reporte: [[],[]],
            };
        },

        created() {
            axios.get('/reportes/pes')
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