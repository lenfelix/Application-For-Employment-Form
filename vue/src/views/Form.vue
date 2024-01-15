
<template>
  <div class="background">
    <div class="form-box">
      <PersonalInfo />

      <CustomTables />

      <Questionnaires />

      <CharacteristicsRating />

      <Declaration />

      <div class="d-flex">
          <div  class="flex-grow-1"></div>
          <button class="btn btn-primary" @click="handleSubmit">Submit</button>
      </div>

      <Modal />


      <div v-for="(errors, fieldName) in $store.state.formErrors" :key="fieldName">
        <div v-for="error in errors" :key="error">
          {{ error }}
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { ref } from 'vue';
import { useStore } from 'vuex';
import PersonalInfo from '@/components/PersonalInfo.vue';
import CharacteristicsRating from '@/components/CharacteristicsRating.vue';
import Declaration from '@/components/Declaration.vue';
import CustomTables from '@/components/CustomTable.vue';
import Questionnaires from '@/components/Questionnaires.vue';
import Modal from '@/components/Modal.vue';

export default {
  components: {
    PersonalInfo,
    CharacteristicsRating,
    Declaration,
    CustomTables,
    Questionnaires,
    Modal,
  },
  setup() {
    const formData = ref(null);
    const store = useStore();
    
    const handleSubmit = () => {
        store.commit('updateFormData');
        store.dispatch('submitForm');
        // store.commit('resetState');
    };

    return {
      formData,
      handleSubmit
    };
  },
};

</script>
