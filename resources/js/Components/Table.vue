<script setup>
import { isEmpty } from "lodash";

defineProps({
    items: {
        type: Array,
        default: () => []
    },
    bordered: Boolean,
    center: Boolean,
    footer: String
})

</script>

<template>
    <div class="w-full overflow-auto shadow-lg border rounded-lg">
        <table class="w-full bg-white" :class="{ 'text-center': center, '[&_tr>*]:border': bordered }" v-bind="$attrs">
            <thead class="border-b-2">
                <tr>
                    <slot name="head" />
                </tr>
            </thead>
            <tbody>
                <template v-if="!isEmpty(items)">
                    <tr v-for="(item, key) in items">
                        <slot name="body" :item="item" :key="key"></slot>
                    </tr>
                </template>
                <tr v-else>
                    <td colspan="100%" class="text-slate-400 italic text-center px-6 py-4">Tidak ada data</td>
                </tr>
            </tbody>
        </table>
        <span class="text-sm text-slate-600 px-4" v-if="footer">{{ footer }}</span>
    </div>
</template>