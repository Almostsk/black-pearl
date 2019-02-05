<template>
    <div class="popup-container">
        <div class="popup-overlay"></div>
        <div class="popup-content-wrapper">
            <div class="popup-content">
                <h2 class="popup-title">Будь ласка, авторизуйтесь</h2>
                <form action="POST" class="popup-form" v-if="getCodeForm">
                    <the-mask   class="popup-input"
                                mask="(###)###-##-##" 
                                type="tel" 
                                placeholder="Номер телефону*"
                                v-model="phone_number"
                                />
                    <v-btn  
                            @click.native="getCode"
                            text="Відправити код"
                            color="gold"/>
                    <a href="/register" class="register-btn">
                        Зареєструватись
                    </a>
                </form>
                <form action="POST" class="popup-form" v-if="codeForm">
                    <the-mask   class="popup-input"
                                mask="####-####-####" 
                                type="text" 
                                placeholder="Код підтвердження*"/>
                    <v-btn
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
   data() {
       return {
           codeForm: false,
           getCodeForm: true,
           phone_number: '',
       }
   }, 
   methods: {
       getCode: function() {
           console.log(this.phone_number);
           this.codeForm = !this.codeForm
           this.getCodeForm = !this.getCodeForm
       }
   }
}
</script>