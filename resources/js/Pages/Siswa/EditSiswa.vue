<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Input, Select, Textarea, Button } from "@/Components";
import { useToast } from "@/Composables";
import { useForm } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import { PhotoIcon } from "@heroicons/vue/24/outline";
import { reactive, ref } from "vue";

const props = defineProps({
    siswa: {
        type: Object,
        default: () => ({})
    },
    ayah: {
        type: Array,
        default: () => []
    },
    ibu: {
        type: Array,
        default: () => []
    },
    parents: {
        type: Object,
        default: () => ({})
    },
})

const formEdit = useForm({
    _method: 'patch',
    nik: props.siswa.nik,
    nama: props.siswa.nama,
    panggilan: props.siswa.panggilan,
    gender: props.siswa.gender,
    tempat: props.siswa.tempat,
    tanggal_lahir: props.siswa.tanggal_lahir,
    asal_sekolah: props.siswa.asal_sekolah,
    tinggi_badan: props.siswa.tinggi_badan,
    berat_badan: props.siswa.berat_badan,
    catatan_siswa: props.siswa.catatan_siswa,
    nama_ayah: props.siswa.parents_id,
    nama_ibu: props.siswa.parents_id,
    foto: props.siswa.foto
})

const parentSelected = reactive({
    pekerjaan_ayah: props.parents.pekerjaan_ayah,
    pekerjaan_ibu: props.parents.pekerjaan_ibu,
    jumlah_saudara: props.parents.jumlah_saudara,
    alamat: props.parents.alamat,
    catatan_keluarga: props.parents.catatan_keluarga,
})

function selectParents(tipe) {

    const parents_id = tipe == 'nama_ayah'
        ? formEdit.nama_ayah
        : formEdit.nama_ibu

    router.get(route('siswa.edit', props.siswa.id), { parents_id }, {
        only: ['parents'],
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            formEdit.nama_ayah = props.parents?.id
            formEdit.nama_ibu = props.parents?.id
            parentSelected.pekerjaan_ayah = props.parents?.pekerjaan_ayah
            parentSelected.pekerjaan_ibu = props.parents?.pekerjaan_ibu
            parentSelected.jumlah_saudara = props.parents?.jumlah_saudara
            parentSelected.alamat = props.parents?.alamat
        }
    })

}

function update() {
    formEdit.post(route('siswa.update', props.siswa.id), {
        onSuccess: () => {
            useToast()
        }
    })
}


const setImage = ref(null)

function setFoto(e) {
    setImage.value = URL.createObjectURL(e.target.files[0])
}

function foto() {
    if (setImage.value) {
        return setImage.value
    }

    if (props.siswa.foto) {
        return '/storage/siswa/' + props.siswa.foto
    }

    return '/storage/user.jpg'
}

</script>

<template>
    <Layout judul="Edit Santri">
        <div class="relative w-36 h-36 mx-auto">
            <div class="w-full h-full border rounded-full overflow-hidden">
                <img :src="foto()" draggable="false" class="w-full h-full object-cover object-top select-none"
                    alt="foto" />
            </div>
            <label for="foto">
                <div class="rounded-full bg-blue-500 text-white absolute bottom-0 right-0 clickable">
                    <PhotoIcon class="h-8 w-8 p-1.5" />
                </div>
            </label>
        </div>

        <input type="file" class="hidden" id="foto" accept="image/png,.jpg,.jpeg"
            @input="formEdit.foto = $event.target.files[0]" @change="setFoto($event)">

        <form class="mt-8" @submit.prevent="update()">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-4">
                    <Input v-model="formEdit.nama" label="Nama Lengkap" required />
                    <Input v-model="formEdit.nik" label="NIK" type="number" required />
                    <Input v-model="formEdit.panggilan" label="Panggilan" required />
                    <Select v-model="formEdit.gender" label="Gender" required>
                        <option value="l">Laki-laki</option>
                        <option value="p">Perempuan</option>
                    </Select>
                    <div class="flex space-x-2">
                        <Input v-model="formEdit.tempat" label="Tempat" />
                        <Input v-model="formEdit.tanggal_lahir" label="Tanggal Lahir" type="date" :max="new Date()" />
                    </div>
                    <Input v-model="formEdit.asal_sekolah" label="Asal Sekolah" />
                    <div class="flex space-x-2">
                        <Input v-model="formEdit.tinggi_badan" label="Tinggi (cm)" type="number" min="0" />
                        <Input v-model="formEdit.berat_badan" label="Berat (kg)" type="number" min="0" />
                    </div>
                </div>
                <div class="space-y-4">
                    <Select label="Ayah" v-model="formEdit.nama_ayah" @change="selectParents('nama_ayah')">
                        <option :value="item.id" v-for="item in ayah">{{ item.nama_ayah }}</option>
                    </Select>
                    <Select label="Ibu" v-model="formEdit.nama_ibu" @change="selectParents('nama_ibu')">
                        <option :value="item.id" v-for="item in ibu">{{ item.nama_ibu }}</option>
                    </Select>
                    <Input label="Pekerjaan Ayah" v-model="parentSelected.pekerjaan_ayah" readonly />
                    <Input label="Pekerjaan Ibu" v-model="parentSelected.pekerjaan_ibu" readonly />
                    <Input label="Jumlah Saudara" v-model="parentSelected.jumlah_saudara" readonly />
                    <Textarea label="Alamat" v-model="parentSelected.alamat" readonly />
                </div>
            </div>

            <Button type="submit" class="mt-8">Simpan</Button>
        </form>
    </Layout>
</template>