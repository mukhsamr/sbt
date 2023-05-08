<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Table, Th, Td, Button } from "@/Components";
import { CheckCircleIcon } from "@heroicons/vue/24/outline";

defineProps({
    daftar: {
        type: Array,
        default: () => []
    }
})


</script>

<template>
    <Layout judul="Semester">
        <Table :items="daftar">
            <template #head>
                <Th>Tahun</Th>
                <Th>Semester</Th>
                <Th>Aktif</Th>
            </template>
            <template #body="{ item }">
                <Td>{{ item.tahun }}</Td>
                <Td>{{ item.semester }}</Td>
                <Td>
                    <Button color="dark" v-if="!item.is_active">Visit</Button>
                    <CheckCircleIcon class="h-5 w-5 text-green-600" v-else />
                </Td>
            </template>
        </Table>
    </Layout>
</template>