<template>
    <div class="register-page">
        <v-header
            :display-hat="true"
        />
        <div class="register-content">
            <div class="register-top">
                <div class="register-input-container">
                    <div class="register-row">
                        <input class="register-input" type="text" name="name" placeholder="Ім'я*" ref="name" v-model="$v.name.$model" :class="{ 'alert-input': $v.name.$error }">
                        <input class="register-input" type="text" name="second_name" placeholder="Прізвище*" ref="surname" v-model="$v.surname.$model" :class="{ 'alert-input': $v.surname.$error }">
                        <!-- <input class="register-input" type="text" name="city" placeholder="Місто*" ref="city_id" v-model="$v.city_id.$model" :class="{ 'alert-input': $v.city_id.$error }"> -->
                        <v-selectpage
                            class="cities-dropdown"
                            name="city"
                            placeholder="Місто*"
                            ref="city_id"
                            :data="cities"
                            :pagination="false"
                            show-field="Name"
                            language="en"
                            @values="singleValues"
                            :class="{ 'alert-input': $v.city_id.$error }"
                        />
                        <the-mask   class="register-input"
                                mask="(###)###-##-##" 
                                type="tel" 
                                placeholder="Номер телефону*"
                                ref="mobile_phone"
                                @click.native.prevent="acceptMobile()"
                                v-model="$v.mobile_phone.$model" 
                                :class="{ 'alert-input': $v.mobile_phone.$error }"
                                readonly
                        />
                    </div>
                    <div class="register-row">
                        <input class="register-input" type="text" name="code" placeholder="Промокод з упаковки*" ref="code" v-model="$v.code.$model" :class="{ 'alert-input': $v.code.$error }">
                        <div class="register-checkbox-container">
                                <p-check name="check_rules" class="p-icon p-default" color="primary-o" ref="check_rules" v-model="check_rules" @click.native.prevent="rulesActionShow">
                                </p-check>
                                <span class="register-checkbox-text" @click="rulesActionShow">
                                    Я погоджуюсь <br>
                                    з  <span class="checkbox-link"> Правилами Акції </span>
                                </span>
                        </div>
                        <div class="register-checkbox-container">
                                <p-check name="check_privacy" class="p-icon p-default" color="primary-o" ref="check_policy" v-model="check_policy" @click.native.prevent="rulesPolicyShow">
                                </p-check>
                                <span class="register-checkbox-text" @click="rulesPolicyShow">
                                    Я погоджуюсь <br>
                                    з  <span class="checkbox-link"> Політикою конфіденційності </span>
                                </span>
                        </div>
                        <!-- <button class="register-input register-page-btn" @click="sendReg()">Відправити</button> -->
                    </div>
                </div>
            </div>
            <div class="register-bottom">
                <div class="register-star">
                    <div class="register-star-title-container">
                        <h1 class="register-star-title">БАЖАЄТЕ СТАТИ ЗІРКОЮ РЕКЛАМНОЇ КАМПАНІЇ «ЧЕРНЫЙ ЖЕМЧУГ»? </h1>
                        <span>Тоді візьміть участь у творчому конкурсі «Сама собі зірка»</span>
                    </div>
                    <div class="register-star-form">
                        <div class="register-quote">
                            <!-- <span class="register-quote-text">Розкажіть про свою сцену чи аудиторію, <br>
                                що Вас надихає бути привабливою
                            </span> -->
                            <div class="register-quote-text">
                                <textarea  
                                    name="about-me" 
                                    placeholder="Розкажіть про свою сцену чи аудиторію, що Вас надихає бути привабливою"
                                    maxlength="180"
                                    v-model="about_me"
                                    ></textarea>
                            </div>
                        </div>
                        <div class="register-photo" @click="cropPopup">
                            <span class="register-photo-text">Завантажте своє фото</span>
                            <img  class="cropped-photo" :src="cropImg">
                        </div>
                    </div>
                </div>
                <span class="login-alert">{{ this.alertMessage }}</span>
                <v-btn
                    text="Відправити"
                    color="violet"
                    link="/"
                    @click.native.prevent="sendReg()"
                />
            </div>
        </div>
        <v-footer/>

        <!-- Accept mobile number popup -->
        
        <div class="popup-container" v-if="showPopup">
            <div class="popup-overlay"></div>
            <div class="popup-content-wrapper">
                <div class="popup-content">
                    <h2 class="popup-title">Будь ласка, підтвердіть номер телефону</h2>
                    <div  class="popup-form" v-if="getCodeForm">
                        <the-mask class="popup-input" mask="(###)###-##-##" type="tel" placeholder="Номер телефону*" v-model="mobile_phone" v-on:keyup.enter.prevent.native = "getCode" />
                        <!-- <span class="alert-popup-text" :class="{'active' : alert}">Номер введений невірно</span> -->
                        <v-btn @click.native="getCode" text="Відправити код" color="gold" />
                        <span class="login-alert">{{ this.alertMessage }}</span> 
                    </div>
                    <div class="popup-form" v-if="codeForm">
                        <the-mask class="popup-input" mask="####-####-####" type="text" placeholder="Код підтвердження*" v-model="mobile_code" v-on:keyup.enter.prevent.native = "activeCode"/>
                        <!-- <span class="alert-popup-text" :class="{'active' : alert}">Код не вірний</span> -->
                        <v-btn @click.native="activeCode" text="Відправити" color="gold" />
                        <span class="login-alert">{{ this.alertMessage }}</span> 
                        

                    </div>
                </div>
            </div>
        </div>

        <!-- Upload photo popup -->

        <div class="popup-container popup-image-crop" v-if="popupImage">
            <div class="popup-overlay" @click="hideCropPopup()"></div>
            <div class="popup-content-wrapper">
                <div class="popup-content">
                    <div class="upload-file-container">
                        <label for="upload-image" class="upload-file-label">1. <span>Завантажте</span> фото</label>
                        <input class="upload-file-button" type="file" name="image" accept="image/*" @change="setImage" id="upload-image" />
                    </div>
                    <p class="crop-popup-text">2. Оберіть область портрету</p>
                    <div class="crop-image-container">
                        <vue-cropper class="crop-image-canvas" ref='cropper' :guides="true" :view-mode="2" drag-mode="crop"
                            aspect-ratio="1" :auto-crop-area="0.5" :min-container-width="250" :min-container-height="180"
                            :background="true" :rotatable="true" :src="imgSrc" alt="" :img-style="cropWidth">
                        </vue-cropper>
                    </div>
                    <!-- <img :src="cropImg" style="width: 200px; height: 200px; border: 1px solid gray" alt="Cropped Image" /> -->
                    <p class="crop-popup-text">3. Підтвердіть своє фото</p>
                    <button class="crop-image-button btn gold" @click="cropImage" v-if="imgSrc != ''">Відправити</button>
                </div>
            </div>
        </div>

        <v-policy-pop
            v-if="rulesPolicy"
            @closeRules="rulesPolicy = false, check_policy = true"
        />
        <v-rules-pop
            v-if="rulesAction"
            @closeRules="rulesAction = false, check_rules = true"
        />


    </div>
