<template>
    <modal :show="show" @close="close">
        <div class="modal-header">
            <h3>Nueva Materia</h3>
        </div>
        <div class="modal-body">
            <label class="form-label">
                Nombre:
                <input v-model="nombre" class="form-control">
            </label>
        </div>
        <div class="modal-footer text-right">
            <button class="modal-default-button" @click="savePost()">
                Save
            </button>
        </div>
    </modal>
</template>

<script>
    export default {
      props: ['show'],
      data: function () {
	    return {
	      nombre: ''
	    };
  	  },
	  methods: {
	    close() {
	      this.$emit('close');
	      this.title = '';
	    },
	    savePost() {
	      // Some save logic goes here...
	      axios.post('/materias',{nombreMateria: this.nombre});
	      this.close();
	    }
    }
}
</script>