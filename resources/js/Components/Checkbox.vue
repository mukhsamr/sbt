<script setup>
import { onMounted, onUpdated, ref } from 'vue';
import { uniqueId } from "lodash";

const props = defineProps({
    modelValue: Array
})

defineEmits(['update:modelValue'])


// Data
const checkbox = ref()
const isCheck = ref(false)

const id = uniqueId('checkbox-')

// Methods
function change(target) {
    if (props.modelValue) {

        const value = parseInt(target.value)
            ? parseInt(target.value)
            : target.value

        if (target.checked) {
            return [...props.modelValue, value]
        } else {
            return props.modelValue.filter(val => val !== value)
        }
    }
}

function mark() {
    if (props.modelValue) {
        const value = parseInt(checkbox.value.value)
            ? parseInt(checkbox.value.value)
            : checkbox.value.value

        isCheck.value = props.modelValue.includes(value)
    }
}


// Mount
onMounted(() => mark())

// Updated
onUpdated(() => mark())
</script>

<template>
    <label :for="id">
        <input :id="id" type="checkbox"
            class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
            ref="checkbox" :checked="isCheck" @change="$emit('update:modelValue', change($event.target))"
            v-bind="$attrs" />
        <slot />
    </label>
</template>

<script>
export default {
    inheritAttrs: false,
}
</script>
