<template>
    <div class="main" ref="home">
        <v-header
             @goTo1="moveTo(1)"
             @goTo2="moveTo(2)"
             @goTo3="moveTo(3)"
        >
        </v-header>
        <div class="fullpage-container">
            <div class="fullpage-wp" v-fullpage="opts" ref="fullpage">
                <div class="page-1 page">
                    <div class="page-1-block page-1-left"></div>
                    <div class="page-1-block page-1-center">
                        <img class="main-logo" src="/img/main/logo.png" alt="">
                        <h2 class="main-title">Сяй разом <br class="br-desctop"/> з «Чeрный Жемчуг» <br class="br-tablets"/> <br class="br-desctop"/> та вигравай <br class="br-desctop"/> подарунки щодня!</h2>
                        <v-btn
                            text="Взяти участь"
                            link="/login"
                            color="gold"
                            class="desktop-only"
                            @click.prevent.native="showPopup()"
                        />
                    </div>
                    <div class="page-1-block page-1-right"></div>
                        <v-btn
                            text="Взяти участь"
                            link="/login"
                            color="gold"
                            class="mobile-only"
                            @click.prevent.native="showPopup()"
                            style="order: 4;"
                        />
                    <div class="arrow-down gold-arrow" @click="moveNext()"></div>    
                </div>
                <div class="page-2 page">
                    <div class="arrow-up" @click="movePrev()"></div> 
                    <div class="page-wrapper">
                        <h2 class="title">Про акцію</h2>
                        <div class="page-content page-2-content">
                            <div class="page-2-left">
                                <iframe class="page-2-video"  src="https://www.youtube.com/embed/CrU-829qoUY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <v-btn
                                    class="mobile-only"
                                    text="Взяти участь"
                                    link="/login"
                                    color="gold"
                                    @click.prevent.native="showPopup()"
                                />
                            </div>
                            <div class="page-2-right">
                                <p class="page-text">
                                    Кожна жінка для нас – це натхнення!
                                    Розкажи, що надихає тебе бути красивою,
                                    і ми віддячимо тобі шансом виграти
                                    блискучі подарунки
                                </p>
                                <v-btn
                                    class="desktop-only"
                                    text="Взяти участь"
                                    link="/login"
                                    color="gold"
                                    @click.prevent.native="showPopup()"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="arrow-down" @click="moveNext()"></div> 
                </div>
                <div class="page-3 page">
                    <div class="arrow-up" @click="movePrev()"></div> 
                    <div class="page-wrapper">
                        <h2 class="title">Призи</h2>
                        <div class="page-content page-3-content">
                            <div class="page-3-left"></div>
                            <div class="mobile-only">
                                <p class="page-text">
                                    Срібна прикраса з натуральною
                                    чорною перлиною може стати
                                    твоєю з кожним зареєстрованим
                                    кодом
                                </p>
                            </div>
                            <div class="page-3-center desktop-only">
                                <p class="page-text">
                                    Срібна прикраса з натуральною
                                    чорною перлиною може стати
                                    твоєю з кожним зареєстрованим
                                    кодом
                                </p>
                                <p class="page-text">
                                    Бери участь у творчому конкурсі
                                    та стань натхненням для інших
                                    у рекламній кампанії
                                    «Черный жемчуг» 
                                </p>
                            </div>
                            <div class="page-3-right"></div>
                            <div class="mobile-only">
                                <p class="page-text">
                                    Бери участь у творчому конкурсі
                                    та стань натхненням для інших
                                    у рекламній кампанії
                                    «Черный жемчуг» 
                                </p>
                            </div>
                        </div>
                        <v-btn
                            text="Взяти участь"
                            link="/login"
                            color="gold"
                            @click.prevent.native="showPopup()"
                        />
                    </div>
                    <div class="arrow-down" @click="moveNext()"></div> 
                </div>
                <div class="page-4 page">
                    <div class="arrow-up" @click="movePrev()"></div> 
                    <div class="page-wrapper">
                        <h2 class="title violet">Як взяти участь</h2>
                        <div class="page-content page-4-content">
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-1.png" alt="">
                                <div class="page-4-item-text-cont">
                                    <span class="page-4-item-title">1.Реєструй</span>
                                    <p class="page-4-item-text">код з упаковки
                                        «Черный Жемчуг» на сайті
                                        samasobizirka.com.ua
                                        або через SMS
                                    </p>
                                </div>
                            </div>
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-2.png" alt="">
                                <div class="page-4-item-text-cont">
                                    <span class="page-4-item-title">2.Вигравай</span>
                                    <p class="page-4-item-text">
                                        прикрасу з чорною
                                        перлиною щодня 
                                    </p>
                                </div>
                            </div>
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-3.png" alt="">
                                <div class="page-4-item-text-cont">
                                    <span class="page-4-item-title">3.Додай</span>
                                    <p class="page-4-item-text">
                                        своє фото та розкажи,
                                        що надихає тебе
                                        залишатись молодою
                                        та красивою 
                                    </p>
                                </div>
                            </div>
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-4.png" alt="">
                                <div class="page-4-item-text-cont">
                                    <span class="page-4-item-title">4.Отримай</span>
                                    <p class="page-4-item-text">
                                        шанс стати зіркою рекламної
                                        кампанії «Черный Жемчуг» 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <v-btn
                            text="Взяти участь"
                            link="/login"
                            color="gold"
                            @click.prevent.native="showPopup()"
                        />
                    </div>
                    <div class="arrow-down" @click="moveNext()"></div> 
                </div>
                <div class="page-5 page">
                    <div class="arrow-up" @click="movePrev()"></div> 
                    <div class="page-5-content">
                        <h2 class="title">Наші зірки</h2>
                        <div class="page-5-stars">
                            <div class="page-5-star desktop-only" v-for="star in stars" :key="star.id" @click="goToStar()">
                                <img class="page-5-star-photo" :src="'storage/' + star.avatar"   alt="avatar">
                                <span class="page-5-star-name"> {{ star.name }} {{ star.surname }} </span>
                                <span class="page-5-star-city">м. {{ star.city }}</span>
                            </div>
                            <div class="page-5-star desktop-only" v-if="stars.length < 1" @click="goToStar()">
                                <img class="page-5-star-photo" src="img/ladies/01.jpg"   alt="avatar">
                            </div>
                            <div class="page-5-star desktop-only" v-if="stars.length < 1" @click="goToStar()">
                                <img class="page-5-star-photo" src="img/ladies/02.jpg"   alt="avatar">
                            </div>
                            <div class="page-5-star desktop-only" v-if="stars.length < 1" @click="goToStar()">
                                <img class="page-5-star-photo" src="img/ladies/03.jpg"   alt="avatar">
                            </div>
                            <swiper class="stars-slider mobile-only" :options="swiperOption">
                                <swiper-slide class="page-5-star" v-for="star in stars" :key="star.id" :data-name="star.surname">
                                    <img class="page-5-star-photo" :src="'storage/' + star.avatar"   alt="avatar">
                                    <span class="page-5-star-name"> {{ star.name }} {{ star.surname }} </span>
                                    <span class="page-5-star-city">м. {{ star.city }}</span>
                                </swiper-slide>
                            </swiper>
                            <div class="swiper-button-prev" slot="button-prev"></div>
                            <div class="swiper-button-next" slot="button-next"></div>
                        </div>
                        <v-btn
                            text="До галереї"
                            link="/gallery"
                            color="gold"
                        />
                        <v-btn
                            text="Правила акції"
                            link="/rules"
                            color="violet"
                        />
                    </div>
                    <v-footer/>
                </div>
            </div>
            <!-- <button @click="moveNext">next</button> -->
        </div>
        <v-login
            v-if="Popup"
            @close="Popup = false"
        ></v-login>
    </div>
