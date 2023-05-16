<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Table, Th, Td, BtnIcon, Input, Select, Button } from "@/Components";
import { useToast, useConfirm } from "@/Composables";
import { InboxIcon, TrashIcon, PencilSquareIcon, FunnelIcon, PlusIcon, NoSymbolIcon } from "@heroicons/vue/24/outline";
import { router } from "@inertiajs/vue3";
import { reactive, watch } from "vue";
import { debounce } from "lodash";
import { useSessionStore } from "@/Stores/Session";


const userRole = () => useSessionStore().checkRole(['admin', 'tu'])

const props = defineProps({
    daftar: {
        type: Array,
        default: () => []
    },
    cari: {
        type: Object,
        default: () => ({})
    }
})


function toProfil(item) {
    router.get(route('siswa.profil', item.id))
}


async function disable(id) {
    const cond = await useConfirm('Nonaktifkan Siswa?')

    if (cond) {
        router.delete(route('siswa.remove', id), {
            onSuccess: () => useToast()
        })
    }
}


async function hapus(id) {
    const cond = await useConfirm('Hapus siswa')

    if (cond) {
        router.delete(route('siswa.destroy', id), {
            onSuccess: () => useToast()
        })
    }
}


const formCari = reactive({
    nama: props.cari.nama,
    gender: props.cari.gender ?? 0,
    limit: props.cari.limit,
})


watch(formCari, debounce((item) => {
    router.get(route('siswa.index'), item, {
        replace: true,
        preserveState: true
    })
}, 300))

</script>

<template>
    <Layout judul="Daftar Siswa">

        <div class="grid grid-cols-1 my-4 gap-2">
            <div v-if="userRole()">
                <Button class="flex" color="success" @click="$inertia.get(route('siswa.create'))">
                    <PlusIcon class="h-4 w-4 md:inline mr-2 hidden" />
                    <span class="align-middle whitespace-nowrap">Tambah Siswa</span>
                </Button>
            </div>

            <div class="flex space-x-2">
                <Input placeholder="cari nama" v-model="formCari.nama" />
                <Button color="warning" data-modal-target="defaultModal" data-modal-toggle="defaultModal">
                    <FunnelIcon class="h-4 w-4 md:inline hidden mr-2" />
                    <span class="align-middle">Filter</span>
                </Button>
            </div>
        </div>

        <Table :items="daftar">
            <template #head>
                <Th>Foto</Th>
                <Th>Nama</Th>
                <Th>NIK</Th>
                <Th>Usia</Th>
                <Th>Profil</Th>
                <Th v-if="userRole()">Aksi</Th>
            </template>
            <template #body="{ item }">
                <Td>
                    <div class="w-16">
                        <img :src="item.foto ? `/storage/siswa/${item.foto}` : `/storage/user.jpg`"
                            class="w-full h-16 rounded-full object-top object-cover" alt="Foto Profil" />
                    </div>
                </Td>
                <Td>{{ item.nama }}</Td>
                <Td>{{ item.nik }}</Td>
                <Td>{{ item.usia }}</Td>
                <Td>
                    <BtnIcon :icon="InboxIcon" class="text-amber-600" @click="toProfil(item)">Biodata</BtnIcon>
                </Td>
                <Td v-if="userRole()">
                    <div class="flex space-x-4">
                        <BtnIcon :icon="PencilSquareIcon" class="text-blue-600"
                            @click="router.get(route('siswa.edit', item.id))">Edit</BtnIcon>
                        <!-- <BtnIcon :icon="NoSymbolIcon" class="text-slate-600" @click="disable(item.id)">Disable</BtnIcon> -->

                        <BtnIcon :icon="TrashIcon" class="text-red-600" @click="hapus(item.id)">Hapus</BtnIcon>
                    </div>
                </Td>
            </template>
        </Table>

        <!-- Modal -->
        <template v-if="userRole()">
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
                            <Select label="Limit" required v-model="formCari.limit">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="0">Semua</option>
                            </Select>
                            <Select label="Jenis Kelamin" required v-model="formCari.gender">
                                <option value="0">-</option>
                                <option value="l">Laki-laki</option>
                                <option value="p">Perempuan</option>
                            </Select>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Layout>
</template>