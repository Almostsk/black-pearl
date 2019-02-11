<template>
    <div class="register-page">
        <v-header
            :display-hat="true"
        />
        <div class="register-content">
            <div class="register-top">
                <div class="register-input-container">
                    <div class="register-row">
                        <input class="register-input" type="text" name="name" placeholder="Ім'я*" v-model="regData.name">
                        <input class="register-input" type="text" name="second_name" placeholder="Прізвище*" v-model="regData.surname">
                        <input class="register-input" type="text" name="city" placeholder="Місто*" v-model="regData.city_id">
                        <the-mask   class="register-input"
                                mask="(###)###-##-##" 
                                type="tel" 
                                placeholder="Номер телефону*"
                                v-model="regData.mobile_phone"
                        />
                    </div>
                    <div class="register-row">
                        <input class="register-input" type="text" name="code" placeholder="Код з упаковки*" v-model="regData.code">
                        <div class="register-checkbox-container">
                                <p-check name="check_rules" class="p-icon p-default" color="primary-o" v-model="regData.check_rules">
                                </p-check>
                                <span class="register-checkbox-text">
                                    Я погоджуюсь <br>
                                    з  <a class="checkbox-link" href="/rules"> Правилами Акції </a>
                                </span>
                        </div>
                        <div class="register-checkbox-container">
                                <p-check name="check_privacy" class="p-icon p-default" color="primary-o" v-model="regData.check_policy">
                                </p-check>
                                <span class="register-checkbox-text">
                                    Я погоджуюсь <br>
                                    з  <a class="checkbox-link" href="/rules"> Політикою конфіденційності </a>
                                </span>
                        </div>
                        <button class="register-input register-page-btn" @click="sendReg()">Відправити</button>
                    </div>
                </div>
            </div>
            <div class="register-bottom">
                <v-star/>
                <v-btn
                    text="Відправити"
                    color="violet"
                    link="/"
                />
            </div>
        </div>
        <v-footer/>
    </div>
</template>

<script>

    import Header from './Header.vue';
    import Footer from './Footer.vue';
    import RegStar from './RegisterStar.vue';
    import Btn from './btn.vue';

export default {
        components: {
            'v-header': Header,
            'v-footer': Footer,
            'v-star': RegStar,
            'v-btn': Btn
        },
        data() {
            return {
                regData: {
                    name : '',
                    surname: '',
                    city_id: '',
                    mobile_phone: '',
                    about_me: '',
                    avatar: '',
                    code: '',
                    check_rules: false,
                    check_policy: false
                },
            }
        },
        methods: {
            sendReg() {
                let formData = {
                    name : this.regData.name,
                    surname: this.regData.surname,
                    city_id: this.regData.city_id,
                    mobile_phone: this.regData.mobile_phone,
                    code: this.regData.code,
                };

                if(this.regData.check_rules && this.regData.check_policy) {
                    axios
                        .post('api/auth/register', {
                            headers: {
                                Accept : 'application/json, text/javascript',
                                Connection: 'keep'
                                },
                            data: formData
                        })
                        .then(responce => {
                            console.log(responce);
                        })
                        .catch(e => {
                            this.errors.push(e)
                        })
                } else {
                    console.log('Галочка нету');
                }

                console.log(formData);

            }
        },
}
</script>