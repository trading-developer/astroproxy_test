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
                <UserForm
                    :user="user"
                    @save-user="save"/>
            </div>

        </div>
    </div>

</template>

<script>
import axios from "axios";
import Payments from "./components/Payments.vue";
import Services from "./components/Services.vue";
import UserForm from "./components/Form.vue";

export default {
    name: "UserView",
    components: {UserForm, Payments, Services},
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
            if (confirm('Вы уверены ?')) {
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
        save(data) {
            axios.patch(`/api/user/${this.$route.params.id}`, data).then(({data}) => {
                this.$router.push({
                    name: 'Users'
                });
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
