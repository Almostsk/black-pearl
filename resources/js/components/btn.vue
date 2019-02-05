<template>
    <div class="btn-wrapper">
        <a 
            class="btn"
            v-bind:href="link"
            v-bind:class="color"
        >
            {{ text }}
        </a>
    </div>
</template>

<script>
export default {
    props: {
        'link': String,
        'text': String,
        'color': String
    },
data() {
    return {

    }
},
}
</script>