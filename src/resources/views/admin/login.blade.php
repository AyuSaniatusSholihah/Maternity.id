<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal Login — Maternity.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-serif-brand {
            font-family: 'DM Serif Display', serif;
        }
    </style>
</head>
<body class="min-h-screen bg-[#FAF5F2] text-neutral-800 flex items-center justify-center p-4 sm:p-6 relative overflow-x-hidden selection:bg-[#5F8C72] selection:text-white">

    {{-- Background Decorative Ambient Circles --}}
    <div class="fixed -top-32 -left-32 w-96 h-96 rounded-full bg-[#DEAAA1]/25 blur-3xl pointer-events-none"></div>
    <div class="fixed -bottom-32 -right-32 w-96 h-96 rounded-full bg-[#5F8C72]/20 blur-3xl pointer-events-none"></div>
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full bg-[#FAF0EC]/60 blur-3xl pointer-events-none"></div>

    {{-- Main Container Card --}}
    <div class="w-full max-w-md relative z-10" 
         x-data="{ 
            username: '', 
            password: '', 
            showPassword: false, 
            rememberMe: true, 
            isLoading: false, 
            errorMessage: '',
            handleLogin() {
                if (!this.username.trim()) {
                    this.errorMessage = 'Silakan masukkan username atau email admin.';
                    return;
                }
                if (!this.password) {
                    this.errorMessage = 'Silakan masukkan password admin.';
                    return;
                }
                this.errorMessage = '';
                this.isLoading = true;
                
                // Frontend Mock Redirection ke Dashboard
                setTimeout(() => {
                    window.location.href = '{{ route('admin.dashboard') }}';
                }, 800);
            }
         }">

        {{-- Top Brand Navigation Link --}}
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-neutral-500 hover:text-[#8C433C] transition group">
                <svg class="w-4 h-4 transition group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Website Maternity.id</span>
            </a>
        </div>

        {{-- Login Box Card --}}
        <div class="bg-white/95 backdrop-blur-md rounded-3xl p-7 sm:p-9 shadow-xl border border-white/80 relative overflow-hidden">
            
            {{-- Top Corner Subtle Accent Bar --}}
            <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-[#5F8C72] via-[#DEAAA1] to-[#8C433C]"></div>

            {{-- Header Title & Badge --}}
            <div class="text-center mb-7">
                {{-- Logo Icon --}}
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#EDF5F0] border border-[#9DB89D]/40 text-[#5F8C72] mb-3 shadow-xs">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>

                <div class="flex items-center justify-center gap-1.5 mb-1">
                    <span class="text-xl font-extrabold text-[#8C433C] tracking-tight">Maternity<span class="text-[#5F8C72]">.id</span></span>
                    <span class="bg-[#5F8C72] text-white text-[10px] font-bold px-2 py-0.5 rounded-md tracking-wider uppercase">Portal</span>
                </div>

                <h1 class="text-xl font-bold text-neutral-900 tracking-tight font-serif-brand">
                    Admin Authentication
                </h1>
                <p class="text-xs text-neutral-500 mt-1">
                    Masukkan kredensial administrator untuk mengelola sistem
                </p>
            </div>

            {{-- Error Notification Banner --}}
            <div x-show="errorMessage" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="mb-5 bg-red-50 border border-red-200 text-red-700 text-xs px-3.5 py-2.5 rounded-xl flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation text-sm shrink-0 text-red-500"></i>
                <span x-text="errorMessage"></span>
            </div>

            {{-- Form Login --}}
            <form action="{{ route('admin.library') }}" method="GET" @submit.prevent="handleLogin()" class="space-y-4">
                
                {{-- Username / Email Field --}}
                <div>
                    <label class="block text-xs font-bold text-neutral-700 mb-1.5">
                        Username atau Email Admin
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <input type="text" 
                               x-model="username" 
                               name="username" 
                               placeholder="admin@maternity.id atau sarah_admin"
                               autocomplete="username"
                               class="w-full bg-[#FAF5F2] border border-neutral-300/80 rounded-xl pl-10 pr-4 py-2.5 text-xs text-neutral-900 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white transition">
                    </div>
                </div>

                {{-- Password Field with Show/Hide Toggle --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold text-neutral-700">
                            Password
                        </label>
                        <a href="javascript:void(0)" 
                           @click="alert('Silakan hubungi Super Admin / Tim IT Maternity.id untuk reset password akun administrator.')" 
                           class="text-[11px] text-[#8C433C] hover:underline font-medium">
                            Lupa password?
                        </a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input :type="showPassword ? 'text' : 'password'" 
                               x-model="password" 
                               name="password" 
                               placeholder="••••••••••••"
                               autocomplete="current-password"
                               class="w-full bg-[#FAF5F2] border border-neutral-300/80 rounded-xl pl-10 pr-10 py-2.5 text-xs text-neutral-900 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white transition">
                        <button type="button" 
                                @click="showPassword = !showPassword" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-neutral-400 hover:text-neutral-700 focus:outline-none">
                            <i :class="showPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye'" class="text-xs"></i>
                        </button>
                    </div>
                </div>

                {{-- Remember Me & Security Info --}}
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" 
                               x-model="rememberMe" 
                               class="w-4 h-4 text-[#5F8C72] bg-[#FAF5F2] border-neutral-300 rounded focus:ring-[#5F8C72] cursor-pointer">
                        <span class="text-xs text-neutral-600 font-medium">Ingat perangkat ini</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit" 
                            :disabled="isLoading"
                            class="w-full bg-[#5F8C72] hover:bg-[#4f755e] active:scale-[0.99] text-white font-bold py-3 px-4 rounded-xl text-xs flex items-center justify-center gap-2 transition shadow-sm hover:shadow-md cursor-pointer disabled:opacity-75">
                        <template x-if="!isLoading">
                            <span class="flex items-center gap-2">
                                <span>Masuk ke Admin Portal</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </span>
                        </template>
                        <template x-if="isLoading">
                            <span class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Memverifikasi Kredensial...</span>
                            </span>
                        </template>
                    </button>
                </div>

            </form>

            {{-- Security Footer Indicator --}}
            <div class="mt-6 pt-5 border-t border-neutral-100 flex items-center justify-center gap-2 text-[11px] text-neutral-500">
                <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Akses Terenkripsi & Terotorisasi Administrator</span>
            </div>

        </div>

        {{-- Copyright & Help Info --}}
        <p class="text-center text-[11px] text-neutral-500 mt-5">
            &copy; {{ date('Y') }} Maternity.id. Seluruh hak cipta dilindungi.
        </p>

    </div>

</body>
</html>
