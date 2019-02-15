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
                        <span class="gallery-name">{{ starName }} {{ starSurname }}</span>
                        <span class="gallery-city">м. {{ starCity }}</span>
                    </div>
                    <div class="gallery-quote">
                        <p class="gallery-quote-text">
                            {{ starInfo }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="gallery-bottom">
                <h3 class="gallery-title">Інші жінки</h3>
                <swiper class="gallery-slider" :options="swiperOption">
                    <swiper-slide class="gallery-slide" v-for="woman in galleryWomen" :key="woman.id">
                        <div class="slider-img-container" @click.prevent="chooseStar($event, woman)">
                            <img class="gallery-slide-image" :src="'storage/' + woman.Avatar" alt="">
                            <img class="gallery-little-star" src="img/gallery-litle-star.png" alt="star">
                        </div>
                    </swiper-slide>
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
            galleryWomen: [],
            imgUrl: '',
            starName: '',
            starCity: '',
            starSurname: '',
            starInfo: '',
            galleryInfo: true,
        }
    },
    methods: {
        chooseStar(event, item) {
            this.imgUrl = event.target.src;
            this.starName = item.Name;
            this.starCity = item.City;
            this.starInfo = item.AboutMe;
            this.starSurname = item.Surname;
            console.log(event.currentTarget);

        }
    },
    beforeMount() {
            axios
                .get('api/gallery', {
                    headers: {
                        Accept : 'application/json, text/javascript',
                        Connection: 'keep'
                        }
                })
                .then(responce => {
                    console.log(responce);
                    this.galleryWomen = responce.data.users;
                    this.imgUrl = 'storage/' + responce.data.users[0].Avatar;
                    this.starName = responce.data.users[0].Name;
                    this.starCity = responce.data.users[0].City;
                    this.starInfo = responce.data.users[0].AboutMe;
                    this.starSurname = responce.data.users[0].Surname;
                })
                .catch(e => {
                    this.errors.push(e)
                })
    }
    
}
</script>