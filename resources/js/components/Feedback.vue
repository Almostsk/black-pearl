<template>
    <div class="popup-container" v-if="displayPopup">
        <div class="popup-overlay"
            @click="hidePopup()"
        ></div>
        <div class="popup-content-wrapper">
            <div class="popup-content">
                <h2 class="popup-title">Зворотній зв'язок</h2>
                <form action="POST" class="popup-form">
                    <input 
                        type="text" 
                        name="name" 
                        class="popup-input"
                        placeholder="Ваше ім'я">
                    <input 
                        type="email" 
                        name="email" 
                        class="popup-input"
                        placeholder="Email">
                    <the-mask   class="popup-input"
                                mask="(###)###-##-##" 
                                type="tel" 
                                placeholder="Номер телефону"
                                v-model="phone_number"
                                />
                    <input 
                        type="text" 
                        name="message" 
                        class="popup-input"
                        placeholder="Ваше повідомлення">
                    <v-btn  
                            @click.native="getCode"
                            text="Відправити"
                            color="gold"/>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import Btn from './btn.vue';

export default {
   components: {
       'v-btn': Btn
   },
   props : {
       showPopup: false,
   },
   data() {
       return {
           codeForm: false,
           getCodeForm: true,
           phone_number: '',
           displayPopup: true,
       }
   }, 
   watch: {
       showPopup() {
           this.displayPopup = !this.displayPopup
       }
   },
   methods: {
       getCode: function() {
           console.log(this.phone_number);
           this.codeForm = !this.codeForm
           this.getCodeForm = !this.getCodeForm
       },
       hidePopup() {
           this.displayPopup = false;

       }
   }
}
</script>