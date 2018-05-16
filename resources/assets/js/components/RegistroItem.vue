<template>
    <div class="row">
        <div class="col-sm-4" style="display: flex;">
            <registro :error-show="errors.materia_id" v-model.number="selectedMateria" atributo="Materia"></registro>
        </div>
        <div class="col-sm-4" style="display: flex;">
            <registro :error-show="errors.tag_id" v-model.number="selectedTag" atributo="Tag"></registro>
        </div>
        <div class="col-sm-4" style="display: flex;">
            <registro :error-show="errors.laboratorio_id" v-model.number="selectedLab" atributo="Laboratorio"></registro>
        </div>
        <label>Descripcion</label>
        <textarea v-model="descripcion" :class="{'form-control' : true, 'is-invalid': errors.descripcion}"></textarea>
        <span v-if="errors.descripcion" class="invalid-feedback">
            <strong>Debe proveer una descripcion</strong>
        </span>
        <div style="text-align: right; width:100%;">
            <hr>
            <button class="btn btn-primary btn-lg" style="margin: 0;" @click="guardarItem()">Aceptar</i></button>
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
              descripcion: '',
              errors: {
                descripcion: null,
                materia_id: null,
                laboratorio_id: null,
                tag_id: null
              }
            };
        },
        mounted() {
            // console.log('Component mounted.')
        },
        watch: {
          selectedMateria: function (newVal,oldVal){
            if(newVal) this.errors.materia_id = null;
          },
          selectedLab: function (newVal,oldVal){
            if(newVal) this.errors.laboratorio_id = null;
          },
          selectedTag: function (newVal,oldVal){
            if(newVal) this.errors.tag_id = null;
          },
          descripcion: function (newVal,oldVal){
            if(newVal.length) this.errors.descripcion = null;
          },
        },
        methods: {
            guardarItem(){
                axios.post('/items',{descripcion: this.descripcion,materia_id:this.selectedMateria,tag_id:this.selectedTag,laboratorio_id:this.selectedLab})
                .then(response => {
                    flash(response.data.message,'success');
                    this.selectedMateria = null;
                    this.selectedTag = null;
                    this.selectedLab = null;
                    this.descripcion = '';
                })
                .catch(error =>{
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>