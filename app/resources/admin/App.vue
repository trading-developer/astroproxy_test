<template>
    <div class="text-center" v-if="$route.meta.withoutLayOut === true">
        <router-view></router-view>
    </div>
    <div v-else>


        <nav class="py-2 bg-light border-bottom">
            <div class="container d-flex flex-wrap">
                <ul class="nav me-auto">
                    <li class="nav-item">
                        <router-link :to="{name: 'Main', params : {}}" class="nav-link link-dark px-2">
                            Главная
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'Users', params : {}}" class="nav-link link-dark px-2">
                            Пользователи
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'Services', params : {}}" class="nav-link link-dark px-2">
                            Услуги
                        </router-link>
                    </li>
                </ul>
                <ul class="nav">
                    <li class="nav-item"><a class=" nav-link link-dark px-2" href=""  @click="logout" >Выйти</a></li>
                </ul>
            </div>
        </nav>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
export default {
    name: "App",
    components: {},
    computed: {},
    methods: {
        logout() {
            if (confirm('Вы уверены ?')) {
                localStorage.removeItem('token');
                window.location.href = '/';
            }
        },
    }
};
</script>

<style scoped>

</style>
