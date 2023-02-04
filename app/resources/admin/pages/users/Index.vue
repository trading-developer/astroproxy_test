<template>
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.phone }}</td>
            <td>
                <button class="btn btn-sm btn-outline-danger rounded-pill" @click="remove(user.id)">Удалить</button>
                <button class="btn btn-sm btn-outline-primary rounded-pill"
                        @click="$router.push({name: 'UserView', params:{'id':user.id}})">Редактировать
                </button>
            </td>
        </tr>
        </tbody>
    </table>

    <nav class="blog-pagination" aria-label="Pagination" v-if="users.length">
        <button :class="{'btn btn-outline-primary rounded-pill': true,
            'disabled':current_page === 1}" @click="prev">Назад</button>
        <button :class="{'btn btn-outline-secondary rounded-pill': true,
            'disabled':current_page === meta?.last_page}" @click="next">Вперед</button>
    </nav>
</template>

<script>

import axios from "axios";

export default {
    name: "UserIndex",
    data() {
        return {
            users: [],
            meta: [],
            per_page: 20,
            current_page: 1
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        prev() {
            this.current_page--;
            this.getData();
        },
        next() {
            this.current_page++;
            this.getData();
        },
        remove(id) {
            if (confirm('Are you sure ?')) {
                axios.delete(`/api/user/${id}`).then(data => {
                    this.getData();
                });
            }
        },
        getData() {
            axios.get(`/api/users?page=${this.current_page}`).then(data => {
                this.users = data.data.data;
                this.meta = data.data.meta;
            });
        }
    }
};
</script>

<style scoped>

</style>
