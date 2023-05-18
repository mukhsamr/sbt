<script setup>
import Layout from "@/Layouts/Layout.vue";
import { PencilIcon, SwatchIcon, TagIcon } from '@heroicons/vue/24/outline';
import { router, useForm } from '@inertiajs/vue3';
import { List, Button, Select } from "@/Components";
import { useToast } from "@/Composables";
import { ref } from "vue";
import { useSessionStore } from "@/Stores/Session";


const userRole = () => useSessionStore().checkRole(['admin', 'kadiv'])

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
const gambar = props.santri.student.foto
    ? `/storage/siswa/${props.santri.student.foto}`
    : "/storage/user.jpg"



function toggle(item) {
    isActive.value = item
    localStorage.setItem('bidang', item)
}


function kategori(item) {
    if (item == 'h') return 'High'
    if (item == 'm') return 'Middle'
    if (item == 'l') return 'Low'

    return '-'
}

function toBidang(bidang) {
    router.get(route('santri.bidangUpdate'), {
        bidang: bidang,
        santri_id: props.santri.id,
        student_id: props.santri.student.id
    })
}


const formBidang = useForm({
    santri_id: props.santri.id,
    tahfidz: {
        kategori: props.tahfidz?.kategori ?? 0,
        plp_id: props.tahfidz?.plp_tahfidz_id ?? 0
    },
    it: {
        kategori: props.it?.kategori ?? 0,
        plp_id: props.it?.plp_it_id ?? 0
    },
    bahasa: {
        kategori: props.bahasa?.kategori ?? 0,
        plp_id: props.bahasa?.plp_bahasa_id ?? 0
    },
    karakter: {
        kategori: props.karakter?.kategori ?? 0,
        plp_id: props.karakter?.plp_karakter_id ?? 0
    },
})


function storeBidang() {
    formBidang.post(route('santri.bidangStore'), {
        onSuccess: () => useToast()
    })
}


function setLevel(item) {
    return item > 3 ? 2 : 1
}

</script>

