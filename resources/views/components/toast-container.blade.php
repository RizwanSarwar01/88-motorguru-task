@props([
    'position' => 'top-right'
])

<div 
    id="toast-container"
    class="fixed z-[10000] {{ $position === 'top-right' ? 'top-4 right-4' : ($position === 'top-left' ? 'top-4 left-4' : ($position === 'bottom-right' ? 'bottom-4 right-4' : 'bottom-4 left-4')) }} flex flex-col gap-3 max-w-md w-full pointer-events-none"
    x-data="toastManager()"
    x-init="init()"
>
    <template x-for="(toast, index) in toasts" :key="toast.id">
        <div
            x-show="toast && toast.show"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-2 sm:translate-x-2"
            x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0"
            x-transition:leave-end="opacity-0 translate-y-2 sm:translate-x-2"
            class="pointer-events-auto w-full bg-white rounded-xl shadow-2xl ring-1 ring-black/5 overflow-hidden"
            :class="{
                'border-l-4 border-green-500': toast.type === 'success',
                'border-l-4 border-red-500': toast.type === 'error',
                'border-l-4 border-yellow-500': toast.type === 'warning',
                'border-l-4 border-blue-500': toast.type === 'info'
            }"
        >
            <div class="p-4">
                <div class="flex items-start">
                    <!-- Icon -->
                    <div class="flex-shrink-0">
                        <div 
                            class="flex items-center justify-center w-10 h-10 rounded-full"
                            :class="{
                                'bg-green-100': toast.type === 'success',
                                'bg-red-100': toast.type === 'error',
                                'bg-yellow-100': toast.type === 'warning',
                                'bg-blue-100': toast.type === 'info'
                            }"
                        >
                            <!-- Success Icon -->
                            <svg x-show="toast.type === 'success'" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <!-- Error Icon -->
                            <svg x-show="toast.type === 'error'" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <!-- Warning Icon -->
                            <svg x-show="toast.type === 'warning'" class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                            <!-- Info Icon -->
                            <svg x-show="toast.type === 'info'" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="ml-3 w-0 flex-1">
                        <p 
                            class="text-sm font-semibold"
                            :class="{
                                'text-green-800': toast.type === 'success',
                                'text-red-800': toast.type === 'error',
                                'text-yellow-800': toast.type === 'warning',
                                'text-blue-800': toast.type === 'info'
                            }"
                            x-text="toast.title"
                        ></p>
                        <p 
                            class="mt-1 text-sm"
                            :class="{
                                'text-green-700': toast.type === 'success',
                                'text-red-700': toast.type === 'error',
                                'text-yellow-700': toast.type === 'warning',
                                'text-blue-700': toast.type === 'info'
                            }"
                            x-text="toast.message"
                        ></p>
                    </div>
                    
                    <!-- Close Button -->
                    <div class="ml-4 flex-shrink-0 flex">
                        <button 
                            @click="removeToast(toast.id)"
                            class="inline-flex rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div 
                x-show="toast.duration > 0"
                class="h-1 bg-gray-200"
            >
                <div 
                    class="h-full transition-all ease-linear"
                    :class="{
                        'bg-green-500': toast.type === 'success',
                        'bg-red-500': toast.type === 'error',
                        'bg-yellow-500': toast.type === 'warning',
                        'bg-blue-500': toast.type === 'info'
                    }"
                    :style="`width: ${toast.progress}%`"
                ></div>
            </div>
        </div>
    </template>
</div>

