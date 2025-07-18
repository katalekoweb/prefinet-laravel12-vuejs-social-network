<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    proflies: {
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

</script>

<template>

    <Head title="Profiles" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Profiles
                </h2>
                <Link :href="route('user.profiles.create')">New</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="w-full">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="profile in proflies.data" :key="profile.id">
                                        <td>{{ profile.id }}</td>
                                        <td>{{ profile.name }}</td>
                                        <td>{{ profile.username }}</td>
                                        <td>{{ profile.email }}</td>
                                        <td class=" flex items-center space-x-2">
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
                            <Pagination :links="proflies.links" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
