<script setup>
import Layout from "@/Layouts/Layout.vue";
import { List } from "@/Components";


const props = defineProps({
    siswa: {
        type: Object,
        default: () => ({})
    },
})

function foto() {
    if (props.siswa.foto) {
        return '/storage/siswa/' + props.siswa.foto
    }

    return '/storage/user.jpg'
}
</script>

<template>
    <Layout judul="Profil Siswa">
        <div class="relative w-36 h-36 mx-auto">
            <div class="w-full h-full border rounded-full overflow-hidden">
                <img :src="foto()" draggable="false" class="w-full h-full object-cover object-top select-none"
                    alt="foto" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 mt-8 gap-8">
            <div>
                <h2 class="mb-4 text-2xl text-slate-600"># Data Diri</h2>
                <div class="space-y-4">
                    <List kolom="NIK" :value="siswa.nik" />
                    <List kolom="Gender">
                        <div v-if="siswa.gender == 'l'">Laki-laki</div>
                        <div v-else>Perempuan</div>
                    </List>
                    <List kolom="TTL">
                        <div>{{ siswa.tempat }}</div>
                        <div>{{ siswa.lahir }}</div>
                    </List>
                    <List kolom="Asal Sekolah" :value="siswa.asal_sekolah" />
                    <List kolom="Tinggi Badan" :value="siswa.tinggi_badan" />
                    <List kolom="Berat Badan" :value="siswa.berat_badan" />
                    <List kolom="Catatan Siswa" :value="siswa.catatan_siswa" />
                </div>
            </div>

            <div>
                <h2 class="mb-4 text-2xl text-slate-600"># Keluarga</h2>
                <div class="space-y-4">
                    <List kolom="KK" :value="siswa.parents.kk" />
                    <List kolom="Ayah" :value="siswa.parents.nama_ayah" />
                    <List kolom="Ibu" :value="siswa.parents.nama_ibu" />
                    <List kolom="Pekerjaan Ayah" :value="siswa.parents.pekerjaan_ayah" />
                    <List kolom="Pekerjaan Ibu" :value="siswa.parents.pekerjaan_ibu" />
                    <List kolom="Jumlah Saudara" :value="siswa.parents.jumlah_saudara" />
                    <List kolom="Alamat" :value="siswa.parents.alamat" />
                    <List kolom="Catatan Keluarga" :value="siswa.parents.catatan_keluarga" />
                </div>
            </div>
        </div>
    </Layout>
</template>