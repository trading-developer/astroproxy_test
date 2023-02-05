<template>
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Стоимость</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="service in services">
            <td>{{ service.id }}</td>
            <td>{{ service.name }}</td>
            <td>{{ service.description }}</td>
            <td>{{ service.price }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>

import axios from "axios";

export default {
    name: "ServicesIndex",
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
        }
    }
};
</script>

<style scoped>

</style>
