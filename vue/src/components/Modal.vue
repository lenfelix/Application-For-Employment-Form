<template>

    <div class="modal" v-if="showModal">
        <div class="modal-overlay" @click="closeModal"></div>
        <div class="modal-content">
            <span class="close-button" @click="closeModal">&times;</span>
            <p class="fw-bold text-success">{{ successMessage }}</p>

            <div class="headerContainer">
                <img class="logo" :src="logo" alt="Logo"/>
                <h3 class="text-center fw-bold">Application For Employment</h3>
            </div>
            <div class="d-flex mt-5">
                <div class="w-50"><span class="fw-bold pe-2">Position: </span>{{ formData.Position }}</div>
                <div class="w-50"><span class="fw-bold pe-2">Mode of Application: </span>{{ formData['Mode of Application'] }}</div>
            </div>
            <table class="mt-5 personal-info-table">
                <tr class="d-flex">
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Name: </span>{{ formData.Name }}</div>
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Gender: </span>{{ formData.Gender }}</div>
                </tr>
                <tr>
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Address: </span>{{ formData.Address }}</div>
                </tr>
                <tr>
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Email: </span>{{ formData.Email }}</div>
                </tr>
                <tr class="d-flex">
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">NRIC No: </span>{{ formData['NRIC No'] }}</div>
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Date of Birth: </span>{{ formatDate(formData['Date of Birth']) }}</div>
                </tr>
                <tr class="d-flex">
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Citizenship: </span>{{ formData['Citizenship'] }}</div>
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Race: </span>{{ formData['Race'] }}</div>
                </tr>
                <tr class="d-flex">
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">H/Phone: </span>{{ formData['H/Phone'] }}</div>
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Marital Status: </span>{{ formData['Marital Status'] }}</div>
                </tr>
                <tr class="d-flex">
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Driving License: </span>{{ formData['Driving License'] }}</div>
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Current Salary: </span>{{ formData['Current Salary'] }}</div>
                </tr>
                <tr class="d-flex my-3">
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Earliest Commencement Date: </span>{{ formatDate(formData['Earliest Commencement Date']) }}</div>
                    <div class="w-50 px-3 pt-3"><span class="fw-bold pe-2">Expected Salary: </span>{{ formData['Expected Salary'] }}</div>
                </tr>
            </table>

            <div class="mt-5">
                <table class="custom-table">
                    <div v-for="(table, k) in tableHeader" :key="k">
                        <div class="fw-bold pt-4 pb-2">{{ tableTitle[k] }}</div>
                        <thead>
                            <tr>
                                <th v-for="header in table">
                                    <div v-if="header === 'School_College_University_Last_Attended'">School / College /
                                        University Last Attended</div>
                                    <div v-else>{{ header }}</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, i) in formData[tableTypes[k]]" :key="i">
                                <td v-for="(value, j) in tableHeader[k]" :key="j">
                                    <textarea :value="row[value]" :readonly="true"
                                        placeholder="Click here to enter text."></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </div>
                </table>
            </div>

            <div class="mt-5">
                <div class="fw-bold">PART VI - QUESTIONNAIRES</div>
                <div class="question-container mt-4">
                    <div class="question">1. What is your greatest achievement?</div>
                    <div class="d-flex flex-column w-100">
                        <textarea readonly :value="formData['questionnaires']['achievement']" class="ms-4 w-75 modal-textbox"
                            placeholder="Click here to enter text."></textarea>
                    </div>
                </div>

                <div class="question-container mt-4">
                    <div class="question">2. What are your strengths & weaknesses?</div>
                    <div class="d-flex">
                        <div class="my-auto me-2 ms-4">Strengths:</div>
                        <div class="d-flex flex-column w-100">
                            <textarea readonly :value="formData['questionnaires']['strengths']" class="ms-4 w-75 modal-textbox"
                                placeholder="Click here to enter text."></textarea>
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <div class="my-auto me-2 ms-4">Weakness:</div>
                        <div class="d-flex flex-column w-100">
                            <textarea readonly :value="formData['questionnaires']['weakness']" class="ms-4 w-75 modal-textbox"
                                placeholder="Click here to enter text."></textarea>
                        </div>
                    </div>
                </div>

                <div class="question-container mt-4">
                    <div class="question">3. How would your employer describe you?</div>
                    <div class="d-flex flex-column w-100">
                        <textarea readonly :value="formData['questionnaires']['employer_describe']" class="ms-4 w-75 modal-textbox"
                            placeholder="Click here to enter text."></textarea>
                    </div>
                </div>
            </div>

            <div class="question-container mt-4">
                <div class="question">
                    4. For each of the characteristics below, rate from a scale of 1 - 4, 1 being least and 4 being most
                    that resembles you.
                </div>

                <div v-for="(characteristic, index) in characteristics" :key="index" class="characteristic ms-4 my-4">
                    <div>{{ characteristic.title }}</div>
                    <div class="rating-scale w-50 form-check">
                        <label class="form-check-label" v-for="rating in characteristic.ratings" :key="rating">
                            <input class="form-check-input" type="radio" :name="`characteristic_${index}`"
                                :value="rating" v-model="formData['ratings'][index]" />
                            {{ rating }}
                        </label>
                    </div>
                </div>
            </div>


            <div class="declaration-container mt-4">
                <div class="fw-bold my-3">PART VII - DECLARATION</div>
                <div class="declaration">
                    <div class="question-container mt-4">
                        <!-- Question 1 -->
                        <div class="declaration-question">
                            <div class="d-flex flex-column">
                                <div class="declaration-text">
                                    Have you ever suffered or suffering from any medical condition(s), illness, or
                                    physical
                                    impairment which may limit work performance and/or attendance?
                                </div>
                                <span v-if="formData['declaration']['medicalCondition'] != 'No'">Yes, {{ formData['declaration']['medicalCondition'] }}</span>
                                <span v-else>{{ formData['declaration']['medicalCondition'] }}</span>
                            </div>
                            <div v-if="medicalCondition === 'YES'" class="declaration-details">
                                If yes, kindly furnish details:
                                <textarea v-model="medicalConditionDetails"
                                    placeholder="Click here to enter text."></textarea>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="declaration-question">
                            <div class="d-flex flex-column">
                                <div class="declaration-text">
                                    Have you ever been convicted in court of law or received any writ of summons?
                                </div>
                                <span v-if="formData['declaration']['conviction'] != 'No'">Yes, {{ formData['declaration']['conviction'] }}</span>
                                <span v-else>{{ formData['declaration']['conviction'] }}</span>
                            </div>
                            <div v-if="conviction === 'YES'" class="declaration-details">
                                If yes, kindly furnish details:
                                <textarea v-model="convictionDetails"
                                    placeholder="Click here to enter text."></textarea>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="declaration-question">
                            <div class="d-flex flex-column">
                                <div class="declaration-text">
                                    Have you had any personal involvement in any business undertaken, e.g.,
                                    directorship,
                                    partnership, etc?
                                </div>
                                <span v-if="formData['declaration']['businessInvolvement'] != 'No'">Yes, {{ formData['declaration']['businessInvolvement'] }}</span>
                                <span v-else>{{ formData['declaration']['businessInvolvement'] }}</span>
                            </div>
                            <div v-if="businessInvolvement === 'YES'" class="declaration-details" >
                                If yes, kindly furnish details:
                                <textarea v-model="businessInvolvementDetails"
                                    placeholder="Click here to enter text."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <strong>
                        I hereby declare that all information given in this application for employment is true &
                        correct. I
                        acknowledge & agree that any false declaration, answer, or statement made by me on this
                        application or
                        any supplement thereto will render me disqualified and/or will be sufficient grounds for
                        immediate
                        dismissal.
                    </strong>
                </div>

                <div class="d-flex mt-4">
                    <img class="m-auto" :src="getSignatureImageSrc" alt="Signature" />
                    <div class="d-flex flex-column m-auto">

                    <div class="px-3 pt-3"><span class="fw-bold pe-2">Date: </span>{{ formatDate(formData['Date']) }}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
    import { computed } from 'vue';
    import { useStore } from 'vuex';
    import logo from '@/assets/Realstar.png';


    const store = useStore();

    const showModal = computed(() => store.state.showModal);
    const formData = computed(() => store.state.formData);
    const successMessage = computed(() => store.state.successMessage);
    const dateFormat = 'dd-MM-yyyy';

    const tableTitle = [
        "PART II - QUALIFICATIONS",
        "PART III - EMPLOYMENT HISTORY (last 2 employments)",
        "PART IV - IN CASE OF EMERGENCY TO CONTACT",
        "PART V - OTHER INFORMATION (Referees who are not related to & whom you have known for at least 2 years)",
    ];
    const tableHeader = [
        ["Period", "School_College_University_Last_Attended", "Language Stream", "Highest Standard"],
        ["Period", "Name of Employer", "Position", "Salary", "Reason For Leaving"],
        ["Name", "Relationship", "Contact Number"],
        ["Name of Refree", "Occupation", "Name of Company", "Contact Number", "Years Known"],
    ];
    const tableIter = [3, 2, 2, 2];
    const tableTypes = ["qualifications", "employment", "emergency", "other"];

    const closeModal = () => {
        store.commit('closeModal');
    };

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const year = date.getFullYear();

        return `${day}-${month}-${year}`;
    }

    const getCategory = (tableTitle) => {
        switch (tableTitle) {
            case 0:
                return "qualifications";
            case 1:
                return "employment";
            case 2:
                return "emergency";
            case 3:
                return "other";
            default:
                return "";
        }
    };

    const characteristics = [{
            title: 'a. Open-minded, Receptive to ideas of others, Compliant',
            ratings: [1, 2, 3, 4]
        },
        {
            title: 'b. Cheerful, Jovial, Good-natured, Pleasant',
            ratings: [1, 2, 3, 4]
        },
        {
            title: 'c. Patient, Calm, Tolerant, Reserved',
            ratings: [1, 2, 3, 4]
        },
        {
            title: 'd. Well-disciplined, Self-controlled, Optimistic, Positive',
            ratings: [1, 2, 3, 4]
        },
        {
            title: 'e. Generous, Ready to help, Considerate',
            ratings: [1, 2, 3, 4]
        },
        {
            title: 'f. Assertive, Aggressive, Determined, Cautious',
            ratings: [1, 2, 3, 4]
        },
        {
            title: 'g. Pioneering, Exploring, Enterprising, Competitive',
            ratings: [1, 2, 3, 4]
        },
        {
            title: 'h. Outgoing, Fun loving, Enjoy social group',
            ratings: [1, 2, 3, 4]
        },
    ];

    const getSignatureImageSrc = computed(() => {
        const base64Data = formData.value.signature;

        if (base64Data) {
            return `data:image/png;base64,${base64Data}`;
        } else {
            return null;
        }
    });

</script>

<style scoped>
    .modal {
        display: flex;
        margin-left: auto;
        margin-right: auto;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        z-index: 1000;
        overflow-y: auto;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1001;
    }

    .modal-content {
        width: 70%;
        height: 100%;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        z-index: 1002;
        overflow-y: auto;
    }

    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }

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

    .modal-textbox{
        height: 150px;
    }
</style>
