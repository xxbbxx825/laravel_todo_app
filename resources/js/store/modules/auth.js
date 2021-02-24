import router from '../../router';

const state = {
  accessToken: null
};
const getters = {
  accessToken: state => state.accessToken
};
const mutations = {
  updateAccessToken(state, accessToken) {
    state.accessToken = accessToken;
  }
};
const actions = {
  autoLogin({ commit }) {
    const accessToken = localStorage.getItem('accessToken');
    if (!accessToken) return;
    commit('updateAccessToken', accessToken);

  },
  login({ dispatch }, authData) {
    axios.post('/api/login', {
      email: authData.email,
      password: authData.password
    }).then(res => {
      dispatch('setAuthData', {
        accessToken: res.data.access_token,
      });
      router.push('/');
    }).catch(error => {
      alert('認証に失敗しました');
    });
  },
  logout({ commit, state }) {
    console.log(state.accessToken);
    commit('updateAccessToken', null);
    localStorage.removeItem('accessToken');
    router.replace('/login');
  },
  setAuthData({ commit }, authData) {
    commit('updateAccessToken', authData.accessToken);
    localStorage.setItem('accessToken', authData.accessToken);
  }
};

export default {
  state,
  getters,
  mutations,
  actions
}
