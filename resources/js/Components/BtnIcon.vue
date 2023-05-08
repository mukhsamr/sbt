<script setup>

defineProps({
    icon: Function
})

</script>

<template>
    <div class="flex clickable">
        <component :is="icon" class="h-5 w-5" />
        <span class="my-auto ml-2">
            <slot />
        </span>
    </div>
</template>