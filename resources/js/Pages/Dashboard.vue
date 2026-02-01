<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import Swal from 'sweetalert2';

const props = defineProps({
    workshops: Array,
    workshopsCount: Number,
    postsCount: Number,
    comments: Array,
});

const isPanelOpen = ref(false);
const editMode = ref(false);
const selectedId = ref(null);
const searchQuery = ref('');
const activeType = ref('workshop');
const imagePreview = ref(null);

const form = useForm({
    title: '',
    date: '',
    category: 'frontend',
    content: '',
    type: 'workshop',
    code_snippet: '',
    image: null,
    video: null,
});

const categories = [
    { value: 'frontend', label: 'Frontend_Architecture' },
    { value: 'backend', label: 'Backend_Infrastructure' },
    { value: 'fullstack', label: 'Fullstack_Systems' },
    { value: 'ai', label: 'AI_Models' },
    { value: 'flutter', label: 'Flutter_Dev' },
    { value: 'software', label: 'General_Engineering' },
    { value: 'cyber', label: 'Cyber_Security' },
];

const totalWorkshops = computed(() => props.workshops.filter(i => i.type === 'workshop').length);
const totalPosts = computed(() => props.workshops.filter(i => i.type === 'post').length);
const totalComments = computed(() => props.comments?.length || 0);

const filteredData = computed(() => {
    return props.workshops.filter(item => {
        const matchesType = item.type === activeType.value;
        const matchesSearch = item.title.toLowerCase().includes(searchQuery.value.toLowerCase());
        return matchesType && matchesSearch;
    });
});

const handleFileChange = (e, field) => {
    const file = e.target.files[0];
    if (file) {
        form[field] = file;
        if (field === 'image') imagePreview.value = URL.createObjectURL(file);
    }
};

const openPanel = (type = 'workshop', mode = 'new', item = null) => {
    editMode.value = mode === 'edit';
    form.reset();
    imagePreview.value = null;
    form.type = type;
    if (editMode.value && item) {
        selectedId.value = item.id;
        form.title = item.title;
        form.date = item.date;
        form.category = item.category;
        form.content = item.content;
        form.code_snippet = item.code_snippet || '';
    }
    isPanelOpen.value = true;
};

const closePanel = () => { isPanelOpen.value = false; form.reset(); };

const submitForm = () => {
    if (editMode.value) {
        form.transform((data) => ({ ...data, _method: 'PUT' }))
            .post(route('workshops.update', selectedId.value), { forceFormData: true, onSuccess: () => closePanel() });
    } else {
        form.post(route('workshops.store'), { forceFormData: true, onSuccess: () => closePanel() });
    }
};

const deleteItem = (id) => {
    Swal.fire({
        title: 'EXECUTE_PURGE?',
        background: '#050505',
        color: '#ffffff',
        confirmButtonColor: '#ff007a',
        showCancelButton: true,
    }).then((result) => { if (result.isConfirmed) router.delete(route('workshops.destroy', id)); });
};

const deleteComment = (id) => {
    Swal.fire({
        title: 'TERMINATE_SIGNAL?',
        background: '#050505',
        color: '#ffffff',
        confirmButtonColor: '#ff007a',
        showCancelButton: true,
    }).then((result) => { if (result.isConfirmed) router.delete(route('comments.destroy', id)); });
};
</script>

