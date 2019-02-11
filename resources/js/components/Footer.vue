<template>
    <div class="footer">
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-left">
                    <p class="footer-text">© Черный жемчуг 2018, Україна</p>
                    <p class="footer-text">ТОВ "Юнілівер Україна"</p>
                    <p class="footer-text">Україна, Київ, 04119, вул.Дегтярівська, 27-Т, літера А</p>
                    <p class="footer-text">Телефон: +38 044 490 58 46</p>
                    <p class="footer-text">kyiv.reception@unilever.com</p>
                </div>
                <div class="footer-center">
                    <a class="footer-link" href="#">
                        http://www.blackpearl.com.ua 
                    </a>
                    <v-btn
                            class="feedback"
                            text="Зворотній зв'язок"
                            link="/feedback"
                            color="violet"
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
            </div>
            <div class="footer-bottom">
                <a href="#" class="footer-link">Правила використання сайту</a>
                <a href="#" class="footer-link">Політика cookie</a>
                <a href="#" class="footer-link">Політика про персональні дані</a>
            </div>
        </div>
    </div>
</template>

<script>

    import Btn from './btn.vue';

export default {
            components: {
            'v-btn': Btn
        },
}
</script>