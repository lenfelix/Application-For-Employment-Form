<template>
    <div class="declaration-container mt-4">
        <div class="fw-bold my-3">PART VII - DECLARATION</div>
        <div class="declaration">
            <div class="question-container mt-4">
                <!-- Question 1 -->
                <div class="declaration-question">
                    <div class="d-flex">
                        <div class="declaration-text">
                            Have you ever suffered or suffering from any medical condition(s), illness, or physical
                            impairment which may limit work performance and/or attendance?
                        </div>
                        <div class="flex-grow-1"></div>
                        <div class="declaration-options">
                            <label>
                                <input type="radio" name="medical_condition" value="NO" v-model="medicalCondition" />
                                NO
                            </label>
                            <label>
                                <input type="radio" name="medical_condition" value="YES" v-model="medicalCondition" />
                                YES
                            </label>
                        </div>
                    </div>
                    <div v-if="medicalCondition === 'YES'" class="declaration-details">
                        If yes, kindly furnish details:
                        <textarea v-model="medicalConditionDetails" placeholder="Click here to enter text."></textarea>
                    </div>
                    <div class="text-danger">
                        {{ errors['declaration.medicalCondition'] != null ? 'This field is required.' : ''}}
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="declaration-question">
                    <div class="d-flex">
                        <div class="declaration-text">
                            Have you ever been convicted in court of law or received any writ of summons?
                        </div>
                        <div class="flex-grow-1"></div>
                        <div class="declaration-options">
                            <label>
                                <input type="radio" name="convicted" value="NO" v-model="conviction" />
                                NO
                            </label>
                            <label>
                                <input type="radio" name="convicted" value="YES" v-model="conviction" />
                                YES
                            </label>
                        </div>
                    </div>
                    <div v-if="conviction === 'YES'" class="declaration-details">
                        If yes, kindly furnish details:
                        <textarea v-model="convictionDetails" placeholder="Click here to enter text."></textarea>
                    </div>
                    <div class="text-danger">
                        {{ errors['declaration.conviction'] != null ? 'This field is required.' : ''}}
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="declaration-question">
                    <div class="d-flex">
                        <div class="declaration-text">
                            Have you had any personal involvement in any business undertaken, e.g., directorship,
                            partnership, etc?
                        </div>
                        <div class="flex-grow-1"></div>
                        <div class="declaration-options">
                            <label>
                                <input type="radio" name="business_involvement" value="NO"
                                    v-model="businessInvolvement" />
                                NO
                            </label>
                            <label>
                                <input type="radio" name="business_involvement" value="YES"
                                    v-model="businessInvolvement" />
                                YES
                            </label>
                        </div>
                    </div>
                    <div v-if="businessInvolvement === 'YES'" class="declaration-details">
                        If yes, kindly furnish details:
                        <textarea v-model="businessInvolvementDetails"
                            placeholder="Click here to enter text."></textarea>
                    </div>
                    <div class="text-danger">
                        {{ errors['declaration.businessInvolvement'] != null ? 'This field is required.' : ''}}
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <strong>
                I hereby declare that all information given in this application for employment is true & correct. I
                acknowledge & agree that any false declaration, answer, or statement made by me on this application or
                any supplement thereto will render me disqualified and/or will be sufficient grounds for immediate
                dismissal.
            </strong>
        </div>

        <div class="d-flex mt-4">
            <div class="d-flex flex-column m-auto">
                <canvas class="border border-dark" ref="signatureCanvas" @mousedown="startDrawing" @mousemove="draw"
                    @mouseup="stopDrawing"></canvas>
                <button class="btn btn-secondary clear-button" @click="clearSignature">Clear Signature</button>
                <div class="text-danger">
                    {{ errors['signature'] != null ? 'This Signature field is required.' : ''}}
                </div>
            </div>
            <div class="d-flex flex-column m-auto">
                <div class="d-flex">
                    <div class="me-3 date-label">Date: </div>
                    <VueDatePicker v-model="signatureDate" auto-apply :format="dateFormat" :enable-time-picker="false"
                        :disabled-dates="disabledAfterToday" />
                </div>
                <div class="text-danger">
                    {{ errors['Date'] != null ? 'This Declaration Date field is required.' : ''}}
                </div>
            </div>
        </div>
        <!-- <img :src="getSignatureImageSrc" alt="Signature" /> -->
    </div>
</template>

<script setup>
    import {
        ref,
        watch,
        computed
    } from 'vue';
    import {
        useStore
    } from 'vuex';

    const signatureDate = ref('');
    const dateFormat = 'dd-MM-yyyy';
    const disabledAfterToday = (date) => {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1); 
        tomorrow.setHours(0, 0, 0, 0);

        return date > tomorrow;
    }

    const $store = useStore();

    const errors = computed(() => $store.state.formErrors);
    const formData = computed(() => $store.state.formData);

    const drawing = ref(false);
    const signatureCanvas = ref(null);
    const pathData = ref([]);

    const startDrawing = () => {
        drawing.value = true;
        pathData.value = [];
    };

    const draw = (event) => {
        if (!drawing.value) return;

        const canvas = signatureCanvas.value;
        const rect = canvas.getBoundingClientRect();

        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        pathData.value.push({
            x,
            y
        });
        drawPath();
    };

    const drawPath = () => {
        const canvas = signatureCanvas.value;
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        const path = new Path2D();
        path.moveTo(pathData.value[0].x, pathData.value[0].y);

        for (let i = 1; i < pathData.value.length; i++) {
            path.lineTo(pathData.value[i].x, pathData.value[i].y);
        }

        ctx.stroke(path);
    };

    const stopDrawing = () => {
        drawing.value = false;
        updateFormData();
    };

    const clearSignature = () => {
        pathData.value = [];
        drawPath();
        updateFormData();
    };

    const canvasToBase64 = (canvas) => {
        const dataURL = canvas.toDataURL('image/png');
        return dataURL.split(',')[1];
    };

    const medicalCondition = ref(null);
    const conviction = ref(null);
    const businessInvolvement = ref(null);
    const medicalConditionDetails = ref('');
    const convictionDetails = ref('');
    const businessInvolvementDetails = ref('');

    watch(
        [medicalCondition, conviction, businessInvolvement, medicalConditionDetails, convictionDetails,
            businessInvolvementDetails, signatureDate
        ],
        () => {
            updateFormData();
        }
    );

    function updateFormData() {
        const signatureImage = canvasToBase64(signatureCanvas.value);
        const formData = {
            declaration: {
                medicalCondition: medicalCondition.value === null ? null : medicalCondition.value === 'YES' ?
                    medicalConditionDetails.value : 'No',
                conviction: conviction.value === null ? null : conviction.value === 'YES' ? convictionDetails
                    .value : 'No',
                businessInvolvement: businessInvolvement.value === null ? null : businessInvolvement.value ===
                    'YES' ? businessInvolvementDetails.value : 'No',
            },
            signature: signatureImage,
            Date: signatureDate,
        };
        $store.commit('updateFormData', formData);
    }




</script>
