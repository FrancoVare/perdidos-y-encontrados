<template>
    <modal :show="show" @close="close">
        
            
            <div class="modal-header">
            <h3>Nueva Sede</h3>
        </div>
        <div class="modal-body">
            <label class="form-label">Nombre</label>
            <input v-model="nombre" :class="{'form-control' : true, 'is-invalid': errors.nombreSede}">
            <span v-if="errors.nombreSede" class="invalid-feedback">
                <strong>Debe ingresar un nombre.</strong>
            </span>
            <label class="form-label">Direccion</label>
            <input v-model="direccion" :class="{'form-control' : true, 'is-invalid': errors.direccion}">
            <span v-if="errors.direccion" class="invalid-feedback">
                <strong>Debe ingresar la direccion.</strong>
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
        direccion: '',
        errors: {
            nombreSede: null,
            direccion: null
        }
	    };
  	  },
	  methods: {
	    close() {
	      this.$emit('close');
	      this.nombre = '';
        this.direccion = '';
        this.errors = {
            nombreSede: null,
            direccion: null
        };
	    },
	    savePost() {
	      // Some save logic goes here...
	      axios.post('/sedes',{nombreSede: this.nombre , direccion: this.direccion})
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