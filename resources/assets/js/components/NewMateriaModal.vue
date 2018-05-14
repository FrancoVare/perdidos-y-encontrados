<template>
    <modal :show="show" @close="close">
        
            
            <div class="modal-header">
            <h3>Nueva Materia</h3>
        </div>
        <div class="modal-body">
            <label class="form-label">Nombre</label>
            <input v-model="nombre" :class="{'form-control' : true, 'is-invalid': errors.nombreMateria}">
            <span v-if="errors.nombreMateria" class="invalid-feedback">
                <strong>Debe ingresar un nombre.</strong>
            </span>
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
          errors: {
            nombreMateria:null
          }
	    };
  	  },
	  methods: {
	    close() {
	      this.$emit('close');
	      this.nombre = '';
          this.errors = {
            nombreMateria:null
          };
	    },
	    savePost() {
	      // Some save logic goes here...
	      axios.post('/materias',{nombreMateria: this.nombre})
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