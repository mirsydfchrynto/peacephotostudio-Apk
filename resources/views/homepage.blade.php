@extends('layouts.app')

@section('title', 'Choose Your Session - Peace Picture Studio')

@push('styles')
<style>
    /* Import Dancing Script Font */
    @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap');
    
    /* Base Styles - Ultra Optimized */
    html, body {
        height: 100%;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        overflow-x: hidden;
        /* ALWAYS allow vertical scroll */
        overflow-y: auto;
    }

    .font-dancing {
        font-family: 'Dancing Script', cursive;
    }

    /* Ultra Compact Container - ALWAYS scrollable */
    .main-container {
        min-height: 100vh;
        position: relative;
        padding-bottom: 5rem;
        /* Remove any overflow restrictions */
        overflow: visible;
    }

    /* Cinematic Background - Optimized */
    .cinematic-bg {
        background-position: center;
        background-size: cover;
        position: fixed;
        inset: 0;
        z-index: 0;
    }

    .cinematic-overlay {
        background: linear-gradient(135deg,
            rgba(0, 0, 0, 0.88) 0%,
            rgba(0, 0, 0, 0.68) 25%,
            rgba(0, 0, 0, 0.48) 50%,
            rgba(0, 0, 0, 0.68) 75%,
            rgba(0, 0, 0, 0.88) 100%);
        position: absolute;
        inset: 0;
        z-index: 1;
    }

    .cinematic-vignette {
        background: radial-gradient(ellipse at center,
            rgba(0, 0, 0, 0.05) 0%,
            rgba(0, 0, 0, 0.25) 50%,
            rgba(0, 0, 0, 0.65) 100%);
        position: absolute;
        inset: 0;
        z-index: 2;
    }

    /* LARGER Side Galleries - Much Bigger */
    .side-panel {
        position: fixed;
        top: 0;
        bottom: 0;
        width: 8rem;
        background: rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(12px);
        z-index: 3;
        display: none;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    @media (min-width: 1280px) {
        .side-panel {
            display: block;
        }
        .main-content {
            margin-left: 8rem;
            margin-right: 8rem;
        }
    }

    @media (min-width: 1440px) {
        .side-panel {
            width: 9rem;
        }
        .main-content {
            margin-left: 9rem;
            margin-right: 9rem;
        }
    }

    @media (min-width: 1920px) {
        .side-panel {
            width: 10rem;
        }
        .main-content {
            margin-left: 10rem;
            margin-right: 10rem;
        }
    }

    /* Perfect Infinite Gallery - NO GLITCH System */
    .gallery-container {
        height: 100%;
        overflow: hidden;
        position: relative;
    }

    .gallery-scroll {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        padding: 1.5rem 1rem;
        will-change: transform;
        position: absolute;
        width: 100%;
        /* Ensure smooth infinite loop */
        animation-fill-mode: none;
        animation-iteration-count: infinite;
    }

    .gallery-scroll.up {
        animation: scrollUpSeamless var(--scroll-duration, 60s) linear infinite;
    }

    .gallery-scroll.down {
        animation: scrollDownSeamless var(--scroll-duration, 70s) linear infinite;
    }

    .gallery-item {
        flex-shrink: 0;
        padding: 0.375rem;
    }

    /* LARGER Gallery Images */
    .gallery-item img {
        width: 100%;
        height: 5.5rem;
        object-fit: cover;
        border-radius: 0.75rem;
        opacity: 0.4;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @media (min-width: 1440px) {
        .gallery-item img {
            height: 6rem;
        }
    }

    @media (min-width: 1920px) {
        .gallery-item img {
            height: 6.5rem;
        }
    }

    .gallery-item:hover img {
        opacity: 0.8;
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.25);
    }

    /* ULTRA RESPONSIVE Service Cards */
    .service-card {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 1rem;
        backdrop-filter: blur(10px);
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        /* Ultra responsive heights */
        min-height: 180px;
    }

    @media (min-width: 360px) {
        .service-card {
            min-height: 190px;
        }
    }

    @media (min-width: 480px) {
        .service-card {
            min-height: 200px;
        }
    }

    @media (min-width: 640px) {
        .service-card {
            min-height: 220px;
        }
    }

    @media (min-width: 768px) {
        .service-card {
            min-height: 240px;
        }
    }

    @media (min-width: 1024px) {
        .service-card {
            min-height: 250px;
        }
    }

    .service-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, 
            rgba(255, 255, 255, 0.08) 0%, 
            rgba(255, 255, 255, 0.04) 100%);
        opacity: 0;
        transition: opacity 0.35s ease;
        z-index: 1;
    }

    .service-card:hover::before,
    .service-card.selected::before {
        opacity: 1;
    }

    .service-card:hover {
        transform: translateY(-4px) scale(1.02);
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(255, 255, 255, 0.3);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.4);
    }

    .service-card.selected {
        transform: translateY(-4px) scale(1.02);
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(255, 255, 255, 0.4);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.4);
    }

    /* Perfect Card Content Layout - Ultra Responsive */
    .card-content {
        position: relative;
        z-index: 10;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 0.75rem;
    }

    @media (min-width: 480px) {
        .card-content {
            padding: 0.875rem;
        }
    }

    @media (min-width: 640px) {
        .card-content {
            padding: 1rem;
        }
    }

    @media (min-width: 768px) {
        .card-content {
            padding: 1.125rem;
        }
    }

    @media (min-width: 1024px) {
        .card-content {
            padding: 1.25rem;
        }
    }

    .card-top {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        flex-grow: 1;
        justify-content: center;
        gap: 0.5rem;
    }

    @media (min-width: 480px) {
        .card-top {
            gap: 0.625rem;
        }
    }

    @media (min-width: 640px) {
        .card-top {
            gap: 0.75rem;
        }
    }

    @media (min-width: 768px) {
        .card-top {
            gap: 0.875rem;
        }
    }

    .card-bottom {
        display: flex;
        justify-content: center;
        margin-top: 0.75rem;
    }

    @media (min-width: 640px) {
        .card-bottom {
            margin-top: 0.875rem;
        }
    }

    /* Ultra Responsive Service Icons */
    .service-icon {
        width: 2.25rem;
        height: 2.25rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        flex-shrink: 0;
    }

    @media (min-width: 480px) {
        .service-icon {
            width: 2.5rem;
            height: 2.5rem;
        }
    }

    @media (min-width: 640px) {
        .service-icon {
            width: 2.75rem;
            height: 2.75rem;
        }
    }

    @media (min-width: 768px) {
        .service-icon {
            width: 3rem;
            height: 3rem;
        }
    }

    .service-card:hover .service-icon,
    .service-card.selected .service-icon {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
        border-color: rgba(255, 255, 255, 0.3);
    }

    /* Ultra Responsive Typography */
    .service-title {
        font-size: 0.875rem;
        font-weight: 500;
        color: white;
        margin: 0;
        line-height: 1.2;
    }

    @media (min-width: 480px) {
        .service-title {
            font-size: 0.9375rem;
        }
    }

    @media (min-width: 640px) {
        .service-title {
            font-size: 1rem;
        }
    }

    @media (min-width: 768px) {
        .service-title {
            font-size: 1.125rem;
        }
    }

    @media (min-width: 1024px) {
        .service-title {
            font-size: 1.1875rem;
        }
    }

    .service-description {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 300;
        font-size: 0.6875rem;
        line-height: 1.3;
        max-width: 14rem;
        margin: 0;
    }

    @media (min-width: 480px) {
        .service-description {
            font-size: 0.75rem;
            line-height: 1.4;
            max-width: 15rem;
        }
    }

    @media (min-width: 640px) {
        .service-description {
            font-size: 0.8125rem;
            max-width: 16rem;
        }
    }

    @media (min-width: 768px) {
        .service-description {
            font-size: 0.875rem;
            line-height: 1.5;
            max-width: 17rem;
        }
    }

    /* Ultra Responsive Booking Button */
    .booking-btn-perfect {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.25rem;
        padding: 0.375rem 1rem;
        font-size: 0.5625rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 1.5rem;
        backdrop-filter: blur(8px);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        min-width: 100px;
        height: 1.875rem;
        flex-shrink: 0;
    }

    @media (min-width: 480px) {
        .booking-btn-perfect {
            padding: 0.4375rem 1.125rem;
            font-size: 0.625rem;
            min-width: 110px;
            height: 2rem;
            gap: 0.3125rem;
        }
    }

    @media (min-width: 640px) {
        .booking-btn-perfect {
            padding: 0.5rem 1.25rem;
            font-size: 0.6875rem;
            min-width: 120px;
            height: 2.25rem;
            gap: 0.375rem;
        }
    }

    @media (min-width: 768px) {
        .booking-btn-perfect {
            padding: 0.5625rem 1.375rem;
            min-width: 130px;
            height: 2.375rem;
        }
    }

    .booking-btn-perfect::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.4s ease;
    }

    .booking-btn-perfect:hover::before {
        left: 100%;
    }

    .booking-btn-perfect:hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .booking-btn-perfect svg {
        transition: transform 0.3s ease;
        position: relative;
        z-index: 10;
        width: 0.625rem;
        height: 0.625rem;
    }

    @media (min-width: 640px) {
        .booking-btn-perfect svg {
            width: 0.75rem;
            height: 0.75rem;
        }
    }

    .booking-btn-perfect:hover svg {
        transform: translateX(3px);
    }

    .booking-btn-perfect span {
        position: relative;
        z-index: 10;
    }

    /* ULTRA RESPONSIVE Header Section */
    .studio-brand {
        font-size: clamp(0.75rem, 1.2vw, 1rem);
        font-weight: 300;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.75);
        margin-bottom: 0.75rem;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.6));
        animation: brandSlideIn 1s ease-out;
    }

    @media (min-width: 640px) {
        .studio-brand {
            margin-bottom: 1rem;
        }
    }

    @media (min-width: 768px) {
        .studio-brand {
            margin-bottom: 1.25rem;
        }
    }

    /* Ultra Responsive Main Header */
    .hero-title {
        font-size: clamp(1.875rem, 6vw, 4rem);
        line-height: 1.05;
        background: linear-gradient(135deg,
            #ffffff 0%,
            #f8fafc 40%,
            #e2e8f0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 400;
        letter-spacing: 0.005em;
        margin-bottom: 0.75rem;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.7));
        animation: titleSlideIn 1.2s ease-out 0.3s both;
    }

    @media (min-width: 640px) {
        .hero-title {
            font-size: clamp(2.5rem, 7vw, 5rem);
            margin-bottom: 0.875rem;
        }
    }

    @media (min-width: 768px) {
        .hero-title {
            font-size: clamp(3rem, 8vw, 5.5rem);
            margin-bottom: 1rem;
        }
    }

    @media (min-width: 1024px) {
        .hero-title {
            font-size: clamp(3.5rem, 9vw, 6rem);
            margin-bottom: 1.125rem;
        }
    }

    .hero-description {
        font-size: clamp(0.8125rem, 1.4vw, 1.0625rem);
        line-height: 1.45;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 300;
        max-width: 32rem;
        filter: drop-shadow(0 1px 3px rgba(0, 0, 0, 0.5));
        animation: descriptionFadeIn 1s ease-out 0.6s both;
    }

    /* Perfect Content Layout - ALWAYS Scrollable */
    .content-wrapper {
        position: relative;
        z-index: 20;
        padding-top: 1.5rem;
        padding-bottom: 6rem;
        min-height: 100vh;
        /* Ensure content can always be scrolled */
        overflow: visible;
    }

    @media (min-width: 480px) {
        .content-wrapper {
            padding-top: 2rem;
            padding-bottom: 5.5rem;
        }
    }

    @media (min-width: 640px) {
        .content-wrapper {
            padding-top: 2.5rem;
            padding-bottom: 5rem;
        }
    }

    @media (min-width: 768px) {
        .content-wrapper {
            padding-top: 3rem;
            padding-bottom: 4.5rem;
        }
    }

    /* Perfect Hero Section Spacing */
    .hero-section {
        margin-bottom: 1.5rem;
    }

    @media (min-width: 480px) {
        .hero-section {
            margin-bottom: 2rem;
        }
    }

    @media (min-width: 640px) {
        .hero-section {
            margin-bottom: 2.5rem;
        }
    }

    @media (min-width: 768px) {
        .hero-section {
            margin-bottom: 3rem;
        }
    }

    @media (min-width: 1024px) {
        .hero-section {
            margin-bottom: 3.5rem;
        }
    }

    /* Perfect Services Grid - Ultra Responsive */
    .services-grid {
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    @media (min-width: 480px) {
        .services-grid {
            gap: 1rem;
            margin-bottom: 2rem;
        }
    }

    @media (min-width: 640px) {
        .services-grid {
            gap: 1.25rem;
            max-width: 42rem;
        }
    }

    @media (min-width: 768px) {
        .services-grid {
            gap: 1.5rem;
            max-width: 48rem;
        }
    }

    @media (min-width: 1024px) {
        .services-grid {
            gap: 1.75rem;
            margin-bottom: 2.5rem;
            max-width: 56rem;
        }
    }

    /* Perfect Animations */
    @keyframes brandSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes titleSlideIn {
        from {
            opacity: 0;
            transform: translateY(-30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes descriptionFadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(16px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .animate-fade-in:nth-child(1) { animation-delay: 0.9s; }
    .animate-fade-in:nth-child(2) { animation-delay: 1s; }
    .animate-fade-in:nth-child(3) { animation-delay: 1.1s; }

    /* PERFECT SEAMLESS Gallery Animations - NO GLITCH */
    @keyframes scrollUpSeamless {
        0% { 
            transform: translateY(0); 
        }
        100% { 
            transform: translateY(-50%); 
        }
    }

    @keyframes scrollDownSeamless {
        0% { 
            transform: translateY(-50%); 
        }
        100% { 
            transform: translateY(0); 
        }
    }

    /* Loading State */
    .loading {
        position: relative;
        pointer-events: none;
        opacity: 0.75;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 14px;
        height: 14px;
        border: 1.5px solid rgba(255, 255, 255, 0.25);
        border-top: 1.5px solid white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    /* Ultra Small Screens */
    @media (max-width: 320px) {
        .content-wrapper {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            padding-top: 1rem;
        }
        
        .service-card {
            min-height: 170px;
        }
        
        .card-content {
            padding: 0.625rem;
        }
        
        .service-icon {
            width: 2rem;
            height: 2rem;
        }
        
        .booking-btn-perfect {
            min-width: 90px;
            height: 1.75rem;
            padding: 0.3125rem 0.875rem;
            font-size: 0.5rem;
        }
        
        .services-grid {
            gap: 0.625rem;
        }
    }

    /* Accessibility & Performance */
    @media (prefers-reduced-motion: reduce) {
        .animate-fade-in,
        .gallery-scroll,
        .studio-brand,
        .hero-title,
        .hero-description {
            animation: none !important;
        }
        
        .service-card,
        .booking-btn-perfect,
        .service-icon {
            transition: none !important;
        }
    }

    .service-card:focus-visible,
    .booking-btn-perfect:focus-visible {
        outline: 2px solid rgba(255, 255, 255, 0.8);
        outline-offset: 2px;
    }

    /* Perfect Gallery Pause on Hover */
    .side-panel:hover .gallery-scroll {
        animation-play-state: paused;
    }

    /* Performance Optimizations */
    .gallery-scroll,
    .service-card,
    .booking-btn-perfect {
        will-change: transform;
    }

    /* Perfect Mobile Touch */
    @media (hover: none) and (pointer: coarse) {
        .service-card:hover {
            transform: none;
        }
        
        .service-card:active {
            transform: translateY(-2px) scale(1.01);
        }
    }
</style>
@endpush

@section('content')
<div class="main-container w-full">
    <!-- Cinematic Background -->
    <div class="cinematic-bg" style="background-image: url('{{ asset('images/prewed.jpg') }}');">
        <div class="cinematic-overlay"></div>
        <div class="cinematic-vignette"></div>
    </div>

    <!-- LARGER Side Galleries -->
    <div class="side-panel" style="left: 0;">
        <div class="gallery-container">
            <div class="gallery-scroll up" id="leftGallery">
                <!-- Gallery items will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <div class="side-panel" style="right: 0;">
        <div class="gallery-container">
            <div class="gallery-scroll down" id="rightGallery">
                <!-- Gallery items will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Perfect Main Content - ALWAYS Scrollable -->
    <div class="content-wrapper px-3 sm:px-4 lg:px-6 main-content">
        <div class="w-full max-w-5xl mx-auto text-center">
            
            <!-- ULTRA RESPONSIVE Hero Section -->
            <div class="hero-section">
                <!-- Studio Brand -->
                <div class="studio-brand">
                    Peace Picture Studio
                </div>
                
                <!-- Ultra Responsive Main Header -->
                <h1 class="hero-title font-dancing text-white">
                    Choose Your Session
                </h1>
                
                <p class="hero-description text-white/85 mx-auto">
                    Professional photography experiences crafted for life's most precious moments with artistic vision and timeless elegance
                </p>
            </div>

            <!-- Perfect ULTRA RESPONSIVE Services Grid -->
            <div class="services-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                
                <!-- Pre-Wedding Package -->
                <div class="service-card animate-fade-in" data-service="prewed">
                    <div class="card-content">
                        <div class="card-top">
                            <div class="service-icon">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <h3 class="service-title font-dancing">Pre-Wedding</h3>
                            <p class="service-description">
                                Romantic sessions capturing your love story with timeless elegance and artistic vision
                            </p>
                        </div>
                        <div class="card-bottom">
                            <button class="booking-btn-perfect" data-url="/prewed-details">
                                <span>Book Session</span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Group Session Package -->
                <div class="service-card animate-fade-in" data-service="group">
                    <div class="card-content">
                        <div class="card-top">
                            <div class="service-icon">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                                </svg>
                            </div>
                            <h3 class="service-title font-dancing">Group Session</h3>
                            <p class="service-description">
                                Family and group portraits with perfect composition and natural heartfelt moments
                            </p>
                        </div>
                        <div class="card-bottom">
                            <button class="booking-btn-perfect" data-url="/group-details">
                                <span>Book Session</span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Baby Smash Cake Package -->
                <div class="service-card animate-fade-in" data-service="bsc">
                    <div class="card-content">
                        <div class="card-top">
                            <div class="service-icon">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.124 1.124H4.124A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z"/>
                                </svg>
                            </div>
                            <h3 class="service-title font-dancing">Baby Smash Cake</h3>
                            <p class="service-description">
                                Adorable first birthday celebrations with playful cake smashing and precious memories
                            </p>
                        </div>
                        <div class="card-bottom">
                            <button class="booking-btn-perfect" data-url="/bsc-details">
                                <span>Book Session</span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Access Hint -->
            <div class="text-center">
                <p class="text-xs text-white/45 font-light">
                    Press 1, 2, or 3 for quick access
                </p>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation Component -->
    <x-bottom-nav current-route="homepage" />
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gallery Images - Can be any number of images
    const galleryImages = [
        '{{ asset("images/prewed.jpg") }}',
        '{{ asset("images/family.jpg") }}',
        '{{ asset("images/bsc.jpg") }}',
        '{{ asset("images/maternity.jpg") }}',
        '{{ asset("images/wisuda.jpg") }}'
    ];

    // PERFECT SEAMLESS Infinite Gallery System - NO GLITCH EVER
    function createPerfectSeamlessGallery() {
        const leftGallery = document.getElementById('leftGallery');
        const rightGallery = document.getElementById('rightGallery');
        
        if (!leftGallery || !rightGallery) return;

        // Calculate perfect repetitions for ZERO glitch seamless loop
        const viewportHeight = window.innerHeight;
        const itemHeight = 88 + 12 + 24; // 5.5rem + gap + padding
        const itemsPerScreen = Math.ceil(viewportHeight / itemHeight);
        
        // CRITICAL: Create EXACTLY enough repetitions for perfect seamless loop
        // We need at least 4 full cycles to ensure no visible gaps during transition
        const minCycles = Math.max(6, Math.ceil(itemsPerScreen / galleryImages.length) + 4);
        const totalRepetitions = minCycles;

        // Clear existing content
        leftGallery.innerHTML = '';
        rightGallery.innerHTML = '';

        // Create PERFECT seamless loop for left gallery (scrolling up)
        // Pattern: A,B,C,D,E,A,B,C,D,E,A,B,C,D,E... (endless train)
        for (let cycle = 0; cycle < totalRepetitions; cycle++) {
            galleryImages.forEach((img, index) => {
                const item = document.createElement('div');
                item.className = 'gallery-item';
                item.innerHTML = `<img src="${img}" alt="Gallery ${index + 1}" loading="lazy">`;
                leftGallery.appendChild(item);
            });
        }
        
        // Create PERFECT seamless loop for right gallery (scrolling down) - reversed
        // Pattern: E,D,C,B,A,E,D,C,B,A,E,D,C,B,A... (endless train reverse)
        const reversedImages = [...galleryImages].reverse();
        for (let cycle = 0; cycle < totalRepetitions; cycle++) {
            reversedImages.forEach((img, index) => {
                const item = document.createElement('div');
                item.className = 'gallery-item';
                item.innerHTML = `<img src="${img}" alt="Gallery ${index + 1}" loading="lazy">`;
                rightGallery.appendChild(item);
            });
        }

        // PERFECT animation duration calculation for seamless loop
        // The key is that animation duration must match exactly with content length
        const singleCycleItems = galleryImages.length;
        const totalItems = singleCycleItems * totalRepetitions;
        
        // SLOW and SMOOTH animation
        const baseSpeed = 2; // Very slow - 2 seconds per item
        const leftDuration = singleCycleItems * baseSpeed;
        const rightDuration = singleCycleItems * baseSpeed * 1.2; // Slightly different speed
        
        leftGallery.style.setProperty('--scroll-duration', `${leftDuration}s`);
        rightGallery.style.setProperty('--scroll-duration', `${rightDuration}s`);

        // CRITICAL: Set perfect height for seamless loop
        // Height must be exactly 2x the single cycle height for 50% animation to work
        const singleCycleHeight = singleCycleItems * itemHeight;
        const totalHeight = singleCycleHeight * totalRepetitions;
        
        leftGallery.style.height = `${totalHeight}px`;
        rightGallery.style.height = `${totalHeight}px`;

        // ENSURE smooth animation restart
        leftGallery.style.animationFillMode = 'none';
        rightGallery.style.animationFillMode = 'none';
    }

    // Initialize perfect galleries
    createPerfectSeamlessGallery();

    // State Management
    let selectedService = null;
    
    // DOM Elements
    const serviceCards = document.querySelectorAll('.service-card');
    const bookingButtons = document.querySelectorAll('.booking-btn-perfect');
    const forwardNav = document.getElementById('forwardNav');
    
    // Package URLs
    const packageUrls = {
        'prewed': '/prewed-details',
        'group': '/group-details',
        'bsc': '/bsc-details'
    };

    // Update Forward Navigation
    function updateForwardNav() {
        if (selectedService && forwardNav) {
            forwardNav.href = packageUrls[selectedService];
            forwardNav.classList.remove('text-white/50', 'pointer-events-none', 'disabled');
            forwardNav.classList.add('text-white/80', 'hover:text-white', 'hover:bg-white/10');
            forwardNav.setAttribute('aria-disabled', 'false');
        } else if (forwardNav) {
            forwardNav.href = '#';
            forwardNav.classList.add('text-white/50', 'pointer-events-none', 'disabled');
            forwardNav.classList.remove('text-white/80', 'hover:text-white', 'hover:bg-white/10');
            forwardNav.setAttribute('aria-disabled', 'true');
        }
    }

    // Perfect Button Handlers
    bookingButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const url = this.getAttribute('data-url');
            this.classList.add('loading');
            
            // Haptic feedback for mobile
            if (navigator.vibrate) {
                navigator.vibrate(50);
            }
            
            setTimeout(() => {
                window.location.href = url;
            }, 500);
        });
    });

    // Service Card Selection
    serviceCards.forEach(card => {
        card.addEventListener('click', function() {
            const service = this.getAttribute('data-service');
            
            // Remove selection from all cards
            serviceCards.forEach(c => c.classList.remove('selected'));
            
            // Add selection to clicked card
            this.classList.add('selected');
            
            // Update state
            selectedService = service;
            updateForwardNav();
        });
    });

    // Perfect Keyboard Navigation
    document.addEventListener('keydown', function(e) {
        if (e.target.matches('input, textarea, select')) return;
        
        if (e.key >= '1' && e.key <= '3') {
            e.preventDefault();
            const index = parseInt(e.key) - 1;
            if (serviceCards[index]) {
                const button = serviceCards[index].querySelector('.booking-btn-perfect');
                if (button) {
                    button.click();
                }
            }
        } else if (e.key === 'Enter' && selectedService) {
            e.preventDefault();
            window.location.href = packageUrls[selectedService];
        }
    });

    // Performance optimizations
    function optimizePerformance() {
        const isMobile = window.innerWidth < 1280;
        const galleries = document.querySelectorAll('.gallery-scroll');
        
        if (isMobile) {
            // Pause animations on mobile for better performance
            galleries.forEach(gallery => {
                gallery.style.animationPlayState = 'paused';
            });
        } else {
            // Resume animations on desktop
            galleries.forEach(gallery => {
                gallery.style.animationPlayState = 'running';
            });
        }
    }

    // Initialize and handle resize
    optimizePerformance();
    window.addEventListener('resize', () => {
        optimizePerformance();
        // Recreate galleries on significant resize
        setTimeout(createPerfectSeamlessGallery, 100);
    });

    // Initialize navigation state
    updateForwardNav();

    // Perfect Intersection Observer for performance
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.willChange = 'transform';
                } else {
                    entry.target.style.willChange = 'auto';
                }
            });
        }, { threshold: 0.1 });

        serviceCards.forEach(card => observer.observe(card));
    }

    // NO SCROLL PREVENTION - Let natural scrolling work everywhere
    // This ensures mobile and all screen sizes can scroll properly
});
</script>
@endpush
