<script setup>
import { Input } from "@/Components";
import { Button } from "@/Components";
import { EyeIcon, EyeSlashIcon } from "@heroicons/vue/24/outline";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const eye = ref()

function toggle() {
    eye.value = !eye.value
}

const form = useForm({
    nama: '',
    password: '',
})

function submit() {
    form.post(route('auth'))
}

</script>

<template>
    <div class="flex justify-center bg-slate-100 h-full w-full absolute">
        <div class="block p-6 rounded-lg shadow-lg bg-white w-80 md:w-96 h-fit mt-24">
            <span
                class="text-2xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-slate-500">
                SB Track
            </span>
            <div class="text-sm text-slate-400">Santri Behaviour Tracking</div>


            <div class="mt-6">
                <h2 class="text-2xl font-semibold text-slate-800">Sign In</h2>
                <div class="text-sm text-slate-400">Please sign in to continue</div>

                <form class="mt-8" @submit.prevent="submit">
                    <div class="space-y-3">
                        <Input type="text" placeholder="Nama" v-model="form.nama" required autofocus />

                        <div class="relative">
                            <Input placeholder="Password" v-model="form.password" :type="!eye ? 'password' : 'text'"
                                required autocomplete />
                            <EyeIcon class="h-5 w-5 text-slate-600 absolute bottom-2 right-3 clickable" @click="toggle"
                                v-if="eye" />
                            <EyeSlashIcon class="h-5 w-5 text-slate-600 absolute bottom-2 right-3 clickable"
                                @click="toggle" v-else />
                        </div>
                    </div>

                    <Button type="submit" class="w-full mb-2 mt-6">Sign In</Button>
                    <span class="text-sm text-red-500">{{ $page.props.errors.msg }}</span>
                </form>
            </div>
        </div>
    </div>
</template>