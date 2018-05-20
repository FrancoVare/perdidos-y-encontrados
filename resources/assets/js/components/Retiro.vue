<template>
    <div class="col-sm-8" >
		
		<div v-if="!submit">
			<h1>Registrar retiro de {{item.tag.nombre}}</h1>

			<hr>

			<div class="form-group">
				<label for="nombre">Nombre de quien retira</label>
				<input v-model="nombre" type="text" :class="{'form-control' : true, 'is-invalid': errors.nombre}">
	            <span class="invalid-feedback" v-if="errors.nombre">
	                <strong>Debe ingresar un nombre</strong>
	            </span>
			</div>
			<div class="form-group">
				<label for="nombre">Email</label>
				<input v-model="email" type="email" :class="{'form-control' : true, 'is-invalid': errors.mail}">
	            <span class="invalid-feedback" v-if="errors.mail">
	                <strong>Debe ingresar un email valido.</strong>
	            </span>
			</div>
			<label>Identificacion</label>
			<div class="form-group" style="display: flex;">
				<select v-model="tipoDoc" :class="{'form-control' : true, 'is-invalid': errors.numeroDoc || errors.tipoDoc}" style="width: 15%;">
					<option>DNI</option>
					<option>Legajo</option>
				</select>
				<input v-model="numeroDoc" type="text" :class="{'form-control' : true, 'is-invalid': errors.numeroDoc || errors.tipoDoc}" style="width: 85%;">
			</div>
	        <span class="invalid-feedback inv-reg" v-if="errors.numeroDoc || errors.tipoDoc">
	            <strong>Debe ingresar la identificacion.</strong>
	        </span>
			<div class="form-group">
				<label for="laboratorio_id">Laboratorio</label>
				<select v-model="laboratorio_id" :class="{'form-control' : true, 'is-invalid': errors.laboratorio_id}">
			     	<option v-for="laboratorio in laboratorios" :value="laboratorio.id">{{laboratorio.nombre}} en {{laboratorio.sede.nombre}}</option>
				</select>
	            <span class="invalid-feedback" v-if="errors.laboratorio_id">
	                <strong>Debe seleccionar un laboratorio</strong>
	            </span>
			</div>
            <uploader v-model="foto_retiro" :error="this.errors.foto_retiro" :upload-percentage="uploadPercentage"></uploader>
			<hr>
			<div class="form-group" style="text-align: right;">
				<button :disabled="cargando" class="btn btn-primary" @click="registrarRetiro">Aceptar</button>
			</div>
		</div>
		<div v-else><h1>Este item ya ha sido retirado.</h1></div>
	</div>
</template>

<script>
import moment from 'moment';
moment.locale('es');
    export default {

        data() {
            return {
            	item: null,
            	laboratorios: null,
            	nombre:'',
            	tipoDoc:'',
            	numeroDoc:'',
            	laboratorio_id:null,
            	foto_retiro:null,
            	uploadPercentage: 0,
            	submit: null,
            	cargando: false,
            	email:'',
            	errors: {
            		nombre: null,
            		numeroDoc: null,
            		laboratorio_id: null,
            		foto_retiro:null,
            		tipoDoc:null,
            		mail:null
            	}
            };
        },
        props:['pItem'],
        created() {
            this.item = JSON.parse(this.pItem);
            this.getLaboratorios();
        	this.submit = this.item.retiro;
        },
        watch: {
          nombre: function (newVal,oldVal){
            if(newVal) this.errors.nombre = null;
          },
          numeroDoc: function (newVal,oldVal){
            if(newVal) this.errors.numeroDoc = null;
          },
          tipoDoc: function (newVal,oldVal){
            if(newVal) this.errors.tipoDoc = null;
          },
          laboratorio_id: function (newVal,oldVal){
            if(newVal) this.errors.laboratorio_id = null;
          },
          foto_retiro: function (newVal,oldVal){
            if(newVal) {
              this.errors.foto_retiro = null;
              this.uploadPercentage = 0;
            }
          },
          email: function (newVal,oldVal){
            if(newVal) this.errors.mail = null;
          },
        },
        methods: {
            getLaboratorios() {
              axios.get("/api/laboratorios")
                    .then(({data}) => {
                        this.laboratorios = data;
                    });
            },
            registrarRetiro(){
            	let formData = new FormData();
            	formData.append('foto_retiro',this.foto_retiro);
            	formData.append('nombre',this.nombre);
            	formData.append('tipoDoc',this.tipoDoc);
            	formData.append('numeroDoc',this.numeroDoc);
            	formData.append('laboratorio_id',this.laboratorio_id);
            	formData.append('item_id',this.item.id);
            	formData.append('mail',this.email);
            	this.cargando = true;
                axios.post('/retiros', formData,
                {
                	headers: {
                		'Content-Type': 'multipart/form-data'
                	},
			        onUploadProgress: function( progressEvent ) {
			          this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) );
			        }.bind(this)
                })
                .then(response => {
                    flash(response.data.message,'success');
                    this.foto_retiro = null;
                    this.nombre = null;
                    this.tipoDoc = '';
                    this.numeroDoc = '';
                    this.laboratorio_id = null;
                    this.submit = true;
                    this.email = '';
            		this.cargando = false;
                    // this.uploadPercentage = 0;
                    setTimeout(function(){window.location.href="/";},5000);
                })
                .catch(error =>{
                    this.errors = error.response.data.errors;
            		this.cargando = false;
                    // this.uploadPercentage = 0;
                    if(!this.errors) this.errors = {
					            		nombre: null,
					            		numeroDoc: null,
					            		laboratorio_id: null,
					            		foto_retiro:null,
					            		tipoDoc:null,
					            		mail:null
					            	}
                });
            },
        },
    }
</script>

<style>
.invalid-feedback{
	display: block;
}
.inv-reg{
    top: -15px;
    position: relative;
}
</style>
