<template>
    <div style="width: 100%">
      <div style="display: flex">
        <div class="container" style="margin: auto">
          <label style="margin: auto .5em">{{this.atributo}}</label>
          <select v-bind:value="value" v-on:change="updateValue($event.target.value)" :class="{'form-control' : true, 'is-invalid': errors.nombre || this.errorShow}" v-model="selected" style="width: 100%; margin:auto .5em">
            <option style="display:none"></option> 
            <option v-if="atributo == 'Materia'" v-for="materia in lista" :value="materia.id">{{materia.nombre}}</option>
            <option v-if="atributo == 'Tag'" v-for="tag in lista" :value="tag.id">{{tag.nombre}}</option>
            <option v-if="atributo == 'Laboratorio'" v-for="lab in lista" :value="lab.id">{{lab.nombre}} de {{lab.sede.nombre}}</option>
          </select>
          <span v-if="errors.nombre || this.errorShow" class="invalid-feedback">
            <strong>Debe seleccionar una opcion.</strong>
          </span>
        </div>
        <div>
          <button class="btn btn-success rounded-circle btn-lg" @click="abrirModal()"><i class="fa fa-plus"></i></button>
          <button class="btn btn-danger rounded-circle btn-lg" @click="eliminarDato()"><i class="fa fa-times"></i></button>
        </div>
      </div>
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
        props:['atributo','value','errorShow'],
        created() {
            this.getDatos();
        },
        watch: {
          selected: function (newVal,oldVal){
            if(newVal) this.errors = {
                nombre:null
              };
            else this.updateValue(null);
          },
          value: function (newVal,oldVal){
            if(!newVal) this.selected = null;
          }
        },
        methods: {
          updateValue: function (value) {
            this.$emit('input', value);
          },
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
                    if(!this.errors) this.errors = {
                      nombre:null,
                  }
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
