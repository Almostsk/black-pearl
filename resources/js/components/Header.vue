<template>
    <div class="header-container">
        <div class="header-hat" v-if="hatShow">
            <img src="/img/main/logo.png" alt="logo">
        </div>
        <div class="header">
            <ul class="header-list">
                <li class="header-item">
                   <router-link class="header-link" to="/" @click.native.prevent="$emit('goTo1')">Сама собі зірка</router-link>
                </li>
                <li class="header-item">
                    <router-link class="header-link" to="/" @click.native.prevent="$emit('goTo2')">Призи</router-link>
                </li>
                <li class="header-item">
                    <router-link class="header-link" to="/" @click.native.prevent="$emit('goTo3')">Як взяти участь</router-link>
                </li>
                <li class="header-item">
                    <router-link class="header-link" to="/gallery">Галерея</router-link>
                </li>
                <li class="header-item">
                    <router-link class="header-link" to="/rules">Правила</router-link>
                </li>
                <li class="header-item">
                    <router-link class="header-link" to="/winners">Переможці</router-link>
                </li>
                <li class="header-item">
                    <router-link class="header-link" to="/cabinet">Особистий кабінет</router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        displayHat: false,
        activeItem: '',
    },
    data() {
        return {
            hatShow: this.displayHat,
        }
    },
    methods: {
        doSomething() {
            axios
                .post('api/auth/send-sms', {
                    headers: {
                        Accept : 'application/json, text/javascript',
                        Connection: 'keep'
                        }, 
                    "mobile_phone": "+380997944169",
                })
                .then(responce => {
                    console.log(responce);
                })
                .catch(e => {
                    this.errors.push(e)
                })
        },
    },

}
</script>
