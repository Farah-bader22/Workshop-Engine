<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
const form = useForm({ name: '', email: '', password: '', password_confirmation: '' });
const submit = () => form.post(route('register'), { onFinish: () => form.reset('password', 'password_confirmation') });
</script>

<template>
    <div class="min-h-screen bg-[#020617] flex items-center justify-center font-sans selection:bg-pink-500/30">
        <Head title="Join | Farah Hub" />

        <div class="w-full max-w-[420px] z-10 px-4">
            <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 p-10 rounded-[40px] shadow-2xl">

                <div class="text-center mb-8">
                    <h1 class="text-3xl font-light text-white tracking-tight">Join the <span class="font-black italic">Impact.</span></h1>
                    <p class="text-[10px] font-bold text-slate-600 uppercase tracking-[0.3em] mt-3">Start your engineering legacy</p>
                </div>

                <form @submit.prevent="submit" class="space-y-4">
                    <input v-model="form.name" type="text" placeholder="Full Name"
                        class="w-full bg-white/5 border-white/10 text-white text-sm rounded-2xl h-12 px-5 focus:border-pink-500/50 focus:ring-0 transition-all placeholder:text-slate-600" />

                    <input v-model="form.email" type="email" placeholder="Email Address"
                        class="w-full bg-white/5 border-white/10 text-white text-sm rounded-2xl h-12 px-5 focus:border-pink-500/50 focus:ring-0 transition-all placeholder:text-slate-600" />

                    <div class="grid grid-cols-2 gap-3">
                        <input v-model="form.password" type="password" placeholder="Password"
                            class="w-full bg-white/5 border-white/10 text-white text-[12px] rounded-2xl h-12 px-5 focus:border-pink-500/50 focus:ring-0 transition-all placeholder:text-slate-600" />
                        <input v-model="form.password_confirmation" type="password" placeholder="Confirm"
                            class="w-full bg-white/5 border-white/10 text-white text-[12px] rounded-2xl h-12 px-5 focus:border-pink-500/50 focus:ring-0 transition-all placeholder:text-slate-600" />
                    </div>

                    <button class="w-full h-12 bg-white text-black hover:bg-pink-600 hover:text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-500 mt-4 shadow-xl shadow-white/5">
                        Register Now
                    </button>
                </form>

                <p class="text-center mt-8 text-[10px] font-bold text-slate-600 uppercase tracking-widest">
                    Already an Engineer? <Link :href="route('login')" class="text-white hover:text-pink-500 transition-colors">Log In</Link>
                </p>
            </div>
        </div>
    </div>
</template>
