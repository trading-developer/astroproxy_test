<template>
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Платежи</span>
        <span class="badge bg-primary rounded-pill">{{payments.length}}</span>
    </h4>
    <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-sm" v-for="payment in payments">
            <div>
                <h6 class="my-0">{{payment.comment}}</h6>
            </div>
            <span class="text-muted">{{payment.total}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
            <span>Всего</span>
            <strong>{{total}}</strong>
        </li>
    </ul>
</template>

<script>
export default {
    name: "Payments",
    props:{
        payments:Array
    },
    computed: {
        total() {
             return Object.values(this.payments).reduce((acc, value) => acc + parseFloat(value.total), 0)
        },
    },
};
</script>

<style scoped>

</style>
