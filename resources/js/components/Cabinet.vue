<template>
    <div class="cabinet-page">
        <v-header
            :display-hat="true"
        />
        <div class="cabinet-content">
            <div class="cabinet-top">
                <div class="cabinet-container">
                    <div class="cabinet-info-block">
                        <div class="cabinet-main-info">
                            <p class="cabinet-name">Маринова Марина</p>
                            <p class="cabinet-city">м. Київ</p>
                            <the-mask   class="cabinet-phone"
                                mask="(###)###-##-##" 
                                type="tel" 
                                value="0988917446"
                                readonly
                            />
                        </div>
                        <div class="cabinet-code-info">
                            <p class="cabinet-code-title">Зареєстровані коди</p>
                            <span class="cabinet-code-item">56451321</span>
                            <span class="cabinet-code-item">56451322</span>
                            <span class="cabinet-code-item">56451323</span>
                            <span class="cabinet-code-item">56451324</span>
                            <span class="cabinet-code-item">56451325</span>
                            <span class="cabinet-code-item">56451326</span>
                        </div>
                    </div>
                    <div class="cabinet-reg-codes">
                        <form action="POST" class="reg-codes-form">
                             <input class="code-input" 
                                    type="text" 
                                    name="code" 
                                    placeholder="Код з упаковки*" 
                                    v-model="packCode">
                            <button class="cabinet-page-btn" @click.prevent="sendCode()">Зареєструвати</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="cabinet-bottom" v-if="!isStar">
                    <div class="register-star-title-container">
                        <h1 class="register-star-title">ВИ БЕРЕТЕ УЧАСТЬ У КОНКУРСІ «САМА СОБІ ЗІРКА»</h1>
                        <!-- <span>Тоді візьміть участь у творчому конкурсі «Сама собі зірка»</span> -->
                    </div>
                    <div class="register-star-form">
                        <div class="cabinet-quote">
                            <span class="cabinet-quote-text">Розкажіть про свою сцену чи аудиторію, <br>
                                що Вас надихає бути привабливою
                            </span>
                        </div>
                        <div class="register-photo">
                            <img  class="cropped-photo" :src="cropImg">
                        </div>
                    </div>                    
            </div>
            <div class="register-bottom" v-if="isStar">
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
    import VueCropper from 'vue-cropperjs';
    import { required, minLength, between } from 'vuelidate/lib/validators';

export default {
        components: {
            'v-header': Header,
            'v-footer': Footer,
            'v-star': RegStar,
            'v-btn': Btn,
            VueCropper,
        },
        data() {
            return {
                packCode: '',
                name : '',
                surname: '',
                city_id: '',
                mobile_phone: '',
                mobile_code: '',
                about_me: '',
                avatar: '',
                isStar: true,
                code: '',
                popupImage: false,
                imgSrc: '',
                cropImg: '',
            }
        },
        methods: {
            sendCode() {
                console.log(this.packCode);
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
}
</script>