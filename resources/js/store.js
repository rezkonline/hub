import Vue from 'vue'
import axios from 'axios';
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user : {}
    },
    mutations: {
        set_user(state, user) {
            state.user = user;
        }
    },
    actions: {
        fetch({commit}) {
            return new Promise((resolve, reject) => {
                axios({url: 'user', method: 'GET'})
                    .then(response => {
                        commit('set_user', response.data.data);
                        resolve(response);
                    })
                    .catch(error => {

                    })
            })
        },
    },
})
