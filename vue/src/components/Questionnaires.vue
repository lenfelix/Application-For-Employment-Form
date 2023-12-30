<template>
  <div class="mt-5">
    <div class="fw-bold">PART VI - QUESTIONNAIRES</div>

    <div class="question-container mt-4">
      <div class="question">1. What is your greatest achievement?</div>
      <textarea
        class="ms-4"
        placeholder="Click here to enter text."
        @input="handleQuestionInput('achievement', $event)"
      ></textarea>
    </div>

    <div class="question-container mt-4">
      <div class="question">2. What are your strengths & weaknesses?</div>
      <div class="d-flex">
        <div class="my-auto me-2 ms-4">Strengths:</div>
        <textarea
          placeholder="Click here to enter text."
          @input="handleQuestionInput('strengths', $event)"
        ></textarea>
      </div>

      <div class="d-flex mt-2">
        <div class="my-auto me-2 ms-4">Weakness:</div>
        <textarea
          placeholder="Click here to enter text."
          @input="handleQuestionInput('weakness', $event)"
        ></textarea>
      </div>
    </div>

    <div class="question-container mt-4">
      <div class="question">3. How would your employer describe you?</div>
      <textarea
        class="ms-4"
        placeholder="Click here to enter text."
        @input="handleQuestionInput('employer_describe', $event)"
      ></textarea>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    handleQuestionInput(category, event) {
      const data = this.$store.state.formData;

      if (!data.questionnaires) {
        data.questionnaires = {};
      }

      data.questionnaires[category] = event.target.value;

      this.$store.commit('updateFormData', data);
    },
  },
};
</script>
