<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';

const form = useForm({ email: '', password: '', remember: false });
const submit = () => form.post(route('login'), { onFinish: () => form.reset('password') });
</script>

<template>
    <div class="min-h-screen bg-[#020617] flex items-center justify-center font-sans selection:bg-pink-500/30">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-pink-600/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-indigo-600/10 blur-[120px] rounded-full"></div>

        <Head title="Login | Farah Hub" />

        <div class="w-full max-w-[400px] z-10 px-4">
            <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 p-10 rounded-[40px] shadow-2xl">

                <div class="text-center mb-10">
                    <div class="inline-block px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-[9px] font-black uppercase tracking-[0.3em] text-pink-400 mb-6">
                        Engineering Portal
                    </div>
                    <h1 class="text-3xl font-light text-white tracking-tight">Welcome <span class="font-black italic">Back.</span></h1>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <input v-model="form.email" type="email" placeholder="Email Address"
                            class="w-full bg-white/5 border-white/10 text-white text-sm rounded-2xl h-12 px-5 focus:border-pink-500/50 focus:ring-0 transition-all placeholder:text-slate-600" />
                    </div>

                    <div>
                        <input v-model="form.password" type="password" placeholder="Access Key"
                            class="w-full bg-white/5 border-white/10 text-white text-sm rounded-2xl h-12 px-5 focus:border-pink-500/50 focus:ring-0 transition-all placeholder:text-slate-600" />
                    </div>

                    <div class="flex items-center justify-between px-1">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" v-model="form.remember" class="w-4 h-4 rounded border-white/10 bg-white/5 text-pink-600 focus:ring-0" />
                            <span class="text-[10px] font-bold text-slate-500 group-hover:text-slate-300 transition-colors uppercase tracking-widest">Remember</span>
                        </label>
                        <Link :href="route('password.request')" class="text-[10px] font-bold text-slate-600 hover:text-pink-500 uppercase tracking-widest transition-colors">Forgot?</Link>
                    </div>

                    <button class="w-full h-12 bg-white text-black hover:bg-pink-600 hover:text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-500 transform hover:scale-[1.02]">
                        Sign In
                    </button>
                </form>

                <p class="text-center mt-8 text-[10px] font-bold text-slate-600 uppercase tracking-widest">
                    New here? <Link :href="route('register')" class="text-white hover:text-pink-500 transition-colors">Create Account</Link>
                </p>
            </div>
        </div>
    </div>
</template>
