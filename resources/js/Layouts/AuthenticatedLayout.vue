<script setup>
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="min-h-screen bg-[#020202] text-slate-200 font-sans selection:bg-pink-500/30">
        <nav class="bg-[#020202]/80 backdrop-blur-2xl border-b border-white/5 sticky top-0 z-[100]">
            <div class="max-w-[1600px] mx-auto px-6 sm:px-10">
                <div class="flex justify-between h-24">
                    <div class="flex items-center gap-10">
                        <div class="shrink-0 flex items-center group cursor-pointer">
                            <Link :href="route('dashboard')" class="flex items-center gap-4">
                                <div class="relative w-11 h-11 flex items-center justify-center">
                                    <div class="absolute inset-0 border border-dashed border-pink-500/30 rounded-full animate-spin-slow group-hover:border-pink-500 transition-colors duration-700"></div>
                                    <div class="absolute w-7 h-7 bg-zinc-900 border border-white/10 rotate-45 group-hover:rotate-90 group-hover:bg-pink-600 group-hover:border-transparent transition-all duration-500 ease-in-out"></div>
                                    <span class="relative text-[11px] font-black text-white group-hover:scale-110 transition-transform tracking-tighter italic">F</span>
                                </div>

                                <div class="flex flex-col">
                                    <span class="text-xl font-black tracking-tighter leading-none text-white uppercase italic">
                                        FARAH<span class="text-pink-600">.BADER</span>
                                    </span>
                                    <span class="text-[7px] font-bold text-zinc-500 uppercase tracking-[0.4em] mt-1">Admin_Control_v2</span>
                                </div>
                            </Link>
                        </div>

                        <div class="hidden space-x-10 sm:ms-10 sm:flex items-center h-full">
                            <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
                                class="text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:text-pink-500">
                                [ System_Dashboard ]
                            </NavLink>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="ms-3 relative">
                            <Dropdown align="right" width="56">
                                <template #trigger>
                                    <button type="button" class="inline-flex items-center gap-3 px-5 py-2.5 border border-white/5 text-[10px] font-black uppercase tracking-widest rounded-none text-zinc-400 bg-white/[0.02] hover:bg-white/[0.05] hover:text-white hover:border-pink-500/50 focus:outline-none transition-all duration-300">
                                        <span class="w-1.5 h-1.5 bg-pink-600 rounded-full animate-pulse"></span>
                                        {{ $page.props.auth.user.name }}
                                        <svg class="ms-2 -me-0.5 h-3 w-3 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </template>

                                <template #content>
                                    <div class="bg-[#0a0a0a] border border-zinc-800 rounded-none shadow-2xl py-2">
                                        <div class="px-4 py-2 border-b border-zinc-900 mb-2">
                                            <p class="text-[8px] font-bold text-zinc-600 uppercase tracking-widest">Active Session</p>
                                        </div>
                                        <DropdownLink :href="route('profile.edit')" class="text-[10px] font-bold text-zinc-400 hover:text-white hover:bg-zinc-900 py-3 uppercase tracking-widest transition-colors">
                                            Access_Profile
                                        </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button" class="text-[10px] font-bold text-pink-500 hover:text-white hover:bg-pink-600/10 py-3 uppercase tracking-widest transition-colors w-full text-left">
                                            Terminate_Session
                                        </DropdownLink>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-zinc-400 hover:text-white hover:bg-zinc-900 transition-all">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div :class="{'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown}" class="sm:hidden bg-[#050505] border-b border-zinc-900 animate-fade-in">
                <div class="pt-2 pb-3 space-y-1 px-4">
                    <DropdownLink :href="route('dashboard')" class="text-xs font-black uppercase tracking-widest py-4">Control_Panel</DropdownLink>
                </div>
                <div class="pt-4 pb-1 border-t border-zinc-900">
                    <div class="px-6 py-4">
                        <div class="text-xs font-black text-white uppercase">{{ $page.props.auth.user.name }}</div>
                        <div class="text-[10px] font-mono text-zinc-500">{{ $page.props.auth.user.email }}</div>
                    </div>
                    <div class="mt-3 space-y-1 pb-6 px-4">
                        <DropdownLink :href="route('profile.edit')" class="text-[10px] font-black uppercase"> Profile </DropdownLink>
                        <DropdownLink :href="route('logout')" method="post" as="button" class="text-[10px] font-black uppercase text-pink-600"> Log Out </DropdownLink>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-[#050505] border-b border-white/5 relative overflow-hidden" v-if="$slots.header">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
                 style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>

            <div class="max-w-[1600px] mx-auto py-10 px-6 sm:px-10 relative z-10">
                <slot name="header" />
            </div>
        </header>

        <main class="relative">
            <div class="fixed top-1/4 right-0 -z-10 w-[500px] h-[500px] bg-pink-600/5 blur-[120px] rounded-full pointer-events-none"></div>
            <div class="fixed bottom-0 left-0 -z-10 w-[500px] h-[500px] bg-indigo-600/5 blur-[120px] rounded-full pointer-events-none"></div>

            <div class="animate-content-up">
                <slot />
            </div>
        </main>

        <footer class="py-10 border-t border-white/5 flex flex-col items-center opacity-30 group hover:opacity-100 transition-opacity">
            <div class="text-[8px] font-black uppercase tracking-[0.8em] text-zinc-500">
                System_Core_v2.0 // Secured_Access // {{ new Date().getFullYear() }}
            </div>
        </footer>
    </div>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700;900&display=swap');

.font-sans {
    font-family: 'Space Grotesk', sans-serif;
}

.animate-spin-slow {
    animation: spin 12s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-content-up {
    animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 4px;
}
::-webkit-scrollbar-track {
    background: #020202;
}
::-webkit-scrollbar-thumb {
    background: #1a1a1a;
}
::-webkit-scrollbar-thumb:hover {
    background: #ff007a;
}
</style>
