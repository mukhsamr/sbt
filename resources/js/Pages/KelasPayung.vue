<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Table, Th, Td, Button, BtnIcon, Input } from "@/Components";
import { useToast, useConfirm } from "@/Composables";
import { TrashIcon, PencilSquareIcon } from "@heroicons/vue/24/outline";
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

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
        Inertia.delete(route('kelas-payung.destroy', item.id), {
            onSuccess: () => useToast()
        })
    }
}

</script>

<template>
    <Layout judul="Kelas Payung">
        <Button color="success" class="mb-2 float-right" data-bs-toggle="modal"
            data-bs-target="#modalTambah">Tambah</Button>
        <Table :items="daftar">
            <template #head>
                <Th>Kelas</Th>
                <Th>Siswa</Th>
                <Th>Aksi</Th>
            </template>
            <template #body="{ item }">
                <Td>{{ item.kelas }}</Td>
                <Td>{{ item.santris_count }}</Td>
                <Td class="flex space-x-4">
                    <BtnIcon :icon="PencilSquareIcon" class="text-blue-600" data-bs-toggle="modal"
                        data-bs-target="#modalEdit" @click="editModal(item)">Edit</BtnIcon>
                    <BtnIcon :icon="TrashIcon" class="text-red-600" @click="hapus(item)">Hapus</BtnIcon>
                </Td>
            </template>
        </Table>


        <!-- Modal Tambah -->
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <form @submit.prevent="store()"
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div
                        class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                            Tambah
                        </h5>
                        <button type="button"
                            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body relative p-4">
                        <Input label="Kelas" v-model="formTambah.kelas" required />
                    </div>
                    <div
                        class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end space-x-2 p-4 border-t border-gray-200 rounded-b-md">
                        <Button type="button" color="secondary" data-bs-dismiss="modal">Tutup</Button>
                        <Button type="submit" data-bs-dismiss="modal">Simpan</Button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalEditLabel" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <form @submit.prevent="update()"
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div
                        class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                            Edit
                        </h5>
                        <button type="button"
                            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body relative p-4">
                        <Input label="Kelas" v-model="formEdit.kelas" required />
                    </div>
                    <div
                        class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end space-x-2 p-4 border-t border-gray-200 rounded-b-md">
                        <Button type="button" color="secondary" data-bs-dismiss="modal">Tutup</Button>
                        <Button type="submit" data-bs-dismiss="modal" color="warning">Update</Button>
                    </div>
                </form>
            </div>
        </div>
    </Layout>
</template>