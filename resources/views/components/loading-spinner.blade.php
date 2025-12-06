@props([
    'id' => 'loading-spinner',
    'message' => 'Loading...'
])

<div
    id="{{ $id }}"
    class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/60 backdrop-blur-sm transition-all duration-300"
    style="display: none; opacity: 0;"
>
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full mx-4 flex flex-col items-center transform transition-all duration-300"
         style="box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">

        <!-- Modern Spinner -->
        <div class="relative w-16 h-16 mb-6">
            <!-- Background ring -->
            <div class="absolute inset-0 border-4 border-gray-200 rounded-full"></div>

            <!-- Primary spinning ring -->
            <div class="absolute inset-0 border-4 border-transparent border-t-orange-600 border-r-orange-600 rounded-full animate-spin"></div>

            <!-- Secondary counter-spinning ring -->
            <div class="absolute inset-2 border-4 border-transparent border-t-amber-500 border-r-amber-500 rounded-full animate-spin"
                 style="animation-direction: reverse; animation-duration: 0.8s;"></div>

            <!-- Center dot -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-2 h-2 bg-gradient-to-br from-orange-600 to-amber-500 rounded-full animate-pulse"></div>
            </div>
        </div>

        <!-- Message -->
        <div class="text-center space-y-2 mb-6">
            <p class="text-gray-800 font-semibold text-lg" id="{{ $id }}-message">
                {{ $message }}
            </p>
            <p class="text-gray-500 text-sm">Please wait...</p>
        </div>

        <!-- Animated Progress Bar -->
        <div class="w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-orange-600 via-orange-500 to-amber-500 rounded-full progress-bar-animation"></div>
        </div>
    </div>
</div>

