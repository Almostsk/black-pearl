<template>
    <div class="footer">
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-left">
                    <p class="footer-text">© Черный жемчуг 2018, Україна <span class="mobile-only" style="display: inline-block">ТОВ "Юнілівер Україна"</span></p>
                    <p class="footer-text desktop-only">ТОВ "Юнілівер Україна"</p>
                    <p class="footer-text">Україна, Київ, 04119, вул.Дегтярівська, 27-Т, літера А</p>
                    <p class="footer-text">Телефон: +38 044 490 58 46</p>
                    <p class="footer-text">kyiv.reception@unilever.com</p>
                </div>
                <div class="footer-center">
                    <a class="footer-link" href="http://www.blackpearl.com.ua" target="_blank">
                        http://www.blackpearl.com.ua 
                    </a>
                    <v-btn
                            class="feedback"
                            text="Зворотній зв'язок"
                            link="/feedback"
                            color="violet"
                            @click.native.prevent="feedbackShow"
                    />
                </div>
                <div class="footer-right">
                    <div class="footer-right-container">
                        <p class="footer-text">Ми в соціальних мережах</p>
                        <div class="footer-social">
                            <a class="footer-social-ico" href="https://www.facebook.com/">
                                <img src="img/fb-ico.png" alt="">
                            </a>
                            <a class="footer-social-ico" href="https://www.youtube.com/">
                                <img src="img/yt-ico.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="footer-links mobile-only">
                    <span  class="footer-link"
                        @click="rulesShow()"
                        @closeRules="rules = false"
                    >Правила використання сайту</span>
                <a href="img/Cookie.pdf" class="footer-link" target="_blank">Політика cookie</a>
                <a href="img/PrivacyPolicy.pdf" class="footer-link" target="_blank">Політика про персональні дані</a>
                </div>
            </div>
            <div class="footer-bottom desktop-only">
                <span  class="footer-link"
                    @click="rulesShow()"
                    @closeRules="rules = false"
                 >Правила використання сайту</span>
                <a href="img/Cookie.pdf" class="footer-link" target="_blank">Політика cookie</a>
                <a href="img/PrivacyPolicy.pdf" class="footer-link" target="_blank">Політика про персональні дані</a>
            </div>
        </div>
        <v-feedback 
            v-if="feedback"
            @close="feedback = false"
            />
        <v-rules-pop
            v-if="rules"
            @closeRules="rules = false"
        />
  
    </div>
</template>

<script>

    import Btn from './btn.vue';
    import Feedback from './Feedback.vue';
    import RulesPopup from './RulesPopup.vue';

export default {
            components: {
            'v-btn': Btn,
            'v-feedback': Feedback,
            'v-rules-pop': RulesPopup
        },
        data() {
            return {
                feedback: false,
                rules: false
            }
        },
        methods: {
            feedbackShow() {
                this.feedback = true;
            },
            feedbackClose () {
                this.feedback = false;
            }, 
            rulesShow() {
                this.rules = true;
            },
            rulesClose () {
                this.rules = false;
            } 
        },
}
</script>