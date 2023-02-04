<template>
    <div class="b-example-divider"></div>

    <div class="container px-4 py-5" id="hanging-icons">
        <h2 class="pb-2 border-bottom">Админ панель</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-start">
                <div>
                    <h3 class="fs-2">Услуги</h3>
                    <p>Раздел со списком услуг</p>
                    <a href="#" class="btn btn-dark">
                        Перейти
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h3 class="fs-2">Пользователи</h3>
                    <p>Управление и назначение услуг пользователям</p>
                    <button class="btn btn-primary"
                         @click="$router.push({name: 'Users'})">
                        Перейти
                    </button>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h3 class="fs-2">Платежи</h3>
                    <p>Список платежей</p>
                    <a href="#" class="btn btn-dark">
                        Перейти
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "HomePage"
};
</script>

<style scoped>

</style>
