import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    formData: {},
    formErrors: {}, 
    showModal: false,
    successMessage: '',
  },
  mutations: {
    updateFormData(state, payload) {
      state.formData = { ...state.formData, ...payload };
      console.log("WHAT", state.formData);
      
    },
    setFormErrors(state, errors) {
      state.formErrors = errors;
    },
    toggleModal(state, show) {
      state.showModal = show;
    },
    closeModal(state, show) {
      state.showModal = false;
      location.reload();
    },
    setSuccessMessage(state, message) {
      state.successMessage = message;
    },
  },
  actions: {
    async submitForm({ commit, state }) {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/submit-form', state.formData);
        console.log("Form submitted successfully");

        commit('setSuccessMessage', 'Form submitted successfully');
        commit('toggleModal', true);
        
      } catch (error) {
        if (error.response && error.response.status === 422) {
          // Validation error
          commit('setFormErrors', error.response.data.errors);
        } else {
          console.error('Error submitting form:', error.response);
        }
      }
    },
  },
});
