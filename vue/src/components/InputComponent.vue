<template>
  <div class="p-2 w-100">
    <div class="form-container d-flex mx-3">
      <span class="label my-auto text-nowrap">{{ label }}:</span>
      <textarea
        :id="id"
        class="mx-2"
        v-model="inputValue"
        @input="handleInput"
        @keydown="handleKeyDown"
        ref="positionTextarea"
        :style="{ height: computedTextareaHeight + 'px', transition: 'none' }"
        :placeholder="placeholder"
        :maxlength="maxWordCount"
        @transitionend="resetTransition"
      ></textarea>

    </div>
    <div v-if="errors && errors.length" class="text-danger mx-2">
      <div v-for="error in errors" :key="error">{{ error }}</div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
    },
    id: {
      type: String,
    },
    placeholder: {
      type: String,
      default: "Click here to enter text",
    },
    maxWordCount: {
      type: String,
      default: Infinity,
    },
    value: {
      type: String,
      default: "",
    },
    errors: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      computedTextareaHeight: 40,
      inputValue: this.value,
    };
  },
  watch: {
    inputValue(newValue) {
      this.$emit('input', newValue);
    },
    errors() {
      this.updateTextareaHeight();
    },
  },
  methods: {
    handleInput() {
      
      const lines = this.inputValue.split('\n').filter(line => line.trim() !== '');
      if (this.inputValue.endsWith('\n') && lines[lines.length - 1].trim() !== '') {
        this.inputValue += '\n';
      }
      
      this.$nextTick(() => {
        this.updateTextareaHeight();
        
        if (this.inputValue.trim() === '') {
          this.computedTextareaHeight = 40;
        }
      });


      this.$store.commit('updateFormData', { [this.label.toString()]: this.inputValue });
    },
    handleKeyDown(event) {
      if (event.key === "Enter") {
        event.preventDefault();
      }
    },
    updateTextareaHeight() {
      const scrollHeight = this.$refs.positionTextarea.scrollHeight;
      this.computedTextareaHeight = Math.max(scrollHeight, 40);
    },
    resetTransition() {
      this.$refs.positionTextarea.style.transition = 'height 0.3s';
    },
  },
};
</script>

<style scoped>
.form-container {
  width: 100%;
}

.label {
  margin-bottom: 8px;
}

textarea {
  width: 75%;
  padding: 8px;
  box-sizing: border-box;
  border: none;
  resize: none;
  overflow-y: hidden;
  border-bottom: 1px solid #ccc;
  transition: height 0.3s;
}

/* Style for displaying validation errors */
.text-danger {
  color: red;
  margin-top: 4px;
}
</style>
