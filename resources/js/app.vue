<template>
    <router-view/>
</template>
<script>
import {defineComponent} from "vue";

export default defineComponent({
    name: 'app',
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title = to.meta.title || 'Photography';
            }
        }
    }
})

</script>
<style>
    @import "../../resources/scss/style.scss";
</style>
