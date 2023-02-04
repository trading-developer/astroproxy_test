<template>
<!--    <div class="text-center" v-if="$route.meta.withoutLayOut === true">-->
<!--        <router-view></router-view>-->
<!--    </div>-->
<!--    <div v-else>-->

<!--    </div>-->

    <main>
        <router-view></router-view>

    </main>

</template>

<script>
export default {
    name: "App",
    components: {},

}
</script>

<style scoped>

</style>
