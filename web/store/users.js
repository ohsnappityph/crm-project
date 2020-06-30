import axios from 'axios';
import { getField, updateField } from 'vuex-map-fields';

export const state = () => ({
    users: [],
    user: {},
    archives: [],
});

export const getters = {
    users: state => {
        return state.clients
    },
    user: state => {
        return state.user
    },
    archives: state => {
        return state.archives
    },
    getField,
}

export const setters = {
    //Creates a user
    async addUser({dispatch}, user) {
        // try {
        //     const res = await this.$axios.$post('api/users', user)
        // }
    }
}

export const mutations = {

}