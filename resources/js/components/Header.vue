<template>
    <div class="header">
        <ul class="header-list">
            <li class="header-item"
                @click="doSomething()"
            >
                Сама собі зірка
            </li>
            <li class="header-item">
                Призи
            </li>
            <li class="header-item">
                Як взяти участь
            </li>
            <li class="header-item">
                Галерея
            </li>
            <li class="header-item">
                Правила
            </li>
            <li class="header-item">
                Особистий кабінет
            </li>
        </ul>
    </div>
</template>

<script>
export default {
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
        }
    },
}
</script>
