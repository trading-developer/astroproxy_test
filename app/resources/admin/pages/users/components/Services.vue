<template>
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Услуги</span>
        <span class="badge bg-primary rounded-pill">{{ services.length }}</span>
    </h4>
    <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-sm" v-for="service in services">
            <div>
                <h6 class="my-0">{{ service.name }}
                    <button @click="attach(service.id)" type="button" class="btn btn-primary btn-sm">+</button>
                </h6>
                <small class="text-muted">{{ service.description }} </small>
            </div>
            <span class="text-muted">{{ service.price }}</span>
        </li>
    </ul>
</template>

<script>
import axios from "axios";

export default {
    name: "Services",
    props: {
        user: Object,
    },
    data() {
        return {
            services: [],
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get(`/api/services`).then(({data}) => {
                this.services = data.data;
            });
        },
        attach(serviceId) {
            axios.post(`/api/user/${this.$route.params.id}/attach-service/${serviceId}`).then(({data}) => {
                this.$emit('attached-service', serviceId);
            });
        }
    }
};
</script>

<style scoped>

</style>
