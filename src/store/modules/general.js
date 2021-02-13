const state = {
    loading: false
};

// getters
const getters = {
    getLoading: state => {
        return state.loading;
    }
};

// actions
const actions = {
    editLoadingP({ commit }) {
        commit("toggleLoading");
    },
};

// mutations
const mutations = {
    toggleLoading(state) {
        state.loading = !state.loading;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};