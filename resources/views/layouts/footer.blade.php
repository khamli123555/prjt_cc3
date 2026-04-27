<footer class="bg-white border-t border-gray-100 py-8 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <span class="text-sm font-semibold text-gray-900 tracking-tight">MedAppoint <span class="text-gray-400 font-normal">© {{ date('Y') }}</span></span>
            </div>
            
            <div class="flex gap-6">
                <a href="#" class="text-xs font-medium text-gray-500 hover:text-indigo-600 transition-colors">{{ __('app.footer.privacy') }}</a>
                <a href="#" class="text-xs font-medium text-gray-500 hover:text-indigo-600 transition-colors">{{ __('app.footer.terms') }}</a>
                <a href="#" class="text-xs font-medium text-gray-500 hover:text-indigo-600 transition-colors">{{ __('app.footer.support') }}</a>
            </div>
        </div>
    </div>
</footer>
