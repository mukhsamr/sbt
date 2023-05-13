<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Input, Textarea, Button } from "@/Components";
import { useToast } from "@/Composables";
import { useForm } from "@inertiajs/vue3";


const formTambah = useForm({
    kk: null,
    nama_ayah: null,
    nama_ibu: null,
    pekerjaan_ayah: null,
    pekerjaan_ibu: null,
    jumlah_saudara: null,
    alamat: null,
    catatan_keluarga: null,
})


function store() {
    formTambah.post(route('parents.store'), {
        onError: (err) => useToast({
            icon: 'warning',
            title: err.nik
        }),
        onSuccess: () => {
            useToast()
        }
    })
}

</script>

<template>
    <Layout judul="Tambah parents">
        <form class="mt-8" @submit.prevent="store()">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-4">
                    <Input v-model="formTambah.kk" label="KK" type="number" required />
                    <Input v-model="formTambah.nama_ayah" label="Ayah" />
                    <Input v-model="formTambah.pekerjaan_ayah" label="Pekerjaan Ayah" />
                    <Input v-model="formTambah.nama_ibu" label="Ibu" />
                    <Input v-model="formTambah.pekerjaan_ibu" label="Pekerjaan Ibu" />
                </div>
                <div class="space-y-4">
                    <Input v-model="formTambah.jumlah_saudara" type="number" label="Jumlah Anak" />
                    <Textarea v-model="formTambah.alamat" label="Alamat"></Textarea>
                    <Textarea v-model="formTambah.catatan_keluarga" label="Catatan Parents"></Textarea>
                </div>
            </div>

            <Button type="submit" class="mt-8">Simpan</Button>
        </form>
    </Layout>
</template>