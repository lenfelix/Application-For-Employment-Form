<template>
    <div>
        <h3 class="text-center fw-bold">Application For Employment</h3>
    </div>
    <div class="d-flex mt-5">
        <InputComponent label="Position" maxWordCount="50" />
        <InputComponent label="Mode of Application" maxWordCount="20" />
    </div>
    <table class="mt-5 personal-info-table">
        <tr class="d-flex">
            <InputComponent label="Name" maxWordCount="50" />
            <InputComponent label="Gender" maxWordCount="20" />
        </tr>
        <tr>
            <InputComponent label="Address" maxWordCount="200" />
        </tr>
        <tr>
            <InputComponent label="Email" maxWordCount="70" class="w-3/4"/>
        </tr>
        <tr class="d-flex">
            <InputComponent class="w-50 me-0" label="NRIC No" maxWordCount="20" />
            <div class="d-flex w-50">
                <div class="h-100 date-label">Date of Birth: </div>
                <VueDatePicker 
                    class="date-field"
                    @update:model-value="handleDOBInput" 
                    :model-value="dateOfBirth"
                    v-model="dateOfBirth"
                    :format="dateFormat"
                    :enable-time-picker="false" 
                    auto-apply
                    :disabled-dates="disabledAfterToday"/>
            </div>
        </tr>
        <tr class="d-flex">
            <InputComponent label="Citizenship" maxWordCount="20" />
            <InputComponent label="Race" maxWordCount="20" />
        </tr>
        <tr class="d-flex">
            <InputComponent label="H/Phone" maxWordCount="20" />
            <InputComponent label="Marital Status" maxWordCount="20" />
        </tr>
        <tr class="d-flex">
            <InputComponent label="Driving License" maxWordCount="20" />
            <InputComponent label="Current Salary" maxWordCount="20" />
        </tr>
        <tr class="d-flex">
            <div class="d-flex w-50 mx-3">
                <div class="h-100" style="width: 40%;">Earliest Commencement Date: </div>
                <VueDatePicker 
                    class="date-field"
                    @update:model-value="handleECDInput" 
                    :model-value="earliestcommencement"
                    v-model="earliestcommencement"
                    :format="dateFormat"
                    :enable-time-picker="false" 
                    auto-apply/>
            </div>
            <InputComponent class="w-50" label="Expected Salary" maxWordCount="20" />
        </tr>
    </table>
</template>

<script setup>
import InputComponent from '@/components/InputComponent.vue';
import { ref, watch, computed } from 'vue';
import { useStore } from 'vuex';

const $store = useStore();
const dateOfBirth = ref('');
const earliestcommencement = ref('');
const dateFormat = 'dd-MM-yyyy';

const handleDOBInput = (modelData) => {
    $store.commit('updateFormData', { ["Date of Birth".toString()]: modelData });
}

const handleECDInput = (modelData) => {
    $store.commit('updateFormData', { ["Earliest Commencement Date".toString()]: modelData });
}

const disabledAfterToday = (date) => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    return date > today
}

</script>