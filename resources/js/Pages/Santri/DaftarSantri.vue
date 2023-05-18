<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Table, Th, Td, Input, Select, BtnIcon, Button } from '@/Components';
import { UserIcon, FunnelIcon, ArrowsRightLeftIcon, TrashIcon, PencilSquareIcon } from '@heroicons/vue/24/outline';
import { reactive, watch } from 'vue';
import { debounce } from "lodash";
import { router, useForm } from '@inertiajs/vue3';
import { useSessionStore } from "@/Stores/Session";
import { useToast, useConfirm } from "@/Composables";

const userRole = () => useSessionStore().checkRole(['admin', 'tu'])

const props = defineProps({
    daftar: {
        type: Array,
        default: () => []
    },
    kelas_payung: {
        type: Array,
        default: () => []
    },
    kelas_pondok: {
        type: Array,
        default: () => []
    },
    cari: {
        type: Object,
        default: () => ({})
    },
})

const formCari = reactive({
    limit: props.cari.limit ?? 10,
    nama: props.cari.nama,
    gender: props.cari.gender ?? 0,
    kelas_payung: props.cari.kelas_payung ?? 0,
})


watch(formCari, debounce((item) => {
    router.get(route('santri.index'), item, {
        replace: true,
        preserveState: true
    })
}, 300))


async function hapus(id) {
    const cond = await useConfirm('Hapus santri')

    if (cond) {
        router.delete(route('santri.assigne-remove', id), {
            onSuccess: () => useToast()
        })
    }

}

const formSantri = useForm({
    id: null,
    nama: null,
    kelas_payung_id: null,
    kelas_pondok_id: null
})

function setForm(item) {
    formSantri.id = item.id
    formSantri.nama = item.student.nama
    formSantri.kelas_payung_id = item.kelas_payung.id
    formSantri.kelas_pondok_id = item.kelas_pondok.id
}

function updateSantri() {
    formSantri.patch(route('santri.assigne-update'), {
        onSuccess: () => useToast()
    })
}



</script>

<template>
    <Layout judul="Santri">

        <div class="grid grid-cols-1 my-4 gap-2">
            <div v-if="userRole()">
                <Button color="secondary" @click="$inertia.get(route('santri.assigne'))">
                    <ArrowsRightLeftIcon class="h-4 w-4 hidden md:inline mr-2" />
                    <span class="align-middle">Assigne</span>
                </Button>
            </div>

            <div class="flex space-x-2">
                <Input placeholder="cari nama" v-model="formCari.nama" />
                <div class="flex space-x-2 ml-4">
                    <Button color="warning" data-modal-target="defaultModal" data-modal-toggle="defaultModal">
                        <FunnelIcon class="h-4 w-4 hidden md:inline mr-2" />
                        <span class="align-middle">Filter</span>
                    </Button>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div id="defaultModal" data-modal-placement="top-center" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl text-gray-900 dark:text-white">
                            Filter Santri
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
                        <Select label="Limit" v-model="formCari.limit">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="0">Semua</option>
                        </Select>
                        <Select label="Jenis Kelamin" v-model="formCari.gender">
                            <option value="0">-</option>
                            <option value="l">Laki-laki</option>
                            <option value="p">Perempuan</option>
                        </Select>
                        <Select label="Kelas" v-model="formCari.kelas_payung">
                            <option value="0">-</option>
                            <option :value="item.id" v-for="item in kelas_payung">{{ item.kelas }}</option>
                        </Select>
                    </div>
                </div>
            </div>
        </div>

        <Table :items="daftar">
            <template #head>
                <Th>Foto</Th>
                <Th>Santri</Th>
                <Th>Usia</Th>
                <Th>Kelas Payung</Th>
                <Th>Kelas Pondok</Th>
                <Th>Profil</Th>
                <Th v-if="userRole()">Aksi</Th>
            </template>
            <template #body="{ item }">
                <Td>
                    <div class="w-16">
                        <img :src="item.student.foto ? `/storage/siswa/${item.student.foto}` : `/storage/user.jpg`"
                            class="rounded-full w-full h-16 object-top object-cover" alt="Foto Profil" />
                    </div>
                </Td>
                <Td>{{ item.student.nama }}</Td>
                <Td>{{ item.student.usia }}</Td>
                <Td>{{ item.kelas_payung?.kelas ?? '-' }}</Td>
                <Td>{{ item.kelas_pondok?.kelas ?? '-' }}</Td>
                <Td>
                    <BtnIcon :icon="UserIcon" class="text-purple-600"
                        @click="$inertia.get(route('santri.profil', item.id))">
                        Profil
                    </BtnIcon>
                </Td>
                <Td v-if="userRole()">
                    <div class="flex space-x-4">
                        <BtnIcon :icon="PencilSquareIcon" class="text-blue-600" data-modal-target="staticModal"
                            data-modal-toggle="staticModal" @click="setForm(item)">Edit</BtnIcon>
                        <BtnIcon :icon="TrashIcon" class="text-red-600" @click="hapus(item.id)">Hapus</BtnIcon>
                    </div>
                </Td>
            </template>
        </Table>


        <!-- Modal -->
        <div id="staticModal" data-modal-placement="top-center" data-modal-backdrop="static" tabindex="-1"
            aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <form @submit.prevent="updateSantri()">
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
                            <Input label="Nama" readonly v-model="formSantri.nama" />
                            <Select label="Kelas Pondok" required v-model="formSantri.kelas_pondok_id">
                                <option :value="item.id" v-for="item in kelas_pondok">{{ item.kelas }}</option>
                            </Select>
                            <Select label="Kelas Payung" required v-model="formSantri.kelas_payung_id">
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