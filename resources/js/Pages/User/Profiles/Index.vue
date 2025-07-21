<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    profiles: {
        type: Object,
        default: () => ({})
    }
})

const deleteRecord = (id) => {
    if (confirm('Sure?')) {
        const form = useForm({
            id: id
        })

        form.delete(route('user.profiles.destroy', id), {
            onSuccess: () => { }
        })
    }
}

const selectProfile = (id) => {
    const form = useForm({
            id: id
        })

        form.post(route('user.select.profile', id), {
            onSuccess: () => { }
        })
}

</script>

<template>

    <Head title="Profiles" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Profiles
                </h2>
                <Link class="underline" :href="route('user.profiles.create')">New</Link>
            </div>
        </template>

        <div class="">
            <div class="">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="w-full">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <!-- <th>Email</th> -->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="profile in profiles.data" :key="profile.id">
                                        <td>{{ profile.name }}</td>
                                        <td class="text-blue-600">@{{ profile.username }}</td>
                                        <!-- <td>{{ profile.email }}</td> -->
                                        <td class=" flex items-center space-x-2">
                                            
                                            <SecondaryButton @click="selectProfile(profile.id)" v-if="$page.props.auth.user.profile_id != profile.id">
                                                Select
                                            </SecondaryButton>

                                            <Link :href="route('user.profiles.edit', profile.id)">
                                            <SecondaryButton>Edit</SecondaryButton>
                                            </Link>
                                            <DangerButton @click="deleteRecord(profile.id)">Delete</DangerButton>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <Pagination :links="profiles.links" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
