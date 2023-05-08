<script setup>

const props = defineProps({
    nama: String,
    level: String | Number,
    usia: String | Number,
    image: String
})

const bg = props.image
    ? `bg-[url('/storage/images/students/${props.image}')]`
    : "bg-[url('/storage/images/students/santri.png')]"

</script>

<template>
    <div class="rounded-2xl shrink-0 h-60 w-40 border-2 bg-cover flex clickable" :class="bg" data-mdb-ripple="true">
        <div class="mt-auto align-bottom p-3 w-full">
            <div class="text-white">{{ nama }}</div>
            <div class="flex justify-between">
                <div class="text-sm opacity-30 text-slate-100">Level {{ level }}</div>
                <div class="text-sm opacity-30 text-slate-100">{{ usia }}</div>
            </div>
        </div>
    </div>
</template>