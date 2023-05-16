<script setup>

defineProps({
    icon: Function,
    disabled: Boolean
})

</script>

<template>
    <div class="flex" :class="disabled ? 'text-slate-400' : 'clickable'">
        <component :is="icon" class="h-5 w-5" />
        <span class="my-auto ml-2">
            <slot />
        </span>
    </div>
</template>