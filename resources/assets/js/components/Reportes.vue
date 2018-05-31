<template>
<div class="row">
    <div class="col-sm-1"></div>

    <div class="col-sm-10">
        
        <ptp></ptp>
        
        <div class="lg-card" style="text-align: right">
            <select v-model="atributoSeleccionado">
                <option value="tag">Tag</option>
                <option value="materia">Materia</option>
                <option value="sede">Sede</option>
                <option value="laboratorio">Laboratorio</option>
            </select>
            <ppa :atributo="atributoSeleccionado"></ppa>
        </div>
        <div class="lg-card">
            <pe></pe>
        </div>
    </div>
</div>
</template>

<script>
    export default {

        data() {
            return {
                atributoSeleccionado: 'tag'
            };
        },

        created() {
        },
        methods: {

        }
    }
</script>

<style>

</style>