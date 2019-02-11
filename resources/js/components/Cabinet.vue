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
            <div class="cabinet-bottom">

            </div>
        </div>
    </div>
</template>

<script>

    import Header from './Header.vue';
    import Footer from './Footer.vue';
    import RegStar from './RegisterStar.vue';
    import Btn from './btn.vue';

export default {
        components: {
            'v-header': Header,
            'v-footer': Footer,
            'v-star': RegStar,
            'v-btn': Btn
        },
        data() {
            return {
                packCode: '',
            }
        },
        methods: {
            sendCode() {
                console.log(this.packCode);
            }
        },
}
</script>