<template>
    <main class="form-signin w-100 m-auto">
        <form>
            <h1 class="h3 mb-3 fw-normal">Войдите в систему управления</h1>

            <div class="form-floating">
                <input v-model="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>

                <div class="text-danger" v-if="errors['email']">
                    {{errors['email'][0]}}
                </div>
            </div>
            <div class="form-floating">
                <input v-model="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                <div class="text-danger" v-if="errors['password']">
                    {{errors['password'][0]}}
                </div>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="button"  @click="auth">Войти</button>
            <p class="mt-5 mb-3 text-muted">Тестовое задание &middot; &copy; 2023</p>
        </form>
    </main>
</template>

<script>

import axios from "axios";

export default {
    name: "AuthPage",
    data() {
        return {
            email: 'admin@astroproxy.com',
            password: 'admin',
            errors:[]
        }
    },
    methods: {
        auth() {
            this.errors = []

            axios.post('/api/auth/login', {
                email: this.email,
                password: this.password,
            }).then(({data}) => {
                localStorage.setItem('token', data.authorisation.token)
                localStorage.setItem('user', JSON.stringify(data.user))

                window.location.href = '/admin'
            }).catch(error => {
                this.errors = error.response.data.errors
            })
        }
    }
};
</script>

<style scoped>
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}

.b-example-divider {
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}

.b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
}

.bi {
    vertical-align: -.125em;
    fill: currentColor;
}

.nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
}

.nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
}
</style>
