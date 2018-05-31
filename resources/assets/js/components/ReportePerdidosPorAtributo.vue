<template>
<div class="lg-card">
<ul>
    <li v-for="reporte in reportes">{{reporte}}</li>
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
            axios.get('/reportes/ppa?atributo=' + this.atributo)
                    .then(({data}) => {
                        this.reportes = data;
                    });
        },
        methods: {

        }
    }
</script>

<style>

</style>