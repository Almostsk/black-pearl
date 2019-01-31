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
            console.log('click');
        }
    },
}
</script>
