<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Table, Th, Td, Input, Button, Select } from '@/Components';
import { FunnelIcon } from '@heroicons/vue/24/outline';
import { router, useForm } from '@inertiajs/vue3';
import { useToast } from "@/Composables";
import { debounce } from "lodash";
import { reactive, watch } from 'vue';

const props = defineProps({
    'siswa': {
        type: Array,
        default: () => []
    },
    kelas_pondok: {
        type: Array,
        default: () => []
    },
    kelas_payung: {
        type: Object,
        default: () => ({})
    },
})


const cariSiswa = reactive({
    siswa: true,
    nama: props.siswa.nama,
    gender: props.siswa.gender
})

watch(cariSiswa, debounce((item) => {
    router.get(route('santri.assigne'), item, {
        only: ['siswa'],
        replace: true,
        preserveState: true
    })
}, 300))

const formSiswa = useForm({
    nama: null,
    student_id: null,
    kelas_pondok_id: null,
    kelas_payung_id: null
})


function setForm(id, nama) {
    formSiswa.nama = nama
    formSiswa.student_id = id
}

function assigne() {
    formSiswa.post(route('santri.assigne-store'), {
        onSuccess: () => useToast()
    })
}

</script>

<template>
    <Layout judul="Assigne Santri">

        <div class="flex space-x-2 mb-3">
            <Input placeholder="cari nama" v-model="cariSiswa.nama" />
            <Button color="warning" data-modal-target="defaultModal" data-modal-toggle="defaultModal">
                <FunnelIcon class="h-4 w-4 md:inline hidden mr-2" />
                <span class="align-middle">Filter</span>
            </Button>
        </div>

        <!-- Modal -->
        <div id="defaultModal" data-modal-placement="top-center" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl text-gray-900 dark:text-white">
                            Filter Siswa
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="defaultModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="p-6 space-y-6">
                        <Select label="Jenis Kelamin" required v-model="cariSiswa.gender">
                            <option value="0">-</option>
                            <option value="l">Laki-laki</option>
                            <option value="p">Perempuan</option>
                        </Select>
                    </div>
                </div>
            </div>
        </div>

        <Table :items="siswa" class="max-h-[calc(100vh-12rem)]">
            <template #head>
                <Th>Foto</Th>
                <Th>Nama</Th>
                <Th>Assigne</Th>
            </template>
            <template #body="{ item }">
                <Td>
                    <div class="w-16">
                        <img :src="item.foto ? `/storage/siswa/${item.foto}` : `/storage/user.jpg`"
                            class="w-full h-16 rounded-full object-top object-cover" alt="Foto Profil" />
                    </div>
                </Td>
                <Td>{{ item.nama }}</Td>
                <Td>
                    <Button color="secondary" data-modal-target="staticModal" data-modal-toggle="staticModal"
                        @click="setForm(item.id, item.nama)">Assigne</Button>
                </Td>
            </template>
        </Table>


        <!-- Modal -->
        <div id="staticModal" data-modal-placement="top-center" data-modal-backdrop="static" tabindex="-1"
            aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <form @submit.prevent="assigne()">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl text-gray-900 dark:text-white">
                                Assigne Siswa
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="staticModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Body -->
                        <div class="p-6 space-y-6">
                            <Input label="Nama" readonly v-model="formSiswa.nama" />
                            <Select label="Kelas Pondok" required v-model="formSiswa.kelas_pondok_id">
                                <option :value="item.id" v-for="item in kelas_pondok">{{ item.kelas }}</option>
                            </Select>
                            <Select label="Kelas Payung" required v-model="formSiswa.kelas_payung_id">
                                <option :value="item.id" v-for="item in kelas_payung">{{ item.kelas }}</option>
                            </Select>
                        </div>

                        <div
                            class="justify-between flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <Button data-modal-hide="staticModal" color="dark">Tutup</Button>
                            <Button data-modal-hide="staticModal" type="submit">Simpan</Button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </Layout>
</template>