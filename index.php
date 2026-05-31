<?php
/**
 * Lumina Fine Dining - Premium Restaurant Website
 * Tech Stack: PHP, HTML, Tailwind CSS, JavaScript
 */

// Basic PHP Routing
$page = isset($_GET['page']) ? filter_var($_GET['page']) : 'home';
$valid_pages = ['home', 'menu', 'reservations', 'gallery', 'about', 'contact'];
if (!in_array($page, $valid_pages)) {
    $page = 'home';
}

// Handle Reservation Form Submission
$reservation_success = false;
$reservation_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reserve') {
    // In a production environment, you would validate inputs and insert into a database or send an email here.
    $name = htmlspecialchars($_POST['name'] ?? '');
    $date = htmlspecialchars($_POST['date'] ?? '');
    $time = htmlspecialchars($_POST['time'] ?? '');
    
    $reservation_success = true;
    $reservation_message = "Thank you, {$name}. Your reservation request for {$date} at {$time} has been received. Our team will contact you shortly to confirm.";
}

// Global Variables for Local SEO
$restaurant_name = "Lumina";
$city = "Lagos";
$cuisine = "Contemporary Fine Dining";
$phone = "+234 800 123 4567";
$whatsapp = "2348001234567";
$developer_name = "<a href='https://myportfolio-six-sepia.vercel.app/' target='_blank'>Sentry Developer Studio</a>";
$developer_website = "";
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?= ucfirst($page) ?> | <?= $restaurant_name ?> - Best Fine Dining Restaurant in <?= $city ?></title>
    <meta name="description" content="Experience the best fine dining at <?= $restaurant_name ?> in <?= $city ?>. We offer exquisite <?= $cuisine ?>, a luxurious atmosphere, and exceptional service. Book your table today.">
    <meta name="keywords" content="best restaurant in <?= $city ?>, <?= $cuisine ?> restaurant, fine dining experience, romantic restaurant <?= $city ?>, reserve a table">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            gold: '#D4AF37',       // Elegant Gold
                            goldHover: '#B5952F',
                            dark: '#0A0A0A',       // Deep Black
                            surface: '#171717',    // Dark Gray surface
                            surfaceLight: '#262626',
                            light: '#E5E5E5',      // Soft White text
                            muted: '#A3A3A3'       // Muted text
                        }
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Styles & Animations */
        body { background-color: #0A0A0A; color: #E5E5E5; }
        .hero-overlay { background: linear-gradient(to bottom, rgba(10,10,10,0.4) 0%, rgba(10,10,10,0.9) 100%); }
        .fade-in { animation: fadeIn 1s ease-in forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .nav-link { position: relative; }
        .nav-link::after {
            content: ''; position: absolute; width: 0; height: 2px;
            bottom: -4px; left: 0; background-color: #D4AF37;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after, .nav-active::after { width: 100%; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0A0A0A; }
        ::-webkit-scrollbar-thumb { background: #D4AF37; border-radius: 4px; }
    </style>
</head>
<body class="font-sans antialiased flex flex-col min-h-screen">

    <!-- Navigation -->
    <header class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="?page=home" class="flex flex-col items-center group">
                    <span class="font-serif text-2xl md:text-3xl font-bold tracking-wider text-white group-hover:text-brand-gold transition duration-300"><?= $restaurant_name ?></span>
                    <span class="text-[10px] tracking-[0.3em] uppercase text-brand-gold">Fine Dining</span>
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex items-center space-x-8 font-medium text-sm tracking-widest uppercase">
                    <a href="?page=home" class="text-white hover:text-brand-gold transition nav-link <?= $page == 'home' ? 'nav-active' : '' ?>">Home</a>
                    <a href="?page=menu" class="text-white hover:text-brand-gold transition nav-link <?= $page == 'menu' ? 'nav-active' : '' ?>">Menu</a>
                    <a href="?page=gallery" class="text-white hover:text-brand-gold transition nav-link <?= $page == 'gallery' ? 'nav-active' : '' ?>">Gallery</a>
                    <a href="?page=about" class="text-white hover:text-brand-gold transition nav-link <?= $page == 'about' ? 'nav-active' : '' ?>">About</a>
                    <a href="?page=contact" class="text-white hover:text-brand-gold transition nav-link <?= $page == 'contact' ? 'nav-active' : '' ?>">Contact</a>
                </nav>

                <!-- CTA & Mobile Toggle -->
                <div class="flex items-center space-x-4">
                    <a href="?page=reservations" class="hidden md:inline-block bg-brand-gold text-brand-dark px-6 py-2.5 font-bold uppercase text-sm tracking-wider hover:bg-brand-goldHover transition duration-300">
                        Reserve a Table
                    </a>
                    <button id="mobile-menu-btn" class="md:hidden text-brand-gold text-2xl focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-brand-surface border-t border-gray-800 shadow-2xl">
            <div class="flex flex-col px-6 py-4 space-y-4 text-center uppercase tracking-widest text-sm">
                <a href="?page=home" class="text-white hover:text-brand-gold py-2">Home</a>
                <a href="?page=menu" class="text-white hover:text-brand-gold py-2">Menu</a>
                <a href="?page=gallery" class="text-white hover:text-brand-gold py-2">Gallery</a>
                <a href="?page=about" class="text-white hover:text-brand-gold py-2">About</a>
                <a href="?page=contact" class="text-white hover:text-brand-gold py-2">Contact</a>
                <a href="?page=reservations" class="bg-brand-gold text-brand-dark py-3 font-bold mt-4">Reserve a Table</a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        <?php if ($page === 'home'): ?>
            <!-- ================= HOMEPAGE ================= -->
            
            <!-- Hero Section -->
            <section class="relative h-screen flex items-center justify-center">
                <!-- Background Image -->
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=1920&q=80" alt="Fine Dining Atmosphere" class="w-full h-full object-cover">
                    <div class="absolute inset-0 hero-overlay"></div>
                </div>
                
                <!-- Hero Content -->
                <div class="relative z-10 text-center px-4 max-w-4xl fade-in">
                    <span class="text-brand-gold font-serif italic text-xl md:text-2xl mb-4 block">A Symphony of Flavors</span>
                    <h1 class="text-5xl md:text-7xl font-serif text-white mb-6 leading-tight">
                        Experience Culinary <br>Excellence in <?= $city ?>
                    </h1>
                    <p class="text-brand-light text-lg mb-10 font-light max-w-2xl mx-auto">
                        Indulge in an unforgettable fine dining experience where exceptional ingredients meet masterful preparation in a luxurious setting.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="?page=reservations" class="bg-brand-gold hover:bg-brand-goldHover text-brand-dark px-8 py-4 font-bold uppercase tracking-widest transition duration-300">
                            Reserve a Table
                        </a>
                        <a href="?page=menu" class="border border-brand-gold text-brand-gold hover:bg-brand-gold hover:text-brand-dark px-8 py-4 font-bold uppercase tracking-widest transition duration-300">
                            View Menu
                        </a>
                    </div>
                </div>
            </section>

            <!-- Introduction Section -->
            <section class="py-24 bg-brand-dark relative">
                <div class="container mx-auto px-6 text-center max-w-3xl">
                    <i class="fas fa-utensils text-brand-gold text-3xl mb-6"></i>
                    <h2 class="text-3xl md:text-4xl font-serif text-white mb-6">The <?= $restaurant_name ?> Concept</h2>
                    <p class="text-brand-muted leading-relaxed text-lg font-light mb-8">
                        Recognized as the best restaurant in <?= $city ?> for contemporary cuisine, we blend traditional techniques with modern innovation. Our mission is simple: to provide a sensory journey that delights the palate and warms the soul, making every dinner, business meeting, or romantic date truly special.
                    </p>
                    <img src="https://images.unsplash.com/signature-placeholder" alt="Chef Signature" onerror="this.style.display='none'" class="h-12 mx-auto opacity-70">
                </div>
            </section>

            <!-- Featured Dishes -->
            <section class="py-24 bg-brand-surface border-y border-brand-surfaceLight">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <span class="text-brand-gold uppercase tracking-[0.2em] text-sm font-bold">Culinary Masterpieces</span>
                        <h2 class="text-4xl font-serif text-white mt-2">Signature Dishes</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <!-- Dish 1 -->
                        <div class="bg-brand-dark group rounded-lg overflow-hidden border border-brand-surfaceLight hover:border-brand-gold transition duration-500">
                            <div class="relative h-64 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800&q=80" alt="Wagyu Beef" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            </div>
                            <div class="p-8 text-center">
                                <h3 class="font-serif text-2xl text-white mb-2">A5 Wagyu Tenderloin</h3>
                                <p class="text-brand-muted font-light text-sm mb-4">Truffle pomme purée, wild mushrooms, red wine reduction.</p>
                                <span class="text-brand-gold font-serif text-xl">₦45,000</span>
                            </div>
                        </div>
                        <!-- Dish 2 -->
                        <div class="bg-brand-dark group rounded-lg overflow-hidden border border-brand-surfaceLight hover:border-brand-gold transition duration-500">
                            <div class="relative h-64 overflow-hidden">
                                <img src="images/scallops.jpg" alt="Seafood" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            </div>
                            <div class="p-8 text-center">
                                <h3 class="font-serif text-2xl text-white mb-2">Pan-Seared Scallops</h3>
                                <p class="text-brand-muted font-light text-sm mb-4">Cauliflower silk, caviar, preserved lemon emulsion.</p>
                                <span class="text-brand-gold font-serif text-xl">₦28,000</span>
                            </div>
                        </div>
                        <!-- Dish 3 -->
                        <div class="bg-brand-dark group rounded-lg overflow-hidden border border-brand-surfaceLight hover:border-brand-gold transition duration-500">
                            <div class="relative h-64 overflow-hidden">
                                <img src="images/dark_chocolate.jpg" alt="Dessert" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            </div>
                            <div class="p-8 text-center">
                                <h3 class="font-serif text-2xl text-white mb-2">Dark Chocolate Sphere</h3>
                                <p class="text-brand-muted font-light text-sm mb-4">Madagascar vanilla bean ice cream, hot salted caramel pour.</p>
                                <span class="text-brand-gold font-serif text-xl">₦15,000</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-12">
                        <a href="?page=menu" class="text-brand-gold uppercase tracking-widest text-sm hover:text-white transition border-b border-brand-gold pb-1">Discover Full Menu</a>
                    </div>
                </div>
            </section>

            <!-- Testimonials & Trust Signals -->
            <section class="py-24 bg-brand-dark">
                <div class="container mx-auto px-6 text-center max-w-4xl">
                    <div class="flex justify-center text-brand-gold text-sm mb-6 space-x-1">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-serif text-white italic mb-10 leading-relaxed">
                        "An absolute triumph. From the ambient lighting to the impeccably plated dishes, <?= $restaurant_name ?> provides a fine dining experience that rivals the best in the world. A must-visit in <?= $city ?>."
                    </h2>
                    <p class="text-brand-muted uppercase tracking-widest text-sm font-bold">— The Culinary Times & Google Reviews</p>
                </div>
            </section>

            <!-- Call to Action Banner -->
            <section class="py-20 bg-[url('https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center bg-fixed relative">
                <div class="absolute inset-0 bg-brand-dark/80"></div>
                <div class="container mx-auto px-6 relative z-10 text-center">
                    <h2 class="text-4xl font-serif text-white mb-6">Join Us for an Evening of Elegance</h2>
                    <p class="text-brand-light mb-8 max-w-xl mx-auto font-light">Tables fill up quickly during weekends. We highly recommend booking your reservation in advance to secure your preferred dining time.</p>
                    <a href="?page=reservations" class="inline-block bg-brand-gold text-brand-dark px-10 py-4 font-bold uppercase tracking-widest hover:bg-white hover:text-brand-dark transition duration-300">
                        Book Your Table Now
                    </a>
                </div>
            </section>

        <?php elseif ($page === 'menu'): ?>
            <!-- ================= MENU PAGE ================= -->
            <section class="pt-32 pb-24 bg-brand-dark min-h-screen">
                <div class="container mx-auto px-6 max-w-5xl">
                    <div class="text-center mb-16">
                        <h1 class="text-5xl font-serif text-white mb-4">Our Menu</h1>
                        <p class="text-brand-muted font-light">A curated selection of seasonal ingredients and bold flavors.</p>
                        <div class="w-24 h-1 bg-brand-gold mx-auto mt-6"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-16">
                        
                        <!-- Appetizers -->
                        <div>
                            <h2 class="text-2xl font-serif text-brand-gold border-b border-brand-surfaceLight pb-2 mb-6 uppercase tracking-widest">Appetizers</h2>
                            <div class="space-y-8">
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">Wagyu Beef Tartare</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Quail egg, black truffle, toasted brioche.</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 18,000</div>
                                </div>
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">Burrata & Heirloom Tomato</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Basil emulsion, aged balsamic, microgreens.</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 14,500</div>
                                </div>
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">Oysters Rockefeller</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Half dozen, spinach, pernod, hollandaise.</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 22,000</div>
                                </div>
                            </div>
                        </div>

                        <!-- Seafood -->
                        <div>
                            <h2 class="text-2xl font-serif text-brand-gold border-b border-brand-surfaceLight pb-2 mb-6 uppercase tracking-widest">Seafood</h2>
                            <div class="space-y-8">
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">Grilled Lobster Tail</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Garlic herb butter, saffron risotto, asparagus.</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 42,000</div>
                                </div>
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">Pan-Seared Scallops</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Cauliflower silk, caviar, preserved lemon.</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 28,000</div>
                                </div>
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">Miso Glazed Black Cod</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Bok choy, shiitake dashi, sesame crunch.</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 35,000</div>
                                </div>
                            </div>
                        </div>

                        <!-- Main Courses -->
                        <div>
                            <h2 class="text-2xl font-serif text-brand-gold border-b border-brand-surfaceLight pb-2 mb-6 uppercase tracking-widest">Main Courses</h2>
                            <div class="space-y-8">
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">A5 Wagyu Tenderloin</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Truffle pomme purée, wild mushrooms.</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 45,000</div>
                                </div>
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">Herb-Crusted Rack of Lamb</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Mint pea purée, fondant potatoes, jus.</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 38,000</div>
                                </div>
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">Truffle Mushroom Risotto</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Arborio rice, porcini, aged parmesan. (V)</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 24,000</div>
                                </div>
                            </div>
                        </div>

                        <!-- Desserts & Drinks -->
                        <div>
                            <h2 class="text-2xl font-serif text-brand-gold border-b border-brand-surfaceLight pb-2 mb-6 uppercase tracking-widest">Desserts</h2>
                            <div class="space-y-8">
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">Dark Chocolate Sphere</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Vanilla bean ice cream, hot salted caramel.</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 15,000</div>
                                </div>
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">Classic Tiramisu</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Espresso soaked ladyfingers, mascarpone.</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 12,000</div>
                                </div>
                                <div class="flex justify-between items-baseline group">
                                    <div class="pr-4">
                                        <h3 class="text-xl font-serif text-white group-hover:text-brand-gold transition">Artisan Cheese Board</h3>
                                        <p class="text-sm text-brand-muted mt-1 font-light">Selection of fine cheeses, honey, crackers.</p>
                                    </div>
                                    <div class="text-brand-gold font-serif text-lg whitespace-nowrap">₦ 18,500</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="mt-20 text-center">
                        <p class="text-brand-muted font-light italic mb-6">Ask your server for our extensive wine pairing and signature cocktail list.</p>
                        <a href="?page=reservations" class="inline-block bg-brand-gold text-brand-dark px-10 py-4 font-bold uppercase tracking-widest hover:bg-white transition duration-300">
                            Reserve to Taste
                        </a>
                    </div>
                </div>
            </section>

        <?php elseif ($page === 'reservations'): ?>
            <!-- ================= RESERVATIONS PAGE ================= -->
            <section class="pt-32 pb-24 bg-brand-surface min-h-screen">
                <div class="container mx-auto px-6 max-w-6xl">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                        
                        <!-- Reservation Form -->
                        <div class="bg-brand-dark p-8 md:p-12 rounded-lg border border-brand-surfaceLight shadow-2xl">
                            <h1 class="text-4xl font-serif text-white mb-2">Book a Table</h1>
                            <p class="text-brand-muted font-light mb-8">Join us for an exquisite dining experience. Please note that advance reservations are highly recommended, especially during weekend dinner hours.</p>
                            
                            <?php if ($reservation_success): ?>
                                <div class="bg-green-900/30 border border-green-500 text-green-400 p-4 rounded mb-6">
                                    <i class="fas fa-check-circle mr-2"></i> <?= $reservation_message ?>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="?page=reservations" class="space-y-6">
                                <input type="hidden" name="action" value="reserve">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-brand-muted text-xs uppercase tracking-widest mb-2">Date</label>
                                        <input type="date" name="date" required class="w-full bg-brand-surface border border-gray-700 text-white p-3 focus:border-brand-gold focus:outline-none transition">
                                    </div>
                                    <div>
                                        <label class="block text-brand-muted text-xs uppercase tracking-widest mb-2">Time</label>
                                        <select name="time" required class="w-full bg-brand-surface border border-gray-700 text-white p-3 focus:border-brand-gold focus:outline-none transition appearance-none">
                                            <option value="">Select Time</option>
                                            <option value="18:00">06:00 PM</option>
                                            <option value="19:00">07:00 PM</option>
                                            <option value="20:00">08:00 PM</option>
                                            <option value="21:00">09:00 PM</option>
                                            <option value="22:00">10:00 PM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-brand-muted text-xs uppercase tracking-widest mb-2">Number of Guests</label>
                                        <select name="guests" required class="w-full bg-brand-surface border border-gray-700 text-white p-3 focus:border-brand-gold focus:outline-none transition appearance-none">
                                            <option value="1">1 Person</option>
                                            <option value="2" selected>2 People</option>
                                            <option value="3">3 People</option>
                                            <option value="4">4 People</option>
                                            <option value="5">5 People</option>
                                            <option value="6+">6+ People (Call Us)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-brand-muted text-xs uppercase tracking-widest mb-2">Full Name</label>
                                        <input type="text" name="name" required placeholder="John Doe" class="w-full bg-brand-surface border border-gray-700 text-white p-3 focus:border-brand-gold focus:outline-none transition">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-brand-muted text-xs uppercase tracking-widest mb-2">Phone Number</label>
                                        <input type="tel" name="phone" required placeholder="+234 XXX XXX XXXX" class="w-full bg-brand-surface border border-gray-700 text-white p-3 focus:border-brand-gold focus:outline-none transition">
                                    </div>
                                    <div>
                                        <label class="block text-brand-muted text-xs uppercase tracking-widest mb-2">Email Address</label>
                                        <input type="email" name="email" required placeholder="john@example.com" class="w-full bg-brand-surface border border-gray-700 text-white p-3 focus:border-brand-gold focus:outline-none transition">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-brand-muted text-xs uppercase tracking-widest mb-2">Special Requests (Optional)</label>
                                    <textarea name="requests" rows="3" placeholder="Dietary requirements, special occasions..." class="w-full bg-brand-surface border border-gray-700 text-white p-3 focus:border-brand-gold focus:outline-none transition"></textarea>
                                </div>

                                <button type="submit" class="w-full bg-brand-gold text-brand-dark py-4 font-bold uppercase tracking-widest hover:bg-brand-goldHover transition shadow-[0_0_15px_rgba(212,175,55,0.3)] hover:shadow-[0_0_25px_rgba(212,175,55,0.5)]">
                                    Confirm Reservation
                                </button>
                            </form>
                        </div>

                        <!-- Contact Options -->
                        <div class="flex flex-col justify-center space-y-10">
                            <div>
                                <h3 class="text-2xl font-serif text-white mb-4">Other Ways to Book</h3>
                                <p class="text-brand-muted font-light mb-6">For large parties, private events, or immediate assistance, please use our direct contact lines.</p>
                                
                                <div class="space-y-4">
                                    <a href="https://wa.me/<?= $whatsapp ?>" target="_blank" class="flex items-center justify-center space-x-3 w-full bg-[#25D366] text-white py-4 font-bold uppercase tracking-widest hover:bg-[#1DA851] transition rounded">
                                        <i class="fab fa-whatsapp text-xl"></i>
                                        <span>Book via WhatsApp</span>
                                    </a>
                                    
                                    <a href="tel:<?= $phone ?>" class="flex items-center justify-center space-x-3 w-full bg-transparent border border-brand-gold text-brand-gold py-4 font-bold uppercase tracking-widest hover:bg-brand-gold hover:text-brand-dark transition rounded">
                                        <i class="fas fa-phone text-xl"></i>
                                        <span>Call to Reserve</span>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="border-t border-brand-surfaceLight pt-8">
                                <h4 class="text-brand-gold font-serif text-xl mb-4">Opening Hours</h4>
                                <ul class="space-y-2 text-brand-muted font-light">
                                    <li class="flex justify-between"><span>Monday - Thursday</span> <span>6:00 PM - 11:00 PM</span></li>
                                    <li class="flex justify-between"><span>Friday - Saturday</span> <span>6:00 PM - 1:00 AM</span></li>
                                    <li class="flex justify-between"><span>Sunday</span> <span>5:00 PM - 10:00 PM</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($page === 'gallery'): ?>
            <!-- ================= GALLERY PAGE ================= -->
            <section class="pt-32 pb-24 bg-brand-dark min-h-screen">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h1 class="text-5xl font-serif text-white mb-4">The Experience</h1>
                        <p class="text-brand-muted font-light max-w-2xl mx-auto">A visual journey through our luxurious dining atmosphere, meticulously crafted dishes, and the passion of our culinary team.</p>
                        <div class="w-24 h-1 bg-brand-gold mx-auto mt-6"></div>
                    </div>

                    <!-- CSS Grid Masonry Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 auto-rows-[250px]">
                        <!-- Item 1 (Large) -->
                        <div class="lg:col-span-2 lg:row-span-2 relative group overflow-hidden rounded">
                            <img src="https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?auto=format&fit=crop&w=1200&q=80" alt="Restaurant Interior" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-500 flex items-end p-6">
                                <span class="text-white font-serif text-xl">Elegant Dining Atmosphere</span>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="relative group overflow-hidden rounded">
                            <img src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800&q=80" alt="Signature Dish" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        </div>
                        <!-- Item 3 -->
                        <div class="relative group overflow-hidden rounded lg:row-span-2">
                            <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&w=600&q=80" alt="Chef Preparing Food" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-500 flex items-end p-6">
                                <span class="text-white font-serif text-xl">Masterful Preparation</span>
                            </div>
                        </div>
                        <!-- Item 4 -->
                        <div class="relative group overflow-hidden rounded">
                            <img src="https://images.unsplash.com/photo-1563805042-7684c8a9e9cb?auto=format&fit=crop&w=800&q=80" alt="Dessert" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        </div>
                        <!-- Item 5 -->
                        <div class="lg:col-span-2 relative group overflow-hidden rounded">
                            <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=1200&q=80" alt="Cocktails" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        </div>
                    </div>

                    <div class="text-center mt-16">
                        <a href="?page=reservations" class="inline-block bg-brand-gold text-brand-dark px-10 py-4 font-bold uppercase tracking-widest hover:bg-white transition duration-300">
                            Experience it Yourself
                        </a>
                    </div>
                </div>
            </section>

        <?php elseif ($page === 'about'): ?>
            <!-- ================= ABOUT PAGE ================= -->
            <section class="pt-32 pb-24 bg-brand-surface min-h-screen">
                <div class="container mx-auto px-6">
                    <div class="flex flex-col lg:flex-row items-center gap-16">
                        <div class="lg:w-1/2 relative">
                            <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?auto=format&fit=crop&w=800&q=80" alt="Executive Chef" class="rounded-lg shadow-[0_0_30px_rgba(0,0,0,0.5)] z-10 relative">
                            <div class="absolute -top-6 -left-6 w-32 h-32 border-t-2 border-l-2 border-brand-gold"></div>
                            <div class="absolute -bottom-6 -right-6 w-32 h-32 border-b-2 border-r-2 border-brand-gold"></div>
                        </div>
                        
                        <div class="lg:w-1/2">
                            <span class="text-brand-gold uppercase tracking-[0.2em] text-sm font-bold block mb-2">Our Story</span>
                            <h1 class="text-4xl md:text-5xl font-serif text-white mb-6 leading-tight">A Passion for <br>Gastronomic Excellence</h1>
                            
                            <div class="space-y-6 text-brand-muted font-light text-lg leading-relaxed">
                                <p>
                                    Founded with the vision of redefining fine dining in <?= $city ?>, <?= $restaurant_name ?> represents the pinnacle of culinary artistry. We believe that a meal should be more than just sustenance; it should be a memorable event that engages all the senses.
                                </p>
                                <p>
                                    Our Executive Chef, bringing over two decades of experience from Michelin-starred kitchens across Europe and Asia, curates a menu that respects classical techniques while embracing modern innovation and local, premium ingredients.
                                </p>
                                <p>
                                    Every detail of <?= $restaurant_name ?>, from the carefully selected wine list to the bespoke interior design, has been orchestrated to provide our guests with an ambiance of sophisticated luxury and warmth.
                                </p>
                            </div>

                            <div class="mt-10 flex items-center space-x-6">
                                <a href="?page=reservations" class="bg-brand-gold text-brand-dark px-8 py-3 font-bold uppercase tracking-widest hover:bg-white transition duration-300">
                                    Dine With Us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($page === 'contact'): ?>
            <!-- ================= CONTACT PAGE ================= -->
            <section class="pt-32 pb-24 bg-brand-dark min-h-screen">
                <div class="container mx-auto px-6 max-w-6xl">
                    <div class="text-center mb-16">
                        <h1 class="text-5xl font-serif text-white mb-4">Get in Touch</h1>
                        <p class="text-brand-muted font-light max-w-2xl mx-auto">We are here to assist you with reservations, private dining inquiries, and any questions you may have.</p>
                        <div class="w-24 h-1 bg-brand-gold mx-auto mt-6"></div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-12 bg-brand-surface p-4 rounded-lg border border-brand-surfaceLight shadow-2xl">
                        <!-- Contact Info -->
                        <div class="lg:w-1/3 p-8">
                            <div class="space-y-10">
                                <div>
                                    <h3 class="text-brand-gold font-serif text-xl mb-3 flex items-center"><i class="fas fa-map-marker-alt mr-3 w-5 text-center"></i> Location</h3>
                                    <p class="text-brand-light font-light pl-8">
                                        123 Luxury Avenue,<br>
                                        Victoria Island, <?= $city ?>,<br>
                                        Nigeria
                                    </p>
                                    <a href="https://maps.google.com" target="_blank" class="inline-block mt-3 pl-8 text-brand-gold text-sm uppercase tracking-widest hover:text-white transition">Get Directions &rarr;</a>
                                </div>

                                <div>
                                    <h3 class="text-brand-gold font-serif text-xl mb-3 flex items-center"><i class="fas fa-phone-alt mr-3 w-5 text-center"></i> Reservations</h3>
                                    <p class="text-brand-light font-light pl-8 mb-1"><?= $phone ?></p>
                                    <p class="text-brand-light font-light pl-8">reservations@<?= strtolower($restaurant_name) ?>.com</p>
                                </div>

                                <div>
                                    <h3 class="text-brand-gold font-serif text-xl mb-3 flex items-center"><i class="fas fa-clock mr-3 w-5 text-center"></i> Hours</h3>
                                    <ul class="text-brand-light font-light pl-8 space-y-1 text-sm">
                                        <li>Mon - Thu: 6:00 PM - 11:00 PM</li>
                                        <li>Fri - Sat: 6:00 PM - 1:00 AM</li>
                                        <li>Sun: 5:00 PM - 10:00 PM</li>
                                    </ul>
                                </div>
                                
                                <div class="pl-8 pt-4 flex space-x-4">
                                    <a href="#" class="w-10 h-10 rounded-full border border-brand-gold flex items-center justify-center text-brand-gold hover:bg-brand-gold hover:text-brand-dark transition"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="w-10 h-10 rounded-full border border-brand-gold flex items-center justify-center text-brand-gold hover:bg-brand-gold hover:text-brand-dark transition"><i class="fab fa-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Map Embed -->
                        <div class="lg:w-2/3 h-[400px] lg:h-auto rounded overflow-hidden">
                            <!-- High-quality grayscale map iframe suitable for dark theme -->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.7!2d3.4!3d6.4!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMjUnMDAuMCJOIDPCsDI0JzAwLjAiRQ!5e0!3m2!1sen!2sng!4v1600000000000!5m2!1sen!2sng" 
                                width="100%" height="100%" style="border:0; filter: invert(90%) hue-rotate(180deg) grayscale(80%);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-[#050505] border-t border-gray-900 py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <a href="?page=home" class="font-serif text-3xl font-bold text-white tracking-wider block mb-4"><?= $restaurant_name ?></a>
                    <p class="text-brand-muted font-light max-w-md text-sm leading-relaxed">
                        The premier destination for contemporary fine dining in <?= $city ?>. Join us for an unparalleled culinary journey of exquisite flavors and luxurious ambiance.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-white font-serif text-lg mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-brand-muted">
                        <li><a href="?page=menu" class="hover:text-brand-gold transition">Our Menu</a></li>
                        <li><a href="?page=reservations" class="hover:text-brand-gold transition">Reserve a Table</a></li>
                        <li><a href="?page=gallery" class="hover:text-brand-gold transition">Gallery</a></li>
                        <li><a href="?page=about" class="hover:text-brand-gold transition">Our Story</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-serif text-lg mb-4">Connect with Us</h4>
                    <ul class="space-y-2 text-sm text-brand-muted">
                        <li><a href="#" class="hover:text-brand-gold transition"><i class="fab fa-instagram mr-2"></i> Instagram</a></li>
                        <li><a href="#" class="hover:text-brand-gold transition"><i class="fab fa-facebook-f mr-2"></i> Facebook</a></li>
                        <li class="pt-4 mt-4 border-t border-gray-800">
                            <a href="?page=contact" class="text-brand-gold hover:text-white transition">Get Directions</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="text-center text-xs text-gray-600 pt-8 border-t border-gray-900 uppercase tracking-widest">
                &copy; <?= date('Y') ?> <?= $restaurant_name ?> Fine Dining. All rights reserved. | Best Restaurant in <?= $city ?>.
                <br> Built by <?= $developer_name ?>  <?= $developer_website ?>.
            </div>
        </div>
    </footer>

    <!-- JavaScript for Mobile Menu & Navbar Effects -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Toggle
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });

            // Navbar Background on Scroll
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-brand-dark', 'shadow-lg', 'border-b', 'border-brand-surfaceLight');
                    navbar.classList.remove('py-4');
                    navbar.classList.add('py-2');
                } else {
                    navbar.classList.remove('bg-brand-dark', 'shadow-lg', 'border-b', 'border-brand-surfaceLight');
                    navbar.classList.remove('py-2');
                    navbar.classList.add('py-4');
                }
            });

            // Trigger scroll event on load to set initial state
            window.dispatchEvent(new Event('scroll'));
        });
    </script>
</body>
</html>