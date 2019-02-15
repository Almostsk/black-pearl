<template>
    <div class="winners-page">
        <v-header
            :displayHat = "true"
        ></v-header>
        <h2 class="winners-title">Переможці</h2>
        <div class="winners-container">
            <div class="winners-coulomb">
                <h3 class="winners-list-title">Прикраса з перлиною</h3>
                <ul class="winners-list">
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подраня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Поужаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подруня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                </ul>
            </div>
            <div class="winners-journal">
                <h3 class="winners-list-title">Стаття в газеті</h3>
                <ul class="winners-list">
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                    <li class="winner-item"><span class="winner-name">Подруга Подружаня</span> <span class="winner-date">13/02/2019</span></li>
                </ul>
            </div>
        </div>
        <v-footer></v-footer>
    </div>
</template>

<script>

    import Header from './Header.vue';
    import Footer from './Footer.vue';


export default {

            components: {
            'v-header': Header,
            'v-footer': Footer
        },
        data() {
            return {
                journal: [],
                coulomb: []
            }
        },
        beforeMount() {
            axios
                .get('api/winners', {
                    headers: {
                        Accept : 'application/json, text/javascript',
                        Connection: 'keep'
                        }
                })
                .then(responce => {
                    console.log(responce.data);
                    // this.stars = responce.data.users;
                })
                .catch(e => {
                    this.errors.push(e)
                })
        }
    
}
</script>