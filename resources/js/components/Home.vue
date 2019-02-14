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
                        <h2 class="main-title">Сяй разом <br> з «Чeрный Жемчуг» <br> та вигравай <br> подарунки щодня!</h2>
                        <v-btn
                            text="Взяти участь"
                            link="/login"
                            color="gold"
                            @click.prevent.native="moveTo(2)"
                        />
                    </div>
                    <div class="page-1-block page-1-right"></div>
                </div>
                <div class="page-2 page">
                    <div class="page-wrapper">
                        <h2 class="title">Про акцію</h2>
                        <div class="page-content page-2-content">
                            <div class="page-2-left">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/2Rmdtg9EEM4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="page-2-right">
                                <p class="page-text">
                                    Кожна жінка для нас – це натхнення!
                                    Розкажи, що надихає тебе бути красивою,
                                    і ми віддячимо тобі шансом виграти
                                    блискучі подарунки
                                </p>
                                <v-btn
                                    text="Взяти участь"
                                    link="/login"
                                    color="gold"
                                    @click.prevent.native="showPopup()"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-3 page">
                    <div class="page-wrapper">
                        <h2 class="title">Призи</h2>
                        <div class="page-content page-3-content">
                            <div class="page-3-left"></div>
                            <div class="page-3-center">
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
                        </div>
                        <v-btn
                            text="Взяти участь"
                            link="/login"
                            color="gold"
                            @click.prevent.native="showPopup()"
                        />
                    </div>
                </div>
                <div class="page-4 page">
                    <div class="page-wrapper">
                        <h2 class="title violet">Як взяти участь</h2>
                        <div class="page-content page-4-content">
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-1.png" alt="">
                                <span class="page-4-item-title">1.Реєструй</span>
                                <p class="page-4-item-text">код з упаковки
                                    «Черный Жемчуг» на сайті
                                    samasobizirka.com.ua
                                    або через SMS
                                </p>
                            </div>
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-2.png" alt="">
                                <span class="page-4-item-title">2.Вигравай</span>
                                <p class="page-4-item-text">
                                    прикрасу з чорною
                                    перлиною щодня 
                                </p>
                            </div>
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-3.png" alt="">
                                <span class="page-4-item-title">3.Додай</span>
                                <p class="page-4-item-text">
                                    своє фото та розкажи,
                                    що надихає тебе
                                    залишатись молодою
                                    та красивою 
                                </p>
                            </div>
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-4.png" alt="">
                                <span class="page-4-item-title">4.Отримай</span>
                                <p class="page-4-item-text">
                                    шанс стати зіркою рекламної
                                    кампанії «Черный Жемчуг» 
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
                </div>
                <div class="page-5 page">
                    <div class="page-5-content">
                        <h2 class="title">Наші зірки</h2>
                        <div class="page-5-stars">
                            <div class="page-5-star" v-for="star in stars" :key="star.id">
                                <img class="page-5-star-photo" :src="star.avatar"   alt="avatar">
                                <span class="page-5-star-name"> {{ star.name }} {{ star.surname }} </span>
                                <span class="page-5-star-city">м. {{ star.city }}</span>
                            </div>
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
                opts: {
                    start: 0,
                    dir: 'v',
                    duration: 500,
                    beforeChange: function (prev, next) {},
                    afterChange: function (prev, next) {}
                },
                pageNum: 0,
                Popup: false,
                stars: []
            }
        },
        methods: {
                moveNext() {
                    this.$refs.fullpage.$fullpage.moveNext(); //Move to the next page
                },
                moveTo: function(index) {
                    this.$refs.fullpage.$fullpage.moveTo(index, true);
                },
                showPopup() {
                    this.Popup = true;
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
                    console.log(responce.data.users);
                    this.stars = responce.data.users;
                })
                .catch(e => {
                    this.errors.push(e)
                })
        }
    }
</script>
