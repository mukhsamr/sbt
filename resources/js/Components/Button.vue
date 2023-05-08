<script setup>

const props = defineProps({
    color: {
        type: String,
        default: 'primary'
    },
})

const type = {
    primary: 'btn bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800',
    secondary: 'btn bg-purple-600 text-white hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800',
    success: 'btn bg-green-600 text-white hover:bg-green-700 focus:bg-green-700 active:bg-green-800',
    danger: 'btn bg-red-600 text-white hover:bg-red-700 focus:bg-red-700 active:bg-red-800',
    warning: 'btn bg-yellow-600 text-white hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-800',
    dark: 'btn bg-slate-600 text-white hover:bg-slate-700 focus:bg-slate-700 active:bg-slate-800',
}[props.color]

</script>

<template>
    <button type="button" :class="type">
        <slot />
    </button>
</template>