<script>
    // Define toastManager function globally BEFORE Alpine initializes
    if (typeof window.toastManager === 'undefined') {
        window.toastManager = function() {
            return {
                toasts: [],
                
                init() {
                    const self = this;
                    
                    // Store reference globally for event listener
                    window.toastInstance = self;
                    
                    // Listen for toast events (only register once)
                    if (!window.toastEventListenerAdded) {
                        window.addEventListener('show-toast', function(e) {
                            if (window.toastInstance && typeof window.toastInstance.show === 'function') {
                                window.toastInstance.show(e.detail);
                            }
                        });
                        window.toastEventListenerAdded = true;
                    }
                    
                    // Check for Laravel session flash messages (only once per page load)
                    if (!window.flashMessagesChecked) {
                        window.flashMessagesChecked = true;
                        setTimeout(() => {
                            self.checkFlashMessages();
                        }, 300);
                    }
                },
                
                checkFlashMessages() {
                    const self = this;
                    
                    // Success messages
                    @if(session('success'))
                        setTimeout(() => {
                            self.show({
                                type: 'success',
                                title: 'Success!',
                                message: {!! json_encode(session('success')) !!},
                                duration: 5000
                            });
                        }, 100);
                    @endif
                    
                    // Status messages (Laravel auth)
                    @if(session('status'))
                        setTimeout(() => {
                            self.show({
                                type: 'success',
                                title: 'Success!',
                                message: {!! json_encode(session('status')) !!},
                                duration: 5000
                            });
                        }, 150);
                    @endif
                    
                    // Error messages
                    @if(session('error'))
                        setTimeout(() => {
                            self.show({
                                type: 'error',
                                title: 'Error!',
                                message: {!! json_encode(session('error')) !!},
                                duration: 6000
                            });
                        }, 100);
                    @endif
                    
                    // Warning messages
                    @if(session('warning'))
                        setTimeout(() => {
                            self.show({
                                type: 'warning',
                                title: 'Warning!',
                                message: {!! json_encode(session('warning')) !!},
                                duration: 5000
                            });
                        }, 100);
                    @endif
                    
                    // Info messages
                    @if(session('info'))
                        setTimeout(() => {
                            self.show({
                                type: 'info',
                                title: 'Information',
                                message: {!! json_encode(session('info')) !!},
                                duration: 5000
                            });
                        }, 100);
                    @endif
                    
                    // Validation errors
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            setTimeout(() => {
                                self.show({
                                    type: 'error',
                                    title: 'Validation Error',
                                    message: {!! json_encode($error) !!},
                                    duration: 6000
                                });
                            }, {{ $loop->index * 100 + 200 }});
                        @endforeach
                    @endif
                },
                
                show(options) {
                    if (!options) return;
                    
                    // Prevent duplicate toasts with same message (within 1 second)
                    const now = Date.now();
                    const existingToast = this.toasts.find(t => 
                        t.message === options.message && 
                        t.type === (options.type || 'info') &&
                        (now - t.createdAt) < 1000
                    );
                    
                    if (existingToast) {
                        return; // Don't show duplicate
                    }
                    
                    const toastId = Date.now() + Math.random();
                    const toast = {
                        id: toastId,
                        type: options.type || 'info',
                        title: options.title || this.getDefaultTitle(options.type),
                        message: options.message || '',
                        duration: options.duration !== undefined ? options.duration : 5000,
                        progress: 100,
                        show: true,
                        createdAt: now
                    };
                    
                    // Play sound immediately
                    this.playSound(toast.type);
                    
                    // Add to array - create new array to trigger Alpine reactivity
                    this.toasts = [...this.toasts, toast];
                    
                    // Auto dismiss
                    if (toast.duration > 0) {
                        const startTime = Date.now();
                        const interval = setInterval(() => {
                            const elapsed = Date.now() - startTime;
                            const currentToasts = [...this.toasts];
                            const index = currentToasts.findIndex(t => t.id === toastId);
                            
                            if (index !== -1 && currentToasts[index]) {
                                currentToasts[index].progress = Math.max(0, 100 - (elapsed / toast.duration * 100));
                                this.toasts = currentToasts;
                            }
                            
                            if (elapsed >= toast.duration) {
                                clearInterval(interval);
                                this.removeToast(toastId);
                            }
                        }, 50);
                    }
                },
                
                removeToast(id) {
                    const index = this.toasts.findIndex(t => t.id === id);
                    if (index !== -1) {
                        this.toasts[index].show = false;
                        this.toasts = [...this.toasts];
                        setTimeout(() => {
                            this.toasts = this.toasts.filter(t => t.id !== id);
                        }, 300);
                    }
                },
                
                getDefaultTitle(type) {
                    const titles = {
                        success: 'Success!',
                        error: 'Error!',
                        warning: 'Warning!',
                        info: 'Info'
                    };
                    return titles[type] || 'Notification';
                },
                
                playSound(type) {
                    try {
                        const AudioContextClass = window.AudioContext || window.webkitAudioContext;
                        if (!window.toastAudioContext) {
                            window.toastAudioContext = new AudioContextClass();
                        }
                        
                        const audioContext = window.toastAudioContext;
                        
                        if (audioContext.state === 'suspended') {
                            audioContext.resume().catch(() => {
                                return;
                            });
                        }
                        
                        let frequency, duration;
                        
                        switch(type) {
                            case 'success':
                                frequency = 523.25;
                                duration = 200;
                                break;
                            case 'error':
                                frequency = 220;
                                duration = 300;
                                break;
                            case 'warning':
                                frequency = 440;
                                duration = 150;
                                break;
                            default:
                                frequency = 349.23;
                                duration = 150;
                        }
                        
                        const oscillator = audioContext.createOscillator();
                        const gainNode = audioContext.createGain();
                        
                        oscillator.connect(gainNode);
                        gainNode.connect(audioContext.destination);
                        
                        oscillator.frequency.value = frequency;
                        oscillator.type = type === 'error' ? 'sawtooth' : 'sine';
                        
                        gainNode.gain.setValueAtTime(0, audioContext.currentTime);
                        gainNode.gain.linearRampToValueAtTime(0.2, audioContext.currentTime + 0.01);
                        gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + duration / 1000);
                        
                        oscillator.start(audioContext.currentTime);
                        oscillator.stop(audioContext.currentTime + duration / 1000);
                    } catch (e) {
                        // Silently fail
                    }
                }
            };
        };
    }
    
    // Global function to show toast
    if (typeof window.showToast === 'undefined') {
        window.showToast = function(options) {
            window.dispatchEvent(new CustomEvent('show-toast', { detail: options }));
        };
    }
</script>
