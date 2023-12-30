<template>
    <div class="mt-5">
      <table class="custom-table">
        <div v-for="(table, k) in tableHeader" :key="k">
          <div class="fw-bold pt-4 pb-2">{{ tableTitle[k] }}</div>
          <thead>
            <tr>
              <th v-for="header in table">
                {{ header }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="i in tableIter[k]" :key="i">
              <td v-for="j in tableHeader[k].length">
                <textarea
                  @input="handleInput($event, k, i - 1, j - 1)"
                  placeholder="Click here to enter text."
                ></textarea>
              </td>
            </tr>
          </tbody>
        </div>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    computed: {
      storeData() {
        return this.$store.state.formData;
      },
    },
    data() {
      return {
        tableTitle: [
          "PART II - QUALIFICATIONS",
          "PART III - EMPLOYMENT HISTORY (last 2 employments)",
          "PART IV - IN CASE OF EMERGENCY TO CONTACT",
          "PART V - OTHER INFORMATION (Referees who are not related to & whom you have known for at least 2 years)",
        ],
        tableHeader: [
          ["Period", "School / College / University Last Attended", "Language Stream", "Highest Standard"],
          ["Period", "Name of Employer", "Position", "Salary", "Reason For Leaving"],
          ["Name", "Relationship", "Contact Number"],
          ["Name of Refree", "Occupation", "Name of Company", "Contact Number", "Years Known"],
        ],
        tableIter: [3, 2, 2, 2],
        tableData: {
          qualifications: [],
          employment: [],
          emergency: [],
          other: [],
        },
      };
    },
    methods: {
  handleInput(event, k, i, j) {
    console.log("k is ", k);
    const category = this.getCategory(k);

    if (!this.tableData) {
      this.tableData = {};
    }

    if (!this.tableData[category]) {
      this.tableData[category] = [];
    }

    const updatedRow = {
      ...(this.tableData[category][i] || {}),
      [this.tableHeader[k][j]]: event.target.value,
    };

    this.tableData[category].splice(i, 1, updatedRow);

    this.$store.commit('updateFormData', this.tableData);
  },
  getCategory(tableTitle) {
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
    },

},

  };
  </script>
  