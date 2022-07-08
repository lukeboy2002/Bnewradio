<div x-show="isUserMenu" style="display: none"  >
    <div class="fixed inset-0 overflow z-50" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 overflow-hidden">
            <!-- Background overlay, show/hide based on slide-over state. -->
            <div class="absolute inset-0" aria-hidden="true">
                <div class="fixed inset-y-0 left-0 pr-10 max-w-full flex"
                     x-transition:enter="transform transition ease-in-out duration-1000"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transform transition ease-in-out duration-1000"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="translate-x-full"
                >
                    <div class="w-screen max-w-md bg-white pt-4">
                        <div class="px-2 pt-2 pb-2 sm:px-3">
                            <x-menus.sidebar />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
