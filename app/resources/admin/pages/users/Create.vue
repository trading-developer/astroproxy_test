<template>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Добавить пользователя </h2>
        </div>

        <div class=" ">
            <UserForm
                :is-show-password="true"
                @save-user="save"
            />
        </div>
    </div>

</template>

<script>
import axios from "axios";
import Payments from "./components/Payments.vue";
import Services from "./components/Services.vue";
import UserForm from "./components/Form.vue";

export default {
    name: "UserCreate",
    components: {UserForm, Payments, Services},
    data() {
        return {};
    },
    methods: {
        save(data) {
            axios.post(`/api/users/create`, data).then(({data}) => {
                this.$router.push({
                    name: 'Users'
                });
            });
        },
    }
};
</script>

<style scoped>
.container {
    max-width: 960px;
}
</style>
