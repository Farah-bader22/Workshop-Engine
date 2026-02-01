<script setup>

import { Head, usePage, useForm, router, Link } from '@inertiajs/vue3';
import { ref, onMounted, nextTick } from 'vue';
import Prism from 'prismjs';
import 'prismjs/themes/prism-tomorrow.css';

const props = defineProps({ item: Object, comments: Array });
const { auth } = usePage().props;
const isCopied = ref(false);

const form = useForm({
    comment: '',
    workshop_id: props.item.id,
    user_name: auth.user.name
});

const submitComment = () => {
    if (form.comment.trim() === '') return;
    form.post(route('comments.store'), {
        preserveScroll: true,
        onSuccess: () => { form.reset('comment'); router.reload({ only: ['comments'] }); },
    });
};

const copyCode = async () => {
    if (!props.item.code_snippet) return;
    await navigator.clipboard.writeText(props.item.code_snippet);
    isCopied.value = true;
    setTimeout(() => isCopied.value = false, 2000);
};

const shareProject = async () => {
    if (navigator.share) {
        try {
            await navigator.share({ title: props.item.title, url: window.location.href });
        } catch (err) { console.log("Share failed"); }
    } else {
        await navigator.clipboard.writeText(window.location.href);
        alert("Link copied!");
    }
};

const triggerPDF = () => window.print();

onMounted(() => { nextTick(() => Prism.highlightAll()); });
</script>

<template>
    <Head :title="item.title" />

    <div class="farah-os-wrapper">
        <div class="main-interface">
            <nav class="os-nav print:hidden">
                <div class="nav-container">
                    <div class="brand-group">
                        <Link href="/" class="close-icon">✕</Link>
                        <span class="logo">Farah.OS <span class="accent">_CORE</span></span>
                    </div>
                    <div class="nav-actions hidden md:flex">
                        <button @click="shareProject" class="btn-outline">SHARE</button>
                        <button @click="triggerPDF" class="btn-pink">EXPORT PDF</button>
                    </div>
                </div>
            </nav>

            <main class="viewport custom-scroll">
                <header class="project-hero">
                    <div class="hero-grid">
                        <div class="text-block">
                            <div class="meta-tag">ENGINEERING_LOG // {{ item.id }}</div>
                            <h1 class="main-title">{{ item.title }}</h1>
                            <p class="main-content">{{ item.content }}</p>
                        </div>

                     <div v-if="item.image_url || item.video_url" class="image-viewer">

    <img v-if="item.image_url"
         :src="item.image_url"
         alt="Engineering Visual"
         class="contain-img" />

    <video v-else-if="item.video_url"
           class="w-full h-full object-contain bg-black"
           controls
           autoplay
           muted
           loop>
        <source :src="item.video_url" type="video/mp4">
        Your browser does not support the video tag.
    </video>

</div>
                    </div>
                </header>

                <section v-if="item.code_snippet" class="terminal-container">
                    <div class="terminal-bar">
                        <div class="window-controls"><span></span><span></span><span></span></div>
                        <button @click="copyCode" class="copy-trigger-pink">
                            {{ isCopied ? 'DONE' : 'COPY_SOURCE' }}
                        </button>
                    </div>
                    <div class="terminal-scroll">
                        <pre class="language-javascript"><code>{{ item.code_snippet }}</code></pre>
                    </div>
                </section>

                <section class="collab-box print:hidden">
                    <h2 class="section-label">COLLABORATION_LOG</h2>

                    <div class="collab-grid">
                        <div class="input-panel">
                            <label class="auth-label">AUTH: Eng. {{ auth.user.name }}</label>
                            <textarea v-model="form.comment" placeholder="Log technical notes..."></textarea>
                            <button @click="submitComment" :disabled="form.processing" class="send-btn-pink">EXECUTE_LOG</button>
                        </div>

                        <div class="logs-feed">
                            <div v-for="comment in comments" :key="comment.id" class="log-entry">
                                <div class="entry-meta">
                                    <span class="user-tag">ENG. {{ comment.user_name }}</span>
                                    <span class="time-tag">{{ new Date(comment.created_at).toLocaleDateString() }}</span>
                                </div>
                                <p class="entry-text">{{ comment.comment }}</p>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="mobile-dock md:hidden print:hidden">
                <button @click="copyCode" class="dock-btn">COPY</button>
                <button @click="triggerPDF" class="dock-btn-main">GET PDF</button>
                <button @click="shareProject" class="dock-btn">SHARE</button>
            </footer>
        </div>
    </div>
</template>

<style scoped>
/* Reset and Core Layout */
.farah-os-wrapper {
    background: #000; min-height: 100vh; width: 100%; display: flex;
    align-items: center; justify-content: center; overflow: hidden;
}

