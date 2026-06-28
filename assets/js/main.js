/**
 * Meridian Studio Theme JavaScript Functionality
 * ES6 Vanilla JS (TFD-02)
 *
 * @package MeridianTheme
 */

document.addEventListener( 'DOMContentLoaded', () => {
    
    // --- 1. Sticky Header ---
    const siteHeader = document.getElementById( 'site-header' );
    
    const handleScroll = () => {
        if ( window.scrollY > 40 ) {
            siteHeader.classList.add( 'scrolled' );
        } else {
            siteHeader.classList.remove( 'scrolled' );
        }
    };
    
    // Check on load
    handleScroll();
    // Check on scroll
    window.addEventListener( 'scroll', handleScroll );
    
    
    // --- 2. Mobile Navigation Toggle ---
    const mobileToggle = document.getElementById( 'mobile-menu-toggle' );
    const mobileMenu = document.getElementById( 'mobile-overlay-menu' );
    
    if ( mobileToggle && mobileMenu ) {
        mobileToggle.addEventListener( 'click', () => {
            const isExpanded = mobileToggle.getAttribute( 'aria-expanded' ) === 'true';
            
            // Toggle hamburger cross state
            mobileToggle.setAttribute( 'aria-expanded', !isExpanded );
            
            // Toggle overlay menu visibility
            mobileMenu.classList.toggle( 'active' );
            mobileMenu.setAttribute( 'aria-hidden', isExpanded );
            
            // Toggle body scroll locking
            if ( !isExpanded ) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        } );

        // Close menu when clicking a link inside mobile overlay
        const mobileLinks = mobileMenu.querySelectorAll( 'a' );
        mobileLinks.forEach( link => {
            link.addEventListener( 'click', () => {
                mobileToggle.setAttribute( 'aria-expanded', 'false' );
                mobileMenu.classList.remove( 'active' );
                mobileMenu.setAttribute( 'aria-hidden', 'true' );
                document.body.style.overflow = '';
            } );
        } );
    }
    
    
    // --- 3. IntersectionObserver for Scroll Reveal ---
    const revealElements = document.querySelectorAll( '.reveal' );
    
    if ( 'IntersectionObserver' in window ) {
        const revealObserver = new IntersectionObserver( ( entries, observer ) => {
            entries.forEach( entry => {
                if ( entry.isIntersecting ) {
                    entry.target.classList.add( 'revealed' );
                    observer.unobserve( entry.target ); // Only animate once
                }
            } );
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px' // Trigger slightly before element enters
        } );
        
        revealElements.forEach( element => {
            revealObserver.observe( element );
        } );
    } else {
        // Fallback for browsers that don't support IntersectionObserver
        revealElements.forEach( element => {
            element.classList.add( 'revealed' );
        } );
    }
    
    
    // --- 4. AJAX Contact Form Submission & Validation ---
    const contactForm = document.getElementById( 'meridian-contact-form' );
    
    if ( contactForm ) {
        const nameInput = document.getElementById( 'contact-name' );
        const emailInput = document.getElementById( 'contact-email' );
        const messageInput = document.getElementById( 'contact-message' );
        const submitBtn = document.getElementById( 'contact-submit-btn' );
        const formResponse = document.getElementById( 'contact-form-response' );
        
        const btnText = submitBtn.querySelector( '.btn-text' );
        const btnSpinner = submitBtn.querySelector( '.btn-spinner' );
        const btnSuccessIcon = submitBtn.querySelector( '.btn-success-icon' );
        
        // Input validation utilities
        const validateField = ( input, errorElId, message ) => {
            const errorEl = document.getElementById( errorElId );
            const parent = input.parentElement;
            
            if ( !input.value.trim() ) {
                errorEl.textContent = message;
                parent.classList.add( 'invalid' );
                return false;
            }
            
            errorEl.textContent = '';
            parent.classList.remove( 'invalid' );
            return true;
        };
        
        const validateEmail = ( input, errorElId ) => {
            const errorEl = document.getElementById( errorElId );
            const parent = input.parentElement;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if ( !input.value.trim() ) {
                errorEl.textContent = 'Email address is required.';
                parent.classList.add( 'invalid' );
                return false;
            }
            
            if ( !emailRegex.test( input.value.trim() ) ) {
                errorEl.textContent = 'Please enter a valid email address.';
                parent.classList.add( 'invalid' );
                return false;
            }
            
            errorEl.textContent = '';
            parent.classList.remove( 'invalid' );
            return true;
        };
        
        // Inline validation on Blur
        nameInput.addEventListener( 'blur', () => {
            validateField( nameInput, 'error-name', 'Name is required.' );
        } );
        
        emailInput.addEventListener( 'blur', () => {
            validateEmail( emailInput, 'error-email' );
        } );
        
        messageInput.addEventListener( 'blur', () => {
            validateField( messageInput, 'error-message', 'Message is required.' );
        } );
        
        // Form Submit Handler
        contactForm.addEventListener( 'submit', ( e ) => {
            e.preventDefault();
            
            // Clean global response alert
            formResponse.style.display = 'none';
            formResponse.textContent = '';
            formResponse.className = 'form-response-alert';
            
            // Perform complete validation checks
            const isNameValid = validateField( nameInput, 'error-name', 'Name is required.' );
            const isEmailValid = validateEmail( emailInput, 'error-email' );
            const isMessageValid = validateField( messageInput, 'error-message', 'Message is required.' );
            
            // If invalid, play visual shake animation on the form container
            if ( !isNameValid || !isEmailValid || !isMessageValid ) {
                contactForm.classList.add( 'shake' );
                setTimeout( () => {
                    contactForm.classList.remove( 'shake' );
                }, 400 );
                return;
            }
            
            // Gather form data BEFORE disabling fields
            // (Disabled fields are excluded from FormData by browser spec)
            const formData = new FormData( contactForm );
            formData.append( 'action', 'meridian_submit_contact' );
            formData.append( 'nonce', meridian_ajax.nonce );
            
            // Now disable fields and show submission loading states
            submitBtn.disabled = true;
            nameInput.disabled = true;
            emailInput.disabled = true;
            messageInput.disabled = true;
            if ( document.getElementById( 'contact-company' ) ) {
                document.getElementById( 'contact-company' ).disabled = true;
            }
            if ( document.getElementById( 'contact-budget' ) ) {
                document.getElementById( 'contact-budget' ).disabled = true;
            }
            
            btnText.style.display = 'none';
            btnSpinner.style.display = 'inline-block';
            
            // Submit form data using Fetch API
            fetch( meridian_ajax.ajax_url, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            } )
            .then( response => response.json() )
            .then( data => {
                if ( data.success ) {
                    // Success State: fade out form and show success card
                    contactForm.style.transition = 'opacity 0.4s ease';
                    contactForm.style.opacity = '0';
                    
                    setTimeout( () => {
                        contactForm.style.display = 'none';
                        
                        const successCard = document.getElementById( 'contact-success-card' );
                        const successMsg = document.getElementById( 'contact-success-message' );
                        
                        if ( successCard ) {
                            if ( successMsg ) {
                                successMsg.textContent = ( data.data && data.data.message ) || 'Thank you! Your enquiry has been successfully saved in our database.';
                            }
                            successCard.style.display = 'block';
                        }
                    }, 400 );
                    
                    contactForm.reset();
                } else {
                    // Fail state from server — extract the error message
                    const errorMsg = ( data.data && data.data.message ) || 'An error occurred. Please try again.';
                    throw new Error( errorMsg );
                }
            } )
            .catch( error => {
                // Error State: restore submit button text
                btnSpinner.style.display = 'none';
                btnText.style.display = 'inline-block';
                
                // Re-enable form fields
                submitBtn.disabled = false;
                nameInput.disabled = false;
                emailInput.disabled = false;
                messageInput.disabled = false;
                if ( document.getElementById( 'contact-company' ) ) {
                    document.getElementById( 'contact-company' ).disabled = false;
                }
                if ( document.getElementById( 'contact-budget' ) ) {
                    document.getElementById( 'contact-budget' ).disabled = false;
                }
                
                formResponse.classList.add( 'error' );
                formResponse.textContent = error.message || 'Something went wrong. Please check your connection.';
                formResponse.style.display = 'block';
            } );
        } );
    }
} );
