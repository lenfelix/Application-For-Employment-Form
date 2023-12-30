<template>
    <div>
        <h3 class="text-center fw-bold">Application For Employment</h3>
    </div>
    <div class="d-flex mt-5">
        <InputBlank label="Position" maxWordCount="50" />
        <InputBlank label="Mode of Application" maxWordCount="20" />
    </div>
    <table class="mt-5 personal-info-table">
        <tr class="d-flex">
            <InputBlank label="Name" maxWordCount="50" />
            <InputBlank label="Gender" maxWordCount="20" />
        </tr>
        <tr>
            <InputBlank label="Address" maxWordCount="200" />
        </tr>
        <tr>
            <InputBlank label="Email" maxWordCount="70" class="w-3/4"/>
        </tr>
        <tr class="d-flex">
            <InputBlank label="NRIC No" maxWordCount="20" />
            <InputBlank label="Date of Birth" maxWordCount="20" />
        </tr>
        <tr class="d-flex">
            <InputBlank label="Citizenship" maxWordCount="20" />
            <InputBlank label="Race" maxWordCount="20" />
        </tr>
        <tr class="d-flex">
            <InputBlank label="H/Phone" maxWordCount="20" />
            <InputBlank label="Matital Status" maxWordCount="20" />
        </tr>
        <tr class="d-flex">
            <InputBlank label="Driving Liscense" maxWordCount="20" />
            <InputBlank label="Current Salary" maxWordCount="20" />
        </tr>
        <tr class="d-flex">
            <InputBlank label="Earliest Commencement Date" maxWordCount="20" />
            <InputBlank label="Expected Salary" maxWordCount="20" />
        </tr>
    </table>
</template>

<script>
import InputBlank from '@/components/InputBlank.vue';
export default {
  components: {
    InputBlank,
  },
  methods: {
    handleInput(data) {
      this.$emit('personalInfoChanged', data);
    },
  },
};
</script>