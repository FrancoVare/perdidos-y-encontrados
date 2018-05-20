<template>
    <div class="col-sm-8" >
		
		<div v-if="!submit">
			<h1>Registrar retiro de {{item.tag.nombre}}</h1>

			<hr>

			<div class="form-group">
				<label for="nombre">Nombre de quien retira:</label>
				<input v-model="nombre" type="text" :class="{'form-control' : true, 'is-invalid': errors.nombre}">
	            <span class="invalid-feedback" v-if="errors.nombre">
	                <strong>Debe ingresar un nombre</strong>
	            </span>
			</div>

			<label>Identificacion:</label>
			<div class="form-group" style="display: flex;">
				<select v-model="tipoDoc" :class="{'form-control' : true, 'is-invalid': errors.numeroDoc}" style="width: 15%;">
					<option>DNI</option>
					<option>Legajo</option>
				</select>
				<input v-model="numeroDoc" type="text" :class="{'form-control' : true, 'is-invalid': errors.numeroDoc}" style="width: 85%;">
			</div>
	        <span class="invalid-feedback inv-reg" v-if="errors.numeroDoc">
	            <strong>Debe ingresar un numero de documento</strong>
	        </span>
	          
			<div class="form-group">
				<label for="laboratorio_id">Laboratorio:</label>
				<select v-model="laboratorio_id" :class="{'form-control' : true, 'is-invalid': errors.laboratorio_id}">
			     	<option v-for="laboratorio in laboratorios" :value="laboratorio.id">{{laboratorio.nombre}} en {{laboratorio.sede.nombre}}</option>
				</select>
	            <span class="invalid-feedback" v-if="errors.laboratorio_id">
	                <strong>Debe seleccionar un laboratorio</strong>
	            </span>
			</div>
            <uploader v-model="foto_retiro" :error="this.errors.foto_retiro"></uploader>
			<hr>
			<div class="form-group" style="text-align: right;">
				<button class="btn btn-primary" @click="registrarRetiro">Aceptar</button>
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
            	tipoDoc:'DNI',
            	numeroDoc:'',
            	laboratorio_id:null,
            	foto_retiro:null,
            	submit: null,
            	errors: {
            		nombre: null,
            		numeroDoc: null,
            		laboratorio_id: null,
            		foto_retiro:null,
            	}
            };
        },
        props:['pItem'],
        created() {
            this.item = JSON.parse(this.pItem);
            this.getLaboratorios();
            this.submit = this.item.retiro;
        },
        methods: {
            getLaboratorios() {
              axios.get("/api/laboratorios")
                    .then(({data}) => {
                        this.laboratorios = data;
            			this.laboratorio_id = this.laboratorios[0].id;
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

                axios.post('/retiros', formData,
                {
                	headers: {
                		'Content-Type': 'multipart/form-data'
                	}
                })
                .then(response => {
                    flash(response.data.message,'success');
                    this.foto_retiro = null;
                    this.nombre = null;
                    this.tipoDoc = '';
                    this.numeroDoc = '';
                    this.laboratorio_id = null;
                    this.submit = true;
                    setTimeout(function(){window.location.href="/";},5000);
                })
                .catch(error =>{
                    this.errors = error.response.data.errors;
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
