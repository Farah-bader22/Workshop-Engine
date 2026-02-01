<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

const isMenuOpen = ref(false);

const techStack = [
    { name: 'Vue.js 3', level: 'Expert', icon: '⚡', desc: 'Reactive Architecture', color: 'from-emerald-400 to-cyan-500' },
    { name: 'Laravel', level: 'Pro', icon: '💎', desc: 'Elegant Backend Systems', color: 'from-red-500 to-orange-500' },
    { name: 'Pinia', level: 'Advanced', icon: '🍍', desc: 'Global State Management', color: 'from-yellow-400 to-orange-400' },
    { name: 'Vite', level: 'Speed', icon: '🚀', desc: 'Instant Server Start', color: 'from-purple-500 to-pink-500' },
    { name: 'Tailwind', level: 'Design', icon: '🎨', desc: 'Modern Utility Styling', color: 'from-sky-400 to-indigo-500' },
    { name: 'Inertia.js', level: 'Link', icon: '🔗', desc: 'The Modern Monolith', color: 'from-indigo-400 to-purple-600' },
];

const contactMe = () => {
    const subject = encodeURIComponent(`Collaboration Inquiry with Engineer Farah Bader`);
    window.location.href = `mailto:farahbader104@gmail.com?subject=${subject}`;
};
</script>

