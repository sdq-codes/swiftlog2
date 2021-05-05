import httpClient from "@/utils/api/httpClient";
const state = {
    loading: false,
		settings: null
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
		getSettings() {
			httpClient.get("settings")
				.then(response => {
					let config = response.data.data.settings.config;
					localStorage.setItem('settings', config)
				})
		}
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
