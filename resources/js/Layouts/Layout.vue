<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Topbar from './Topbar.vue';
import Sidebar from './Sidebar.vue';
import { ref } from 'vue';

onMounted(() => {
    initFlowbite()
})

defineProps({
    judul: {
        type: String,
        required: true
    }
})

const sidebar = ref()

function toggle() {
    sidebar.value.toggle()
}

</script>

<template>

    <main class="h-full w-full">

        <Sidebar class="w-60 shrink-0" ref="sidebar" />


        <div class="w-full md:ml-[15rem] md:w-[calc(100%-15rem)]">

            <Topbar :judul="judul" @toggle="toggle" />


            <div class="mx-4 my-2 md:mx-8 md:my-6 grow-0">
                <slot />
            </div>
        </div>

    </main>


</template>