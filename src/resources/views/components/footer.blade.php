{{-- ─── FOOTER MATERNITY.ID ───────────────────────────────────────────
    Dipakai via <x-footer /> di dalam x-layout
──────────────────────────────────────────────────────────────────── --}}
<footer class="w-full bg-[#FAF0EE] border-t border-[#EEE0DC] mt-auto py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs md:text-sm text-gray-600">
        <!-- Logo Footer & Copyright -->
        <div class="flex items-center gap-3">
            <x-logo class="w-6 h-6" />
            <p>&copy; {{ date('Y') }} Maternity Woman's Health. Empowering in every stage of life.</p>
        </div>

        <!-- Footer Links -->
        <div class="flex flex-wrap items-center gap-6 font-medium text-[#3D2B2B]">
            <a href="#" class="hover:underline hover:text-[#2A1614] transition-colors">Support Center</a>
            <a href="#" class="hover:underline hover:text-[#2A1614] transition-colors">Privacy Policy</a>
            <a href="#" class="hover:underline hover:text-[#2A1614] transition-colors">Terms of Service</a>
            <a href="#" class="hover:underline hover:text-[#2A1614] transition-colors">Contact Us</a>
        </div>
    </div>
</footer>
