<template>
    <div class="main">
        <v-header>

        </v-header>
        <div class="fullpage-container">
            <div class="fullpage-wp" v-fullpage="opts" ref="example">
                <div class="page-1 page">
                    <div class="page-1-block page-1-left"></div>
                    <div class="page-1-block page-1-center">
                        <img class="main-logo" src="/img/main/logo.png" alt="">
                        <h2 class="main-title">Сяй разом <br> з «Чeрный Жемчуг» <br> та вигравай <br> подарунки щодня!</h2>
                        <v-btn
                            text="Взяти участь"
                            link="/login"
                            color="gold"
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
                        />
                    </div>
                </div>
                <div class="page-4 page">
                    <div class="page-wrapper">
                        <h2 class="title violet">Як взяти участь</h2>
                        <div class="page-content page-4-content">
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-1.png" alt="">
                            </div>
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-2.png" alt="">
                                <span class="page-4-item-title">1.Реєструй</span>
                                <p class="page-4-item-text">код з упаковки
                                    «Черный Жемчуг» на сайті
                                    samasobizirka.com.ua
                                    або через SMS
                                </p>
                            </div>
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-3.png" alt="">
                            </div>
                            <div class="page-4-item">
                                <img class="page-4-ico" src="/img/main/page-4-ico-4.png" alt="">
                            </div>
                        </div>
                        <v-btn
                            text="Взяти участь"
                            link="/login"
                            color="gold"
                        />
                    </div>
                </div>
                <div class="page-5 page">
                    <v-footer/>
                </div>
            </div>
            <!-- <button @click="moveNext">next</button> -->
        </div>
    </div>
</template>

<script>

    import Header from './Header.vue';
    import Footer from './Footer.vue';
    import Btn from './btn.vue';

    export default {
        components: {
            'v-header': Header,
            'v-footer': Footer,
            'v-btn': Btn,
        },
        data: function() {
            return {
                opts: {
                    start: 0,
                    dir: 'v',
                    duration: 500,
                    beforeChange: function (prev, next) {},
                    afterChange: function (prev, next) {}
                }
            }
        },
        methods: {
                moveNext() {
                    this.$refs.example.$fullpage.moveNext(); //Move to the next page
                }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
