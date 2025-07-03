<?php
//  filepath: c:\xampp\htdocs\tachomarket\tachomarket\tachodocs\tachodocs.php  -->
// <?php
define('shoppingcart', true);
include '../config.php';
include '../functions.php';
$pdo = pdo_connect_mysql();

// Fetch the 3 most recent news posts (with slug and created_at)
$stmt = $pdo->prepare("SELECT title, slug, created_at FROM blog WHERE is_published = 1 ORDER BY created_at DESC LIMIT 3");
$stmt->execute();
$recent_news = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TachoDocs</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .tile-btn {
      border: 2px solid #0e478a;
      padding: 0.5rem 1.25rem;
      border-radius: 9999px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      transition: background 0.3s;
    }
    .tile-btn:hover {
      background: #0e478a;
      color: white;
    }
    .tile-btn::before {
      content: '\25B6';
      margin-right: 0.5rem;
      color: #22c55e;
    }
    .info-tile {
      background-color: #f5f7fa;
    }
  </style>
</head>
<body class="bg-white text-gray-800">
<header class="bg-white py-6 shadow-md border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
      <img src="images/tachodocs_logo_2025.svg" alt="TachoDocs Logo" class="h-12 w-auto mx-auto sm:mx-0">
    </div>
    <button
      type="button"
      onclick="history.back()"
      class="inline-flex items-center px-4 py-2 bg-[#08428c] text-white text-sm font-medium rounded-lg shadow hover:bg-[#073575] focus:outline-none focus:ring-2 focus:ring-[#08428c]"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Назад
    </button>
  </div>
</header>

  <main class="max-w-7xl mx-auto px-6 py-16 space-y-20">
    <!-- Tile 1 -->
    <section class="grid md:grid-cols-3 gap-6 items-center">
      <div>
        <h2 class="text-2xl font-semibold mb-4 pl-4">Техници</h2>
        <div class="info-tile p-6 rounded-xl space-y-4">
          <div class="space-y-2">
            <a href="workshop_docs/#dtco4.1" class="flex justify-between items-center border-b border-gray-300 pb-2 cursor-pointer">
              <span>DTCO 4.1 ... 4.1b</span>
              <span>&rarr;</span>
            </a>
            <a href="workshop_docs/#intsallation_and_calibration" class="flex justify-between items-center border-b border-gray-300 pb-2 cursor-pointer">
              <span>Монтаж и настройка</span>
              <span>&rarr;</span>
            </a>
            <a href="workshop_docs/#WST2" class="flex justify-between items-center border-b border-gray-300 pb-2 cursor-pointer">
              <span>WorkshopTab2</span>
              <span>&rarr;</span>
            </a>
            <a href="workshop_docs/#miscellaneous" class="flex justify-between items-center border-b border-gray-300 pb-2 cursor-pointer">
              <span>Други</span>
              <span>&rarr;</span>
            </a>
          </div>
        </div>
      </div>
      <div class="md:col-span-2">
        <!-- <img src="bg2.png" alt="User Support Image" class="w-full rounded-xl shadow-md"> -->
        <div class="mt-4">
          <a href="workshop_docs/" class="tile-btn">Сервизна документация</a>
        </div>
      </div>
    </section>

    <!-- Tile 2 -->
    <section class="grid md:grid-cols-3 gap-6 items-center">
      <div>
        <h2 class="text-2xl font-semibold mb-4 pl-4">Потребители</h2>
        <div class="info-tile p-6 rounded-xl space-y-4">
          <div class="space-y-2">
            <a href="user_docs/#dtco41" class="flex justify-between items-center border-b border-gray-300 pb-2 cursor-pointer" >
              <span>DTCO 4.1/4.1a/4.1b</span>
              <span>&rarr;</span>
            </a>
            <a href="user_docs/#tachographs" class="flex justify-between items-center border-b border-gray-300 pb-2 cursor-pointer">
              <span>Други тахографи</span>
              <span>&rarr;</span>
            </a>
            <a href="user_docs/#vdo-fleet" class="flex justify-between items-center border-b border-gray-300 pb-2 cursor-pointer">
              <span>VDO Fleet</span>
              <span>&rarr;</span>
            </a>
            <a href="user_docs/#mobility-package-1" class="flex justify-between items-center border-b border-gray-300 pb-2 cursor-pointer">
              <span>Пакет мобилност 1</span>
              <span>&rarr;</span>
            </a>
            <!-- Fancy Dropdown Trigger -->
            <div class="relative group border-b border-gray-300 pb-2 cursor-pointer">
              <div class="flex justify-between items-center">
                <span class="font-medium text-gray-800 group-hover:text-blue-700 transition-colors duration-200">Download Tools</span>
                <span class="transform group-hover:rotate-90 transition-transform duration-200">&rarr;</span>
              </div>
              <!-- Dropdown Menu -->
              <div class="absolute left-0 mt-3 w-56 bg-white border border-gray-200 rounded-xl shadow-xl opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100 transition-all duration-300 z-10">
                <div class="p-2 space-y-1">
                  <a href="user_docs/#vdo-link" class="block px-4 py-2 rounded-lg text-sm text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition-colors duration-150">VDO Link</a>
                  <a href="#dl-4g" class="block px-4 py-2 rounded-lg text-sm text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition-colors duration-150">DL 4G</a>
                  <a href="#downloadkey-s" class="block px-4 py-2 rounded-lg text-sm text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition-colors duration-150">DOWNLOADKEY S</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="md:col-span-2">
        <!-- <img src="img2.jpg" alt="FAQ Image" class="w-full rounded-xl shadow-md"> -->
        <div class="mt-4">
          <a href="user_docs/" class="tile-btn">Потребителска документация</a>
        </div>
      </div>
    </section>
              <!-- Tile 3: News (Full-width, fits container) -->
    <section class="space-y-4">
      <!-- Section title -->
      <h2 class="text-2xl font-semibold pl-4">News</h2>

      <!-- Card container fills full width -->
      <div class="info-tile w-full p-6 rounded-xl space-y-6">
        <!-- Header Row: Recently Added + All News button -->
        <div class="flex justify-between items-center">
          <p class="text-gray-600 font-medium m-0">Recently Added</p>
          <a href="news_blog/news.php" class="tile-btn">All News</a>
        </div>

        <!-- Cards: mobile = 1 column, md+ = 3 columns -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <?php if ($recent_news): ?>
            <?php foreach ($recent_news as $news): ?>
              <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition-shadow">
                <a href="news_blog/news.php?slug=<?= urlencode($news['slug']) ?>" class="block font-semibold text-lg hover:underline">
                  <?= htmlspecialchars($news['title']) ?>
                </a>
                <time datetime="<?= htmlspecialchars($news['created_at']) ?>" class="text-sm text-gray-500 mt-2 block">
                  <?= date('M j, Y', strtotime($news['created_at'])) ?>
                </time>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col-span-3 text-center text-gray-500 py-8">No news yet.</div>
          <?php endif; ?>
        </div>
      </div>
    </section>



  </main>

<footer class="text-center text-gray-500 text-sm py-10">
    © 2025 TachoDocs. All rights reserved.
  </footer>
</body>
</html>
