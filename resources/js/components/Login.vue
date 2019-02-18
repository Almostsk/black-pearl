<template>
    <div class="popup-container">
        <div class="popup-overlay"
            @click="$emit('close')"
        ></div>
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
                    <a href="/registration" class="register-btn">
                        Зареєструватись
                    </a>
                </form>
                <form action="POST" class="popup-form" v-if="codeForm">
                    <the-mask   class="popup-input"
                                mask="####-####-####" 
                                type="text" 
                                v-model="code"
                                placeholder="Код підтвердження*"/>
                    <v-btn
                            @click.native="login"
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
           code: '',
           displayPopup: false,
           token: localStorage.getItem('token') || ''
       }
   }, 
   methods: {
       getCode: function() {
           console.log(this.phone_number);
        //    this.codeForm = !this.codeForm
        //    this.getCodeForm = !this.getCodeForm

            if (this.phone_number.length == 10) {
                
                axios
                    .post('api/send-sms',
                        {
                            'mobile_phone': '38' + this.phone_number
                        }
                    )
                    .then(responce => {
                        if (responce.data.success) {
                            this.getCodeForm = false;
                            this.codeForm = true;
                        }
                    })
                    .catch(e => {
                        // this.errors.push(e)
                    })   
            }

       },
       login: function() { 

                if (this.code.length > 2) {
                    axios
                        .post('api/login',
                            {
                                'code': this.code,
                                'mobile_phone': '38' + this.phone_number
                            }
                        )
                        .then(responce => {
                            if (responce.data.token) {
                                const token = responce.data.token;
                                localStorage.setItem('token', token);
                                this.$router.push('/')
                                // this.$emit('close');
                            } else {
                                console.log(responce);
                                localStorage.removeItem('token');
                            }
                        })
                        .catch(error => {
                                console.log(error);
                                // this.alert = true;
                            // this.errors.push(e)
                        }) 
                } else {
                    this.alert = true;
                }
        }
   }
}
</script>