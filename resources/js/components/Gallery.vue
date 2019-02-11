<template>
    <div class="gallery-page">
        <v-header />
        <div class="gallery-container">
            <div class="gallery-top">
                <div class="gallery-photo">
                    <img class="gallery-big-star" :src="imgUrl" alt="women">
                    <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                </div>
                <div class="gallery-info" v-if="galleryInfo">
                    <div class="gallery-personal-info">
                        <span class="gallery-name">Маринова Марина</span>
                        <span class="gallery-city">м. Київ</span>
                    </div>
                    <div class="gallery-quote">
                        <p class="gallery-quote-text">Моя аудиторія – це мої покупці. Вони спонукають бути красивою 
                            та привабливою щодня. Це моє найбільше натхнення!
                        </p>
                    </div>
                </div>
            </div>
            <div class="gallery-bottom">
                <h3 class="gallery-title">Інші жінки</h3>
                <swiper class="gallery-slider" :options="swiperOption">
                    <swiper-slide class="gallery-slide">
                        <div class="slider-img-container">
                            <img class="gallery-slide-image" @click.prevent="chooseStar($event)" src="img/main/star-1.png" alt="">
                            <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                        </div>
                    </swiper-slide>
                    <swiper-slide class="gallery-slide">
                        <div class="slider-img-container">
                            <img class="gallery-slide-image" @click.prevent="chooseStar($event)" src="img/main/star-2.png" alt="">
                            <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                        </div>
                    </swiper-slide>
                    <swiper-slide class="gallery-slide">
                        <div class="slider-img-container">
                            <img class="gallery-slide-image" src="img/main/star-1.png" alt="">
                            <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                        </div>
                    </swiper-slide>
                    <swiper-slide class="gallery-slide">
                        <div class="slider-img-container">
                            <img class="gallery-slide-image" src="img/main/star-2.png" alt="">
                            <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                        </div>                        
                    </swiper-slide>
                    <swiper-slide class="gallery-slide">
                        <div class="slider-img-container">
                            <img class="gallery-slide-image" src="img/main/star-1.png" alt="">
                            <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                        </div>                        
                    </swiper-slide>
                    <swiper-slide class="gallery-slide">
                        <div class="slider-img-container">
                            <img class="gallery-slide-image" src="img/main/star-2.png" alt="">
                            <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                        </div>                        
                    </swiper-slide>
                    <swiper-slide class="gallery-slide">
                        <div class="slider-img-container">
                            <img class="gallery-slide-image" src="img/main/star-1.png" alt="">
                            <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                        </div>                        
                    </swiper-slide>
                    <swiper-slide class="gallery-slide">
                        <div class="slider-img-container">
                            <img class="gallery-slide-image" src="img/main/star-2.png" alt="">
                            <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                        </div>                        
                    </swiper-slide>
                    <swiper-slide class="gallery-slide">
                        <div class="slider-img-container">
                            <img class="gallery-slide-image" src="img/main/star-1.png" alt="">
                            <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                        </div>                        
                    </swiper-slide>
                    <swiper-slide class="gallery-slide">
                        <div class="slider-img-container">
                            <img class="gallery-slide-image" src="img/main/star-1.png" alt="">
                            <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                        </div>                        
                    </swiper-slide>
                    <!-- <div class="swiper-pagination" slot="pagination"></div> -->
                </swiper>
                <div class="swiper-button-prev" slot="button-prev"></div>
                <div class="swiper-button-next" slot="button-next"></div>
            </div>
        </div>
        <v-footer />
    </div>
</template>

<script>

    import Header from './Header.vue';
    import Footer from './Footer.vue';

export default {

    components: {
            'v-header': Header,
            'v-footer': Footer,
    }, 
    data() {
        return {
            swiperOption: {
                slidesPerView: 4,
                spaceBetween: 30,
                pagination: {
                  el: '.swiper-pagination',
                  clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            },
            imgUrl: 'img/main/star-1.png',
            galleryInfo: true,
        }
    },
    methods: {
        chooseStar(event) {
            this.imgUrl = event.target.src;
            console.log(event.target.src);
        }
    },
    
}
</script>