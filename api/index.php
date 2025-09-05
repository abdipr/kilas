<?php
$api_url = 'https://kilas.com/api/detik'; // ganti ke https
$response = @file_get_contents($api_url);

if ($response === FALSE) {
    echo "Gagal mengambil response dari API.";
    exit();
}

$data = json_decode($response, true);

if ($data && isset($data['status']) && $data['status'] == 200) {
    $articles = $data['result'];
} else {
    echo "Gagal mengambil data dari API.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Primary Meta Tags -->
<title>Kilas.com - Berita Indonesia Hari Ini</title>
<meta name="title" content="Kilas.com - Berita Indonesia Hari Ini">
<meta name="description" content="Kilas.com menyajikan berita terkini Indonesia, update setiap hari dari berbagai sumber terpercaya.">

<!-- Favicon -->
<link rel="icon" type="image/png" href="https://kilas.com/assets/kilas-icon.png">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://kilas.com/">
<meta property="og:title" content="Kilas.com - Berita Indonesia Terkini">
<meta property="og:description" content="Kilas.com menyajikan berita terkini Indonesia, update setiap hari dari berbagai sumber terpercaya.">
<meta property="og:image" content="https://kilas.com/assets/kilas-banner.png">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://kilas.com/">
<meta property="twitter:title" content="Kilas.com - Berita Indonesia Terkini">
<meta property="twitter:description" content="Kilas.com menyajikan berita terkini Indonesia, update setiap hari dari berbagai sumber terpercaya.">
<meta property="twitter:image" content="https://kilas.com/assets/kilas-banner.png">
<meta name="keywords" content="berita, berita terkini, berita terbaru, berita hari ini, detik.com, liputan6, inews, inilah.com, kompas.com, cnn indonesia, indonesia, kilas.com">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "Berita Indonesia Terkini",
  "image": ["https://kilas.com/assets/kilas-banner.png"],
  "author": {
    "@type": "Organization",
    "name": "Kilas.com"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Kilas.com",
    "logo": {
      "@type": "ImageObject",
      "url": "https://kilas.com/assets/kilas-icon.png"
    }
  },
  "datePublished": "2025-09-05"
}
</script>

    <style>
        :root {
            --primary: #36A0D6;
            --primary-hover: #2a8ab9;
            --secondary: #64748b;
            --dark: #172030;
            --light: #f8fafc;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #e2e8f0;
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .article-image {
            transition: opacity 0.3s ease;
        }
        
        .article-card:hover .article-image {
            opacity: 0.9;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center mb-4 md:mb-0">
                <img src="./KILAS_Black.png" height="30px">
            </div>
            
            <div class="relative w-full md:w-1/3">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i data-feather="search" class="text-gray-400"></i>
                </div>
                <input type="text" id="searchInput" placeholder="Cari artikel..." 
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Loading Indicator -->
        <div id="loading" class="flex justify-center items-center py-12">
            <div class="loading-spinner"></div>
        </div>

        <!-- Articles Grid -->
        <div id="articlesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 hidden">
            <?php foreach ($articles as $article): ?>
                <article class="article-card bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 ease-in-out" 
                         data-aos="fade-up" data-title="<?= strtolower($article['title']) ?>">
                    <div class="relative h-48 overflow-hidden">
                        <img src="<?= $article['image'] ?>" 
                             alt="<?= $article['title'] ?>" 
                             class="article-image w-full h-full object-cover lazy" 
                             loading="lazy">
                    </div>
                    <div class="p-5">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i data-feather="clock" class="w-4 h-4 mr-1"></i>
                            <span><?= $article['date_ago'] ?></span>
                            <span class="mx-2">•</span>
                            <span><?= $article['date'] ?></span>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-3 line-clamp-2"><?= $article['title'] ?></h2>
                        <a href="<?= $article['link'] ?>" target="_blank" 
                           class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-300">
                            Baca Selengkapnya
                            <i data-feather="arrow-right" class="w-4 h-4 ml-2"></i>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        
        <!-- No Results Message -->
        <div id="noResults" class="hidden text-center py-12">
            <i data-feather="search" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-600">Artikel tidak ditemukan</h3>
            <p class="text-gray-500 mt-2">Coba kata kunci lain atau periksa ejaan</p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center">
                        <i data-feather="zap" class="text-blue-400 mr-2"></i>
                        <span class="text-xl font-semibold">Kilas.com</span>
                    </div>
                    <p class="text-gray-400 mt-2">Berita terkini, update setiap hari</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i data-feather="facebook"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i data-feather="twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i data-feather="instagram"></i>
                    </a>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-6 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; <?= date('Y') ?> Kilas.com. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Initialize AOS and Feather Icons
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 600,
                once: true
            });
            feather.replace();
            
            // Hide loading and show articles after page load
            setTimeout(() => {
                document.getElementById('loading').classList.add('hidden');
                document.getElementById('articlesContainer').classList.remove('hidden');
            }, 1000);
            
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const articles = document.querySelectorAll('.article-card');
            const noResults = document.getElementById('noResults');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                let hasResults = false;
                
                articles.forEach(article => {
                    const title = article.getAttribute('data-title');
                    if (title.includes(searchTerm)) {
                        article.classList.remove('hidden');
                        hasResults = true;
                    } else {
                        article.classList.add('hidden');
                    }
                });
                
                if (hasResults || searchTerm === '') {
                    noResults.classList.add('hidden');
                } else {
                    noResults.classList.remove('hidden');
                }
            });
            
            // Lazy loading images
            if ('IntersectionObserver' in window) {
                const lazyImages = document.querySelectorAll('.lazy');
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.getAttribute('src');
                            img.classList.remove('lazy');
                            imageObserver.unobserve(img);
                        }
                    });
                });
                
                lazyImages.forEach(img => imageObserver.observe(img));
            }
        });
    </script>
</body>
</html>
