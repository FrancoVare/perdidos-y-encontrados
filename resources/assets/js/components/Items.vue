<template>
    <div class="row">
      <div class="col-sm-1"></div>

      <div class="col-sm-8">
        <div v-if="total" class="container" style="text-align: right;"><p class="blog-post-meta">Mostrando {{Math.min(this.perPage,this.total)}} de {{this.total}}</p></div>
        <div v-else class="blog-post">
          <h2 class="blog-post-title">No se encontro nada con esas caracteristicas...</h2>
        </div>
        <a v-for="item in items" v-if="authCheck" :href="'/items/'+item.id">
          <div class="blog-post">
            <h2 class="blog-post-title">{{item.tag.nombre}}</h2>
            <p class="blog-post-meta" v-html="highlight(item)"></p>
          </div>
        </a>

        <div class="blog-post" v-if="!authCheck" v-for="item in items">
              <h2 class="blog-post-title">{{item.tag.nombre}}</h2>
              <p class="blog-post-meta" v-html="highlight(item)"></p>
        </div>

        <paginate
            :page-count="pageCount"
            :click-handler="fetch"
            :prev-text="'Anterior'"
            :next-text="'Siguiente'"
            :container-class="'pagination'"
            ref="paginate"
            v-if="total">

            <span slot="prevContent"><i class="fa fa-angle-left fa-lg"></i></span>
            <span slot="nextContent"><i class="fa fa-angle-right fa-lg"></i></span>
        </paginate>
      </div>

      <div class="col-sm-1"></div>

      <div class="col-sm-2">
        <div class="filter-module filter-module-inset">
          <h4>Tags</h4>
          <select size="3" v-model="tagActive" @change="fetchChangeSelect()">
            <option>Todos</option>
            <option v-for="tag in tags">{{tag.nombre}}</option>
          </select>
          <hr>
          <h4>Materia</h4>
          <select size="3" v-model="materiaActive" @change="fetchChangeSelect()">
            <option>Todas</option>
            <option v-for="materia in materias">{{materia.nombre}}</option>
          </select>
          <hr>
          <h4>Sede</h4>
          <select size="3" v-model="sedeActive" @change="fetchSede()">
            <option>Todas</option>
            <option v-for="sede in sedes">{{sede.nombre}}</option>
          </select>
          <hr>
          <h4>Laboratorio</h4>
          <select size="3" v-model="laboratorioActive" @change="fetchChangeSelect()">
            <option>Todos</option>
            <option v-for="laboratorio in laboratorios" :value="laboratorio.nombre" v-if="(laboratorio.sede.nombre == sedeActive && sedeActive != 'Todas') || sedeActive == 'Todas'">
              {{nombreLab(laboratorio)}}
            </option>
          </select>
<!--           <hr>
          <h4>Estado</h4>
          <ul class="fa-ul">
            <li><a :class="{active : estadoActive == 'Perdidos'}" href="#" @click="addEstado('Perdidos')"><i class="fa-li fa fa-chevron-circle-right"></i>Perdidos</a></li>
            <li><a :class="{active : estadoActive == 'Encontrados'}" href="#" @click="addEstado('Encontrados')"><i class="fa-li fa fa-chevron-circle-right"></i>Encontrados</a></li>
          </ul> -->
          <hr>
          <h4>Estado</h4>
          <select size="2" v-model="estadoActive" @change="fetchChangeSelect()">
            <option>Perdidos</option>
            <option>Encontrados</option>
          </select>
          <div class="input-group">
            <input v-model="searchQuery" type="text" class="form-control" placeholder="Buscar..." @keyup.enter="addSearch">
            <span class="input-group-btn">
              <button class="btn btn-secondary btn-search" type="button" @click="addSearch"><i class="fa fa-search"></i></button>
            </span>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import moment from 'moment';
