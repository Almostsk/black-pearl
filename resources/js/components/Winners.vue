<template>
    <div class="winners-page">
        <v-header
            :displayHat = "true"
        ></v-header>
        <h2 class="winners-title">Переможці</h2>
        <div class="winners-container">
            <div class="winners-coulomb">
                <h3 class="winners-list-title">Прикраса з перлиною</h3>
                <transition-group name="list" tag="ul" class="winners-list">
                        <li class="winner-item" v-for="winner in coulomb" :key="winner.Id">
                            <span class="winner-name">{{winner.Name}} {{winner.Surname}}</span> 
                            <!--<span class="winner-date">13/02/2019</span>-->
                        </li>
                </transition-group>
            </div>
            <div class="winners-journal">
                <h3 class="winners-list-title">Стаття в газеті</h3>
                <transition-group name="liste" tag="ul" class="winners-list">
                        <li class="winner-item" v-for="winner in journal" :key="winner.Id">
                            <span class="winner-name">{{winner.Name}} {{winner.Surname}}</span> 
                            <span class="winner-date">13/02/2019</span>
                        </li>
                </transition-group>
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
                    this.coulomb = responce.data.first;
                    this.journal = responce.data.second;
                })
                .catch(e => {
                    this.errors.push(e)
                })
        }
    
}
</script>