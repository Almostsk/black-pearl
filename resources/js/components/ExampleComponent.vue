<template>
    <div class="main">
        <v-header>

        </v-header>
        <div class="fullpage-container">
            <div class="fullpage-wp" v-fullpage="opts" ref="example">
                <div class="page-1 page">
                    <p class="part-1" v-animate="{value: 'bounceInLeft'}">fullpage-vue 1</p>
                </div>
                <div class="page-2 page">
                    <p class="part-2" v-animate="{value: 'bounceInRight'}">fullpage-vue 2</p>
                </div>
                <div class="page-3 page">
                    <p class="part-3" v-animate="{value: 'bounceInLeft', delay: 0}">fullpage-vue</p>
                    <p class="part-3" v-animate="{value: 'bounceInRight', delay: 600}">fullpage-vue</p>
                    <p class="part-3" v-animate="{value: 'zoomInDown', delay: 1200}">fullpage-vue</p>
                </div>
            </div>
            <!-- <button @click="moveNext">next</button> -->
        </div>
    </div>
</template>

<script>

    import Vue from 'Vue';
    import Header from './Header.vue';

    export default {
        components: {
            'v-header': Header,
        },
        data: {
            opts: {
                start: 0,
                dir: 'v',
                duration: 500,
                beforeChange: function (prev, next) {},
                afterChange: function (prev, next) {}
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
