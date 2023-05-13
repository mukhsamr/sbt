<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Input, Select, Textarea, Button } from "@/Components";
import { useToast } from "@/Composables";
import { useForm } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import { PhotoIcon } from "@heroicons/vue/24/outline";
import { reactive, ref } from "vue";

const props = defineProps({
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

const formTambah = useForm({
    nik: null,
    nama: null,
    panggilan: null,
    gender: null,
    tempat: null,
    tanggal_lahir: null,
    anak_ke: null,
    asal_sekolah: null,
    tinggi_badan: null,
    berat_badan: null,
    catatan_siswa: null,
    nama_ayah: null,
    nama_ibu: null,
    foto: null,
    parents_id: null
})

const parentSelected = reactive({
    pekerjaan_ayah: null,
    pekerjaan_ibu: null,
    jumlah_saudara: null,
    alamat: null,
    catatan_keluarga: null,
})

function selectParents(tipe) {

    const parents_id = tipe == 'nama_ayah'
        ? formTambah.nama_ayah
        : formTambah.nama_ibu

    router.get(route('siswa.create'), { parents_id }, {
        replace: true,
        only: ['parents'],
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            formTambah.parents_id = props.parents?.id

            formTambah.nama_ayah = props.parents?.id
            formTambah.nama_ibu = props.parents?.id
            parentSelected.pekerjaan_ayah = props.parents?.pekerjaan_ayah
            parentSelected.pekerjaan_ibu = props.parents?.pekerjaan_ibu
            parentSelected.jumlah_saudara = props.parents?.jumlah_saudara
            parentSelected.alamat = props.parents?.alamat
            parentSelected.catatan_keluarga = props.parents?.catatan_keluarga
        }
    })

}

function store() {
    formTambah.post(route('siswa.store'), {
        onError: (err) => useToast({
            icon: 'warning',
            title: err.nik
        }),
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

    return '/storage/user.jpg'
}

</script>

<template>
    <Layout judul="Tambah Siswa">
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
            @input="formTambah.foto = $event.target.files[0]" @change="setFoto($event)">

        <form class="mt-8" @submit.prevent="store()">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-4">
                    <Input v-model="formTambah.nama" label="Nama Lengkap" required />
                    <Input v-model="formTambah.nik" label="NIK" type="number" required />
                    <Input v-model="formTambah.panggilan" label="Panggilan" required />
                    <Select v-model="formTambah.gender" label="Gender" required>
                        <option value="l">Laki-laki</option>
                        <option value="p">Perempuan</option>
                    </Select>
                    <div class="flex space-x-2">
                        <Input v-model="formTambah.tempat" label="Tempat" />
                        <Input v-model="formTambah.tanggal_lahir" label="Tanggal Lahir" type="date" :max="new Date()" />
                    </div>
                    <Input v-model="formTambah.anak_ke" label="Anak Ke" type="number" />
                    <Input v-model="formTambah.asal_sekolah" label="Asal Sekolah" />
                    <div class="flex space-x-2">
                        <Input v-model="formTambah.tinggi_badan" label="Tinggi (cm)" type="number" min="0" />
                        <Input v-model="formTambah.berat_badan" label="Berat (kg)" type="number" min="0" />
                    </div>
                    <Textarea v-model="formTambah.catatan_siswa" label="Catatan Siswa"></Textarea>
                </div>
                <div class="space-y-4">
                    <Select label="Ayah" v-model="formTambah.nama_ayah" @change="selectParents('nama_ayah')">
                        <option :value="item.id" v-for="item in ayah">{{ item.nama_ayah }}</option>
                    </Select>
                    <Select label="Ibu" v-model="formTambah.nama_ibu" @change="selectParents('nama_ibu')">
                        <option :value="item.id" v-for="item in ibu">{{ item.nama_ibu }}</option>
                    </Select>
                    <Input label="Pekerjaan Ayah" v-model="parentSelected.pekerjaan_ayah" readonly />
                    <Input label="Pekerjaan Ibu" v-model="parentSelected.pekerjaan_ibu" readonly />
                    <Input label="Jumlah Saudara" v-model="parentSelected.jumlah_saudara" readonly />
                    <Textarea label="Alamat" v-model="parentSelected.alamat" readonly />
                    <Textarea label="Catatan Keluarga" v-model="parentSelected.catatan_keluarga" readonly />
                </div>
            </div>

            <Button type="submit" class="mt-8">Simpan</Button>
        </form>
    </Layout>
</template>