</template>

<script>

    import Header from './Header.vue';
    import Footer from './Footer.vue';
    import Btn from './btn.vue';
    import Login from './Login.vue';

    export default {
        components: {
            'v-header': Header,
            'v-footer': Footer,
            'v-btn': Btn,
            'v-login': Login,
        },
        data: function() {
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
                    },
                    breakpoints: {
                        1024: {
                        slidesPerView: 1,
                        // spaceBetween: 40
                        },
                        640: {
                        slidesPerView: 1,
                        // spaceBetween: 20
                        }
                    }
                },
                opts: {
                    start: 0,
                    dir: 'v',
                    duration: 500,
                    beforeChange: function (prev, next) {},
                    afterChange: function (prev, next) {}
                },
                pageNum: 0,
                Popup: false,
                stars: [],
                token: localStorage.getItem('token') || ''
            }
        },
        methods: {
                moveNext() {
                    this.$refs.fullpage.$fullpage.moveNext(); //Move to the next page
                },
                movePrev() {
                    this.$refs.fullpage.$fullpage.movePrev(); //Move to the next page
                },
                moveTo: function(index) {
                    this.$refs.fullpage.$fullpage.moveTo(index, true);
                },
                showPopup() {
                    if(this.token == '') {
                         this.Popup = true;
                    } else {
                        this.$router.push('/cabinet')
                    }
                   
                },
                goToStar() {
                    console.log('star');
                    this.$router.push({name: 'Gallery', params: {starSurname: 'surname' }});
                }
        },
        beforeMount() {
            axios
                .get('api/stars', {
                    headers: {
                        Accept : 'application/json, text/javascript',
                        Connection: 'keep'
                        }
                })
                .then(responce => {
                    // console.log(responce.data.users);
                    this.stars = responce.data.users;
                })
                .catch(e => {
                    this.errors.push(e)
                })
        }
    }
</script>
