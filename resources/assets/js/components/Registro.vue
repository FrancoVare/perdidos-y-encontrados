<template>
    <div style="width: 100%">
      <div style="display: flex">
        <label style="margin-right: 1rem">{{this.atributo}}:</label>
        <select id="selector" :name="this.atributo" v-model="selected" style="width: 100%; margin-bottom: 1rem;">
          <option style="display:none"></option> 
          <option v-if="atributo == 'Materia'" v-for="materia in lista" :value="materia.id">{{materia.nombre}}</option>
          <option v-if="atributo == 'Tag'" v-for="tag in lista" :value="tag.id">{{tag.nombre}}</option>
          <option v-if="atributo == 'Laboratorio'" v-for="lab in lista" :value="lab.id">{{lab.nombre}} de {{lab.sede.nombre}}</option>
        </select>
      </div>
      <div style="text-align: center;">
        <button class="btn btn-primary" @click="abrirModal()">Agregar {{this.atributo}}</button>
        <button class="btn btn-primary" @click="eliminarDato()">Eliminar {{this.atributo}}</button>
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
            };
        },

        props:['atributo'],

        created() {
            this.getDatos();
        },

        methods: {
            getDatos() {
              axios.get("/api/" + this.atributo.toLowerCase() + 's')
                    .then(({data}) => {
                        this.lista = data;
                    });
            },
            eliminarDato(){
              if(this.selected){
                this.post = '/' + this.atributo.toLowerCase() + 's/destroy' +' => '+ '{nombre: ' + this.selected + '}';
                axios.post('/' + this.atributo.toLowerCase() + 's/destroy',{nombre: this.selected})
                .then(response => {
                    this.selected = null;
                    this.getDatos();
                    flash(response.data.message,'success');
                });
              } else {
                this.post = "no seleccionaste nada";
              }
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

</style>