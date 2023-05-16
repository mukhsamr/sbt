<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Table, Th, Td, Input, Select, BtnIcon, Button } from '@/Components';
import { UserIcon, FunnelIcon, ArrowsRightLeftIcon } from '@heroicons/vue/24/outline';
import { reactive, watch } from 'vue';
import { debounce } from "lodash";
import { router } from '@inertiajs/vue3';
import { useSessionStore } from "@/Stores/Session";

const userRole = (role) => useSessionStore().checkRole(role)

const props = defineProps({
    daftar: {
        type: Array,
        default: () => []
    },
    kelas_payung: {
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


</script>

<template>
    <Layout judul="Santri">

        <div class="grid grid-cols-1 my-4 gap-2">
            <div v-if="userRole(['admin', 'tu'])">
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
                <Th>Kelas</Th>
                <Th>Usia</Th>
                <Th>Aksi</Th>
            </template>
            <template #body="{ item }">
                <Td>
                    <div class="w-16">
                        <img :src="item.student.foto ? `/storage/siswa/${item.student.foto}` : `/storage/user.jpg`"
                            class="rounded-full w-full h-16 object-top object-cover" alt="Foto Profil" />
                    </div>
                </Td>
                <Td>{{ item.student.nama }}</Td>
                <Td>{{ item.kelas_payung ?? '-' }}</Td>
                <Td>{{ item.student.usia }}</Td>
                <Td>
                    <div class="flex space-x-4">
                        <BtnIcon :icon="UserIcon" class="text-purple-600"
                            @click="$inertia.get(route('santri.profil', item.id))">
                            Profil
                        </BtnIcon>
                    </div>
                </Td>
            </template>
        </Table>

    </Layout>
</template>