.main-interface {
    background: #050505; width: 100%; max-width: 1200px; height: 96vh;
    border: 1px solid #111; display: flex; flex-direction: column; position: relative;
}

.viewport { flex: 1; overflow-y: auto; overflow-x: hidden; padding: 20px; }

/* Navigation */
.os-nav { border-bottom: 1px solid #111; padding: 15px 25px; }
.nav-container { display: flex; justify-content: space-between; align-items: center; }
.logo { color: #fff; font-weight: 900; letter-spacing: -1px; font-size: 1.1rem; }
.accent { color: #db2777; font-size: 0.8rem; }
.close-icon { background: #fff; color: #000; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; font-weight: bold; }

/* Buttons */
.btn-pink, .send-btn-pink { background: #db2777; color: #fff; padding: 10px 20px; border-radius: 8px; font-size: 12px; font-weight: 900; transition: opacity 0.2s; }
.btn-pink:hover, .send-btn-pink:hover { opacity: 0.9; }
.btn-outline { border: 1px solid #222; color: #fff; padding: 10px 20px; border-radius: 8px; font-size: 11px; }

/* Hero Fixes */
.hero-grid { display: grid; grid-template-columns: 1fr; gap: 30px; margin-bottom: 40px; }
@media (min-width: 1024px) { .hero-grid { grid-template-columns: 1.2fr 0.8fr; align-items: center; } }

.main-title { color: #fff; font-size: clamp(1.8rem, 6vw, 3rem); font-weight: 900; margin: 10px 0; word-break: break-word; }
.main-content { color: #fff; border-left: 3px solid #db2777; padding-left: 20px; line-height: 1.7; word-break: break-word; }
.meta-tag { color: #db2777; font-size: 10px; font-weight: bold; letter-spacing: 2px; }

/* Image Display */
.image-viewer {
    background: #000; border: 1px solid #111; border-radius: 12px;
    height: 300px; display: flex; align-items: center; justify-content: center; overflow: hidden;
}
.contain-img { max-width: 100%; max-height: 100%; object-fit: contain; }

/* Terminal (Pink Copy Button) */
.terminal-container { background: #000; border: 1px solid #222; border-radius: 8px; margin: 30px 0; max-width: 100%; }
.terminal-bar { background: #0d0d0d; padding: 10px 15px; display: flex; justify-content: space-between; align-items: center; }
.copy-trigger-pink { background: #db2777; color: #fff; font-size: 10px; font-weight: 900; padding: 6px 12px; border-radius: 6px; }
.terminal-scroll { overflow-x: auto; width: 100%; }
:deep(pre) { margin: 0 !important; padding: 20px !important; font-size: 13px !important; white-space: pre !important; }

/* Collaboration Section */
.collab-grid { display: grid; grid-template-columns: 1fr; gap: 20px; }
@media (min-width: 1024px) { .collab-grid { grid-template-columns: 1fr 1.5fr; } }

.input-panel { background: #0a0a0a; padding: 20px; border-radius: 12px; border: 1px solid #1a1a1a; }
.auth-label { font-size: 10px; color: #db2777; font-weight: bold; }
textarea { width: 100%; background: #000; border: 1px solid #222; color: #fff; padding: 12px; margin: 10px 0; border-radius: 8px; outline: none; }
textarea:focus { border-color: #db2777; }

.log-entry { background: #0a0a0a; border-left: 4px solid #db2777; padding: 15px; margin-bottom: 12px; border-radius: 4px; }
.entry-text { color: #fff !important; font-size: 14px; margin-top: 5px; word-break: break-all; }
.user-tag { color: #db2777; font-weight: 800; font-size: 11px; }

/* Bottom Dock for Mobile */
.mobile-dock {
    position: sticky; bottom: 0; background: rgba(5,5,5,0.95);
    backdrop-filter: blur(10px); padding: 15px; display: flex; gap: 10px; border-top: 1px solid #111;
}
.dock-btn-main { flex: 2; background: #db2777; color: #fff; border-radius: 10px; font-weight: 900; }
.dock-btn { flex: 1; background: #1a1a1a; color: #fff; border-radius: 10px; font-size: 11px; font-weight: bold; }

/* Custom Scrollbar */
.custom-scroll::-webkit-scrollbar { width: 4px; }
.custom-scroll::-webkit-scrollbar-thumb { background: #db2777; }

/* Mobile Optimization */
@media (max-width: 768px) {
    .main-interface { height: 100vh; border-radius: 0; }
    .viewport { padding: 15px; padding-bottom: 20px; }
    .image-viewer { order: -1; height: 200px; }
}
</style>
