<?php
require_once __DIR__ . '/functions.php';
$cartCount = get_cart_count();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | ' . APP_NAME : APP_NAME . ' | ' . APP_TAGLINE ?></title>
    
    <!-- Meta Descriptions for SEO -->
    <meta name="description" content="Discover Olive Shoe: Artisanal handcrafted luxury footwear forged in deep Italian olive calfskin with gold-tone hardware.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS (CDN configured for Olive & Gold Luxury Aesthetic) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        olive: {
                            50: '#f6f8f2',
                            100: '#ebf1e2',
                            200: '#d7e2c5',
                            300: '#bbcca1',
                            400: '#9db37b',
                            500: '#7f9859',
                            600: '#617941',
                            700: '#4c5f34',
                            800: '#384626',
                            900: '#232d18',
                            950: '#141a0d',
                        },
                        gold: {
                            100: '#fcf6df',
                            200: '#f8edb9',
                            300: '#f3df8d',
                            400: '#eacb5e',
                            500: '#d4af37', // Classic metallic gold
                            600: '#b59124',
                            700: '#8c6e18',
                            800: '#664e12',
                            900: '#42320b',
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Style Layer -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="bg-[#faf9f5] text-zinc-900 antialiased flex flex-col min-h-screen">
