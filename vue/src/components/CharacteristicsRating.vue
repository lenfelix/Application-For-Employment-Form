<template>
  <div>
    <div class="question-container mt-4">
      <div class="question">
        4. For each of the characteristics below, rate from a scale of 1 - 4, 1 being least and 4 being most that resembles you.
      </div>

      <div v-for="(characteristic, index) in characteristics" :key="index" class="characteristic ms-4 my-4">
        <div>{{ characteristic.title }}</div>
        <div class="rating-scale w-50 form-check">
          <label class="form-check-label" v-for="rating in characteristic.ratings" :key="rating">
            <input class="form-check-input" type="radio" :name="`characteristic_${index}`" :value="rating" @change="handleRatingChange(index, rating)" />
            {{ rating }}
          </label>
        </div>
        <div class="text-danger">
            {{ ratings[index] == null && errors['ratings'] != null ? 'This rating field is required.' : ''}}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useStore } from 'vuex';

const $store = useStore();

const errors = computed(() => $store.state.formErrors);
const formData = computed(() => $store.state.formData);

const ratings = ref([null, null, null, null, null, null, null, null]);

const characteristics = [
  { title: 'a. Open-minded, Receptive to ideas of others, Compliant', ratings: [1, 2, 3, 4] },
  { title: 'b. Cheerful, Jovial, Good-natured, Pleasant', ratings: [1, 2, 3, 4] },
  { title: 'c. Patient, Calm, Tolerant, Reserved', ratings: [1, 2, 3, 4] },
  { title: 'd. Well-disciplined, Self-controlled, Optimistic, Positive', ratings: [1, 2, 3, 4] },
  { title: 'e. Generous, Ready to help, Considerate', ratings: [1, 2, 3, 4] },
  { title: 'f. Assertive, Aggressive, Determined, Cautious', ratings: [1, 2, 3, 4] },
  { title: 'g. Pioneering, Exploring, Enterprising, Competitive', ratings: [1, 2, 3, 4] },
  { title: 'h. Outgoing, Fun loving, Enjoy social group', ratings: [1, 2, 3, 4] },
];

const handleRatingChange = (index, rating) => {
  ratings.value[index] = rating;
  $store.commit('updateFormData', { ratings: ratings.value });
};
</script>


<style scoped>
.characteristic {
  margin-top: 10px;
}

.rating-scale {
  display: flex;
  gap: 5px;
}

.rating-scale label {
  cursor: pointer;
}
</style>
