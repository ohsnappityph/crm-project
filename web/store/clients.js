import axios from 'axios';
import { getField, updateField } from 'vuex-map-fields';

export const state = () => ({
    clients: [],
    client: {},
    archives: [],
});

export const getters = {
    clients: state => {
        return state.clients
    },
    client: state => {
        return state.client
    },
    archives: state => {
        return state.archives
    },
    archived: state => {
        return state.archived
    },
    getField,
}

export const actions = {
    // Creates a client
    async addClient({dispatch}, client) {
        try {
            const res = await this.$axios.$post('/api/users/clients', client)

            console.log(res)
        }catch(error) {
            console.log(error)
        }
    },
    //Updates a client
    async updateClient({state}, payload) {
        try {
            payload = state.client
            console.log('New Client data received.')
            console.log(payload)
            const data = await this.$axios.$put(`/api/users/clients/${payload.id}`, payload)

            console.log(data, 'Client has been updated')
        }catch(error) {
            console.log(error)
        }
    },
    //Fetch all clients 
    async fetchAllClients({commit}) {
        try {
            const data = await this.$axios.$get('/api/users/clients')

            commit("SET_ALL_CLIENTS", data)
            console.log('Clients data fetched.')
            console.log(data)
        }catch(error) {
            console.log(error)
        }
    },

    //Fetch one client
    async fetchOneClient({commit}, id) {
        try {
            const data = await this.$axios.$get(`/api/users/clients/${id}`)

            commit('SET_ONE_CLIENT', data)
            console.log('Client data fetched.')
            console.log(data)
        }catch(error) {
            console.log(error)
        }
    },
    //Delete one client
    async destroyClient({commit, dispatch}, payload) {
        try {
            console.log('Delete this client data?')
            console.log(payload)
            const deleted = await this.$axios.$delete(`/api/users/clients/${payload}`)

            if(deleted) {
                commit('DESTROY_CLIENT', payload)
                dispatch('alerts/execute', {
                    type: 'success',
                    message: 'A client has been removed.',
                },  {root: true})
            }
        }catch(error) {
            console.log(error.response)
            const statusCode = error.response.statusCode
            if(statusCode == 422) {
                const errorMsg = error.response.data.message
                dispatch('alerts/execute', {
                    type: 'error',
                    message: errorMsg
                }, {root: true})
            }
        }
    },
    //Fetch all archived clients
    async fetchAllArchived({commit}) {
        try {
            const data = await this.$axios.$get('/api/users/clients/archived/all')

            commit("SET_ALL_ARCHIVED_CLIENTS", data)
            console.log('Archived clients data fetched.')
            console.log(data)
        }catch(error) {
            console.log(error)
        }
    },
    //Restore an archived client
    async restoreOneClient({commit, dispatch}, payload) {
        try {
            console.log('Restore this client?')
            console.log(payload)
            const restored = await this.$axios.$get(`/api/users/clients/restore/${payload}`)
            console.log(restored)
            if(restored) {
                commit('RESTORE_ARCHIVED_CLIENT', payload)
            }
        }catch(error) {
            console.log(error.response)
            const statusCode = error.response.statusCode
            if(statusCode == 422) {
                const errorMsg = error.response.data.message
                dispatch('alerts/execute', {
                    type: 'error',
                    message: errorMsg,
                }, {root: true})
            }
        }
    },
    //Delete an archived client 
    async forceDeleteClient({commit, dispatch}, payload) {
        try {
            console.log('Force delete this payload?')
            console.log(payload)
            const deleted = await this.$axios.$get(`api/users/clients/delete/${payload}`)
            console.log(deleted)
            if(deleted) {
                commit('FORCE_DELETE_ARCHIVED_CLIENT', payload)
            }
        }catch(error) {
            console.log(error.response)
            const statusCode = error.response.statusCode
            if(statusCode == 422) {
                const errorMsg = error.response.data.message
                dispatch('alerts/execute', {
                    type: 'error',
                    message: errorMsg,
                }, {root:true})
            }
        }
    },
}

export const mutations = {
    //fetchAllClients mutation
    SET_ALL_CLIENTS: (state, payload) => state.clients = payload,

    //fetchOneClient mutation
    SET_ONE_CLIENT: (state, payload) => state.client = payload,

    //destroyClient mutation
    DESTROY_CLIENT: (state, payload) => {
        const index = state.clients.findIndex(d => d.id === payload)
        state.clients.splice(index, 1)
    },

    //fetchAllArchived mutation
    SET_ALL_ARCHIVED_CLIENTS: (state, payload) => state.archives = payload,

    //restoreOneClient mutation
    RESTORE_ARCHIVED_CLIENT: (state, payload) => {
        const index = state.archives.findIndex(d => d.id === payload)
        state.archives.splice(index, 1)
    },

    //forceDeleteClient mutation
    FORCE_DELETE_ARCHIVED_CLIENT: (state, payload) => {
        const index = state.archives.findIndex(d => d.id === payload)
        state.archives.splice(index, 1)
    },
    //for updating a client
    updateField,

}