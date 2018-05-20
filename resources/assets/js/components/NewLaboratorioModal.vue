<template>
    <modal :show="show" @close="close">
        <div class="modal-header">
            <h3>Nuevo Laboratorio</h3>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label class="form-label">Nombre</label>
              <input v-model="nombre" :class="{'form-control' : true, 'is-invalid': errors.nombreLab}">
              <span v-if="errors.nombreLab" class="invalid-feedback">
                  <strong>Debe ingresar un nombre.</strong>
              </span>
            </div>
            <div class="form-group">
              <label class="form-label">Sedes</label>
              <select v-model="selected" :class="{'form-control' : true, 'is-invalid': errors.sede}">
                  <option v-for="sede in sedes" :value="sede.id">{{sede.nombre}}</option>
              </select>
              <span v-if="errors.sede" class="invalid-feedback">
                  <strong>Debe seleccionar al menos una sede.</strong>
              </span>
            </div>
            <div style="text-align: center;">
              <button class="btn btn-success rounded-circle btn-lg" @click="abrirModal()"><i class="fa fa-plus"></i></button>
              <button class="btn btn-danger rounded-circle btn-lg" @click="eliminarSede()"><i class="fa fa-times"></i></button>
              <new-sede-modal :show="showModal" @close="cerrarModal()"></new-sede-modal>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" @click="savePost()">
                Aceptar
            </button>
        </div>
    </modal>
</template>

<script>
    export default {
      props: ['show'],
      data: function () {
      return {
        nombre: '',
        selected: null,
        sedes: [],
        showModal: false,
        errors: {
            nombreLab:null,
            sedes:null
          }
      };
      },
      created(){
        this.getDatos();
      },
    methods: {
      close() {
        this.$emit('close');
        this.nombre = '';
        this.errors = {
            nombreLab:null,
            sedes:null
        };
        this.selected = null;
      },
      abrirModal(){
        this.showModal = true;
      },
      cerrarModal(){
        this.showModal = false;
        this.getDatos();
      },
      getDatos() {
              axios.get("/api/sedes")
                    .then(({data}) => {
                        this.sedes = data;
                    });
      },
      savePost() {
        // Some save logic goes here...
        axios.post('/laboratorios',{nombreLab: this.nombre, sede: this.selected})
          .then(response => {
            flash(response.data.message,'success');
            this.close();
          })
          .catch(error =>{
            this.errors = error.response.data.errors;
            if(!this.errors) this.errors = {
                              nombreLab:null,
                              sedes:null
                            }
          });
      },
      eliminarSede() {
        // Some save logic goes here...
      axios.post('/sedes/destroy',{sede: this.selected})
           .then(response => {
              flash(response.data.message,'success');
              this.getDatos();
              this.selected = null;
            })
           .catch(error =>{
              this.errors = error.response.data.errors;
              if(!this.errors) this.errors = {
                                  nombreLab:null,
                                  sedes:null
                                }
           });
      }
    }
}
</script>