<template>
    <Head title="FB // CORE_SYSTEM" />
    <AuthenticatedLayout>
        <div class="min-h-screen bg-[#020202] text-zinc-400 font-sans selection:bg-pink-500/30 overflow-x-hidden">

            <div class="fixed top-0 left-0 w-full h-[1px] bg-zinc-900 z-[100] overflow-hidden">
                <div class="h-full bg-pink-600 w-1/4 animate-scan shadow-[0_0_15px_#db2777]"></div>
            </div>

            <main class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-12 py-6 md:py-12">

                <header class="flex flex-col gap-8 mb-12 md:mb-16">
                    <div class="border-l-4 border-pink-600 pl-6">
                        <span class="text-[10px] font-black tracking-[0.4em] text-pink-600 uppercase block mb-2">Admin_Console_v4</span>
                        <h1 class="text-4xl sm:text-6xl md:text-8xl font-black text-white uppercase italic tracking-tighter">
                            Engineering<span class="text-zinc-800 ml-2">Hub</span>
                        </h1>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <Link :href="route('public.showcase')" class="flex-1 sm:flex-none text-center px-8 py-4 border border-zinc-900 text-[10px] font-bold uppercase hover:bg-white hover:text-black transition-all italic">Live_View</Link>
                        <button @click="openPanel('workshop')" class="flex-1 sm:flex-none px-8 py-4 bg-white text-black text-[10px] font-black uppercase tracking-widest hover:bg-pink-600 hover:text-white transition-all">+ Workshop</button>
                        <button @click="openPanel('post')" class="flex-1 sm:flex-none px-8 py-4 bg-zinc-900 text-white text-[10px] font-black uppercase tracking-widest hover:bg-pink-600 transition-all">+ Post</button>
                    </div>
                </header>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 mb-12">
                    <div v-for="(val, label) in { 'Units': totalWorkshops + totalPosts, 'Workshops': totalWorkshops, 'Feedback': totalComments, 'Region': 'Palestine' }" :key="label"
                         class="bg-[#050505] border border-zinc-900 p-6 md:p-10 hover:border-pink-600 transition-all group">
                        <p class="text-[9px] uppercase tracking-widest text-zinc-600 font-bold mb-3 group-hover:text-pink-600">{{ label }}</p>
                        <p class="text-2xl md:text-5xl font-light text-white italic truncate">{{ val }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">

                    <div class="xl:col-span-8 space-y-6">
                        <div class="flex flex-col sm:flex-row border border-zinc-900 bg-[#080808] rounded-sm overflow-hidden">
                            <div class="flex divide-x divide-zinc-900 border-b sm:border-b-0 sm:border-r border-zinc-900">
                                <button v-for="t in ['workshop', 'post']" :key="t" @click="activeType = t"
                                        :class="activeType === t ? 'bg-white text-black' : 'text-zinc-500'"
                                        class="px-8 py-5 text-[10px] font-black uppercase tracking-widest transition-all">
                                    {{ t }}s
                                </button>
                            </div>
                            <input v-model="searchQuery" placeholder="SEARCH_CORE_DATA..."
                                   class="flex-1 bg-transparent border-none px-6 py-5 text-[11px] font-mono text-white focus:ring-0 placeholder:text-zinc-800" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div v-for="item in filteredData" :key="item.id"
                                 class="bg-[#050505] border border-zinc-900 p-8 flex flex-col justify-between min-h-[220px] hover:border-zinc-400 transition-all group relative overflow-hidden">
                                <div class="absolute top-0 right-0 p-4 flex gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button @click="openPanel(item.type, 'edit', item)" class="text-zinc-500 hover:text-white"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></button>
                                    <button @click="deleteItem(item.id)" class="text-zinc-500 hover:text-pink-600"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                </div>
                                <div class="mb-4">
                                    <span class="text-[8px] font-mono text-pink-600 uppercase tracking-[0.3em] mb-2 block">{{ item.category }}</span>
                                    <h3 class="text-2xl font-black text-white uppercase italic leading-tight line-clamp-2">{{ item.title }}</h3>
                                </div>
                                <div class="flex justify-between items-center pt-6 border-t border-zinc-900/50">
                                    <span class="text-[10px] font-mono text-zinc-700">REF_{{ item.id }}</span>
                                    <span class="text-[10px] font-mono text-zinc-500 italic">{{ item.date }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="xl:col-span-4 space-y-6">
                        <div class="bg-[#050505] border border-zinc-900 flex flex-col h-full max-h-[800px]">
                            <div class="p-6 border-b border-zinc-900 flex justify-between items-center">
                                <h2 class="text-xs font-black uppercase text-white tracking-[0.3em]">Feedback_Stream</h2>
                                <span class="bg-pink-600 text-white text-[9px] px-2 py-1 font-bold">{{ totalComments }}</span>
                            </div>

                            <div class="overflow-y-auto custom-scrollbar p-2 space-y-2">
                                <div v-for="comment in comments" :key="comment.id"
                                     class="bg-[#0a0a0a] border border-zinc-900 p-5 hover:border-pink-900/50 transition-all group">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <p class="text-white text-[11px] font-bold uppercase tracking-wider mb-1">{{ comment.user_name }}</p>
                                            <p class="text-pink-600 text-[9px] font-mono italic">@{{ comment.workshop?.title || 'System' }}</p>
                                        </div>
                                        <button v-if="$page.props.auth.user.is_admin" @click="deleteComment(comment.id)"
                                                class="opacity-0 group-hover:opacity-100 text-[8px] text-red-800 font-black uppercase border border-red-900/20 px-2 py-1 hover:bg-red-600 hover:text-white transition-all">
                                            Kill
                                        </button>
                                    </div>
                                    <p class="text-zinc-500 text-xs italic leading-relaxed">"{{ comment.comment }}"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <Transition name="slide">
                <div v-if="isPanelOpen" class="fixed inset-0 z-[2000] flex justify-end">
                    <div @click="closePanel" class="absolute inset-0 bg-black/95 backdrop-blur-md"></div>
                    <div class="relative w-full md:max-w-2xl bg-[#080808] h-full shadow-2xl flex flex-col border-l border-zinc-900">
                        <div class="p-8 border-b border-zinc-900 flex justify-between items-center bg-black">
                            <h2 class="text-2xl font-black uppercase italic text-white">{{ editMode ? 'Sync' : 'Initialize' }}</h2>
                            <button @click="closePanel" class="text-zinc-500 hover:text-white transition-all">
                                <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <form @submit.prevent="submitForm" class="p-6 md:p-12 space-y-10 overflow-y-auto flex-1 custom-scrollbar pb-32">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase text-zinc-600 tracking-[0.4em]">Project_Label</label>
                                <input v-model="form.title" required class="w-full bg-transparent border-b border-zinc-900 py-4 text-2xl font-black text-white outline-none focus:border-pink-600 transition-all uppercase italic" />
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase text-zinc-600 tracking-[0.4em]">Category</label>
                                    <select v-model="form.category" class="w-full bg-zinc-950 border border-zinc-900 p-4 text-xs text-zinc-400 outline-none uppercase italic focus:border-pink-600">
                                        <option v-for="c in categories" :key="c.value" :value="c.value">{{ c.label }}</option>
                                    </select>
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase text-zinc-600 tracking-[0.4em]">Date_Stamp</label>
                                    <input type="date" v-model="form.date" class="w-full bg-zinc-950 border border-zinc-900 p-4 text-xs text-zinc-400 outline-none focus:border-pink-600" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="relative h-40 border-2 border-dashed border-zinc-900 bg-black flex items-center justify-center group overflow-hidden">
                                    <input type="file" @change="e => handleFileChange(e, 'image')" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                                    <img v-if="imagePreview" :src="imagePreview" class="absolute inset-0 w-full h-full object-cover opacity-50" />
                                    <span class="text-[10px] font-bold text-zinc-700 group-hover:text-pink-600 transition-colors uppercase">Attach_Image</span>
                                </div>
                                <div class="relative h-40 border-2 border-dashed border-zinc-900 bg-black flex items-center justify-center group">
                                    <input type="file" @change="e => handleFileChange(e, 'video')" accept="video/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                                    <span class="text-[10px] font-bold text-zinc-700 group-hover:text-pink-600 transition-colors uppercase">Attach_Stream</span>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase text-pink-600 tracking-[0.4em]">Core_Snippet</label>
                                <textarea v-model="form.code_snippet" rows="8" class="w-full bg-black border border-zinc-900 p-6 font-mono text-[11px] text-pink-500 focus:text-white outline-none focus:border-pink-600 transition-all shadow-inner" placeholder="// Your code here..."></textarea>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase text-zinc-600 tracking-[0.4em]">Payload_Content</label>
                                <textarea v-model="form.content" rows="4" class="w-full bg-black border border-zinc-900 p-6 text-xs text-zinc-400 outline-none focus:border-zinc-100 transition-all"></textarea>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 pt-10">
                                <button type="button" @click="closePanel" class="flex-1 py-5 bg-zinc-950 text-white text-[10px] font-black uppercase tracking-widest border border-zinc-900 hover:bg-red-950/20">Cancel</button>
                                <button type="submit" :disabled="form.processing" class="flex-[2] py-5 bg-white text-black text-[10px] font-black uppercase tracking-[0.4em] hover:bg-pink-600 hover:text-white transition-all">Execute_Push</button>
                            </div>
                        </form>
                    </div>
                </div>
            </Transition>

        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;700;900&display=swap');
.font-sans { font-family: 'Space Grotesk', sans-serif; }

@keyframes scan { 0% { transform: translateX(-100%); } 100% { transform: translateX(400%); } }
.animate-scan { animation: scan 4s linear infinite; }

.slide-enter-active, .slide-leave-active { transition: all 0.6s cubic-bezier(0.85, 0, 0.15, 1); }
.slide-enter-from, .slide-leave-to { transform: translateX(100%); opacity: 0; }

.custom-scrollbar::-webkit-scrollbar { width: 3px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #db2777; }
.custom-scrollbar::-webkit-scrollbar-track { background: #020202; }

/* Mobile Optimizations */
@media (max-width: 640px) {
    .text-4xl { font-size: 2.5rem; }
    .p-8 { padding: 1.5rem; }
}
</style>

