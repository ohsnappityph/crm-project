<template>
    <Order />
</template>

<script>
import Order from '../../components/Order'
export default {
    layout: 'order',
    auth: 'guest',
    components: {
        Order,
    },
}
</script>

<style>

</style>