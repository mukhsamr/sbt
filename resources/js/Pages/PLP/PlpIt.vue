<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Table, Th, Td, Button, BtnIcon, Input } from "@/Components";
import { useToast, useConfirm } from "@/Composables";
import { TrashIcon, PencilSquareIcon, PlusIcon } from "@heroicons/vue/24/outline";
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { useSessionStore } from "@/Stores/Session";


const userRole = () => useSessionStore().checkRole(['admin', 'kadiv'])

defineProps({
    daftar: {
        type: Array,
        default: () => []
    }
})


const formTambah = useForm({
    plp: null
})

const formEdit = useForm({
    id: null,
    plp: null
})



function editModal(item) {
    formEdit.id = item.id
    formEdit.plp = item.plp
}

function store() {
    formTambah.post(route('plp-it.store'), {
        onSuccess: () => useToast(),
        onError: (err) => useToast({
            icon: 'error',
            title: err.plp
        }),
        preserveState: false
    })
}

function update() {
    formEdit.patch(route('plp-it.update'), {
        onSuccess: () => useToast(),
        onError: (err) => useToast({
            icon: 'error',
            title: err.plp
        }),
        preserveState: false
    })
}

async function hapus(item) {
    const cond = await useConfirm('Hapus plp')

    if (cond) {
        router.delete(route('plp-it.destroy', item.id), {
            onSuccess: () => useToast()
        })
    }
}

</script>

<template>
    <Layout judul="PLP IT">
        <Button color="success" class="mb-2 flex" data-modal-target="modalTambah" data-modal-toggle="modalTambah"
            v-if="userRole()">
            <PlusIcon class="h-4 w-4 md:inline mr-2 hidden" />
            <div class="align-middle">Tambah</div>
        </Button>
        <Table :items="daftar">
            <template #head>
                <Th>PLP</Th>
                <Th>Siswa</Th>
                <Th v-if="userRole()">Aksi</Th>
            </template>
            <template #body="{ item }">
                <Td>{{ item.plp }}</Td>
                <Td>{{ item.santris_count }}</Td>
                <Td v-if="userRole()" class="flex space-x-4">
                    <BtnIcon :icon="PencilSquareIcon" class="text-blue-600" data-modal-target="modalEdit"
                        data-modal-toggle="modalEdit" @click="editModal(item)">Edit</BtnIcon>
                    <div>
                        <BtnIcon :icon="TrashIcon" disabled v-if="item.santris_count">Hapus</BtnIcon>
                        <BtnIcon :icon="TrashIcon" class="text-red-600" @click="hapus(item)" v-else>Hapus</BtnIcon>
                    </div>
                </Td>
            </template>
        </Table>


        <template v-if="userRole()">
            <!-- Modal Tambah -->
            <div id="modalTambah" data-modal-placement="top-center" data-modal-backdrop="static" tabindex="-1"
                aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <form @submit.prevent="store()">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Tambah PLP
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="modalTambah">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-6 space-y-6">
                                <Input label="PLP" v-model="formTambah.plp" required />
                            </div>
                            <div
                                class="flex justify-between items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <Button data-modal-hide="modalTambah" color="dark">Tutup</Button>
                                <Button data-modal-hide="modalTambah" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Edit -->
            <div id="modalEdit" data-modal-placement="top-center" data-modal-backdrop="static" tabindex="-1"
                aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <form @submit.prevent="update()">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Edit PLP
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="modalEdit">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-6 space-y-6">
                                <Input label="PLP" v-model="formEdit.plp" required />
                            </div>
                            <div
                                class="flex justify-between items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <Button data-modal-hide="modalEdit" color="dark">Tutup</Button>
                                <Button data-modal-hide="modalEdit" type="submit">Simpan</Button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </Layout>
</template>