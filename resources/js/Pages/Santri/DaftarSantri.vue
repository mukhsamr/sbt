<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Table, Th, Td, Input, Select, BtnIcon, Button } from '@/Components';
import { UserIcon, FunnelIcon } from '@heroicons/vue/24/outline';
import { reactive, watch } from 'vue';
import { chunk, debounce } from "lodash";
import { router } from '@inertiajs/vue3';


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
    nama: props.cari.nama,
    kelas_payung: props.cari.kelas_payung,
})


watch(formCari, debounce((item) => {
    router.get(route('santri.index'), item, {
        preserveState: true
    })
}, 300))


function filter() {

}

</script>

<template>
    <Layout judul="Santri">

        <div class="flex justify-between my-4">
            <Input placeholder="cari nama" v-model="formCari.nama" />
            <div class="flex space-x-2 ml-4">
                <Button color="warning" data-modal-target="staticModal" data-modal-toggle="staticModal">
                    <FunnelIcon class="h-4 w-4 inline mr-2" />
                    <span class="align-middle">Filter</span>
                </Button>
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
                    <img :src="item.student.foto ? `/storage/siswa/${item.student.foto}` : `/storage/user.jpg`"
                        class="rounded-full w-16 h-16 object-top object-cover" alt="Foto Profil" />
                </Td>
                <Td>{{ item.student.nama }}</Td>
                <Td>{{ item.kelas_payung }}</Td>
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


        <!-- Modal -->
        <div id="staticModal" data-modal-backdrop="static" data-modal-placement="top-center" tabindex="-1"
            aria-hidden="true"
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
                        <form @submit.prevent="filter()">
                            <Select label="Kelas" required v-model="formCari.kelas_payung">
                                <option value="0">-</option>
                                <option :value="item.id" v-for="item in kelas_payung">{{ item.kelas }}</option>
                            </Select>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <Button color="warning" data-modal-hide="staticModal">Filter</Button>
                    </div>
                </div>
            </div>
        </div>

    </Layout>
</template>