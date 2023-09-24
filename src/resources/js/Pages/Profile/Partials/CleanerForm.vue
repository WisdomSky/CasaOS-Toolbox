<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm} from '@inertiajs/vue3';
import DangerButton from "@/Components/DangerButton.vue";

const form = useForm({});

const clean = () => {
    form.post(route('settings.clean'), {
        preserveScroll: true,
        onError: () => {

        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Toolbox Remover</h2>

            <p class="mt-1 text-sm text-gray-600">
                If you are planning to un-install CasaOS Toolbox, make sure to run the toolbox cleaner prior
                uninstallation in order to remove all injected files and restore CasaOS into its original state.
            </p>
        </header>

        <form @submit.prevent="clean" class="mt-6 space-y-6">

            <div class="flex items-center gap-4">
                <DangerButton :disabled="form.processing">Remove</DangerButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Done.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
