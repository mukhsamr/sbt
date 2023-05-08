<script setup>
import Layout from '@/Layouts/Layout.vue';
import { SwatchIcon, TagIcon } from '@heroicons/vue/24/outline';
import { Button, Select } from "@/Components";
import { useToast } from "@/Composables";
import { useForm } from '@inertiajs/vue3';


const props = defineProps({
    daftar: {
        type: Array,
        default: () => []
    },
    bidang: {
        type: Object,
        default: () => ({})
    },
    tipe: String,
    list_plp: {
        type: Object,
        default: () => ({})
    },
})

function kategoriWarna(item) {
    return {
        l: 'bg-yellow-300 text-yellow-700',
        m: 'bg-blue-300 text-blue-700',
        h: 'bg-red-300 text-red-700',
    }[item]
}

function kategori(item) {
    if (item == 'h') return 'High'
    if (item == 'm') return 'Middle'
    if (item == 'l') return 'Low'
}


const bidangTypeId = 'plp_' + props.tipe + '_id'

const formBidang = useForm({
    bidang: props.tipe,
    santri_id: props.bidang.santri_id,
    [bidangTypeId]: props.bidang[bidangTypeId],
    kategori: props.bidang.kategori
})


function updateBidang() {
    formBidang.patch(route('santri.bidangUpdate'), {
        onSuccess: () => useToast()
    })
}

</script>

<template>
    <Layout :judul="`Bidang ${tipe}`">
        <div class="p-6 bg-white grid grid-cols-1 md:grid-cols-2 gap-24">
            <div class="space-y-8">
                <div>
                    <h3 class="text-lg text-slate-400">Present Learning Package</h3>
                    <div class="flex mt-2">
                        <TagIcon class="h-7 w-7 mr-4" />
                        <div class="text-xl my-auto">{{ bidang.plp }}</div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg text-slate-400">Level Siswa</h3>
                    <div class="flex mt-2">
                        <SwatchIcon class="h-7 w-7 mr-4" />
                        <div class="text-xl my-auto">{{ kategori(bidang.kategori) }}</div>
                    </div>
                </div>

                <Button color="secondary" data-modal-target="staticModal" data-modal-toggle="staticModal">Edit</Button>

                <!-- Main modal -->
                <div id="staticModal" data-modal-placement="top-center" data-modal-backdrop="static" tabindex="-1"
                    aria-hidden="true"
                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <form @submit.prevent="updateBidang()">
                                <!-- Modal header -->
                                <div
                                    class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Edit PLP Tahfidz
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
                                <div class="modal-body relative p-4 space-y-3">
                                    <Select label="PLP" required v-model="formBidang[bidangTypeId]">
                                        <option :value="item.id" v-for="item in list_plp">{{ item.plp }}</option>
                                    </Select>
                                    <Select label="Level" required v-model="formBidang.kategori">
                                        <option value="l">Low</option>
                                        <option value="m">Middle</option>
                                        <option value="h">High</option>
                                    </Select>
                                </div>
                                <div
                                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-between p-4 border-t border-gray-200 rounded-b-md">
                                    <Button color="secondary" data-modal-hide="staticModal">Tutup</Button>
                                    <Button type="submit" data-modal-hide="staticModal">Simpan</Button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

            <div>
                <h3 class="text-xl text-slate-400">Tahun ajaran sebelumnya</h3>

                <div class="divide-y mt-4">
                    <template v-for="item in daftar">
                        <div class="grid grid-cols-2 py-4">
                            <div class="flex space-x-4 items-center">
                                <div class="rounded-full w-10 h-10 flex items-center justify-center"
                                    :class="kategoriWarna(item.kategori)">
                                    <span class="uppercase">{{ item.kategori }}</span>
                                </div>
                                <div>
                                    <div>Kelas {{ item.santri.kelas_payung.kelas }}</div>
                                    <div class="text-sm text-slate-400">Semester {{ item.santri.semester.semester }}
                                    </div>
                                </div>


                            </div>
                            <div class="flex">
                                <TagIcon class="h-7 w-7 text-slate-800 mr-4" />
                                <div>{{ item.plp }}</div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </Layout>
</template>