moment.locale('es');
    export default {

        data() {
            return {
                items: [],
                tags:[],
                materias:[],
                laboratorios:[],
                sedes:[],
                total:0,
                perPage:0,
                pageCount: 1,
                searchQuery: '',
                searchActive:'',
                endpoint: '/api/items?page=',
                tagActive: 'Todos',
                estadoActive: 'Perdidos',
                materiaActive: 'Todas',
                laboratorioActive: 'Todos',
                sedeActive: 'Todas',
            };
        },

        props:['auth-check'],

        created() {
            this.fetch();
            axios.get('/api/tags?side=1')
                    .then(({data}) => {
                        this.tags = data;
                    });
            axios.get('/api/materias')
                    .then(({data}) => {
                        this.materias = data;
                    });
            axios.get('/api/laboratorios')
                    .then(({data}) => {
                        this.laboratorios = data;
                    });
            axios.get('/api/sedes')
                    .then(({data}) => {
                        this.sedes = data;
                    });
        },

        watch:{
          searchQuery: function(newVal,oldVal){
            if (!newVal.length) this.addSearch();
          }
        },

        methods: {
            fetch(page = 1) {
                axios.get(this.endpoint + page + 
                          '&tag=' + this.tagActive + 
                          '&estado=' + this.estadoActive + 
                          '&q=' + this.searchActive + 
                          '&materia=' + this.materiaActive +
                          '&sede=' + this.sedeActive + 
                          '&laboratorio=' + this.laboratorioActive)
                    .then(({data}) => {
                        this.items = data.data;
                        this.pageCount = data.last_page;
                        this.total = data.total;
                        this.perPage = data.to - data.from + 1;
                    });
            },
            fetchSede(){
              this.laboratorioActive = 'Todos';
              this.fetchChangeSelect();
            },
            nombreLab(lab){
              if(this.sedeActive == 'Todas') return lab.nombre + ' de ' + lab.sede.nombre;
              else return lab.nombre;
            },
            blogMeta(item){
              var ret = '';
              if(item.retiro){
                ret = 'Retirado el '+this.getHumanDate(item.retiro.created_at)+' por '+item.retiro.nombre+'\n\n';
              }
               ret = ret + 'Lo encontro '+item.user.name+' el '+this.getHumanDate(item.created_at)+' despues de la cursada de '+item.materia.nombre+' en el laboratorio '+item.laboratorio.nombre+' de '+item.laboratorio.sede.nombre+'.';
               return ret;
            },
            getHumanDate(date){
                return moment(date,'YYYY-MM-DD H:m:s').format('dddd, D [de] MMMM [de] YYYY [a alrededor de las] H:mm');
            },
            fetchChangeSelect(){
                this.fetch(1);
                if(this.total) this.$refs.paginate.selected=0;
            },
            addSearch(){
                this.searchActive = this.searchQuery;
                this.fetch(1);
                if(this.total) this.$refs.paginate.selected=0;
            },
            addEstado(estado){
                if(estado == ''){
                    this.estadoActive= 'Perdidos';
                }else{
                    this.estadoActive = estado;
                }
                this.fetch(1);
                if(this.total) this.$refs.paginate.selected=0;
                this.searchQuery = this.searchActive;
            },
            highlight(item) {
                if(!this.searchActive) {
                    return this.blogMeta(item);
                }
                return this.blogMeta(item).replace(new RegExp(this.searchRegular(), "gi"), (match,string) => {
                    return '<span class="highlightText">' + match + '</span>';
                });
            },
            searchRegular(){
              return this.searchActive.replace(/\s+/g,'|').replace(new RegExp('á|a','gi'),'(á|a)')
                                                             .replace(new RegExp('é|e','gi'),'(é|e)')
                                                             .replace(new RegExp('í|i','gi'),'(í|i)')
                                                             .replace(new RegExp('ó|o','gi'),'(ó|o)')
                                                             .replace(new RegExp('ú|u','gi'),'(ú|u)');
            }
        }
    }
</script>

<style>
.pagination {
    justify-content: center;
}

.highlightText{
  background: yellow;
}

.pagination li > a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 5px;
}

.pagination li {
    color: white;
    border-radius: 5px;
    box-shadow: 0 0 3px black;
    margin: 3px;
    background-color: #fafafa;
}

.pagination li.active {
    background-color: #4b4b4b;
    text-decoration-color: white;
    border-radius: 5px;
}

.pagination li.disabled {
  box-shadow: none;
}

.pagination li.disabled > a{
  cursor: default;
  background: #343a40;
  border-radius: 0px;
}

.pagination li.active > a {
    color: white;
}

.pagination li > a:hover:not(.active) {
    background-color: #ddd;
}

.pagination li.disabled > a:hover:not(.active) {
    background-color: #343a40;
}

.blog-post {
  margin-bottom:30px;
  padding:15px;
  border-radius: 15px;
  box-shadow: 0 0 3px black;
  background: #fafafa;
}

a > .blog-post:hover {
  background-color: #434343;
}

.blog-post-title {
  margin-bottom: 5px;
  font-size: 40px;
}

.blog-post-meta {
  margin-bottom: 0px;
  color: #999;
  white-space: pre-wrap;
}

a:hover{
  color:#999999;
  text-decoration: none;
}

a.active{
    border-radius: 5px;
  box-shadow: 0 0 5px green;
  background-color: #bef7b7;
}

/* Sidebar modules for boxing content */
.filter-module {
  padding: 15px;
  position: fixed;
}
.filter-module-inset {
  padding: 15px;
  background-color: #f0f0f0;
  border-radius: 15px;
}
.filter-module-inset p:last-child,
.filter-module-inset ul:last-child,
.filter-module-inset ol:last-child {
  margin-bottom: 0;
}

.btn-search{
  margin:0;
  border-top-left-radius: 0px;
  border-bottom-left-radius: 0px;
}

select {
  border: 0;
  background: #f0f0f0;
  width:100%;
}

select::-webkit-scrollbar {
    width: .5em;
}
 
select::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
  border-radius: 5px;
}

select:focus{
  outline:none;
}

select option:checked{ 
  box-shadow: 0 0 0 15px lightgreen inset;
  color:red;
}

select option{
  color: gray;
}

select option:hover{
  cursor:pointer;
}

hr{
  margin:0;
}
</style>