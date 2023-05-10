import { usePage } from '@inertiajs/vue3'
import { defineStore } from 'pinia'

export const useSessionStore = defineStore('session', () => {
    const props = usePage().props

    const user = props.user
    const role = props.user.role

    const checkRole = (roles) => {
        return roles.includes(role)
    }

    return { user, role, checkRole }
})