<template>
    <Layout judul="Profil Santri">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-2">
            <div class="flex items-center space-x-4 md:col-span-2">
                <div class="w-24">
                    <img :src="gambar" class="w-full h-24 rounded-full object-top object-cover" alt="Foto Profil" />
                </div>
                <div class="space-y-2">
                    <div>{{ santri.student.nama }}</div>
                    <div class="text-sm text-slate-400">{{
                        'Kelas ' + santri.kelas_payung?.kelas + ' - Level ' + setLevel(santri.kelas_pondok?.kelas)
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

        <div class="col-span-12 bg-white p-4 shadow-xl border rounded-xl md:mt-4">

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
                    @click="toBidang('tahfidz')" v-if="tahfidz">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Tahfidz</h2>
                    <div class="mb-3">
                        <SwatchIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                        <span>{{ kategori(tahfidz.kategori) }}</span>
                    </div>
                    <div>
                        <TagIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                        <span>{{ tahfidz?.plp ?? '-' }}</span>
                    </div>
                </div>

                <!-- IT -->
                <div class="clickable md:hover:bg-slate-200 rounded-lg shadow-lg bg-slate-100 p-4"
                    @click="toBidang('it')" v-if="it">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">IT</h2>
                    <div class="mb-3">
                        <SwatchIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                        <span>{{ kategori(it.kategori) }}</span>
                    </div>
                    <div>
                        <TagIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                        <span>{{ it.plp ?? '-' }}</span>
                    </div>
                </div>

                <!-- Bahasa -->
                <div class="clickable md:hover:bg-slate-200 rounded-lg shadow-lg bg-slate-100 p-4"
                    @click="toBidang('bahasa')" v-if="bahasa">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Bahasa</h2>
                    <div class="mb-3">
                        <SwatchIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                        <span>{{ kategori(bahasa.kategori) }}</span>
                    </div>
                    <div>
                        <TagIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                        <span>{{ bahasa.plp ?? '-' }}</span>
                    </div>
                </div>

                <!-- Karakter -->
                <div class="clickable md:hover:bg-slate-200 rounded-lg shadow-lg bg-slate-100 p-4"
                    @click="toBidang('karakter')" v-if="karakter">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Karakter</h2>
                    <div class="mb-3">
                        <SwatchIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                        <span>{{ kategori(karakter.kategori) }}</span>
                    </div>
                    <div>
                        <TagIcon class="text-slate-600 w-7 h-7 inline mr-3" />
                        <span>{{ karakter.plp ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Catatan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" v-if="isActive == 'catatan'">
                <div class="rounded-lg bg-slate-100 p-4 clickable hover:bg-slate-200"
                    @click="$inertia.get(route('santri.catatan', { tipe: 'p', santri: santri.id }))">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Positif</h2>
                    <div class="space-y-3">
                        <template v-for="item in catatan.p">
                            <div>{{ item.judul }}</div>
                            <span class="text-slate-400 text-sm" v-if="item.catatan.length > 10">
                                {{ item.catatan.substr(0, 25) + ' ...' }}
                            </span>
                            <span class="text-slate-400 text-sm" v-else>
                                {{ item.catatan }}
                            </span>
                        </template>
                    </div>
                </div>

                <div class="rounded-lg bg-slate-100 p-4 clickable hover:bg-slate-200"
                    @click="$inertia.get(route('santri.catatan', { tipe: 'n', santri: santri.id }))">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Negatif</h2>
                    <div class="space-y-3">
                        <template v-for="item in catatan.n">
                            <div>{{ item.judul }}</div>
                            <span class="text-slate-400 text-sm" v-if="item.catatan.length > 10">
                                {{ item.catatan.substr(0, 25) + ' ...' }}
                            </span>
                            <span class="text-slate-400 text-sm" v-else>
                                {{ item.catatan }}
                            </span>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <template v-if="userRole()">
            <Button :class="{ hidden: isActive !== 'bidang' }" class="mt-4" color="success" data-modal-target="modalPlp"
                data-modal-toggle="modalPlp" @click="tes()">
                <PencilIcon class="h-4 w-4 md:inline hidden mr-2" />
                <span class="align-middle">Edit PLP</span>
            </Button>

            <!-- Modal Plp -->
            <div id="modalPlp" data-modal-backdrop="static" data-modal-placement="top-center" tabindex="-1"
                aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <form @submit.prevent="storeBidang()">
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    PLP
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="modalPlp">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>

                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div class="space-y-2 border rounded p-3">
                                    <div class="text-xl mb-2">Tahfidz</div>
                                    <Select label="PLP" v-model="formBidang.tahfidz.plp_id">
                                        <option :value="0">-</option>
                                        <option :value="item.id" v-for="item in plpTahfidz">{{ item.plp }}</option>
                                    </Select>
                                    <Select label="Kategori" v-model="formBidang.tahfidz.kategori">
                                        <option :value="0">-</option>
                                        <option value="l">Low</option>
                                        <option value="m">Middle</option>
                                        <option value="h">High</option>
                                    </Select>
                                </div>
                                <div class="space-y-2 border rounded p-3">
                                    <div class="text-xl mb-2">IT</div>
                                    <Select label="PLP" v-model="formBidang.it.plp_id">
                                        <option :value="0">-</option>
                                        <option :value="item.id" v-for="item in plpIt">{{ item.plp }}</option>
                                    </Select>
                                    <Select label="Kategori" v-model="formBidang.it.kategori">
                                        <option :value="0">-</option>
                                        <option value="l">Low</option>
                                        <option value="m">Middle</option>
                                        <option value="h">High</option>
                                    </Select>
                                </div>
                                <div class="space-y-2 border rounded p-3">
                                    <div class="text-xl mb-2">Bahasa</div>
                                    <Select label="PLP" v-model="formBidang.bahasa.plp_id">
                                        <option :value="0">-</option>
                                        <option :value="item.id" v-for="item in plpBahasa">{{ item.plp }}</option>
                                    </Select>
                                    <Select label="Kategori" v-model="formBidang.bahasa.kategori">
                                        <option :value="0">-</option>
                                        <option value="l">Low</option>
                                        <option value="m">Middle</option>
                                        <option value="h">High</option>
                                    </Select>
                                </div>
                                <div class="space-y-2 border rounded p-3">
                                    <div class="text-xl mb-2">Karakter</div>
                                    <Select label="PLP" v-model="formBidang.karakter.plp_id">
                                        <option :value="0">-</option>
                                        <option :value="item.id" v-for="item in plpKarakter">{{ item.plp }}</option>
                                    </Select>
                                    <Select label="Kategori" v-model="formBidang.karakter.kategori">
                                        <option :value="0">-</option>
                                        <option value="l">Low</option>
                                        <option value="m">Middle</option>
                                        <option value="h">High</option>
                                    </Select>
                                </div>
                            </div>

                            <div
                                class="flex justify-between items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <Button data-modal-hide="modalPlp" color="dark">Tutup</Button>
                                <Button data-modal-hide="modalPlp" type="submit">Simpan</Button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>



    </Layout>
</template>