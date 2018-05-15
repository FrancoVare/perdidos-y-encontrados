<template>
    <div style="width: 100%">
      <div style="display: flex">
        <label style="margin: auto .5em">{{this.atributo}}:</label>
        <select :name="this.atributo" :class="{'form-control' : true, 'is-invalid': errors.nombre}" v-model="selected" style="width: 100%; margin:auto .5em">
          <option style="display:none"></option> 
          <option v-if="atributo == 'Materia'" v-for="materia in lista" :value="materia.id">{{materia.nombre}}</option>
          <option v-if="atributo == 'Tag'" v-for="tag in lista" :value="tag.id">{{tag.nombre}}</option>
          <option v-if="atributo == 'Laboratorio'" v-for="lab in lista" :value="lab.id">{{lab.nombre}} de {{lab.sede.nombre}}</option>
        </select>
        <div>
          <button class="btn btn-success rounded-circle btn-lg" @click="abrirModal()"><i class="fa fa-plus"></i></button>
          <button class="btn btn-danger rounded-circle btn-lg" @click="eliminarDato()"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <span v-if="errors.nombre" class="invalid-feedback inv-reg">
            <strong>Debe seleccionar una opcion.</strong>
        </span>
      <div style="text-align: center;">
        
        <new-materia-modal v-if="atributo == 'Materia'" :show="showModal" @close="cerrarModal()"></new-materia-modal>
        <new-laboratorio-modal v-if="atributo == 'Laboratorio'" :show="showModal" @close="cerrarModal()"></new-laboratorio-modal>
        <new-tag-modal v-if="atributo == 'Tag'" :show="showModal" @close="cerrarModal()"></new-tag-modal>
      </div>
    </div>
</template>

<script>
import moment from 'moment';
moment.locale('es');
    export default {
        data() {
            return {
              lista:[],
              showModal: false,
              selected: null,
              post: '',
              errors: {
                nombre:null
              }
            };
        },
        props:['atributo'],
        created() {
            this.getDatos();
        },
        watch: {
          selected: function (newVal,oldVal){
            if(newVal) this.errors = {
                nombre:null
              };
          }
        },
        methods: {
            getDatos() {
              axios.get("/api/" + this.atributo.toLowerCase() + 's')
                    .then(({data}) => {
                        this.lista = data;
                    });
            },
            eliminarDato(){
                axios.post('/' + this.atributo.toLowerCase() + 's/destroy',{nombre: this.selected})
                .then(response => {
                    this.selected = null;
                    this.getDatos();
                    flash(response.data.message,'success');
                })
                .catch(error =>{
                    this.errors = error.response.data.errors;
                });
            },
            abrirModal(){
              this.showModal = true;
            },
            cerrarModal(){
              this.showModal = false;
              this.getDatos();
            }
        }
    }
</script>

<style>
.inv-reg{
    text-align: center;
    top: -30px;
    position: relative;
}
</style>