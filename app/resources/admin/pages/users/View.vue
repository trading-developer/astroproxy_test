<template>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Редактирование пользователя - {{ user?.name }}</h2>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">

                <Payments
                    v-if="payments.length"
                    :payments="payments"/>

                <Services
                    :user="user"
                    @attached-service="attachedService"
                />
            </div>
            <div class="col-md-7 col-lg-8">
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
                            <label for="lastName" class="form-label">Phone</label>
                            <input v-model="user.phone" type="text" class="form-control" id="phone" placeholder=""
                                   required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>


                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input v-model="user.email" type="email" class="form-control" id="email"
                                   placeholder="you@example.com">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="button" @click="save">Сохранить</button>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";
import Payments from "./components/Payments.vue";
import Services from "./components/Services.vue";

export default {
    name: "UserView",
    components: {Payments, Services},
    data() {
        return {
            user: {
                name: '',
                email: '',
                phone: '',
            },
            payments: [],
            services: [],
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        remove(id) {
            if (confirm('Are you sure ?')) {
                axios.delete(`/api/user/delete/${id}`).then(data => {
                    this.getData();
                });
            }
        },
        getPayments() {
            axios.get(`/api/user/${this.$route.params.id}/payments`).then(({data}) => {
                this.payments = data.data;
            });
        },
        getData() {
            axios.get(`/api/user/${this.$route.params.id}`).then(({data}) => {
                this.user = data.data;
            });

            this.getPayments();
        },
        save() {
            axios.patch(`/api/user/${this.$route.params.id}`, this.user).then(({data}) => {
                alert('ok');
            });
        },
        attachedService() {
            this.getPayments();
        }
    }
};
</script>

<style scoped>
.container {
    max-width: 960px;
}
</style>
