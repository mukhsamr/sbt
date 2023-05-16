<script setup>
import { ref } from 'vue';
import { Link, Collapse } from "@/Components";
import { UserIcon, UsersIcon, HomeIcon, InboxStackIcon, Squares2X2Icon, CalendarIcon } from "@heroicons/vue/24/outline";
import { Link as A } from "@inertiajs/vue3";
import { useSessionStore } from "@/Stores/Session";


const isHide = ref(window.screen.width < 992)

const store = useSessionStore()
const user = store.user

const userRole = (role) => store.checkRole(role)

function toggle() {
    isHide.value = !isHide.value
}

defineExpose({
    toggle
})

</script>

<template>
    <Teleport to="#app">
        <div class="inset-0 fixed bg-black/30 z-10 lg:hidden" :class="{ 'hidden': isHide }" @click="toggle()" />
    </Teleport>

    <div class="shadow-md bg-white transition ease-in-out z-20 h-full fixed md:h-screen md:sticky-top p-2"
        :class="{ '-translate-x-full': isHide }" v-bind="$attrs">

        <!-- Avatar -->
        <div class="pt-4 pb-2 px-6">
            <div class="flex items-center">
                <img src="/storage/user.jpg" class="rounded-full w-16 h-16 object-cover object-top" alt="Foto">
                <div class="text-sm text-slate-600 ml-3">{{ user.nama }}</div>
            </div>
        </div>

        <hr class="my-2">

        <ul class="relative">
            <Link :icon="HomeIcon" :isActive="$page.url.startsWith('/home')" href="/">Beranda</Link>
            <Link :icon="UserIcon" :isActive="$page.url.startsWith('/santri')" href="/santri">Santri</Link>

            <!-- Bidang -->
            <Collapse :icon="InboxStackIcon" text="PLP" :isActive="$page.url.startsWith('/plp')">
                <A class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
                    data-mdb-ripple="true" data-mdb-ripple-color="primary" href="/plp-tahfidz">Tahfidz</A>
                <A class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
                    data-mdb-ripple="true" data-mdb-ripple-color="primary" href="/plp-it">IT</A>
                <A class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
                    data-mdb-ripple="true" data-mdb-ripple-color="primary" href="/plp-bahasa">Bahasa</A>
                <A class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
                    data-mdb-ripple="true" data-mdb-ripple-color="primary" href="/plp-karakter">Karakter</A>
            </Collapse>

            <hr class="my-2">

            <!-- Kelas -->
            <Link :icon="Squares2X2Icon" :isActive="$page.url.startsWith('/kelas-payung')" href="/kelas-payung">
            Kelas Payung
            </Link>
            <Link :icon="Squares2X2Icon" :isActive="$page.url.startsWith('/kelas-pondok')" href="/kelas-pondok">
            Kelas Pondok
            </Link>

            <hr class="my-2">

            <!-- Siswa -->
            <Link :icon="UserIcon" :isActive="$page.url.startsWith('/siswa')" href="/siswa">
            Siswa
            </Link>

            <!-- Parents -->
            <Link :icon="UsersIcon" :isActive="$page.url.startsWith('/parents')" href="/parents">
            Parents
            </Link>

            <!-- Semester -->
            <template v-if="userRole(['admin'])">
                <Link :icon="CalendarIcon" :isActive="$page.url.startsWith('/semester')" href="/semester">
                Semester
                </Link>
            </template>

        </ul>
    </div>
</template>