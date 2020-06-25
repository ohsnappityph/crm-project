<template>
  
</template>

<script>
import { mapGetters, mapActions, mapState} from 'vuex'
export default {
    data: () => ({

    }),
    methods: {
        ...mapActions({fetchOneClient: 'clients/fetchOneClient'})
    },
    computed: {
        ...mapGetters({showClient: 'clients/client'})
    },
    async fetch({store, params}) {
        await store.dispatch('clients/fetchOneClient', params.id)
    },
    created() {
        console.log(this.$route.params.id)
    }
}
</script>

<style>

</style>