<template>
  <div>
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
    </div>
        <label>Descripcion</label>
        <textarea v-model="descripcion" :class="{'form-control' : true, 'is-invalid': errors.descripcion}"></textarea>
        <span v-if="errors.descripcion" class="invalid-feedback">
            <strong>Debe proveer una descripcion</strong>
        </span>
        <uploader v-model="foto_item" :error="this.errors.foto_item" :upload-percentage="uploadPercentage"></uploader>
        <div style="text-align: right; width:100%;">
            <hr>
            <button :disabled="cargando" class="btn btn-primary btn-lg" style="margin: 0;" @click="guardarItem()">Aceptar</i></button>
        </div>
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
              foto_item:null,
              uploadPercentage: 0,
              cargando: false,
              errors: {
                descripcion: null,
                materia_id: null,
                laboratorio_id: null,
                tag_id: null,
                foto_item: null,
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
          foto_item: function (newVal,oldVal){
            if(newVal) {
              this.errors.foto_item = null;
              this.uploadPercentage = 0;
            }
          },
        },
        methods: {
            guardarItem(){
                let formData = new FormData();
                formData.append('foto_item',this.foto_item);
                formData.append('descripcion',this.descripcion);
                formData.append('materia_id',this.selectedMateria);
                formData.append('laboratorio_id',this.selectedLab);
                formData.append('tag_id',this.selectedTag);
                this.cargando = true;
                axios.post('/items',formData,
                {
                  headers: {
                    'Content-Type': 'multipart/form-data'
                  },
                  onUploadProgress: function( progressEvent ) {
                    this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) );
                  }.bind(this)
                })
                .then(response => {
                    flash(response.data.message,'success');
                    // this.uploadPercentage = 0;
                    this.cargando = false;
                    this.selectedMateria = null;
                    this.selectedTag = null;
                    this.selectedLab = null;
                    this.descripcion = '';
                    this.foto_item = null;
                    this.errors = {
                      descripcion: null,
                      materia_id: null,
                      laboratorio_id: null,
                      tag_id: null,
                      foto_item: null,
                    }
                })
                .catch(error =>{
                    this.errors = error.response.data.errors;
                    // this.uploadPercentage = 0;
                    this.cargando = false;
                    if(!this.errors) this.errors = {
                      descripcion: null,
                      materia_id: null,
                      laboratorio_id: null,
                      tag_id: null,
                      foto_item: null,
                    }
                });
            }
        }
    }
</script>