</template>

<script>

    import Header from './Header.vue';
    import Footer from './Footer.vue';
    import RegStar from './RegisterStar.vue';
    import Btn from './btn.vue';
    import VueCropper from 'vue-cropperjs';
    import RulesPopup from './RulesPopup.vue'
    import PolicyPopup from './PolicyPopup.vue'
    import { required, minLength, between } from 'vuelidate/lib/validators';

export default {
        components: {
            'v-header': Header,
            'v-footer': Footer,
            'v-star': RegStar,
            'v-btn': Btn,
            'v-rules-pop': RulesPopup,
            'v-policy-pop': PolicyPopup,
            VueCropper,
        },
        data() {
            return {
                    name : '',
                    surname: '',
                    city_id: '',
                    mobile_phone: '',
                    mobile_code: '',
                    about_me: '',
                    avatar: '',
                    code: '',
                    check_rules: false,
                    check_policy: false,
                    cities: [],
                    showPopup: false,
                    getCodeForm: true,
                    codeForm: false,
                    alert: false,
                    popupImage: false,
                    imgSrc: '',
                    cropImg: '',
                    rulesPolicy: false,
                    rulesAction: false,
                    alertMessage: '',
                    isStarCheck: true,
                    windowWidth: '',
                    cropWidth: {},
            }
        },
        validations: {
            name: {
                required,
                minLength: minLength(3)
            },
            surname: {
                required,
                minLength: minLength(3) 
            },
            city_id: {
                required
            },
            mobile_phone: {
                required,
                minLength: minLength(10) 
            },
            code: {
                required
            },
            check_rules: {
                required
            },
            check_policy: {
                required
            }
        },
        methods: {
            sendReg() {
                let formData = {
                    name : this.name,
                    surname: this.surname,
                    city_id: this.city_id,
                    mobile_phone: '38' + this.mobile_phone,
                    code: this.code,
                    about_me: this.about_me,
                };

                this.$v.$touch()
                // if (this.$v.$invalid) {
                //     console.log($v.mobile_phone.$error);
                // } else {
                //     // do your submit logic here
                // }

                // for (const key in formData) {
                //     if ( formData[key].length < 1 ) {
                //         (key == 'name') ? console.log(this.$refs.name) : this.$refs.name;
                //     }
                // }


                let testData = new FormData();

                function dataURItoBlob(dataURI) {
                    // convert base64 to raw binary data held in a string
                    // doesn't handle URLEncoded DataURIs - see SO answer #6850276 for code that does this
                    var byteString = atob(dataURI.split(',')[1]);

                    // separate out the mime component
                    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

                    // write the bytes of the string to an ArrayBuffer
                    var ab = new ArrayBuffer(byteString.length);
                    var ia = new Uint8Array(ab);
                    for (var i = 0; i < byteString.length; i++) {
                        ia[i] = byteString.charCodeAt(i);
                    }

                    //Old Code
                    //write the ArrayBuffer to a blob, and you're done
                    //var bb = new BlobBuilder();
                    //bb.append(ab);
                    //return bb.getBlob(mimeString);

                    //New Code
                    return new Blob([ab], {type: mimeString});


                }


                if (!this.check_rules) {
                    this.$refs.check_rules.$el.classList.add("alert-input");
                } else {
                    this.$refs.check_rules.$el.classList.remove("alert-input");
                }
                if (!this.check_policy) {
                    this.$refs.check_policy.$el.classList.add("alert-input");
                } else {
                    this.$refs.check_policy.$el.classList.remove("alert-input");
                }

                if((this.about_me.length < 1 && this.cropImg.length > 1) || (this.about_me.length > 1 && this.cropImg.length < 1) ) {
                    this.alertMessage = "Необхідно заповнити обидва поля участі у конкурсі";
                    this.isStarCheck = false;
                } else {
                    this.alertMessage = '';
                    this.isStarCheck = true;
                }

                if(this.check_rules && this.check_policy && !this.$v.$invalid && this.isStarCheck) {



                    if(this.cropImg != "") {
                        // console.log('crop');
                        const filePhoto = dataURItoBlob(this.cropImg);
                        this.avatar = filePhoto;

                        testData.append("avatar", filePhoto);

                    }

                    // console.log(formData);

                    for (const key in formData) {
                            // console.log(key);
                            // console.log(formData[key]);
                            testData.append(key + "", formData[key]);
                    }


                    axios
                        .post('api/register', 
                            testData
                        )
                        .then(responce => {
                            console.log(responce);
                            if (responce.data.success) {
                                this.$router.push({name: "Home"});
                                this.alertMessage = '';
                            }
                        })
                        .catch(e => {
                            const response = e.response;
                            this.alertMessage = response.data.message;
                            // this.errors.push(e)
                        })
                } else {
                    // this.$refs.check_rules.$el.classList.add("alert-input");
                    // this.$refs.check_policy.$el.classList.add("alert-input");
                }

                console.log(formData);
                console.log('test',testData);

            },
            singleValues(items){
                this.city_id = items[0].Id;
            },
            acceptMobile() {
                this.showPopup = true;
                this.codeForm = false;
                this.getCodeForm = true;
            },
            hidePopup() {
                this.showPopup = false;
            },
            getCode() {
                if(this.mobile_phone.length == 10) {
                    this.alert = false;
                    axios
                        .post('api/send-sms',
                            {
                                'mobile_phone': '38' + this.mobile_phone
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
                            this.alertMessage = e.response.data.message;
                        })                    
                } else {
                    this.alert = true;
                }
            },
            activeCode() {
                if (this.mobile_code.length > 2) {
                    axios
                        .post('api/verify-code',
                            {
                                'code': this.mobile_code,
                                'mobile_phone': '38' + this.mobile_phone
                            }
                        )
                        .then(responce => {
                            if (responce.data.success) {
                                this.alert = false;
                                this.showPopup = false;
                                this.alertMessage = '';
                            } else {
                                console.log(responce);
                                this.alert = true;
                            }
                        })
                        .catch(e => {
                                const response = e.response;
                                this.alert = true;
                                this.alertMessage = response.data.message;
                            // this.errors.push(e)
                        }) 
                } else {
                    this.alert = true;
                }
            },
            setImage(e) {
                const file = e.target.files[0];

                if (!file.type.includes('image/')) {
                alert('Please select an image file');
                return;
                }

                if (typeof FileReader === 'function') {
                const reader = new FileReader();

                reader.onload = (event) => {
                    this.imgSrc = event.target.result;
                    // rebuild cropperjs with the updated source
                    this.$refs.cropper.replace(event.target.result);
                };

                reader.readAsDataURL(file);
                } else {
                alert('Sorry, FileReader API not supported');
                }
            },
            cropImage() {

                // get image data for post processing, e.g. upload or setting image src
                this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();


                // let filePhoto = new Image();
                // filePhoto.src = this.cropImg;
                
                
                // this.avatar = filePhoto;
                this.popupImage = false;
            },
            cropPopup() {
                this.popupImage = true;
            },
            hideCropPopup() {
                this.popupImage = false;
            },
            rulesPolicyShow() {
                this.rulesPolicy = true;
            },
            rulesActionShow() {
                this.rulesAction = true;
            },
        },
        beforeMount() {
        this.windowWidth = window.innerWidth;

        if(this.windowWidth > 500) {
            console.log('>500');
            this.cropWidth = { 'width': '400px', 'height': '300px', 'margin': '0 auto' };
        } else {
            console.log('<500');
            this.cropWidth = { 'width': '250px', 'height': '180px', 'margin': '0 auto' };
        }
          axios
             .get('api/cities'
            )
            .then(responce => {
                this.cities = responce.data.Cities;
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
}
</script>