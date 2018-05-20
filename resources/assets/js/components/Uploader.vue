<template>
    <div>
    	<div :class="{'file-uploader' : true, 'uploader-invalid': errors.file || this.error}">
			<input @change="updateValue($event.target.files[0])" ref="file" type="file" :accept="acceptedFiles" id="file">
	        <button :class="{'btn' : true, 'btn-secondary': !errors.file && !this.error, 'btn-danger': errors.file || this.error}" @click="addFiles" style="margin: auto 10px">Agregar foto</button>
	        <div v-if="file" class="file-listing">{{ this.nombreFoto() }} 
	        	<span class="remove-file" @click="removeFile()"><i class="fa fa-times-circle"></i></span>
	        	<img :src="imagePreview"/>
	        </div>
        
		</div>
		<span class="invalid-feedback" style="text-align: center" v-if="errors.file == 'extension'">
	        <strong>Debe cargar un archivo de tipo jpg o png.</strong>
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
        props:['value', 'error'],
        methods: {
        	updateValue: function (value) {
            	var file = this.$refs.file.files[0];
            	let reader = new FileReader();
            	if(file){
            		if(/\.(jpe?g|png)$/i.test(file.name)){
	            		this.file = file;
	            		reader.addEventListener("load", function () {
					      this.showPreview = true;
					      this.imagePreview = reader.result;
					    }.bind(this), false);
					    reader.readAsDataURL( this.file );
					    this.$emit('input', value);
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
			},
			nombreFoto(){
				if(this.file.name.length > 30){
					return this.file.name.substring(0,27) + ' ...';
				} else return this.file.name;
			}
        },
    }
</script>

<style>
input[type="file"]{
    position: absolute;
    top: -500px;
 }
div.file-listing{
	margin:auto 5px;
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
.inv-reg{
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

.btn{
	max-height: 38px;
}
</style>