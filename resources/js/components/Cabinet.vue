<template>
    <div class="cabinet-page">
        <v-header
            :display-hat="true"
        />
        <div class="cabinet-content" v-if="token != ''">
            <div class="cabinet-top">
                <div class="cabinet-container">
                    <div class="cabinet-info-block">
                        <div class="cabinet-main-info">
                            <p class="cabinet-name">{{ user.Name }}  {{ user.Surname }}</p>
                            <p class="cabinet-city">м. {{ user.City }}</p>
                            <the-mask   class="cabinet-phone"
                                mask="+##(###)###-##-##" 
                                type="tel" 
                                :value="user.Mobile_phone"
                                readonly
                            />
                        </div>
                        <div class="cabinet-code-info">
                            <p class="cabinet-code-title">Зареєстровані коди</p>
                            <span class="cabinet-code-item" v-for="code in user.Codes" :key="code.Id">{{ code.Name }}</span>
                        </div>
                    </div>
                    <div class="cabinet-reg-codes">
                        <form action="POST" class="reg-codes-form">
                             <input class="code-input" 
                                    type="text" 
                                    name="code" 
                                    placeholder="Код з упаковки*" 
                                    :class="{'alert-input' : alert}"
                                    v-model="packCode"
                                    v-on:keyup.enter.prevent.native = "sendCode"
                                    >
                            <button class="cabinet-page-btn" @click.prevent="sendCode()">Зареєструвати</button>
                            <span class="login-alert">{{ this.alertMessage }}</span>  
                        </form>
                    </div>
                </div>
            </div>
            <div class="cabinet-bottom" v-if="user.Can_be_brand_face == '1' ">
                    <div class="register-star-title-container">
                        <h1 class="register-star-title">ВИ БЕРЕТЕ УЧАСТЬ У КОНКУРСІ «САМА СОБІ ЗІРКА»</h1>
                        <!-- <span>Тоді візьміть участь у творчому конкурсі «Сама собі зірка»</span> -->
                    </div>
                    <div class="register-star-form">
                        <div class="cabinet-quote">
                            <span class="cabinet-quote-text">
                                {{ user.About_me }}
                            </span>
                        </div>
                        <div class="register-photo">
                            <img  class="cropped-photo" :src="'storage/' + user.Avatar">
                        </div>
                    </div>                    
            </div>
            <div class="register-bottom" v-if="user.Can_be_brand_face == '0' ">
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
                <v-btn
                    text="Відправити"
                    color="violet"
                    link="/"
                    @click.native.prevent="sendReg()"
                />
            </div>
        </div>
        <div class="unautorized" v-if="token == ''">
        </div>
        <v-login
            v-if="token == ''"
            @close="Popup = false"
        ></v-login>
        <v-footer/>

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
                            :background="true" :rotatable="true" :src="imgSrc" alt="" :img-style="{ 'width': '400px', 'height': '300px', 'margin': '0 auto' }">
                        </vue-cropper>
                    </div>
                    <!-- <img :src="cropImg" style="width: 200px; height: 200px; border: 1px solid gray" alt="Cropped Image" /> -->
                    <p class="crop-popup-text">3. Підтвердіть своє фото</p>
                    <button class="crop-image-button btn gold" @click="cropImage" v-if="imgSrc != ''">Відправити</button>
                </div>
            </div>
        </div>


    </div>
</template>

<script>

    import Header from './Header.vue';
    import Footer from './Footer.vue';
    import RegStar from './RegisterStar.vue';
    import Btn from './btn.vue';
    import Login from './Login.vue';
    import VueCropper from 'vue-cropperjs';
    import { required, minLength, between } from 'vuelidate/lib/validators';

export default {
        components: {
            'v-header': Header,
            'v-footer': Footer,
            'v-star': RegStar,
            'v-btn': Btn,
            'v-login': Login,
            VueCropper,
        },
        data() {
            return {
                user: {},
                packCode: '',
                about_me: '',
                avatar: '',
                popupImage: false,
                imgSrc: '',
                cropImg: '',
                token: localStorage.getItem('token') || '',
                alert: false,
                alertMessage: '',
            }
        },
        methods: {
            sendReg() {
                let formData = {
                    about_me: this.about_me,
                };


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


                if(this.about_me) {

                    if(this.cropImage !== '') {
                        const filePhoto = dataURItoBlob(this.cropImg);
                        this.avatar = filePhoto;
                        testData.append("avatar", this.avatar);
                        console.log('199', testData);

                    }

                    console.log('205',formData);

                    for (const key in formData) {
                            // console.log(key);
                            // console.log(formData[key]);
                            testData.append(key + "", formData[key]);
                    }
                    
                    console.log('213',testData);

                    if(testData) {
                        let headers = {
                            Accept : 'application/json, text/javascript',
                            Connection: 'keep',
                            Authorization: this.token
                        };
                        axios
                        .post('api/cabinet/update', 
                            testData , {headers : headers}
                        )
                        .then(responce => {
                            console.log(responce);
                            this.$router.push('/')
                        })
                        .catch(e => {
                            // this.errors.push(e)
                        })
                    }

                } 

            },
            sendCode() {
                console.log(this.packCode);
                let headers = {
                        Accept : 'application/json, text/javascript',
                        Connection: 'keep',
                        Authorization: this.token
                    };
                axios
                    .post('api/cabinet/code', {
                        name: this.packCode
                    }, {headers : headers}
                    )
                    .then(responce => {
                        if(responce.data.success) {
                            this.user.Codes.push({Id: '', Name: this.packCode});
                            this.alert = false;
                            this.alertMessage = '';
                        } else {
                            this.alert = true;
                            this.alertMessage = 'Промо код невірний';
                        }
                        
                    })
                    .catch(e => {
                        console.log('Ошибка');
                         this.alert = true;
                         this.alertMessage = 'Промо код невірний';
                    })
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
                let filePhoto = new Image();
                filePhoto.src = this.cropImg;
                
                this.avatar = filePhoto;
                this.popupImage = false;
            },
            cropPopup() {
                this.popupImage = true;
            },
            hideCropPopup() {
                this.popupImage = false;
            }
        },
        beforeMount() {
            axios
                .get('api/cabinet', {
                    headers: {
                        Accept : 'application/json, text/javascript',
                        Connection: 'keep',
                        Authorization: this.token
                        }
                })
                .then(responce => {
                    console.log(responce);
                    this.user = responce.data.user;
                    if(responce.data == "Unauthorized" && this.token != '') {
                        localStorage.removeItem('token');
                        this.token = '';
                        this.$router.push('/')
                    } 
                    // if(responce.data == "Unauthorized" && this.token == '') {
                        
                    // }
                })
                .catch(error => {
                    console.log(error.request.statusText);
                })
        },
}
</script>