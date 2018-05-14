<template>
    <modal :show="show" @close="close">
        <div class="modal-header">
            <h3>Nuevo Tag</h3>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label class="form-label">Nombre</label>
              <input v-model="nombre" :class="{'form-control' : true, 'is-invalid': errors.nombre}">
              <span v-if="errors.nombre" class="invalid-feedback">
                  <strong>Debe ingresar un nombre.</strong>
              </span>
            </div>
            <div class="form-group">
              <label class="form-label">Pruebas</label>
              <select multiple v-model="selected" :class="{'form-control' : true, 'is-invalid': errors.pruebas}" style="size=10">
                  <option v-for="prueba in pruebas" :value="prueba.id">{{prueba.nombre}}</option>
              </select>
              <span v-if="errors.pruebas" class="invalid-feedback">
                  <strong>Debe seleccionar al menos una prueba.</strong>
              </span>
            </div>
            <div style="text-align: center;">
              <button class="btn btn-primary" @click="abrirModal()">Agregar Prueba</button>
              <new-materia-modal :show="showModal" @close="cerrarModal()"></new-materia-modal>
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
        selected: [],
        pruebas: [],
        showModal: false,
        errors: {
            nombre:null,
            pruebas:null
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
            nombre:null,
            pruebas:null
        };
        this.selected = [];
	    },
      abrirModal(){
        this.showModal = true;
      },
      cerrarModal(){
        this.showModal = false;
      },
      getDatos() {
              axios.get("/api/pruebas")
                    .then(({data}) => {
                        this.pruebas = data;
                    });
      },
	    savePost() {
	      // Some save logic goes here...
	      axios.post('/tags',{nombre: this.nombre, pruebas: this.selected})
          .then(response => {
            flash(response.data.message,'success');
            this.close();
          })
          .catch(error =>{
            this.errors = error.response.data.errors;
          });
	    }
    }
}
</script>