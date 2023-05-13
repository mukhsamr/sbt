<script setup>

defineProps({
    kolom: String,
    value: String
})

</script>

<template>
    <div>
        <div class="text-slate-400 text-sm">{{ kolom }}</div>
        <div>
            <slot>{{ value }}</slot>
        </div>
    </div>
</template>