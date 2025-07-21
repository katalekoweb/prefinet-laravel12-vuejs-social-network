<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Multiselect from 'vue-multiselect'

const props = defineProps({
    profile: {
        type: Object,
        default: () => ({})
    },
    tags: {
        type: Object,
        default: () => ({})
    }
})

const form = useForm({
    id: props.profile.id,
    name: props.profile.name,
    username: props.profile.username,
    email: props.profile.email,
    bio: props.profile.bio,
    hidden_words: props.profile.hidden_words,
    avatar: "",
    cover: "",
    delete_avatar: null,
    delete_cover: null,
    tags: props.profile.tags ? props.profile.tags : [],
    preferences: props.profile.preferences ? props.profile.preferences : []
})

const save = () => {

    form.tags = form.tags ? form.tags.map(t => t.id) : []
    form.preferences = form.preferences ? form.preferences.map(t => t.id) : []

    if (props.profile.id) {
        form.post(route('user.profiles.update', { profile: props.profile.id, _method: "put" }))
    } else {
        form.post(route('user.profiles.store'))
    }

    console.log(form);

}

const previewCoverUrl = ref(props.profile.cover_url)
const previewAvatarUrl = ref(props.profile.avatar_url)

const handleAvatarImage = (event) => {
    const file = event.target.files[0]
    form.avatar = file

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader()
        reader.onload = (e) => {
            previewAvatarUrl.value = e.target.result
        }
        reader.readAsDataURL(file)
    } else {
        previewAvatarUrl.value = null
    }
}

const handleCoverImage = (event) => {
    const file = event.target.files[0]
    form.cover = file

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader()
        reader.onload = (e) => {
            previewCoverUrl.value = e.target.result
        }
        reader.readAsDataURL(file)
    } else {
        previewCoverUrl.value = null
    }

}

</script>

<template>

    <Head :title="profile.id ? 'Edit profile' : 'New profile'" />

    <AuthenticatedLayout>
        <template #header>

            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ profile.id ? 'Edit profile' : 'New profile' }}
                </h2>

                <Link class="underline" :href="route('user.profiles.index')">Back</Link>
            </div>

        </template>

        <div class="py-8 ">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-3">
                <div :style="{
                    backgroundImage: `url(${previewCoverUrl})`,
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',
                }"
                    class="overflow-hidden bg-white h-[300px] shadow-md sm:rounded-lg dark:bg-gray-800 p-6 relative flex items-center justify-center">

                    <div class="text-center">
                        <div class="text-[40px]">
                            {{ form.name }}
                        </div>
                        <div class="text-white bg-black p-1 px-4 rounded-md bg-opacity-50">
                            @{{ form.username }}
                        </div>
                    </div>

                    <div class="absolute bottom-3 left-3 h-32 w-32 rounded-full flex flex-col items-center justify-center shadow-md bg-gray-200 "
                        :style="{
                            backgroundImage: `url(${previewAvatarUrl})`,
                            backgroundSize: 'cover',
                            backgroundPosition: 'center',
                        }">
                        <InputLabel for="avatar" value="Change Avatar"
                            class=" bg-gray-500 shadow-md px-2 bg-opacity-70 text-white rounded-md" />

                        <label v-if="profile.avatar" for="delete_avatar"
                            class=" bg-opacity-90 p-1 text-white rounded-md mt-2 px-5 absolute bottom-2 select-none"
                            :class="{ 'bg-green-600 bg-opacity-90': form.delete_avatar }">
                            <input type="checkbox" name="delete_avatar" class="hidden" id="delete_avatar"
                                v-model="form.delete_avatar">
                            <span>Delete</span>
                        </label>

                        <input @input="handleAvatarImage" id="avatar" type="file" class="mt-1 hidden w-full" />
                        <InputError class="mt-2" :message="form.errors.avatar" />
                    </div>
                    <div class="absolute top-3 right-3  h-20 flex flex-col items-center justify-center">
                        <InputLabel for="cover" value="Cover" class="shadow-md bg-gray-200 rounded-md px-12 py-2" />
                        <label v-if="profile.cover" for="delete_cover"
                            class="bg-gray-400 bg-opacity-60 p-1 rounded-md mt-2 px-5 flex space-x-2 items-center">
                            <input type="checkbox" name="delete_cover" id="delete_cover" v-model="form.delete_cover">
                            <span>Delete</span>
                        </label>
                        <input id="cover" type="file" class="mt-1 hidden w-full" @input="handleCoverImage" />
                        <InputError class="mt-2" :message="form.errors.cover" />
                    </div>
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">

                        <div class="mt-4">
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="username" value="Username" />
                            <TextInput id="username" type="text" class="mt-1 block w-full" v-model="form.username" />
                            <InputError class="mt-2" :message="form.errors.username" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Bio" />
                            <textarea id="bio" type="email" class="mt-1 block w-full rounded-lg border border-gray-200"
                                v-model="form.bio"></textarea>
                            <InputError class="mt-2" :message="form.errors.bio" />
                        </div>

                        <div class="mt-12">
                            <hr class="border border-blue-600">
                        </div>

                        <div class="mt-4">
                            <InputLabel for="hidden_words" value="Hidden Words" />
                            <textarea id="hidden_words" class="mt-1 block w-full rounded-lg border border-gray-200"
                                v-model="form.hidden_words"></textarea>
                            <InputError class="mt-2" :message="form.errors.hidden_words" />
                        </div>



                        <div class="mt-8">
                            <InputLabel for="tags" value="Profile Categories" />

                            <div>
                                <multiselect v-model="form.tags" :options="tags" :multiple="true"
                                    :close-on-select="false" :clear-on-select="false" :preserve-search="true"
                                    placeholder="Add tags" label="name" track-by="id"></multiselect>
                                <pre class="language-json"><code>{{ value }}</code></pre>
                            </div>

                            <InputError class="mt-2" :message="form.errors.tags" />
                        </div>

                        <div class="mt-8">
                            <InputLabel for="tags" value="Preferences" />

                            <div><label class="typo__label">What do you want to see in your feed</label>
                                <multiselect v-model="form.preferences" :options="tags" :multiple="true"
                                    :close-on-select="false" :clear-on-select="false" :preserve-search="true"
                                    placeholder="Add tags" label="name" track-by="id"></multiselect>
                                <pre class="language-json"><code>{{ value }}</code></pre>
                            </div>

                            <InputError class="mt-2" :message="form.errors.preferences" />
                        </div>

                        <div>
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                        </div>

                        <div class="flex items-center justify-end">
                            <PrimaryButton @click="save()">Save</PrimaryButton>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </AuthenticatedLayout>
</template>
