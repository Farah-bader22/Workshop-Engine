<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Farah.OS // Profile_Config" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <div class="w-2 h-8 bg-pink-600"></div>
                <h2 class="text-3xl font-black uppercase italic tracking-tighter text-white">
                    Account<span class="text-pink-600">_Configuration</span>
                </h2>
            </div>
        </template>

        <div class="py-12 bg-[#020202]">
            <div class="mx-auto max-w-7xl space-y-10 sm:px-6 lg:px-8">

                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-pink-600/20 to-violet-600/20 opacity-0 group-hover:opacity-100 transition duration-1000 blur-xl"></div>

                    <div class="relative bg-[#080808] p-8 border border-white/5 shadow-2xl overflow-hidden">
                        <div class="absolute top-0 right-0 p-2 opacity-10">
                            <span class="text-[10px] font-mono text-white">MOD_01 // INFO</span>
                        </div>

                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-xl"
                        />
                    </div>
                </div>

                <div class="relative group">
                    <div class="relative bg-[#080808] p-8 border border-white/5 shadow-2xl overflow-hidden">
                        <div class="absolute top-0 right-0 p-2 opacity-10">
                            <span class="text-[10px] font-mono text-white">MOD_02 // SECURE</span>
                        </div>
                        <UpdatePasswordForm class="max-w-xl" />
                    </div>
                </div>

                <div class="relative">
                    <div class="relative bg-[#080808] p-8 border border-red-900/20 border-l-red-600 border-l-4 shadow-2xl">
                         <div class="absolute top-0 right-0 p-2 opacity-10">
                            <span class="text-[10px] font-mono text-red-500">MOD_03 // DANGER</span>
                        </div>
                        <DeleteUserForm class="max-w-xl text-red-500" />
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

:deep(h2) {
    @apply text-lg font-black uppercase tracking-widest text-white mb-2;
}

:deep(p) {
    @apply text-xs font-medium text-zinc-500 mb-6 uppercase tracking-wider;
}

:deep(label) {
    @apply text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 !important;
}

:deep(input) {
    @apply bg-transparent border-zinc-800 text-white rounded-none focus:ring-pink-600 focus:border-pink-600 transition-all !important;
}
</style>
