import axios from 'axios';
import { getField, updateField } from 'vuex-map-fields';

export const state = () => ({
    surveyors: [],
    surveyor: {},
    archives: [],
});

export const getters = {
    surveyors: state => {
        return state.surveyors
    },
    surveyor: state => {
        return state.surveyor
    },
    archives: state => {
        return state.archives
    },
    getField,
}

export const actions = {
    //Creates a surveyor
    async addSurveyor({dispatch}, surveyor) {
        try {
            const response = await this.$axios.$post('/api/surveyors', surveyor)

            console.log(response)
        }catch(error) {
            console.log(error)
        }
    },
    //Updates a surveyor
    async updateSurveyor({state}, payload) {
        try {
            payload = state.surveyor
            console.log('New Surveyor data received.')
            console.log(payload)
            const response = await this.$axios.$put(`/api/surveyors/${payload.id}`, payload)

            console.log(response, 'Surveyor has been updated')
        }catch(error) {
            console.log(error)
        }
    },
    //Fetch all surveyors
    async fetchAllSurveyors({commit}) {
        try {
            const response = await this.$axios.$get('/api/surveyors')

            // commit('SET_STATE', {
            //     field: 'surveyors',
            //     data: response.data
            // })
            commit("SET_ALL_SURVEYORS", response)
            console.log('All Surveyor data retrieved.')
            console.log(response)
        }catch(error) {
            console.log(error)
            return await this.$helpers.notify({
                type: 'error',
                message: 'Unable to fetch data.'
            })
        }
    },
    //Fetch one surveyor
    async fetchOneSurveyor({commit}, id) {
        try {
            const response = await this.$axios.$get(`/api/surveyors/${id}`)

            // commit('SET_STATE', {
            //     field: 'surveyor',
            //     data: response.data
            // })
            commit("SET_ONE_SURVEYORS", response)
            console.log('Surveyor data retrieved.')
            console.log(response)
        }catch(error) {
            console.log(error)
            return await this.$helpers.notify({
                type: 'error',
                message: 'Unable to fetch data.'
            })
        }
    },
    //Delete one surveyor
    async destroySurveyor({commit, dispatch}, payload) {
        try {
            console.log('Deleting surveyor data.')
            console.log(payload)
            const deleted = await this.$axios.$delete(`/api/surveyors/${payload}`)

            if(deleted) {
                commit('DESTROY_SURVEYOR', payload)
                dispatch('alerts/execute', {
                    type: 'success',
                    message: 'A surveyor has been removed.',
                }, {root: true})
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
    //Fetch all archived surveyors
    async fetchAllArchived({commit}) {
        try {
            const response = await this.$axios.$get('/api/surveyors/archived/all')

            commit("SET_ALL_ARCHIVED_SURVEYORS", data)
            console.log('Archived clients data fetched')
            console.log(data)
        }catch(error) {
            console.log(error)
        }
    },
    //Restore an archived surveyor
    async restoreOneSurveyor({commit, dispatch}, payload) {
        try {
            console.log('Restoring surveyor data.')
            console.log(payload)
            const restored = await this.$axios.$get(`/api/surveyors/restore/${payload}`)
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
                    message: errorMsg
                }, {root: true})
            }
        }
    },
    //Delete an archived surveyor
    async forceDeleteSurveyor({commit, dispatch}, payload) {
        try { 
            console.log('Force deleting surveyor data.')
            console.log(payload)
            const deleted = await this.$axios.$get(`api/surveyors/delete/${payload}`)
            console.log(deleted)
            if(deleted) {
                commit('FORCE_DELETE_ARCHIVED_SUREYOR', payload)
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
    }

}

export const mutations = {
    //fetchAllSurveyors and fetchOneSurveyor mutation
    // SET_STATE: (state, payload) => 
    //     state[payload.field] = payload.data,

    //fetchAllSurveyors mutation
    SET_ALL_SURVEYORS: (state, payload) => state.surveyors = payload,

    //fetchOneSurveyors mutation
    SET_ONE_SURVEYOR: (state, payload) => state.surveyor = payload,

    //destroySurveyor mutation
    DESTROY_SURVEYOR: (state, payload) => {
        const index = state.surveyors.findIndex(d => d.id === payload)
        state.surveyors.splice(index, 1)
    },
    //fetchAllArchived
    SET_ALL_ARCHIVED_SURVEYORS: (state, payload) => state.archives = payload,

    //restoreOneSurveyor
    RESTORE_ARCHIVED_CLIENT: (state, payload) => {
        const index = state.archives.findIndex(d => d.id === payload)
        state.archives.splice(index, 1)
    },

    //forceDeleteSurveyor mutation
    FORCE_DELETE_ARCHIVED_SUREYOR: (state, payload) => {
        const index = state.archives.findIndex(d => d.id === payload)
        state.archives.splice(index, 1)
    },
    
    //for updating a client
    updateField,
    
}