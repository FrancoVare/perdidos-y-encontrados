<template> 
<transition name="modal">
        <div class="modal-mask" @click="close" v-show="show">
            <div class="modal-container" @click.stop>
                <button type="button" class="close close-btn" aria-label="Close" @click="close()">
                  <span aria-hidden="true">&times;</span>
                </button>
              <slot></slot>
            </div>
        </div>
    </transition>
</template>

<style>
* {
    box-sizing: border-box;
}

.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    transition: opacity .3s ease;
}

.invalid-feedback{
    display: block;
}

.close-btn{
    right: -24px;
    top: -14.02px;
    position: relative;
}

.modal-container {
    width: 400px;
    margin: 40px auto 0;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    transition: all .3s ease;
    font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
    margin-top: 0;
    color: #4b4b4b;
}

.modal-header {
    justify-content: center;
}

.modal-body {
    margin: 20px 0;
}

.modal-footer{
    justify-content: center;
}

.text-right {
    text-align: right;
}

.form-label {
    display: block;
    margin-bottom: .5em;
    text-align: left;
}

.form-label > .form-control {
    margin-top: 0.5em;
}

.form-control {
    display: block;
    width: 100%;
    padding: 0.5em 1em;
    line-height: 1.5;
    border: 1px solid #ddd;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>

<script>
    export default {
        props: {
            show:{
                type: Boolean
            }
        },
        methods: {
          close: function () {
            this.$emit('close');
          }
        }
    }
</script>