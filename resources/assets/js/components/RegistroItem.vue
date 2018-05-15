<template>
    <div class="row">
            <div class="col-sm-4" style="display: flex;">
                <registro v-model.number="selectedMateria" atributo="Materia"></registro>
            </div>
            <div class="col-sm-4" style="display: flex;">
                <registro v-model.number="selectedTag" atributo="Tag"></registro>
            </div>
            <div class="col-sm-4" style="display: flex;">
                <registro v-model.number="selectedLab" atributo="Laboratorio"></registro>
            </div>
        </div>
</template>

<script>
    export default {
        data() {
            return {
              selectedMateria: null,
              selectedTag: null,
              selectedLab: null,
            };
        },
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>