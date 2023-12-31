<template>
    <div class="mt-5">
        <div class="fw-bold">PART VI - QUESTIONNAIRES</div>

        <div class="question-container mt-4">
            <div class="question">1. What is your greatest achievement?</div>
            <div class="d-flex flex-column w-100">
                <textarea class="ms-4" placeholder="Click here to enter text."
                    @input="handleQuestionInput('achievement', $event)"></textarea>
                <div class="text-danger ms-4">
                    {{ errors['questionnaires.achievement'] != null ? 'This field is required!' : ''}}</div>
            </div>
        </div>

        <div class="question-container mt-4">
            <div class="question">2. What are your strengths & weaknesses?</div>
            <div class="d-flex">
                <div class="my-auto me-2 ms-4">Strengths:</div>
                <div class="d-flex flex-column w-100">
                    <textarea placeholder="Click here to enter text."
                        @input="handleQuestionInput('strengths', $event)"></textarea>
                    <div class="text-danger">
                        {{ errors['questionnaires.strengths'] != null ? 'This field is required!' : ''}}
                    </div>
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="my-auto me-2 ms-4">Weakness:</div>
                <div class="d-flex flex-column w-100">
                    <textarea placeholder="Click here to enter text."
                        @input="handleQuestionInput('weakness', $event)"></textarea>
                    <div class="text-danger">
                        {{ errors['questionnaires.weakness'] != null ? 'This field is required!' : ''}}
                    </div>
                </div>
            </div>
        </div>

        <div class="question-container mt-4">
            <div class="question">3. How would your employer describe you?</div>
            <div class="d-flex flex-column w-100">
                <textarea class="ms-4" placeholder="Click here to enter text."
                    @input="handleQuestionInput('employer_describe', $event)"></textarea>
                <div class="text-danger ms-4">
                    {{ errors['questionnaires.employer_describe'] != null ? 'This field is required!' : ''}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            errors() {
                return this.$store.state.formErrors;
            },
        },
        methods: {
            handleQuestionInput(category, event) {
                const data = this.$store.state.formData;

                if (!data.questionnaires) {
                    data.questionnaires = {};
                }

                data.questionnaires[category] = event.target.value;

                this.$store.commit('updateFormData', data);
            },
            getErrors(category) {
                return this.errors.questionnaires[category].value || [];
            },
            submitForm() {
                this.$store.dispatch('submitForm');
            },
        },
    };

</script>
