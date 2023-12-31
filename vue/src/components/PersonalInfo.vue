<template>
    <div class="headerContainer">
        <img class="logo" :src="logo" alt="Logo"/>
        <h3 class="text-center fw-bold">Application For Employment</h3>
    </div>
    <div class="d-flex mt-5">
        <InputComponent label="Position" maxWordCount="50" :errors="$store.state.formErrors['Position']" />
        <InputComponent label="Mode of Application" maxWordCount="20"
            :errors="$store.state.formErrors['Mode of Application']" />
    </div>
    <table class="mt-5 personal-info-table">
        <tr class="d-flex">
            <InputComponent label="Name" maxWordCount="50" :errors="$store.state.formErrors['Name']" />
            <InputComponent label="Gender" maxWordCount="20" :errors="$store.state.formErrors['Gender']" />
        </tr>
        <tr>
            <InputComponent label="Address" maxWordCount="200" :errors="$store.state.formErrors['Address']" />
        </tr>
        <tr>
            <InputComponent label="Email" maxWordCount="70" class="w-3/4" :errors="$store.state.formErrors['Email']" />
        </tr>
        <tr class="d-flex">
            <InputComponent class="w-50 me-0" style="width: 50% !important;" label="NRIC No" maxWordCount="20"
                :errors="$store.state.formErrors['NRIC No']" />
            <div class="d-flex flex-column w-50 ms-4">
                <div class="d-flex p-2">
                    <div class="h-100 date-label">Date of Birth: </div>
                    <VueDatePicker class="date-field" @update:model-value="handleDOBInput" :model-value="dateOfBirth"
                        v-model="dateOfBirth" :format="dateFormat" :enable-time-picker="false" auto-apply
                        :disabled-dates="disabledAfterToday" />
                </div>
                <div class="text-danger">
                    {{ errors['Date of Birth'] != null ? 'This Date of Birth field is required.' : ''}}
                </div>
            </div>
        </tr>
        <tr class="d-flex">
            <InputComponent label="Citizenship" maxWordCount="20" :errors="$store.state.formErrors['Citizenship']" />
            <InputComponent label="Race" maxWordCount="20" :errors="$store.state.formErrors['Race']" />
        </tr>
        <tr class="d-flex">
            <InputComponent label="H/Phone" maxWordCount="20" :errors="$store.state.formErrors['H/Phone']" />
            <InputComponent label="Marital Status" maxWordCount="20"
                :errors="$store.state.formErrors['Marital Status']" />
        </tr>
        <tr class="d-flex">
            <InputComponent label="Driving License" maxWordCount="20"
                :errors="$store.state.formErrors['Driving License']" />
            <InputComponent label="Current Salary" maxWordCount="20"
                :errors="$store.state.formErrors['Current Salary']" />
        </tr>
        <tr class="d-flex my-3">
            <div class="d-flex flex-column w-50 ms-4">

                <div class="d-flex">
                    <div class="h-100" style="width: 40%;">Earliest Commencement Date: </div>
                    <VueDatePicker class="date-field" @update:model-value="handleECDInput"
                        :model-value="earliestcommencement" v-model="earliestcommencement" :format="dateFormat"
                        :enable-time-picker="false" auto-apply />
                </div>
                <div class="text-danger">
                    {{ errors['Earliest Commencement Date'] != null ? 'This Earliest Commencement Date field is required.' : ''}}
                </div>
            </div>
            <InputComponent style="width: 50% !important;" label="Expected Salary" maxWordCount="20"
                :errors="$store.state.formErrors['Expected Salary']" />
        </tr>
    </table>
</template>

<script setup>
    import InputComponent from '@/components/InputComponent.vue';
    import logo from '@/assets/Realstar.png';
    import {
        ref,
        watch,
        computed
    } from 'vue';
    import {
        useStore
    } from 'vuex';

    const store = useStore();

    const dateOfBirth = ref('');
    const earliestcommencement = ref('');
    const dateFormat = 'dd-MM-yyyy';

    const errors = computed(() => store.state.formErrors);
    const formData = computed(() => store.state.formData);

    const handleDOBInput = (modelData) => {
        store.commit('updateFormData', {
            ["Date of Birth".toString()]: modelData
        });
    }

    const handleECDInput = (modelData) => {
        store.commit('updateFormData', {
            ["Earliest Commencement Date".toString()]: modelData
        });
    }

    const disabledAfterToday = (date) => {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1); 
        tomorrow.setHours(0, 0, 0, 0);

        return date > tomorrow;
    }


</script>
