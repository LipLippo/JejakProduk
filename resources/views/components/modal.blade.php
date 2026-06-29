<div x-data="{ show: false }" 
     @open-modal.window="if ($event.detail === '{{ $name }}') show = true" 
     @close-modal.window="if ($event.detail === '{{ $name }}') show = false" 
     @keydown.escape.window="show = false" 
     class="relative z-50" 
     x-show="show" 
     style="display: none;">
     
    <!-- Backdrop -->
    <div x-show="show" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/40 backdrop-blur-sm"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-end sm:items-center justify-center p-0 sm:p-4">
            <div x-show="show" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 class="w-full sm:max-w-md bg-white rounded-t-3xl sm:rounded-2xl shadow-xl overflow-hidden p-5 sm:p-6 max-h-[90vh] overflow-y-auto" 
                 @click.away="show = false">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
