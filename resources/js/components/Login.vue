<template>
    <div class="popup-container">
        <div class="popup-overlay"
            @click="$emit('close')"
        ></div>
        <div class="popup-content-wrapper">
            <div class="popup-content">
                <h2 class="popup-title">Будь ласка, авторизуйтесь</h2>
                <div  class="popup-form" v-if="getCodeForm">
                    <the-mask   class="popup-input"
                                mask="(###)###-##-##" 
                                type="tel" 
                                placeholder="Номер телефону*"
                                v-model="phone_number"
                                v-on:keyup.enter.prevent.native = "getCode"
                                />       
                    <v-btn  
                            @click.native="getCode"
                            text="Відправити код"
                            color="gold"/>
                    <span class="login-alert">{{ this.alertMessage }}</span>     
                    <a href="/registration" class="register-btn">
                        Зареєструватись
                    </a>
                </div>
                <div  class="popup-form" v-if="codeForm">
                    <the-mask   class="popup-input"
                                mask="####-####-####" 
                                type="text" 
                                v-model="code"
                                v-on:keyup.enter.prevent.native = "login"
                                placeholder="Код підтвердження*"/>
                    <v-btn
                            @click.native="login"
                            text="Відправити"
                            color="gold"/>
                    <span class="login-alert">{{ this.alertMessage }}</span> 
                    <a href="/registration" class="register-btn" v-if="registerVisible">
                        Зареєструватись
                    </a>        
                            

                </div>
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
           registerVisible: false,
           codeForm: false,
           getCodeForm: true,
           phone_number: '',
           code: '',
           alertMessage: '',
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
                            this.alertMessage = '';
                        } 
                    })
                    .catch(e => {
                        // this.errors.push(e)
                        console.log(e.response.data.message);
                        this.alertMessage = e.response.data.message;
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
                                // let routePush = this.$router.currentRoute.path == '/cabinet' ? '/' : '/cabinet';
                                if(this.$router.currentRoute.path == '/cabinet') {
                                    this.$router.go();
                                } else {
                                    this.$router.push('/cabinet');
                                }
                                this.alertMessage = '';
                                this.registerVisible = false;
                                // this.$emit('close');
                            } else {
                                console.log(responce);
                                localStorage.removeItem('token');
                            }
                        })
                        .catch(e => {
                                console.log(e);
                                this.alertMessage = e.response.data.message;
                                if(e.response.data.message == "Користувач з введеним номером телефону не знайдений") {
                                   this.registerVisible = true;
                                }
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