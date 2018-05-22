<template>
    <modal :show="show" @close="close">
        
            
            <div class="modal-header">
            <h3>Nueva Prueba</h3>
        </div>
        <div class="modal-body">
            <label class="form-label">Descripcion</label>
            <input v-model="nombre" :class="{'form-control' : true, 'is-invalid': errors.nombre}">
            <span v-if="errors.nombre" class="invalid-feedback">
                <strong>Debe ingresar una descripcion.</strong>
            </span>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="savePost()">
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
          errors: {
            nombre:null
          }
	    };
  	  },
	  methods: {
	    close() {
	      this.$emit('close');
	      this.nombre = '';
          this.errors = {
            nombre:null
          };
	    },
	    savePost() {
	      // Some save logic goes here...
	      axios.post('/pruebas',{nombre: this.nombre})
          .then(response => {
            flash(response.data.message,'success');
            this.close();
          })
          .catch(error =>{
            this.errors = error.response.data.errors;
            if(!this.errors) this.errors = {
                                nombre:null
                              }
          });
	    }
    }
}
</script>