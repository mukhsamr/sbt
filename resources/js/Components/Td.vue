<script setup>

defineProps({
    text: String
})

</script>

<template>
    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-b">
        <slot>{{ text }}</slot>
    </td>
</template>