<template>
    <Head title="Farah Hub | Engineering the Future" />

    <div class="min-h-screen bg-[#020617] text-white font-sans selection:bg-pink-500/30 overflow-x-hidden">

        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[70%] h-[50%] bg-pink-600/10 blur-[150px] rounded-full animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[70%] h-[50%] bg-indigo-600/10 blur-[150px] rounded-full animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <nav class="relative z-50 sticky top-0 border-b border-white/10 bg-[#020617]/80 backdrop-blur-xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center gap-4 group cursor-pointer">
                        <div class="relative w-12 h-12 flex items-center justify-center">
                            <div class="absolute inset-0 border-2 border-dashed border-pink-500/20 rounded-full animate-spin-slow group-hover:border-pink-500/50 transition-colors"></div>
                            <div class="absolute w-7 h-7 bg-slate-900 border border-white/20 rotate-45 group-hover:rotate-90 transition-all duration-700 ease-in-out shadow-[0_0_15px_rgba(236,72,153,0.2)]"></div>
                            <span class="relative text-[9px] font-black text-pink-500 tracking-tighter group-hover:scale-110 transition-transform">&lt;/&gt;</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-black tracking-tighter leading-none group-hover:text-pink-500 transition-colors uppercase italic">
                                FARAH<span class="text-pink-600">BADER</span>
                            </span>
                            <span class="text-[8px] font-bold text-slate-500 uppercase tracking-[0.4em] mt-1">Software Engineer</span>
                        </div>
                    </div>

                    <div v-if="canLogin" class="hidden md:flex items-center gap-8">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-xs font-black hover:text-pink-400 transition-colors uppercase tracking-[0.2em]">System.Dashboard</Link>
                        <template v-else>
                            <Link :href="route('login')" class="text-xs font-black tracking-[0.2em] hover:text-pink-400 transition-colors uppercase">Login</Link>
                            <Link :href="route('register')" class="relative group">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-pink-600 to-violet-600 rounded-lg blur opacity-40 group-hover:opacity-100 transition duration-300"></div>
                                <button class="relative px-6 py-2.5 bg-[#020617] border border-white/10 rounded-lg font-black text-[10px] transition-all tracking-[0.1em] hover:border-transparent">ESTABLISH_CONNECTION</button>
                            </Link>
                        </template>
                    </div>

                    <div class="md:hidden flex items-center">
                        <button @click="isMenuOpen = !isMenuOpen" class="text-white p-2">
                            <div class="w-6 h-5 flex flex-col justify-between">
                                <span class="w-full h-0.5 bg-white transition-all origin-left" :class="{'rotate-45 translate-x-1': isMenuOpen}"></span>
                                <span class="w-full h-0.5 bg-pink-600 transition-all" :class="{'opacity-0': isMenuOpen}"></span>
                                <span class="w-full h-0.5 bg-white transition-all origin-left" :class="{'-rotate-45 translate-x-1': isMenuOpen}"></span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <div v-show="isMenuOpen" class="md:hidden bg-[#020617] border-b border-white/10 px-6 py-10 flex flex-col gap-6 animate-fade-in-down">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-xl font-black italic text-pink-500">System_Dashboard</Link>
                <template v-else>
                    <Link :href="route('login')" class="text-lg font-black uppercase tracking-widest text-white/70 hover:text-white transition-colors">Login</Link>
                    <Link :href="route('register')" class="py-4 bg-gradient-to-r from-pink-600 to-violet-600 rounded-xl text-center font-black uppercase tracking-widest text-xs">Join Impact</Link>
                </template>
            </div>
        </nav>

        <header class="relative z-10 max-w-7xl mx-auto px-6 pt-24 md:pt-36 pb-24 flex flex-col items-center text-center">
            <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/5 border border-white/10 mb-10 backdrop-blur-sm">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-pink-500"></span>
                </span>
                <span class="text-[9px] font-black uppercase tracking-[0.4em] text-pink-400">Engineering Modernity</span>
            </div>

            <h1 class="text-6xl sm:text-8xl md:text-[130px] font-black leading-[0.85] tracking-tighter mb-12">
                CRAFTING <br class="hidden sm:block"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-b from-white to-white/20 italic font-light">DIGITAL</span>
                <span class="relative inline-block">
                    <span class="bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 bg-clip-text text-transparent"> IMPACT.</span>
                    <span class="absolute -bottom-4 left-0 w-full h-1 bg-pink-500/20 blur-md"></span>
                </span>
            </h1>

            <p class="max-w-2xl text-base md:text-xl text-slate-400 font-medium leading-relaxed mb-16 px-4">
                I am <span class="text-white font-bold decoration-pink-500 underline decoration-2 underline-offset-8">Farah Bader</span>. I build web ecosystems that combine high-performance engineering with breathtaking aesthetics.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 w-full sm:w-auto px-6 max-w-md sm:max-w-none">
                <Link :href="route('public.showcase')"
                      class="flex items-center justify-center h-16 px-10 sm:px-14 bg-white text-black font-black text-[11px] uppercase tracking-[0.25em] rounded-full hover:bg-pink-600 hover:text-white transition-all transform hover:scale-105 active:scale-95 shadow-[0_20px_50px_rgba(255,255,255,0.1)]">
                    Access_Workshops
                </Link>
                <button @click="contactMe"
                        class="flex items-center justify-center h-16 px-10 sm:px-14 bg-white/5 border border-white/20 backdrop-blur-md rounded-full font-black text-[11px] uppercase tracking-[0.25em] text-white hover:bg-white/10 transition-all transform hover:scale-105 active:scale-95">
                    Establish_Contact
                </button>
            </div>
        </header>

        <section class="relative z-10 max-w-7xl mx-auto px-6 pb-48">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                <div v-for="skill in techStack" :key="skill.name"
                     class="group relative p-[1px] rounded-[35px] overflow-hidden transition-all duration-700 hover:-translate-y-3">
                    <div class="absolute inset-0 bg-gradient-to-br opacity-0 group-hover:opacity-100 transition-opacity duration-700" :class="skill.color"></div>
                    <div class="relative bg-[#0b1120]/90 backdrop-blur-3xl p-10 rounded-[34px] flex flex-col h-full border border-white/5">
                        <div class="flex justify-between items-center mb-10">
                            <div class="w-16 h-16 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-4xl group-hover:scale-110 transition-transform duration-500">
                                {{ skill.icon }}
                            </div>
                            <span class="text-[9px] font-black px-4 py-1.5 bg-white/5 border border-white/10 rounded-full uppercase tracking-[0.2em] text-slate-400 group-hover:text-white transition-colors">
                                {{ skill.level }}
                            </span>
                        </div>
                        <h3 class="text-3xl font-black mb-4 text-white tracking-tighter">{{ skill.name }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed group-hover:text-slate-300 transition-colors font-medium">{{ skill.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="relative z-10 border-t border-white/5 py-20 flex flex-col items-center px-6 text-center">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1.5 h-1.5 rounded-full bg-pink-600 animate-pulse"></div>
                <div class="w-32 h-[1px] bg-gradient-to-r from-pink-600/50 to-transparent"></div>
            </div>
            <div class="text-[11px] font-black text-slate-500 tracking-[0.6em] uppercase mb-5">
                Designed & Engineered by <span class="text-white border-b border-pink-500/30">Farah Bader</span>
            </div>
            <div class="text-[9px] text-slate-700 uppercase tracking-widest font-mono font-bold">
                System.v2.0 // {{ new Date().getFullYear() }} // Building the future one line at a time
            </div>
        </footer>
    </div>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;500;800&family=JetBrains+Mono:wght@700&display=swap');

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background-color: #020617;
    margin: 0;
}

.font-mono {
    font-family: 'JetBrains Mono', monospace;
}

.animate-spin-slow {
    animation: spin 12s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-fade-in-down {
    animation: fadeInDown 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}
::-webkit-scrollbar-track {
    background: #020617;
}
::-webkit-scrollbar-thumb {
    background: #1e293b;
    border-radius: 20px;
    border: 2px solid #020617;
}
::-webkit-scrollbar-thumb:hover {
    background: #db2777;
}

::selection {
    background: rgba(236, 72, 153, 0.3);
    color: #fff;
}
</style>
