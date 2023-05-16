<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Input, Textarea, Button } from "@/Components";
import { useToast } from "@/Composables";
import { useForm } from "@inertiajs/vue3";


const props = defineProps({
    parents: {
        type: Object,
        default: () => ({})
    },
})

const formEdit = useForm({
    id: props.parents.id,
    kk: props.parents.kk,
    nama_ayah: props.parents.nama_ayah,
    nama_ibu: props.parents.nama_ibu,
    pekerjaan_ayah: props.parents.pekerjaan_ayah,
    pekerjaan_ibu: props.parents.pekerjaan_ibu,
    jumlah_saudara: props.parents.jumlah_saudara,
    alamat: props.parents.alamat,
    catatan_keluarga: props.parents.catatan_keluarga,
})


function update() {
    formEdit.patch(route('parents.update', props.parents.id), {
        onError: (err) => useToast({
            icon: 'warning',
            title: err.kk
        }),
        onSuccess: () => {
            useToast()
        }
    })
}

</script>

<template>
    <Layout judul="Edit parents">
        <form class="mt-8" @submit.prevent="update()">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-4">
                    <Input v-model="formEdit.kk" label="KK" type="number" required />
                    <Input v-model="formEdit.nama_ayah" label="Ayah" />
                    <Input v-model="formEdit.pekerjaan_ayah" label="Pekerjaan Ayah" />
                    <Input v-model="formEdit.nama_ibu" label="Ibu" />
                    <Input v-model="formEdit.pekerjaan_ibu" label="Pekerjaan Ibu" />
                </div>
                <div class="space-y-4">
                    <Input v-model="formEdit.jumlah_saudara" type="number" label="Jumlah Anak" />
                    <Textarea v-model="formEdit.alamat" label="Alamat"></Textarea>
                    <Textarea v-model="formEdit.catatan_keluarga" label="Catatan Parents"></Textarea>
                </div>
            </div>

            <Button type="submit" class="mt-8">Simpan</Button>
        </form>
    </Layout>
</template>