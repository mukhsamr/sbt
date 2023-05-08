<script setup>
import Layout from "@/Layouts/Layout.vue";
import { SwatchIcon, TagIcon } from '@heroicons/vue/24/outline';
import { router } from '@inertiajs/vue3';
import { List } from "@/Components";
import { ref } from "vue";


const props = defineProps({
    santri: {
        type: Object,
        default: () => ({})
    },
    tahfidz: {
        type: Object,
        default: () => ({})
    },
    it: {
        type: Object,
        default: () => ({})
    },
    bahasa: {
        type: Object,
        default: () => ({})
    },
    karakter: {
        type: Object,
        default: () => ({})
    },
    catatan: {
        type: Object,
        default: () => ({})
    },
    plpTahfidz: {
        type: Array,
        default: () => []
    },
    plpIt: {
        type: Array,
        default: () => []
    },
    plpBahasa: {
        type: Array,
        default: () => []
    },
    plpKarakter: {
        type: Array,
        default: () => []
    },
})

const isActive = ref(localStorage.getItem('bidang') ?? 'biodata')
const gambar = props.santri.foto
    ? `bg-[url('/storage/images/students/${props.santri.foto}')]`
    : "bg-[url('/storage/images/students/santri.png')]"



function toggle(item) {
    isActive.value = item
    localStorage.setItem('bidang', item)
}

function back() {
    window.history.back()
}

function kategori(item) {
    if (item == 'h') return 'High'
    if (item == 'm') return 'Middle'
    if (item == 'l') return 'Low'
}

function toBidang(bidang) {
    router.get(route('santri.bidangUpdate'), {
        bidang: bidang,
        santri_id: props.santri.id,
        student_id: props.santri.student.id
    })
}

</script>

<template>
    <Layout judul="Profil Santri">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            <div class="flex items-center md:col-span-2">
                <img class="rounded-full w-24" src="/storage/user.jpg" alt="image description">
                <div class="space-y-2">
                    <div>{{ santri.student.nama }}</div>
                    <div class="text-sm text-slate-400">{{
                        'Kelas ' + santri.kelas_payung.kelas + ' - Level ' +
                            santri.kelas_pondok.kelas
                    }}</div>
                </div>
            </div>
            <div class="flex ml-auto p-1.5 rounded-full bg-slate-300 mb-3 w-full h-fit text-sm justify-between">
                <div class="rounded-full cursor-pointer py-2 px-6"
                    :class="{ 'bg-white font-semibold': isActive == 'biodata' }" @click="toggle('biodata')">Biodata
                </div>
                <div class="rounded-full cursor-pointer py-2 px-6"
                    :class="{ 'bg-white font-semibold': isActive == 'bidang' }" @click="toggle('bidang')">
                    Bidang</div>
                <div class="rounded-full cursor-pointer py-2 px-6"
                    :class="{ 'bg-white font-semibold': isActive == 'catatan' }" @click="toggle('catatan')">Catatan
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 mt-4">
            <div class="col-span-12 bg-white p-4 shadow-xl border rounded-xl">

                <!-- Biodata -->
                <div class="space-y-2" v-if="isActive == 'biodata'">
                    <List kolom="Nama Lengkap" :value="santri.student?.nama" />
                    <List kolom="Panggilan" :value="santri.student?.panggilan" />
                    <List kolom="NIK" :value="santri.student?.nik" />
                    <List kolom="TTL">
                        {{ santri.student?.tempat + ', ' + santri.student?.lahir }}
                    </List>
                    <List kolom="Asal Sekolah" :value="santri.student?.asal_sekolah" />
                    <List kolom="Tinggi Badan" :value="santri.student?.tinggi_badan + ' cm'" />
                    <List kolom="Berat Badan" :value="santri.student?.berat_badan + ' kg'" />
                    <List kolom="Ayah" :value="santri.student?.ayah" />
                </div>

                <!-- Bidang -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" v-if="isActive == 'bidang'">

                    <!-- Tahfidz -->
                    <div class="clickable md:hover:bg-slate-200 rounded-lg shadow-lg bg-slate-100 p-4"
                        @click="toBidang('tahfidz')">
                        <h2 class="text-xl font-semibold text-slate-800 mb-4">Tahfidz</h2>
                        <div class="mb-3">
                            <SwatchIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                            <span>{{ kategori(tahfidz.kategori) }}</span>
                        </div>
                        <div>
                            <TagIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                            <span>{{ tahfidz.plp }}</span>
                        </div>
                    </div>

                    <!-- IT -->
                    <div class="clickable md:hover:bg-slate-200 rounded-lg shadow-lg bg-slate-100 p-4"
                        @click="toBidang('it')">
                        <h2 class="text-xl font-semibold text-slate-800 mb-4">IT</h2>
                        <div class="mb-3">
                            <SwatchIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                            <span>{{ kategori(it.kategori) }}</span>
                        </div>
                        <div>
                            <TagIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                            <span>{{ it.plp }}</span>
                        </div>
                    </div>

                    <!-- Bahasa -->
                    <div class="clickable md:hover:bg-slate-200 rounded-lg shadow-lg bg-slate-100 p-4"
                        @click="toBidang('bahasa')">
                        <h2 class="text-xl font-semibold text-slate-800 mb-4">Bahasa</h2>
                        <div class="mb-3">
                            <SwatchIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                            <span>{{ kategori(bahasa.kategori) }}</span>
                        </div>
                        <div>
                            <TagIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                            <span>{{ bahasa.plp }}</span>
                        </div>
                    </div>

                    <!-- Karakter -->
                    <div class="clickable md:hover:bg-slate-200 rounded-lg shadow-lg bg-slate-100 p-4"
                        @click="toBidang('karakter')">
                        <h2 class="text-xl font-semibold text-slate-800 mb-4">Karakter</h2>
                        <div class="mb-3">
                            <SwatchIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                            <span>{{ kategori(karakter.kategori) }}</span>
                        </div>
                        <div>
                            <TagIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                            <span>{{ karakter.plp }}</span>
                        </div>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" v-if="isActive == 'catatan'">
                    <div class="rounded-lg bg-slate-100 p-4 clickable hover:bg-slate-200"
                        @click="$inertia.get(route('santri.catatan', { tipe: 'p', santri: santri.id }))">
                        <h2 class="text-xl font-semibold text-slate-800 mb-4">Positif</h2>
                        <template v-for="item in catatan.p">
                            <div class="space-y-3">
                                <div>{{ item.judul }}</div>
                                <span class="text-slate-400 text-sm" v-if="item.catatan.length > 10">
                                    {{ item.catatan.substr(0, 25) + ' ...' }}
                                </span>
                                <span class="text-slate-400 text-sm" v-else>
                                    {{ item.catatan }}
                                </span>
                            </div>
                        </template>
                    </div>

                    <div class="rounded-lg bg-slate-100 p-4 clickable hover:bg-slate-200"
                        @click="$inertia.get(route('santri.catatan', { tipe: 'n', santri: santri.id }))">
                        <h2 class="text-xl font-semibold text-slate-800 mb-4">Negatif</h2>
                        <template v-for="item in catatan.n">
                            <div class="space-y-3">
                                <div>{{ item.judul }}</div>
                                <span class="text-slate-400 text-sm" v-if="item.catatan.length > 10">
                                    {{ item.catatan.substr(0, 25) + ' ...' }}
                                </span>
                                <span class="text-slate-400 text-sm" v-else>
                                    {{ item.catatan }}
                                </span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>