import { createStore } from 'vuex';
import axios from 'axios';


export default createStore({
  state: {
    formData: {},
  },
  mutations: {
    updateFormData(state, payload) {
        state.formData = { ...state.formData, ...payload };
    },
  },
  actions: {
    async submitForm({ commit, state }) {

      console.log("Gather data    ", state.formData);

      axios.post('http://127.0.0.1:8000/api/submit-form', state.formData).then(res => {
            console.log("res");
      }).catch(error => {
        console.error('Error submitting form:', error.response);
      });
      
    },
  },
});
