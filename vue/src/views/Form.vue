
<template>
    <PersonalInfo />

    <CustomTables />

    <Questionnaires />

    <CharacteristicsRating />

    <Declaration />

    <div class="d-flex">
        <div  class="flex-grow-1"></div>
        <button class="btn btn-primary" @click="handleSubmit">Submit</button>
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

export default {
  components: {
    PersonalInfo,
    CharacteristicsRating,
    Declaration,
    CustomTables,
    Questionnaires,
  },
  setup() {
    const formData = ref(null);
    const store = useStore();
    
    const handleSubmit = () => {
        store.commit('updateFormData');
        store.dispatch('submitForm');
    };

    return {
      formData,
      handleSubmit
    };
  },
};

</script>
