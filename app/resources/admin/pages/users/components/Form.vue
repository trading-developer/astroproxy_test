<template>
    <h4 class="mb-3">Данные пользователя</h4>
    <form class="needs-validation" novalidate>
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">Имя</label>
                <input v-model="user.name" type="text" class="form-control" id="firstName" placeholder=""
                       required>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="lastName" class="form-label">Телефон</label>
                <input v-model="user.phone" type="text" class="form-control" id="phone" placeholder=""
                       required>
                <div class="invalid-feedback">
                    Valid phone is required.
                </div>
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input v-model="user.email" type="email" class="form-control" id="email"
                       placeholder="you@example.com">
                <div class="invalid-feedback">
                    Please enter a valid email address.
                </div>
            </div>

            <div class="col-12" v-if="isShowPassword">
                <label for="email" class="form-label">Пароль</label>
                <input v-model="password" type="password" class="form-control" id="password">
                <div class="invalid-feedback">
                    Please enter a valid password
                </div>
            </div>
        </div>

        <hr class="my-4">

        <button class="w-100 btn btn-primary btn-lg" type="button" @click="save">Сохранить</button>
    </form>

</template>

<script>

export default {
    name: "UserForm",
    props: {
        isShowPassword: {
            default: false,
            type: Boolean
        },
        user: {
            default: {
                name: '',
                email: '',
                phone: '',
            },
            type: Object
        },
    },
    data() {
        return {
            password: '',
        };
    },
    methods: {
        save() {
            let data = this.user;
            if (this.isShowPassword) {
                data.password = this.password;
            }
            this.$emit('save-user',data);
        },
    }
};
</script>

<style scoped>

</style>
