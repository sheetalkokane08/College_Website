<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to College Website</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen flex flex-col" style="background: url('/storage/backgrounds/Screenshot-from-2026-03-09-12-21-11.png') no-repeat center center fixed; background-size: cover;">
    <!-- Header -->
    <header class="bg-gray-900 text-white shadow-md">
        <nav class="container mx-auto flex items-center justify-between py-6 px-4">
            <div class="flex items-center gap-2">
                <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Logo" class="h-8 w-auto" />
                <span class="font-bold text-lg">College Website</span>
            </div>
            <div class="md:flex gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-indigo-500 px-4 py-2 rounded text-white hover:bg-indigo-400">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-indigo-500 px-4 py-2 rounded text-white hover:bg-indigo-400">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-gray-700 px-4 py-2 rounded text-white hover:bg-gray-600">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-800 mb-4">Welcome to College Website</h1>
            <p class="text-lg text-gray-600">Empowering your college experience with modern tools and information.</p>
        </div>

        // ...existing code...
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Courses Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center">
                <img src="https://img.icons8.com/color/96/000000/classroom.png" alt="Courses" class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Courses</h2>
                <p class="text-gray-600 mb-4">Explore available courses and enroll to boost your academic journey.</p>
                <a href="{{ route('courses.index') ?? '#' }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-400">View Courses</a>
            </div>
            <!-- Faculty Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center">
                <img src="https://img.icons8.com/color/96/000000/teacher.png" alt="Faculty" class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Faculty</h2>
                <p class="text-gray-600 mb-4">Meet our experienced faculty members and connect for guidance.</p>
                <a href="{{ route('faculty.index') ?? '#' }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-400">View Faculty</a>
            </div>
            <!-- Notices Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center">
                <img src="https://img.icons8.com/color/96/000000/news.png" alt="Notices" class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Notices</h2>
                <p class="text-gray-600 mb-4">Stay updated with the latest news, events, and announcements.</p>
                <div class="w-full mt-2 overflow-hidden">
                    <marquee behavior="scroll" direction="up" scrollamount="3" class="text-left text-gray-700 h-24">
                        @if(isset($notices) && count($notices) > 0)
                            @foreach($notices as $notice)
                                <div class="mb-2">{{$notice->title}} {{$notice->body}}</div>
                            @endforeach
                        @else
                            <div>No notices available.</div>
                        @endif
                    </marquee>
                </div>
            </div>
        </div>
        <div class="mt-16 text-center">
            <h3 class="text-2xl font-bold text-white mb-4">Explore More</h3>
            <div class="flex flex-wrap justify-center gap-4">
                <button onclick="document.getElementById('events-modal').style.display='flex'" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-indigo-400">Events</button>
                <button onclick="document.getElementById('contact-modal').style.display='flex'" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-indigo-400">Contact Us</button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-6 text-center mt-auto">
        &copy; {{ date('Y') }} College Website. All rights reserved.
    </footer>

    <!-- Events Modal -->
    <div id="events-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-60" style="display:none;">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl w-full relative">
            <button onclick="document.getElementById('events-modal').style.display='none'" class="absolute top-2 right-2 text-gray-500 hover:text-black">&times;</button>
            <h2 class="text-2xl font-bold mb-4 text-center">Event Photos</h2>
            <div class="overflow-y-auto h-[32rem] flex flex-col gap-6 pb-2" style="max-height:32rem;">
                <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80" alt="College Campus" class="rounded shadow w-full h-64 object-cover">
                <img src="https://images.unsplash.com/photo-1503676382389-4809596d5290?auto=format&fit=crop&w=800&q=80" alt="Convocation Ceremony" class="rounded shadow w-full h-64 object-cover">
                <img src="https://images.unsplash.com/photo-1465101178521-c1a9136a3b43?auto=format&fit=crop&w=800&q=80" alt="Lecture Hall" class="rounded shadow w-full h-64 object-cover">
                <img src="https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=800&q=80" alt="Sports Event" class="rounded shadow w-full h-64 object-cover">
                <img src="https://images.unsplash.com/photo-1465808883808-8a8b1b6b2b36?auto=format&fit=crop&w=800&q=80" alt="Cultural Fest" class="rounded shadow w-full h-64 object-cover">
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div id="contact-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-60" style="display:none;">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full relative">
            <button onclick="document.getElementById('contact-modal').style.display='none'" class="absolute top-2 right-2 text-gray-500 hover:text-black">&times;</button>
            <h2 class="text-2xl font-bold mb-4 text-center">Contact Details</h2>
            <div class="text-gray-800 space-y-2">
                <div><strong>Email:</strong> info@collegewebsite.com</div>
                <div><strong>Phone:</strong> +91 98765 43210</div>
                <div><strong>Address:</strong> 123 College Road, City, State, 123456</div>
            </div>
        </div>
    </div>
    <script>
        // Hide modals when clicking outside the modal content
        window.onclick = function(event) {
            var eventsModal = document.getElementById('events-modal');
            var contactModal = document.getElementById('contact-modal');
            if (event.target === eventsModal) eventsModal.style.display = 'none';
            if (event.target === contactModal) contactModal.style.display = 'none';
        }
    </script>
</body>
</html>
