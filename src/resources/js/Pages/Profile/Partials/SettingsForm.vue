<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import {onBeforeMount, ref} from 'vue';
import axios from "axios";

const baseUrl = ref(null);

const form = useForm({
    base_url: ''
});

onBeforeMount(async () => {
    const { data } = await axios.get('/api/settings');
    form.base_url = data.base_url;
})


const updateSettings = () => {
    form.post(route('settings.update'), {
        preserveScroll: true,
        onError: () => {
            if (form.errors.base_url) {
                baseUrl.value.focus();
            }

        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Toolbox Settings</h2>

            <p class="mt-1 text-sm text-gray-600">

            </p>
        </header>

        <form @submit.prevent="updateSettings" class="mt-6 space-y-6">
            <div>
                <InputLabel for="base_url" value="Host" />

                <TextInput
                    id="base_url"
                    ref="baseUrl"
                    v-model="form.base_url"
                    type="text"
                    class="mt-1 block w-full"
                />

                <InputError :message="form.errors.base_url" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
