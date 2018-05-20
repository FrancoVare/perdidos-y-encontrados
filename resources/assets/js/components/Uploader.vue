<template>
    <div>
    	<div :class="{'file-uploader' : true, 'uploader-invalid': errors.file || this.error}">
    		<button :class="{'btn' : true, 'btn-secondary': !errors.file && !this.error, 'btn-danger': errors.file || this.error}" @click="addFiles" style="margin: auto 10px">Agregar foto</button>
			<input @change="updateValue($event.target.files[0])" ref="file" type="file" :accept="acceptedFiles" id="file">
	        <div v-if="showPreview" class="file-listing">
	        	<p style="margin: 0">{{this.nombreFoto()}} <span class="remove-file" @click="removeFile()"><i class="fa fa-times-circle"></i></span> </p>
	        	<img :src="imagePreview"/>
	        	<div class="progress">
				  <div :class="{'progress-bar' : true, 'progress-bar-striped': true, 'bg-success': uploadPercentage == 100}" class="progress-bar progress-bar-striped" role="progressbar" :style="{'min-width': uploadPercentage + '%'}" :aria-valuenow="uploadPercentage" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
	        </div>
		</div>
		<span class="invalid-feedback" style="text-align: center" v-if="errors.file == 'extension'">
	        <strong>Debe cargar un archivo de tipo jpg o png.</strong>
	    </span>
	    <span class="invalid-feedback" style="text-align: center" v-else-if="errors.file == 'size'">
	        <strong>El tamaño maximo para los archivos es de 15MB.</strong>
	    </span>
		<span class="invalid-feedback" style="text-align: center" v-else-if="error">
	        <strong>Debe cargar una foto que verifique el retiro.</strong>
	    </span>
	    </div>
</template>

<script>
	export default {

        data() {
            return {
            	acceptedFiles: 'image/jpg,image/jpeg,image/png',
            	imagePreview: '',
            	file: null,
            	showPreview: false,
            	errors: {
            		file:null,
            	}
            };
        },
        mounted(){
			
        },
        props:['value', 'error','uploadPercentage'],
        methods: {
        	updateValue: function (value) {
            	var file = this.$refs.file.files[0];
            	let reader = new FileReader();
            	if(file){
            		if(/\.(jpe?g|png)$/i.test(file.name)){
	            		if(file.size/1024<15360){
	            			this.file = file;
		            		reader.addEventListener("load", function () {
						      this.showPreview = true;
						      this.imagePreview = reader.result;
						      this.$emit('input', value);
						      this.errors.file = null;
						    }.bind(this), false);
						    reader.readAsDataURL( this.file );
	            		}else{
	            			this.errors.file = 'size';
	            		}
	            	} else {
	            		this.errors.file = 'extension';
	            	}
            	}
          	},
            addFiles(){
			  this.$refs.file.click();
			},
			removeFile(){
				this.file = null;
				this.showPreview = null;
				this.imagePreview = '';
				this.$emit('input',null);
				this.$refs.file.value = "";
			},
			nombreFoto(){
				if(this.file.name.length > 30){
					return this.file.name.substring(0,27) + ' ...';
				} else return this.file.name;
			}
        },
        watch: {
        	value: function(newVal,oldVal){
        		if(!newVal) this.removeFile();
        	}
        }
    }
</script>

<style>
input[type="file"]{
    position: absolute;
    top: -500px;
 }
div.file-listing{
	margin:auto;
	text-align: center;
}

span.remove-file{
	cursor: pointer;
	transition: ease .5s;
}
span.remove-file:hover{
	color: red;
}
.invalid-feedback{
	display: block;
}
.inv-up{
    top: -15px;
    position: relative;
}
.file-uploader{
	display: flex;
    background: #cccccc;
    border-style: dashed;
    border-radius: 10px;
    border-width: 2px;
    border-color: darkslategray;
    min-height: 57px;
    max-width: 425px;
    margin: auto;
    margin-top: 1rem;
}
.uploader-invalid{
    border-color: red;
    background: #ffcdd2;
}

img{
	max-width: 150px; 
	max-height: 150px;
	margin: 5px;
	border-radius: 15px;
}

.progress{
	height: 10px;
    width: 150px;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 5px;
}
.progress-bar{
	transition: none;
}
</style>