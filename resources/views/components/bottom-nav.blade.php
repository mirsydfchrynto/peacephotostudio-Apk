@props(['currentRoute' => 'homepage'])

@push('styles')
<style>
    /* Base Navigation Styles */
    .nav-container {
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3),
                    0 0 0 1px rgba(255, 255, 255, 0.05) inset;
        transition: all 0.3s ease;
    }
    
    .nav-item {
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }
    
    .nav-item svg {
        width: 1.25rem;
        height: 1.25rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .nav-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
            transparent,
            rgba(255, 255, 255, 0.1),
            transparent);
        transition: left 0.5s ease;
    }
    
    .nav-item:hover::before {
        left: 100%;
    }
    
    .nav-item:active {
        transform: scale(0.95);
        transition: transform 0.1s ease;
    }
    
    .nav-item.active {
        background: linear-gradient(135deg,
            rgba(255, 255, 255, 0.2) 0%,
            rgba(255, 255, 255, 0.15) 100%);
        box-shadow: 0 4px 16px rgba(255, 255, 255, 0.1);
    }
    
    /* Responsive Breakpoints */
    @media (max-width: 640px) {
        .nav-item svg {
            width: 1.1rem;
            height: 1.1rem;
        }
        
        .nav-text {
            display: none;
        }
        
        .nav-item {
            padding: 0.75rem !important;
            min-width: 42px;
            min-height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }
    
    @media (min-width: 641px) and (max-width: 768px) {
        .nav-item svg {
            width: 1.1rem;
            height: 1.1rem;
        }
        
        .nav-text {
            font-size: 0.65rem;
        }
        
        .nav-item {
            padding: 0.5rem 0.75rem !important;
        }
    }
    
    @media (min-width: 769px) {
        .nav-item svg {
            width: 1.1rem;
            height: 1.1rem;
        }
        
        .nav-text {
            font-size: 0.75rem;
        }
    }
    
    /* Ultra Small Screens */
    @media (max-width: 380px) {
        .nav-container {
            max-width: 280px;
            padding: 0.5rem !important;
            gap: 0.25rem !important;
        }
        
        .nav-item {
            min-width: 38px;
            min-height: 38px;
            padding: 0.625rem !important;
        }
        
        .nav-item svg {
            width: 1rem;
            height: 1rem;
        }
    }
    
    /* Focus States for Accessibility */
    .nav-item:focus-visible {
        outline: 2px solid rgba(255, 255, 255, 0.8);
        outline-offset: 2px;
    }
    
    /* Disabled State */
    .nav-item.disabled {
        opacity: 0.4;
        pointer-events: none;
    }
</style>
@endpush

<!-- Bottom Navigation - Responsive & Consistent -->
<nav class="fixed bottom-0 left-0 right-0 z-50 px-3 sm:px-4 lg:px-8 pb-3 sm:pb-4 pt-2"
     role="navigation"
     aria-label="Main navigation">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-center">
            <div class="nav-container flex items-center gap-2 rounded-xl p-1.5 shadow-xl">
                
                <!-- Back -->
                <a href="{{ route('welcome') }}"
                   class="nav-item flex items-center justify-center gap-2 px-4 py-2 rounded-lg transition-all duration-300 text-white/80 hover:text-white hover:bg-white/10"
                   aria-label="Go back to previous page">
                    <svg class="transition-transform hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                    </svg>
                    <span class="nav-text text-xs font-medium uppercase tracking-wider">Back</span>
                </a>

                <!-- Home -->
                <a href="{{ route('homepage') }}"
                   class="nav-item flex items-center justify-center gap-2 px-4 py-2 rounded-lg transition-all duration-300 {{ $currentRoute === 'homepage' ? 'text-white active' : 'text-white/80 hover:text-white hover:bg-white/10' }}"
                   aria-label="Go to homepage"
                    aria-current="{{ $currentRoute === 'homepage' ? 'page' : 'false' }}">
                    <svg class="transition-transform hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                    </svg>
                    <span class="nav-text text-xs font-medium uppercase tracking-wider">Home</span>
                </a>

                <!-- Forward -->
                <a href="#"
                   id="forwardNav"
                   class="nav-item flex items-center justify-center gap-2 px-4 py-2 rounded-lg transition-all duration-300 text-white/50 pointer-events-none disabled"
                   aria-label="Go to next page"
                    aria-disabled="true">
                    <span class="nav-text text-xs font-medium uppercase tracking-wider">Next</span>
                    <svg class="transition-transform hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>

                <!-- Info -->
                <a href="#"
                   class="nav-item flex items-center justify-center gap-2 px-4 py-2 rounded-lg transition-all duration-300 text-white/80 hover:text-white hover:bg-white/10"
                   aria-label="View information">
                    <svg class="transition-transform hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                    </svg>
                    <span class="nav-text text-xs font-medium uppercase tracking-wider">Info</span>
                </a>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced Touch Experience
    const navItems = document.querySelectorAll('.nav-item');
    
    navItems.forEach(item => {
        // Touch/click feedback
        item.addEventListener('touchstart', function(e) {
            if (!this.classList.contains('disabled')) {
                this.style.transform = 'scale(0.95)';
            }
        }, { passive: true });
        
        item.addEventListener('touchend', function(e) {
            if (!this.classList.contains('disabled')) {
                setTimeout(() => {
                    this.style.transform = '';
                }, 100);
            }
        }, { passive: true });
        
        // Click enhancement
        item.addEventListener('click', function(e) {
            if (!this.classList.contains('disabled') && this.href && this.href !== '#') {
                e.preventDefault();
                
                // Add visual feedback
                this.style.opacity = '0.8';
                
                // Navigate after animation
                setTimeout(() => {
                    window.location.href = this.href;
                }, 200);
            }
        });
    });
    
    // Keyboard Navigation
    document.addEventListener('keydown', function(e) {
        if (e.target.matches('input, textarea')) return;
        
        switch(e.key) {
            case 'ArrowLeft':
                e.preventDefault();
                const backBtn = document.querySelector('a[href*="welcome"]');
                if (backBtn) backBtn.click();
                break;
                
            case 'ArrowRight':
                e.preventDefault();
                const nextBtn = document.getElementById('forwardNav');
                if (nextBtn && !nextBtn.classList.contains('disabled')) nextBtn.click();
                break;
                
            case 'Home':
                e.preventDefault();
                const homeBtn = document.querySelector('a[href*="homepage"]');
                if (homeBtn) homeBtn.click();
                break;
        }
    });
    
    // Responsive adjustments on resize
    function adjustNavigation() {
        const navContainer = document.querySelector('.nav-container');
        const windowWidth = window.innerWidth;
        
        if (windowWidth <= 380) {
            navContainer.classList.add('ultra-small');
        } else {
            navContainer.classList.remove('ultra-small');
        }
    }
    
    // Initial call and resize listener
    adjustNavigation();
    window.addEventListener('resize', adjustNavigation);
});
</script>
@endpush
