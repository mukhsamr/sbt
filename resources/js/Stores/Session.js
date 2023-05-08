import { usePage } from '@inertiajs/vue3'
import { defineStore } from 'pinia'

export const useSessionStore = defineStore('session', () => {
    const props = usePage().props

    const user = props.user

    return { user }
})