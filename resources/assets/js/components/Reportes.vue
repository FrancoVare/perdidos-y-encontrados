<template>
<div class="row">
    <div class="col-sm-1"></div>

    <div class="col-sm-10">
        <ptp></ptp>
        <div class="row">
            <div class="col-sm-6">
                
                

                <div class="lg-card" style="text-align: center">
                    <div style="display: flex">
                        <h3 style="margin-right:10px">Objetos perdidos por</h3>
                        <select v-model="atributoSeleccionado">
                            <option value="tag">Tag</option>
                            <option value="materia">Materia</option>
                            <option value="sede">Sede</option>
                            <option value="laboratorio">Laboratorio</option>
                        </select>
                    </div>
                    <hr>
                    <ppa :atributo="atributoSeleccionado"></ppa>
                </div>

            </div>

            <div class="col-sm-6">

                <div class="lg-card" style="text-align: center">
                    <h3>Perdidos y encontrados</h3>
                    <hr>
                    <pe></pe>
                </div>

                
            </div>
        </div>
        
        <div class="lg-card" style="text-align: center">
            <h3>Perdidos por dia</h3>
            <hr>
            <ppd></ppd>
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