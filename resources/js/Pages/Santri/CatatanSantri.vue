<script setup>
import Layout from "@/Layouts/Layout.vue";
import { PencilSquareIcon, PlusIcon } from '@heroicons/vue/24/outline';
import { useToast } from '@/Composables';
import { useForm } from "@inertiajs/vue3";
import { Textarea, Input, Select, Button } from '@/Components';

const props = defineProps({
    tipe: String,
    santri: {
        type: Object,
        default: () => ({})
    },
    catatan: {
        type: Array,
        default: () => []
    },
    teacher: {
        type: Array,
        default: () => []
    },
})

const formEdit = useForm({
    id: null,
    judul: null,
    teacher_id: null,
    catatan: null
})

const formTambah = useForm({
    judul: null,
    santri_id: props.santri.id,
    teacher_id: null,
    catatan: null
})


function setModel(item) {
    formEdit.id = item.id
    formEdit.judul = item.judul
    formEdit.teacher_id = item.teacher_id
    formEdit.catatan = item.catatan
}

function update() {
    formEdit.patch(route('santri.catatanUpdate'), {
        onSuccess: () => useToast()
    })
}

function store() {
    formTambah.post(route('santri.catatanStore'), {
        onSuccess: () => useToast()
    })
}

function back() {
    window.history.back()
}

</script>

<template>

    <Layout :judul="'Catatan ' + (tipe == 'p' ? 'Positif' : 'Negatif')">
        <div class="space-y-4 mt-4">
            <Button color="success" data-modal-target="modalTambah" data-modal-toggle="modalTambah">
                <div class="flex">
                    <div class="align-middle">Tambah</div>
                    <PlusIcon class="h-4 w-4 inline ml-2" />
                </div>
            </Button>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <template v-for="item in catatan">
                    <div class="rounded-lg p-4 bg-slate-100 hover:bg-slate-300 relative">
                        <div data-modal-target="modalEdit" data-modal-toggle="modalEdit" @click="setModel(item)">
                            <PencilSquareIcon class="h-6 w-6 text-slate-600 absolute right-4 clickable" />
                        </div>
                        <h3 class="text-xl mb-2">{{ item.judul }}</h3>
                        <div class="text-slate-400 text-xs">{{ item.teacher.jabatan }}</div>
                        <div class="text-slate-400 text-xs">{{ item.teacher.nama }}</div>

                        <div class="flex space-x-2 mt-4">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="h-6 w-6 text-green-600" viewBox="0 0 16 16">
                                    <path
                                        d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z" />
                                </svg>
                            </div>
                            <p>{{ item.catatan }}</p>
                        </div>
                    </div>
                </template>
            </div>
        </div>



        <!-- Modal Tambah -->
        <div id="modalTambah" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <form @submit.prevent="store()">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Tambah Catatan
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
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <Select label="Guru" required v-model="formTambah.teacher_id">
                                <option :value="item.id" v-for="item in teacher">{{ item.nama }}</option>
                            </Select>
                            <Input label="Judul" required v-model="formTambah.judul" />
                            <Textarea label="Catatan" required v-model="formTambah.catatan" />
                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <Button data-modal-hide="modalTambah" color="secondary">Tutup</Button>
                            <Button data-modal-hide="modalTambah" type="submit">Simpan</Button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- Modal Edit -->
        <div id="modalEdit" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <form @submit.prevent="update()">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Catatan
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
                            <Select label="Guru" required v-model="formEdit.teacher_id">
                                <option :value="item.id" v-for="item in teacher">{{ item.nama }}</option>
                            </Select>
                            <Input label="Judul" required v-model="formEdit.judul" />
                            <Textarea label="Catatan" required v-model="formEdit.catatan" />
                        </div>
                        <div
                            class="flex justify-between items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <Button data-modal-hide="modalEdit" color="secondary">Tutup</Button>
                            <Button data-modal-hide="modalEdit" type="submit">Simpan</Button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </Layout>

</template>