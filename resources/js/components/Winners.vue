<template>
    <div class="popup-container popup-image-crop" v-if="popupImage">
        <div class="popup-overlay" @click="hidePopup()"></div>
        <div class="popup-content-wrapper">
            <div class="popup-content">
                <div class="upload-file-container">
                    <label for="upload-image" class="upload-file-label">1. <span>Виберіть</span> фотографію</label>
                    <input 
                        class="upload-file-button"
                        type="file" 
                        name="image" 
                        accept="image/*" 
                        @change="setImage"
                        id="upload-image" 
                    />
                </div>
                <p class="crop-popup-text">2. Виберіть необхідні розміри фотографії</p>
                <div class="crop-image-container">
                    <vue-cropper 
                        class="crop-image-canvas"
                        ref='cropper' 
                        :guides="true" 
                        :view-mode="2" 
                        drag-mode="crop" 
                        aspect-ratio=1
                        :auto-crop-area="0.5" 
                        :min-container-width="250" 
                        :min-container-height="180" 
                        :background="true"
                        :rotatable="true" 
                        :src="imgSrc" 
                        alt="" 
                        :img-style="{ 'width': '400px', 'height': '300px', 'margin': '0 auto' }">
                    </vue-cropper>
                </div>
                <!-- <img :src="cropImg" style="width: 200px; height: 200px; border: 1px solid gray" alt="Cropped Image" /> -->
                <p class="crop-popup-text">3. Підтвердіть своє фото</p>
                <button class="crop-image-button btn gold" @click="cropImage" v-if="imgSrc != ''" >Відправити</button>
            </div>
        </div>
    </div>
</template>

<script>
  import VueCropper from 'vue-cropperjs';


  export default {
    components: {
      VueCropper,
    },
    data() {
      return {
        popupImage: true,
        imgSrc: '',
        cropImg: '',
      };
    },
    methods: {
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
      },
      hidePopup() {
          this.popupImage = false;
      }
    },
  };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