<style>
    @keyframes progressBar {
        0% {
            width: 0%;
        }
        100% {
            width: 100%;
        }
    }

    .progress-bar-animation {
        width: 0%;
        animation: progressBar 3s ease-out forwards;
    }

    /* Smooth fade in animation */
    #{{ $id }}[style*="opacity: 1"] > div {
        animation: scaleIn 0.3s ease-out;
    }

    @keyframes scaleIn {
        0% {
            transform: scale(0.9);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

<script>
    (function() {
        // Track if we're in browser navigation (back/forward button)
        let isBrowserNavigation = false;
        let navigationBlockTimeout = null;

        // Global functions to show/hide loading spinner
        window.showLoading = function(message = 'Loading...', spinnerId = 'loading-spinner') {
            // Don't show spinner if this is browser navigation
            if (isBrowserNavigation) {
                return;
            }

            const spinner = document.getElementById(spinnerId);
            if (spinner) {
                const messageElement = document.getElementById(spinnerId + '-message');
                if (messageElement && message) {
                    messageElement.textContent = message;
                }

                // Reset progress bar animation
                const progressBar = spinner.querySelector('.progress-bar-animation');
                if (progressBar) {
                    progressBar.style.animation = 'none';
                    progressBar.offsetHeight; // Force reflow
                    progressBar.style.animation = 'progressBar 3s ease-out forwards';
                }

                spinner.style.display = 'flex';
                // Force reflow to ensure display change is applied
                spinner.offsetHeight;
                spinner.style.opacity = '1';
            }
        };

        window.hideLoading = function(spinnerId = 'loading-spinner') {
            const spinner = document.getElementById(spinnerId);
            if (spinner) {
                spinner.style.opacity = '0';
                setTimeout(function() {
                    spinner.style.display = 'none';
                }, 300);
            }
        };

        // Get appropriate message based on form action
        function getFormMessage(form) {
            // Check for custom message first
            if (form.dataset.loadingMessage) {
                return form.dataset.loadingMessage;
            }

            const method = (form.querySelector('input[name="_method"]')?.value || form.method).toUpperCase();
            const action = form.action.toLowerCase();
            const submitButton = form.querySelector('button[type="submit"]');
            const buttonText = submitButton?.textContent?.trim() || '';

            // Determine action type from URL or button text
            let actionType = '';
            if (action.includes('/store') || action.includes('/create') || buttonText.toLowerCase().includes('create') || buttonText.toLowerCase().includes('add') || buttonText.toLowerCase().includes('save')) {
                actionType = 'Creating';
            } else if (action.includes('/update') || action.includes('/edit') || method === 'PUT' || method === 'PATCH' || buttonText.toLowerCase().includes('update') || buttonText.toLowerCase().includes('edit')) {
                actionType = 'Updating';
            } else if (method === 'DELETE' || buttonText.toLowerCase().includes('delete') || buttonText.toLowerCase().includes('remove')) {
                actionType = 'Deleting';
            } else {
                actionType = 'Processing';
            }

            // Get resource name from URL
            let resourceName = 'record';
            const urlParts = action.split('/').filter(p => p);
            if (urlParts.length > 0) {
                const lastPart = urlParts[urlParts.length - 1];
                // Skip common route parts
                if (!['store', 'update', 'create', 'edit'].includes(lastPart)) {
                    resourceName = lastPart.replace(/s$/, ''); // Remove plural 's'
                } else if (urlParts.length > 1) {
                    resourceName = urlParts[urlParts.length - 2].replace(/s$/, '');
                }
            }

            // Capitalize first letter
            resourceName = resourceName.charAt(0).toUpperCase() + resourceName.slice(1);

            return `${actionType} ${resourceName}...`;
        }

        // Universal form submission handler
        function initUniversalFormLoading() {
            // Intercept all form submissions
            document.addEventListener('submit', function(e) {
                const form = e.target;

                // Skip if form has data-loading="false"
                if (form.dataset.loading === 'false') {
                    return;
                }

                // Skip if form is meant to open a modal (has data-modal attribute)
                if (form.dataset.modal === 'true' || form.hasAttribute('data-modal')) {
                    return;
                }

                // Check if form has Alpine.js @submit.prevent (form won't actually submit)
                const formSubmit = form.getAttribute('@submit') || form.getAttribute('x-on:submit');
                if (formSubmit && formSubmit.includes('prevent')) {
                    return;
                }

                // Check if submit button has Alpine.js click handler that prevents default
                const submitButton = form.querySelector('button[type="submit"]');
                if (submitButton) {
                    const buttonOnClick = submitButton.getAttribute('@click') || submitButton.getAttribute('x-on:click');
                    if (buttonOnClick && buttonOnClick.includes('prevent')) {
                        return;
                    }
                }

                // Show loading spinner
                const message = getFormMessage(form);
                const spinnerId = form.dataset.loadingSpinner || 'loading-spinner';

                // Small delay to ensure form validation passes
                setTimeout(function() {
                    showLoading(message, spinnerId);
                }, 50);
            }, true); // Use capture phase to catch early
        }

        // Universal link click handler for page navigation
        function initUniversalLinkLoading() {
            document.addEventListener('click', function(e) {
                const link = e.target.closest('a');

                if (!link) return;

                // Skip if link has data-loading="false"
                if (link.dataset.loading === 'false') {
                    return;
                }

                // Skip if it's a hash link, javascript:, mailto:, tel:, or external link
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || href.startsWith('javascript:') ||
                    href.startsWith('mailto:') || href.startsWith('tel:') ||
                    (href.startsWith('http') && !href.includes(window.location.hostname))) {
                    return;
                }

                // Skip if it opens in new tab/window
                if (link.target === '_blank' || link.hasAttribute('download')) {
                    return;
                }

                // Skip if link has Alpine.js click handler that prevents default
                const linkOnClick = link.getAttribute('@click') || link.getAttribute('x-on:click');
                if (linkOnClick && linkOnClick.includes('prevent')) {
                    return;
                }

                // Show loading spinner
                const message = link.dataset.loadingMessage || 'Loading page...';
                const spinnerId = link.dataset.loadingSpinner || 'loading-spinner';

                setTimeout(function() {
                    showLoading(message, spinnerId);
                }, 100);
            }, true);
        }

        // Handle browser back/forward navigation - don't show spinner and hide if visible
        function initBrowserNavigationHandler() {
            // Immediately hide spinner on popstate (browser back/forward button)
            window.addEventListener('popstate', function(event) {
                // Immediately hide any visible spinner
                hideLoading('loading-spinner');
            }, true); // Use capture phase to catch early

            // Hide spinner when page is loaded from cache (back button)
            window.addEventListener('pageshow', function(event) {
                // If page was loaded from cache (back/forward navigation)
                if (event.persisted) {
                    // Immediately hide spinner - page loaded from cache, no loading needed
                    hideLoading('loading-spinner');
                }
            });

            // Always hide spinner when page fully loads (normal page load)
            window.addEventListener('load', function() {
                // Small delay to ensure page is fully rendered
                setTimeout(function() {
                    hideLoading('loading-spinner');
                }, 100);
            });

            // Also hide on DOMContentLoaded as backup
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(function() {
                        hideLoading('loading-spinner');
                    }, 100);
                });
            } else {
                // DOM already loaded, hide immediately
                setTimeout(function() {
                    hideLoading('loading-spinner');
                }, 100);
            }
        }

        // Initialize everything when DOM is ready
        function init() {
            // Initialize browser navigation handler first to catch back button immediately
            initBrowserNavigationHandler();

            // Then initialize form and link handlers
            initUniversalFormLoading();
            initUniversalLinkLoading();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            // If DOM is already loaded, initialize immediately
            init();
        }
    })();
</script>
