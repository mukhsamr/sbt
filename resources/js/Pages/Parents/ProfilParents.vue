<script setup>
import Layout from "@/Layouts/Layout.vue";
import { List } from "@/Components";
import { Link } from "@inertiajs/vue3";


const props = defineProps({
    parents: {
        type: Object,
        default: () => ({})
    },
    students: {
        type: Object,
        default: () => ({})
    },
})
</script>

<template>
    <Layout judul="Profil Parents">

        <div class="grid grid-cols-1 md:grid-cols-2 mt-8 gap-8">
            <div>
                <h2 class="mb-4 text-2xl text-slate-600"># Keluarga</h2>
                <div class="space-y-4">
                    <List kolom="KK" :value="parents.kk" />
                    <List kolom="Ayah" :value="parents.nama_ayah" />
                    <List kolom="Ibu" :value="parents.nama_ibu" />
                    <List kolom="Pekerjaan Ayah" :value="parents.pekerjaan_ayah" />
                    <List kolom="Pekerjaan Ibu" :value="parents.pekerjaan_ibu" />
                    <List kolom="Jumlah Anak" :value="parents.jumlah_saudara" />
                    <List kolom="Alamat" :value="parents.alamat" />
                    <List kolom="Catatan Keluarga" :value="parents.catatan_keluarga" />
                </div>
            </div>
            <div>
                <h2 class="mb-4 text-2xl text-slate-600"># Wali dari</h2>

                <ul class="divide-y divide-gray-200">
                    <li class="py-3" v-for="item in students">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12">
                                    <img :src="item.foto ? `/storage/siswa/${item.foto}` : `/storage/user.jpg`"
                                        class="rounded-full w-full h-12 object-top object-cover" alt="Foto Profil" />
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">
                                    {{ item.nama }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ item.usia }} Tahun
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </Layout>
</template>