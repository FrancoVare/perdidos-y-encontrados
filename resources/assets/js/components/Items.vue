<template>
    <div class="row">
      <div class="col-sm-1"></div>

      <div class="col-sm-8">
        <div class="container" style="text-align: right;"><p class="blog-post-meta">Mostrando {{Math.min(this.perPage,this.total)}} de {{this.total}}</p></div>
          <a v-for="item in items" v-if="authCheck" :href="'/items/'+item.id">
            <div class="blog-post">
              <h2 class="blog-post-title">{{item.tag.nombre}}</h2>

              <p v-if="item.retiro != null">Retirado el {{getHumanDate(item.retiro.created_at)}} por {{item.retiro.nombre}}</p>

              <p class="blog-post-meta">

                Lo encontro {{item.user.name}} el {{getHumanDate(item.created_at)}}
                despues de la cursada de 
                {{item.materia.nombre}} en el laboratorio 
                {{item.laboratorio.nombre}} de 
                {{item.laboratorio.sede.nombre}}.

              </p>

            </div>
        </a>

        <div class="blog-post" v-else v-for="item in items">
              <h2 class="blog-post-title">{{item.tag.nombre}}</h2>
              <p v-if="item.retiro != null">Retirado el {{getHumanDate(item.retiro.created_at)}} por {{item.retiro.nombre}}</p>
              <p class="blog-post-meta">

                Lo encontro {{item.user.name}} el {{getHumanDate(item.created_at)}}
                despues de la cursada de 
                {{item.materia.nombre}} en el laboratorio 
                {{item.laboratorio.nombre}} de 
                {{item.laboratorio.sede.nombre}}.

              </p>

        </div>

        <paginate
            :page-count="pageCount"
            :click-handler="fetch"
            :prev-text="'Anterior'"
            :next-text="'Siguiente'"
            :container-class="'pagination'"
            ref="paginate">

            <span slot="prevContent"><i class="fa fa-angle-left fa-lg"></i></span>
            <span slot="nextContent"><i class="fa fa-angle-right fa-lg"></i></span>
        </paginate>
      </div>

      <div class="col-sm-1"></div>

      <div class="col-sm-2">
        <div class="filter-module filter-module-inset">
          <h4 style="text-align: center;">Tags</h4>
          <ul class="fa-ul">
              <li v-for="tag in tags"><a :class="{active : tagActive == tag}" href="#" @click="addTag(tag)"><i class="fa-li fa fa-chevron-circle-right"></i>{{tag}}</a></li>
              <li><a :class="{active : tagActive == 'Todos'}" href="#" @click="addTag('')"><i class="fa-li fa fa-chevron-circle-right"></i>Todos</a></li>
          </ul>
          <hr>
          <h4 style="text-align: center;">Estado</h4>
          <ul class="fa-ul">
            <li><a :class="{active : estadoActive == 'Perdidos'}" href="#" @click="addEstado('Perdidos')"><i class="fa-li fa fa-chevron-circle-right"></i>Perdidos</a></li>
            <li><a :class="{active : estadoActive == 'Encontrados'}" href="#" @click="addEstado('Encontrados')"><i class="fa-li fa fa-chevron-circle-right"></i>Encontrados</a></li>
          </ul>
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
                total:0,
                perPage:0,
                pageCount: 1,
                endpoint: '/api/items?page=',
                tagActive: 'Todos',
                estadoActive: 'Perdidos'
            };
        },

        props:['auth-check'],

        created() {
            this.fetch();
            axios.get('/api/tags')
                    .then(({data}) => {
                        this.tags = data;
                    });
        },

        methods: {
            fetch(page = 1) {
                axios.get(this.endpoint + page + '&tag=' + this.tagActive + '&estado=' + this.estadoActive)
                    .then(({data}) => {
                        this.items = data.data;
                        this.pageCount = data.last_page;
                        this.total = data.total;
                        this.perPage = data.to - data.from + 1;
                    });
            },
            getHumanDate(date){
                return moment(date,'YYYY-MM-DD H:m:s').format('dddd, D [de] MMMM [de] YYYY [a alrededor de las] H:mm');
            },
            addTag(tag){
                if(tag == ''){
                    this.tagActive= 'Todos';
                }else{
                    this.tagActive = tag;
                }
                this.fetch(1);
                this.$refs.paginate.selected=0;
            },
            addEstado(estado){
                if(estado == ''){
                    this.estadoActive= 'Perdidos';
                }else{
                    this.estadoActive = estado;
                }
                this.fetch(1);
                this.$refs.paginate.selected=0;
            }
        }
    }
</script>

<style>
.pagination {
    justify-content: center;
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
}

.pagination li.active > a {
    color: white;
}

.pagination li > a:hover:not(.active) {
    background-color: #ddd;
}

.pagination li.disabled > a:hover:not(.active) {
    background-color: #fafafa;
}

.blog-post {
  margin-bottom:30px;
  padding:15px;
  border-radius: 15px;
  box-shadow: 0 0 3px black;
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
</style>