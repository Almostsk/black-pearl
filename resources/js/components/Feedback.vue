<template>
    <div class="popup-container">
        <div class="popup-overlay"
            @click="$emit('close')"
        ></div>
        <div class="popup-content-wrapper">
            <div class="popup-content">
                <h2 class="popup-title">Зворотній зв'язок</h2>
                <form action="POST" class="popup-form">
                    <input 
                        type="text" 
                        name="name" 
                        class="popup-input"
                        placeholder="Ваше ім'я*"
                        v-model="$v.name.$model" 
                        :class="{ 'alert-input': $v.name.$error }"
                        ref="name"
                        >
                    <input 
                        type="email" 
                        name="email" 
                        class="popup-input"
                        placeholder="Email*"
                        v-model="$v.email.$model" 
                        :class="{ 'alert-input': $v.email.$error }"
                        ref="email"
                        >
                    <the-mask   class="popup-input"
                                mask="(###)###-##-##" 
                                type="tel" 
                                placeholder="Номер телефону*"
                                ref="mobile_phone"
                                v-model="$v.phone_number.$model" 
                                :class="{ 'alert-input': $v.phone_number.$error }"
                                />
                    <input 
                        type="text" 
                        name="message" 
                        class="popup-input"
                        placeholder="Ваше повідомлення*"
                        v-model="$v.message.$model" 
                        :class="{ 'alert-input': $v.message.$error }"
                        ref="message"
                        >
                    <v-btn  
                            @click.native="sendFeedback"
                            text="Відправити"
                            color="gold"/>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import Btn from './btn.vue';
import { required, minLength, between } from 'vuelidate/lib/validators';

export default {
   components: {
       'v-btn': Btn
   },
   data() {
       return {
           codeForm: false,
           getCodeForm: true,
           phone_number: '',
           name: '',
           email: '',
           message: '',
           mesAlert: false,
           alert: false
       }
   }, 
   methods: {
       sendFeedback: function() {

           let fbData = {
            'name': this.name,         
            'email': this.email,
            'mobile_phone': this.phone_number,
            'message': this.message
           }

           for (const key in fbData) {
               if ((fbData[key] == '') && (this.$refs[key].$attrs ? this.$refs[key].$attrs.type !== 'tel': true)) {
                   this.$refs[key].classList.add("alert-input");
                    this.alert = false;
               } else {
                    this.alert = true;
               }
               if ((fbData[key] == '') && (this.$refs[key].$attrs ? this.$refs[key].$attrs.type == 'tel': false)) {
                    this.$refs[key].$el.classList.add("alert-input");
                    this.mesAlert = false;
               } else {
                   this.mesAlert = true;
               }
           }

            if (this.alert && this.mesAlert) {
                axios
                    .post('api/feedback/create', 
                        fbData
                    )
                    .then(responce => {
                        console.log(responce);
                        if (responce.data.success) {
                            this.$emit('close')
                        }
                    })
                    .catch(e => {
                        // this.errors.push(e)
                    })
            }

       }
   },
    validations: {
        name: {
            required,
            minLength: minLength(3)
        },
        email: {
            required,
            minLength: minLength(4) 
        },
        phone_number: {
            required,
            minLength: minLength(10) 
        },
        message: {
            required,
            minLength: minLength(3) 
        }
    }
}
</script>