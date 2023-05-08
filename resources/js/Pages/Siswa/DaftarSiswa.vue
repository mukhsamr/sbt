<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Table, Th, Td, BtnIcon } from "@/Components";
import { useToast, useConfirm } from "@/Composables";
import { InboxIcon, TrashIcon, PencilSquareIcon } from "@heroicons/vue/24/outline";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    daftar: {
        type: Array,
        default: () => []
    },
})


function toProfil(item) {
    router.get(route('siswa.profil', item.id))
}

async function hapus(id) {
    const cond = await useConfirm('Hapus siswa')

    if (cond) {
        router.delete(route('siswa.destroy', id), {
            onSuccess: () => useToast()
        })
    }
}

</script>

<template>
    <Layout judul="Daftar Siswa">
        <Table :items="daftar">
            <template #head>
                <Th>Nama</Th>
                <Th>NIK</Th>
                <Th>Usia</Th>
                <Th>Profil</Th>
                <Th>Aksi</Th>
            </template>
            <template #body="{ item }">
                <Td>{{ item.nama }}</Td>
                <Td>{{ item.nik }}</Td>
                <Td>{{ item.usia }}</Td>
                <Td>
                    <BtnIcon :icon="InboxIcon" class="text-amber-600" @click="toProfil(item)">Biodata</BtnIcon>
                </Td>
                <Td>
                    <div class="flex space-x-4">
                        <BtnIcon :icon="PencilSquareIcon" class="text-blue-600"
                            @click="router.get(route('siswa.edit', item.id))">Edit</BtnIcon>
                        <BtnIcon :icon="TrashIcon" class="text-red-600" @click="hapus(item.id)">Hapus</BtnIcon>
                    </div>
                </Td>
            </template>
        </Table>
    </Layout>
</template>