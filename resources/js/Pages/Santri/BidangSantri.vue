<script setup>
import Layout from '@/Layouts/Layout.vue';
import { SwatchIcon, TagIcon } from '@heroicons/vue/24/outline';

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

    return '-'
}
</script>

<template>
    <Layout :judul="`Bidang ${tipe.toUpperCase()}`">
        <div class="p-6 bg-white grid grid-cols-1 md:grid-cols-2 gap-24">
            <div class="space-y-8">
                <div>
                    <h3 class="text-lg text-slate-400">Present Learning Package</h3>
                    <div class="flex mt-2">
                        <TagIcon class="h-7 w-7 mr-4" />
                        <div class="text-xl my-auto">{{ bidang.plp ?? '-' }}</div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg text-slate-400">Level Siswa</h3>
                    <div class="flex mt-2">
                        <SwatchIcon class="h-7 w-7 mr-4" />
                        <div class="text-xl my-auto">{{ kategori(bidang.kategori) }}</div>
                    </div>
                </div>

            </div>

            <div>
                <h3 class="text-xl text-slate-400">Riwayat</h3>

                <div class="divide-y mt-4">
                    <template v-for="item in daftar">
                        <div class="grid grid-cols-2 py-4">
                            <div class="flex space-x-4 items-center">
                                <div class="rounded-full w-10 h-10 flex items-center justify-center"
                                    :class="kategoriWarna(item.kategori)">
                                    <span class="uppercase">{{ item.kategori ?? '-' }}</span>
                                </div>
                                <div>
                                    <div>Kelas {{ item.santri.kelas_payung.kelas }}</div>
                                    <div class="text-sm text-slate-400">Semester {{ item.santri.semester.semester }}
                                    </div>
                                </div>


                            </div>
                            <div class="flex">
                                <TagIcon class="h-7 w-7 text-slate-800 mr-4" />
                                <div>{{ item.plp ?? '-' }}</div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </Layout>
</template>