<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    workshops: Array
});

const activeFilter = ref('All');
const categories = computed(() => {
    const allCats = props.workshops.map(w => w.category);
    return ['All', ...new Set(allCats)];
});

const filteredWorkshops = computed(() => {
    if (activeFilter.value === 'All') return props.workshops;
    return props.workshops.filter(w => w.category === activeFilter.value);
});

const submitContactForm = () => {
    const subject = encodeURIComponent(`Inquiry for Engineer Farah Bader`);
    window.location.href = `mailto:farahbader104@gmail.com?subject=${subject}`;
};
</script>

<template>
    <Head title="Farah Bader | Systems Architect" />

    <div class="min-h-screen bg-[#050508] text-zinc-300 font-sans selection:bg-pink-500/50 relative overflow-x-hidden">

        <div class="fixed inset-0 z-0 opacity-[0.03] pointer-events-none">
            <div class="absolute inset-0" style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        </div>

        <div class="fixed inset-0 pointer-events-none z-0">
            <div class="absolute top-[-5%] left-[-5%] w-[80%] md:w-[45%] h-[45%] bg-pink-900/10 rounded-full blur-[80px] md:blur-[120px] animate-blob"></div>
            <div class="absolute bottom-[-5%] right-[-5%] w-[80%] md:w-[45%] h-[45%] bg-indigo-900/10 rounded-full blur-[80px] md:blur-[120px] animate-blob animation-delay-2000"></div>
        </div>

        <nav class="max-w-6xl mx-auto px-4 md:px-6 py-6 md:py-8 flex justify-between items-center relative z-20 border-b border-white/5 backdrop-blur-md">
            <div class="text-white text-lg md:text-xl font-bold tracking-tighter uppercase italic">
                FARAH<span class="text-pink-600">.</span>BADER
            </div>
            <div class="flex items-center gap-4 md:gap-10">
                <a href="#projects" class="hidden sm:block text-[9px] md:text-[10px] font-bold uppercase tracking-[0.2em] hover:text-pink-500 transition-colors">Modules</a>
                <Link :href="route('login')" class="text-[8px] md:text-[10px] font-black uppercase tracking-widest bg-white/5 px-4 py-2 rounded-full border border-white/10 hover:bg-pink-600 hover:text-white transition-all">
                    Access
                </Link>
            </div>
        </nav>

        <main class="max-w-6xl mx-auto px-4 md:px-6 relative z-10">
            <section class="min-h-[70vh] md:min-h-[80vh] flex flex-col justify-center items-start py-12 md:py-20">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-pink-600/10 border border-pink-600/20 rounded-full mb-6 md:mb-8">
                    <span class="w-1.5 h-1.5 rounded-full bg-pink-600 animate-pulse"></span>
                    <span class="text-[8px] md:text-[9px] font-bold uppercase tracking-[0.2em] md:tracking-[0.3em] text-pink-500">Engineering future-proof solutions</span>
                </div>

                <h1 class="text-white text-4xl sm:text-6xl md:text-9xl font-black tracking-tighter leading-[0.9] mb-8 md:mb-10 animate-fade-in-up uppercase italic">
                    Architecting <br/>
                    <span class="bg-gradient-to-r from-pink-600 via-purple-500 to-indigo-500 bg-clip-text text-transparent">Digital</span> Impact.
                </h1>

                <p class="max-w-2xl text-base md:text-xl text-zinc-500 leading-relaxed font-light mb-8 md:mb-12 italic">
                    Software Engineer specialized in high-performance architectures and technical leadership. Creating modules that bridge the gap between design and scalable engineering.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                    <a href="#projects" class="text-center px-8 py-4 bg-white text-black font-black uppercase tracking-widest text-[10px] rounded-full hover:bg-pink-600 hover:text-white transition-all shadow-lg">
                        Explore_Modules
                    </a>
                    <button @click="submitContactForm" class="text-center px-8 py-4 border border-white/10 text-zinc-400 font-black uppercase tracking-widest text-[10px] rounded-full hover:border-pink-500 hover:text-pink-500 transition-all">
                        Contact_Engineer
                    </button>
                </div>
            </section>

            <section id="projects" class="py-16 md:py-24 border-t border-white/5">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 md:mb-16 gap-6 md:gap-8">
                    <div class="w-full md:w-auto">
                        <h3 class="text-3xl md:text-4xl font-bold text-white italic uppercase tracking-tighter mb-6">Core_Deployments.</h3>
                        <div class="flex flex-wrap gap-2 overflow-x-auto pb-2 no-scrollbar">
                            <button
                                v-for="cat in categories" :key="cat"
                                @click="activeFilter = cat"
                                :class="[
                                    'whitespace-nowrap text-[8px] md:text-[9px] font-bold uppercase tracking-widest px-4 py-2 rounded-full border transition-all',
                                    activeFilter === cat ? 'bg-pink-600 border-pink-600 text-white' : 'border-white/10 text-zinc-500 hover:border-white/30'
                                ]"
                            >
                                {{ cat }}
                            </button>
                        </div>
                    </div>
                    <p class="hidden md:block text-zinc-600 font-mono text-[10px] uppercase tracking-widest">
                        // Active_Modules: {{ filteredWorkshops.length }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10">
                    <div v-for="workshop in filteredWorkshops" :key="workshop.id"
                        class="group relative bg-[#0a0a0f] border border-white/5 p-4 rounded-[1.5rem] md:rounded-[2rem] hover:border-pink-600/40 transition-all duration-500">

                        <div class="relative aspect-[16/10] mb-6 md:mb-8 overflow-hidden rounded-[1rem] md:rounded-[1.5rem] bg-zinc-900 border border-white/5">
                           <img v-if="workshop.image_url"
     :src="workshop.image_url"
     class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105"
     loading="lazy" />

                            <video v-else-if="workshop.video_url"
                                   class="w-full h-full object-cover opacity-60 group-hover:opacity-100"
                                   muted loop autoplay playsinline>
                             <source :src="workshop.video_url" type="video/mp4">
                            </video>

                            <div class="absolute inset-0 pointer-events-none bg-gradient-to-b from-transparent via-pink-500/10 to-transparent h-full w-full animate-scan opacity-0 group-hover:opacity-100"></div>
                        </div>

                        <div class="px-2 md:px-4 pb-4">
                            <div class="flex justify-between items-center mb-3 md:mb-4">
                                <span class="text-[8px] md:text-[9px] font-mono text-pink-500 uppercase tracking-widest px-2 py-1 bg-pink-600/5 rounded border border-pink-500/10">
                                    {{ workshop.category }}
                                </span>
                                <span class="text-[9px] md:text-[10px] text-zinc-600 font-mono italic">{{ workshop.date }}</span>
                            </div>

                            <h4 class="text-xl md:text-3xl font-bold text-white mb-3 md:mb-4 group-hover:text-pink-600 transition-colors uppercase italic tracking-tighter leading-tight">
                                {{ workshop.title }}
                            </h4>

                            <p class="text-zinc-500 text-xs md:text-sm leading-relaxed mb-6 md:mb-10 line-clamp-2 italic font-light">
                                {{ workshop.content || 'Technical specifications pending synchronization...' }}
                            </p>

                            <Link :href="route('public.details', workshop.id)"
                                  class="inline-flex items-center gap-3 text-[9px] md:text-[10px] font-black uppercase tracking-widest text-white hover:text-pink-500 transition-all group/link">
                                <span class="w-6 md:w-8 h-[1px] bg-white group-hover/link:w-10 md:group-hover/link:w-12 group-hover/link:bg-pink-500 transition-all"></span>
                                View_Detailed_Module
                            </Link>
                        </div>
                    </div>
                </div>
            </section>

            <section id="contact" class="py-20 md:py-32">
                <div class="max-w-4xl mx-auto relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-pink-600 to-indigo-600 rounded-[2rem] md:rounded-[40px] blur opacity-10 group-hover:opacity-20 transition duration-1000"></div>
                    <div class="relative bg-black border border-white/5 p-8 md:p-16 rounded-[2rem] md:rounded-[40px] text-center overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-[0.02] font-mono text-[60px] md:text-[120px] font-black italic select-none">BUILD</div>

                        <h2 class="text-3xl md:text-6xl font-bold text-white mb-6 md:mb-8 tracking-tighter italic uppercase relative z-10">Start_Engineering.</h2>
                        <p class="text-zinc-500 mb-8 md:mb-12 max-w-lg mx-auto italic text-sm md:text-lg font-light relative z-10">
                            Available for high-level workshops, system architecture consulting, and impactful collaborations.
                        </p>

                        <div class="flex flex-col items-center gap-6 md:gap-8 relative z-10">
                            <a href="mailto:farahbader104@gmail.com" class="text-sm md:text-2xl font-light text-zinc-300 hover:text-pink-500 transition-colors tracking-tight break-all px-4">
                                farahbader104<span class="text-pink-600">@</span>gmail.com
                            </a>
                            <button @click="submitContactForm" class="w-full sm:w-auto px-10 py-4 bg-white text-black font-black uppercase tracking-[0.2em] md:tracking-[0.3em] text-[10px] rounded-full hover:bg-pink-600 hover:text-white transition-all shadow-xl">
                                Dispatch_Signal
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="max-w-6xl mx-auto px-4 md:px-6 py-10 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-[8px] md:text-[9px] font-bold uppercase tracking-[0.3em] md:tracking-[0.4em] text-zinc-700 italic text-center md:text-left">
                &copy; {{ new Date().getFullYear() }} Farah Bader Systems // Engineering Documentation
            </div>
            <div class="flex gap-6 md:gap-8">
                <a href="https://www.linkedin.com/in/farah-bader-528994379" target="_blank" class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-zinc-500 hover:text-pink-600 transition-colors">LinkedIn</a>
                <a href="https://github.com/Farah-bader22" target="_blank" class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-zinc-500 hover:text-pink-600 transition-colors">GitHub</a>
            </div>
        </footer>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;700&display=swap');

:deep(html) {
    scroll-behavior: smooth;
}

.font-sans {
    font-family: 'Space Grotesk', sans-serif;
}

/* Scrollbar and utility */
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

@keyframes blob {
    0%, 100% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(20px, -30px) scale(1.05); }
    66% { transform: translate(-15px, 15px) scale(0.95); }
}

@keyframes scan {
    0% { transform: translateY(-100%); }
    100% { transform: translateY(100%); }
}

.animate-blob { animation: blob 10s infinite ease-in-out; }
.animate-scan { animation: scan 3s linear infinite; }

.animate-fade-in-up {
    animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

::-webkit-scrollbar { width: 3px; }
::-webkit-scrollbar-track { background: #050508; }
::-webkit-scrollbar-thumb { background: #db2777; border-radius: 10px; }
</style>
