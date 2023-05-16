<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Table, Th, Td, Button, BtnIcon, Input } from "@/Components";
import { useToast, useConfirm } from "@/Composables";
import { TrashIcon, PencilSquareIcon, PlusIcon } from "@heroicons/vue/24/outline";
import { router, useForm } from '@inertiajs/vue3';
import { useSessionStore } from "@/Stores/Session";


const userRole = () => useSessionStore().checkRole(['admin', 'tu'])

defineProps({
    daftar: {
        type: Array,
        default: () => []
    }
})


const formTambah = useForm({
    kelas: null
})

const formEdit = useForm({
    id: null,
    kelas: null
})



function editModal(item) {
    formEdit.id = item.id
    formEdit.kelas = item.kelas
}

function store() {
    formTambah.post(route('kelas-payung.store'), {
        onSuccess: () => useToast(),
        onError: (err) => useToast({
            icon: 'error',
            title: err.kelas
        }),
        preserveState: false
    })
}

function update() {
    formEdit.patch(route('kelas-payung.update'), {
        onSuccess: () => useToast(),
        onError: (err) => useToast({
            icon: 'error',
            title: err.kelas
        }),
        preserveState: false
    })
}

async function hapus(item) {
    const cond = await useConfirm('Hapus kelas payung')

    if (cond) {
        router.delete(route('kelas-payung.destroy', item.id), {
            onSuccess: () => useToast()
        })
    }
}

</script>

<template>
    <Layout judul="Kelas Payung">
        <Button v-if="userRole()" color="success" class="mb-2" data-modal-target="modalTambah"
            data-modal-toggle="modalTambah">
            <PlusIcon class="h-4 w-4 md:inline mr-2 hidden" />
            <span class="align-middle whitespace-nowrap">Tambah</span>
        </Button>
        <Table :items="daftar">
            <template #head>
                <Th>Kelas</Th>
                <Th>Siswa</Th>
                <Th v-if="userRole()">Aksi</Th>
            </template>
            <template #body="{ item }">
                <Td>{{ item.kelas }}</Td>
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
            <div id="modalTambah" tabindex="-1" aria-hidden="true" data-modal-placement="top-center"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <form @submit.prevent="store">
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Tambah Kelas
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="modalTambah">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>

                            <div class="p-6 space-y-6">
                                <Input label="Kelas" type="number" v-model="formTambah.kelas" required />
                            </div>

                            <div
                                class="justify-between flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

                                <Button data-modal-hide="modalTambah" type="button" color="secondary"
                                    data-bs-dismiss="modal">Tutup</Button>
                                <Button data-modal-hide="modalTambah" type="submit"
                                    data-bs-dismiss="modal">Simpan</Button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div id="modalEdit" tabindex="-1" aria-hidden="true" data-modal-placement="top-center"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <form @submit.prevent="update">
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Tambah Kelas
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="modalEdit">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>

                            <div class="p-6 space-y-6">
                                <Input label="Kelas" type="number" v-model="formEdit.kelas" required />
                            </div>

                            <div
                                class="justify-between flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

                                <Button data-modal-hide="modalEdit" type="button" color="secondary"
                                    data-bs-dismiss="modal">Tutup</Button>
                                <Button data-modal-hide="modalEdit" type="submit"
                                    data-bs-dismiss="modal">Simpan</Button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </template>

    </Layout>
</template>