@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- Home Section -->
<section class="home" id="home" style="background-image: url('{{ asset('images/puni.webp') }}');">
    <div class="content">
        <h3 class="home-title">Discover Your Journey with Us!</h3>
        <form class="search-form" method="post" action="{{ route('search.packages') }}">
            @csrf
            <input type="text" name="destination" class="destination-input" placeholder="Enter Destination" required style="color: #000; background-color: rgba(255, 255, 255, 0.8);">
            <input type="month" name="selected_month" class="month-input" required style="color: #000; background-color: rgba(255, 255, 255, 0.8);">
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>
</section>


<section class="packages" id="packages">
    <h2>Explore Our Packages</h2>
    <div class="scroll-wrapper" style="overflow: hidden; width: 100%; position: relative;">
        <button class="scroll-button left" id="scrollLeft">&lt;</button>
        <div class="packages-container" style="display: flex; overflow-x: auto; white-space: nowrap;">
            @foreach($packages as $package)
                <div class="package-card" style="flex: 0 0 auto;"> <!-- Ensure cards are displayed inline -->
                    <img src="{{ $package->image ? asset('storage/' . $package->image) : asset('images/default-package.jpg') }}" alt="{{ $package->package_name }}">
                    <h2>{{ $package->package_name }}</h2>
                    <p>Destination: {{ $package->location }}</p>
                    <p>{{ $package->description }}</p>
                    <p>Price: {{ number_format($package->price_per_person, 2) }} Tk</p>
                    <p>Journey Start Date: {{ \Carbon\Carbon::parse($package->starting_date)->format('M d, Y') }}</p>
                    <p>Return Date: {{ \Carbon\Carbon::parse($package->ending_date)->format('M d, Y') }}</p>

                    @if($package->booking_enabled)
                        <a href="{{ route('bookings.customer-info', $package->id) }}" class="btn" style="display: block;">Book Now</a>
                    @else
                        <button class="btn" disabled>Booking Closed</button>
                    @endif
                </div>
            @endforeach
        </div>
        <button class="scroll-button right" id="scrollRight">&gt;</button>
    </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrollWrapper = document.querySelector('.scroll-wrapper');
    const leftButton = document.querySelector('.scroll-button.left');
    const rightButton = document.querySelector('.scroll-button.right');

    // Function to check scroll position and show/hide buttons
    function updateButtonsVisibility() {
        const scrollLeftPos = scrollWrapper.scrollLeft;
        const scrollWidth = scrollWrapper.scrollWidth;
        const clientWidth = scrollWrapper.clientWidth;

        // If the content can't be scrolled (scrollable width is less than client width), hide both buttons
        if (scrollWidth <= clientWidth) {
            leftButton.classList.add('hidden');
            rightButton.classList.add('hidden');
            return; // No need to continue if there's no scrollable content
        }

        // Show or hide the left button based on scroll position
        leftButton.classList.toggle('hidden', scrollLeftPos <= 0);
        // Show or hide the right button based on scroll position
        rightButton.classList.toggle('hidden', scrollLeftPos + clientWidth >= scrollWidth);
    }

    // Function to show buttons while scrolling
    function showButtons() {
        leftButton.classList.remove('hidden');
        rightButton.classList.remove('hidden');

        // Hide buttons after 1 second of inactivity
        setTimeout(() => {
            leftButton.classList.add('hidden');
            rightButton.classList.add('hidden');
        }, 1000); // Adjust time as needed
    }

    // Scroll right button functionality
    rightButton.addEventListener('click', function() {
        scrollWrapper.scrollBy({
            left: 400, // Adjust this value to control the scroll distance
            behavior: 'smooth'
        });

        // Show buttons when scrolling
        showButtons();
        setTimeout(updateButtonsVisibility, 300); // Delay to update after scroll
    });

    // Scroll left button functionality
    leftButton.addEventListener('click', function() {
        scrollWrapper.scrollBy({
            left: -400, // Adjust this value to control the scroll distance
            behavior: 'smooth'
        });

        // Show buttons when scrolling
        showButtons();
        setTimeout(updateButtonsVisibility, 300); // Delay to update after scroll
    });

    // Check button visibility on initial page load
    updateButtonsVisibility();

    // Also check button visibility during scroll
    scrollWrapper.addEventListener('scroll', function() {
        updateButtonsVisibility();
        showButtons(); // Show buttons when scrolling
    });
});




</script>



<!-- Gallery Section -->
<section class="gallery" id="gallery">
    <h2 class="gallery-title">Explore the World Through Our Lens</h2>
    <div class="gallery-container">
        <div class="gallery-images-wrapper">
            <div class="gallery-row">
                @if($gallery->isEmpty())
                    <p>No images found in the gallery.</p>
                @else
                    @foreach($gallery as $image)
                        <div class="gallery-item">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery Image">
                            <p>Destination: {{ $image->destination }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="gallery-row">
                @if($gallery->isEmpty())
                    <p>No images found in the gallery.</p>
                @else
                    @foreach($gallery as $image)
                        <div class="gallery-item">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery Image">
                            <p>Destination: {{ $image->destination }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>



<!-- About Us Section -->
<section class="about-us" id="about-us">
       <!-- About Us & Why Choose Us Section -->
    <h2>About Us</h2>
    <div class="about-content">
        <p> Every journey begins with a dream, and at TravelXplorer, we are here to turn those dreams into unforgettable experiences. As a dedicated travel management company, our passion lies in crafting tailor-made travel adventures that cater to your unique desires and preferences. Our expert team meticulously curates exceptional travel packages, ensuring that every detail is taken care of, from exhilarating excursions to serene escapes. With a commitment to excellence and a focus on customer satisfaction, we provide 24/7 support to guide you throughout your travels. Join us at TravelXplorer as we embark on extraordinary journeys together, exploring the world one destination at a time!</p>
    </div>
    
    <h2>Why Choose Us ? </h2>
    <div class="about-services">
        <div class="service-item">
            <i class="fas fa-globe"></i>
            <p>Expert Travel Planning</p>
        </div>
        <div class="service-item">
            <i class="fas fa-suitcase-rolling"></i>
            <p>Adventure and Cultural Experiences</p>
        </div>
        <div class="service-item">
            <i class="fas fa-headset"></i>
            <p>24/7 Customer Support</p>
        </div>
        <div class="service-item">
            <i class="fas fa-plane"></i>
            <p>Exclusive Travel Deals</p>
        </div>
        <div class="service-item">
            <i class="fas fa-bicycle"></i>
            <p>Local Activity Recommendations</p>
        </div>
    </div>
</section>

    </section>
<!-- Contact Us Section -->
<section class="contact-us" id="contact-us">
    <h2>Contact Us</h2>
    <div class="contact-content">
        <div class="contact-item">
            <i class="fas fa-envelope"></i>
            <p>Email: <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
        </div>
        <div class="contact-item">
            <i class="fas fa-phone-alt"></i>
            <p>Phone: <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></p>
        </div>
        <div class="contact-item">
            <i class="fas fa-map-marker-alt"></i>
            <p>Address: {{ $contact->address }}</p>
        </div>
        <div class="contact-item">
                <i class="fab fa-facebook-f"></i> <!-- Facebook Icon -->
                <p>Follow us on Facebook</p>
            </div>

            <div class="contact-item">
                <i class="fab fa-instagram"></i> <!-- Instagram Icon -->
                <p>Follow us on Instagram</p>
            </div>
    </div>
</section>




@endsection
