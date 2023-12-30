<template>
    <div class="declaration-container">
      <div class="declaration">
        <div class="question-container mt-4">
          <!-- Question 1 -->
          <div class="declaration-question">
            <div class="d-flex">
              <div class="declaration-text">
                Have you ever suffered or suffering from any medical condition(s), illness, or physical impairment which may limit work performance and/or attendance?
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
          </div>
  
          <!-- Question 3 -->
          <div class="declaration-question">
            <div class="d-flex">
              <div class="declaration-text">
                Have you had any personal involvement in any business undertaken, e.g., directorship, partnership, etc?
              </div>
              <div class="flex-grow-1"></div>
              <div class="declaration-options">
                <label>
                  <input type="radio" name="business_involvement" value="NO" v-model="businessInvolvement" />
                  NO
                </label>
                <label>
                  <input type="radio" name="business_involvement" value="YES" v-model="businessInvolvement" />
                  YES
                </label>
              </div>
            </div>
            <div v-if="businessInvolvement === 'YES'" class="declaration-details">
              If yes, kindly furnish details:
              <textarea v-model="businessInvolvementDetails" placeholder="Click here to enter text."></textarea>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Declaration -->
      <div class="mt-4">
        <strong>
          I hereby declare that all information given in this application for employment is true & correct. I acknowledge & agree that any false declaration, answer, or statement made by me on this application or any supplement thereto will render me disqualified and/or will be sufficient grounds for immediate dismissal.
        </strong>
      </div>
  
      <div class="d-flex mt-4">
      <div class="d-flex flex-column m-auto">
        <canvas class="border border-dark" ref="signatureCanvas" @mousedown="startDrawing" @mousemove="draw" @mouseup="stopDrawing"></canvas>
        <button class="btn btn-secondary clear-button" @click="clearSignature">Clear Signature</button>
      </div>
      <div class="m-auto">
        <InputBlank label="Date" maxWordCount="50" v-model="signatureDate" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import InputBlank from './InputBlank.vue';
import { useStore } from 'vuex';

const $store = useStore();

const drawing = ref(false);
const signatureCanvas = ref(null);
const signatureDate = ref('');

const startDrawing = () => {
  drawing.value = true;
};

const draw = (event) => {
  if (!drawing.value) return;

  const canvas = signatureCanvas.value;
  const ctx = canvas.getContext('2d');
  const rect = canvas.getBoundingClientRect();

  const x = event.clientX - rect.left;
  const y = event.clientY - rect.top;

  ctx.lineTo(x, y);
  ctx.stroke();
};

const stopDrawing = () => {
  drawing.value = false;
  updateFormData();
};

const clearSignature = () => {
  const canvas = signatureCanvas.value;
  const ctx = canvas.getContext('2d');

  ctx.clearRect(0, 0, canvas.width, canvas.height);

  ctx.beginPath();
  updateFormData();
};

const medicalCondition = ref(null);
const conviction = ref(null);
const businessInvolvement = ref(null);
const medicalConditionDetails = ref('');
const convictionDetails = ref('');
const businessInvolvementDetails = ref('');

watch(
  [medicalCondition, conviction, businessInvolvement, medicalConditionDetails, convictionDetails, businessInvolvementDetails, signatureDate],
  () => {
    updateFormData();
  }
);

function updateFormData() {
  const signatureImage = canvasToBase64(signatureCanvas.value);
  const formData = {
    declaration: {
      medicalCondition: medicalCondition.value === null ? 'NULL' : medicalCondition.value === 'YES' ? medicalConditionDetails.value : 'NO',
      conviction: conviction.value === null ? 'NULL' : conviction.value === 'YES' ? convictionDetails.value : 'NO',
      businessInvolvement: businessInvolvement.value === null ? 'NULL' : businessInvolvement.value === 'YES' ? businessInvolvementDetails.value : 'NO',
    },
    signature: signatureImage,
  };
  $store.commit('updateFormData', formData);
}

function canvasToBase64(canvas) {
  const dataURL = canvas.toDataURL('image/png');
  return dataURL.split(',')[1];
}
</script>