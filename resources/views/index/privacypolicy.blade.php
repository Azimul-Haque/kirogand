@extends('layouts.index')
@section('title') ডিজিটাল নাগরিক - গোপনীয়তা নীতি @endsection

@section('third_party_stylesheets')
	<style>
		.header-section {
        background-color: var(--primary-color);
        color: white;
        padding: 30px 20px;
        border-radius: .75rem .75rem 0 0;
        position: relative;
    }
    .card-title {
        font-size: 2rem;
        font-weight: 700;
    }
    .policy-card {
        border-radius: .75rem;
    }
    .card-body h3, .card-body h4 {
        color: #343a40;
        font-weight: 600;
        margin-top: 25px;
        margin-bottom: 15px;
    }
    .card-body h2 {
        font-weight: 700;
    }
    .card-body h3 {
        font-size: 1.4rem;
    }
    .card-body h4 {
        font-size: 1.2rem;
        color: var(--primary-color);
    }
    .list-unstyled li:before {
        content: "•";
        color: var(--primary-color);
        font-weight: bold;
        display: inline-block; 
        width: 1em;
        margin-left: -1em;
    }
		/* Language Toggle Styles */
    .lang-toggle-container {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 10;
    }
    .language-toggle {
        display: flex;
        background-color: white;
        border-radius: 50px;
        padding: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .toggle-button {
        border: none;
        padding: 8px 15px;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        background-color: transparent;
        color: #6c757d;
        min-width: 80px;
    }
    .toggle-button.active {
        background-color: var(--primary-color);
        color: var(--active-toggle-color);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
	</style>
@endsection

@section('content')

<section class="service-section section-gap">
	<div class="container policy-card rounded-4 bg-white">
	        <div class="p-4 p-md-5">
	            
	            <!-- Language Toggle Button (Pill Style) -->
	            <div class="d-flex justify-content-center mb-5 pt-3">
	                <div class="toggle-group-bg">
	                    <div class="btn-group" role="group">
	                        <button id="lang-bn" class="lang-toggle-btn active" data-lang="bn">
	                            বাংলা
	                        </button>
	                        <button id="lang-en" class="lang-toggle-btn" data-lang="en">
	                            English
	                        </button>
	                    </div>
	                </div>
	            </div>

	            <!-- Content Area -->
	            <div id="policy-content">
	                <!-- Content will be inserted here by JavaScript -->
	            </div>
	        
	        </div>
	    </div>
</section>
    
@endsection

@section('third_party_scripts')
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

	<script>
	    // JavaScript for Language Toggle functionality
	    function switchLanguage(lang) {
	        const bnContent = document.getElementById('bangla-content');
	        const enContent = document.getElementById('english-content');
	        const btnBn = document.getElementById('btnBangla');
	        const btnEn = document.getElementById('btnEnglish');
	        const mainTitle = document.getElementById('mainTitle');
	        const mainSubtitle = document.getElementById('mainSubtitle');

	        if (lang === 'en') {
	            bnContent.style.display = 'none';
	            enContent.style.display = 'block';
	            btnEn.classList.add('active');
	            btnBn.classList.remove('active');
	            mainTitle.innerText = 'D-Nagorik Policies & Terms';
	            mainSubtitle.innerText = 'Simple and user-friendly rules for the national online certificate system';
	            document.documentElement.lang = 'en';
	        } else {
	            bnContent.style.display = 'block';
	            enContent.style.display = 'none';
	            btnBn.classList.add('active');
	            btnEn.classList.remove('active');
	            mainTitle.innerText = 'ডি-নাগরিক নীতিমালা ও শর্তাবলী';
	            mainSubtitle.innerText = 'দেশের অনলাইন সার্টিফিকেট ব্যবস্থার জন্য তৈরি সহজ এবং ব্যবহারকারী-বান্ধব নিয়ম';
	            document.documentElement.lang = 'bn';
	        }
	    }

	    // Initial state setup and event listeners
	    window.onload = function() {
	        // Set Bangla as default (bn) and visually activate the button
	        switchLanguage('bn');
	        
	        document.getElementById('btnBangla').addEventListener('click', () => switchLanguage('bn'));
	        document.getElementById('btnEnglish').addEventListener('click', () => switchLanguage('en'));
	    };
	</script>
@endsection