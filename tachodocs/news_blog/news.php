<?php
define('shoppingcart', true);
include '../../config.php';
include '../../functions.php';
$pdo = pdo_connect_mysql();

if (isset($_GET['slug'])) {
    // Show single post
    $stmt = $pdo->prepare("SELECT * FROM blog WHERE slug = ? AND is_published = 1");
    $stmt->execute([$_GET['slug']]);
    $post = $stmt->fetch();
    if (!$post) {
        http_response_code(404);
        $not_found = true;
    }
} else {
    // Show all posts
    $stmt = $pdo->prepare("SELECT id, title, slug, content, image, created_at FROM blog WHERE is_published = 1 ORDER BY created_at DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        <?php if (!empty($post)): ?>
            <?= htmlspecialchars($post['title']) ?> – TachoDocs
        <?php else: ?>
            TachoDocs – Новинарски блог
        <?php endif; ?>
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
      .doc-card {
        transition: box-shadow 0.2s, transform 0.2s;
        box-shadow: 0 2px 8px 0 rgba(0,0,0,0.06);
        border-radius: 1rem;
        background: #fff;
        display: flex;
        flex-direction: column;
        height: 100%;
      }
      .doc-card:hover {
        box-shadow: 0 6px 24px 0 rgba(8,66,140,0.12);
        transform: translateY(-4px) scale(1.02);
      }
      .doc-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
      }
      @media (min-width: 640px) {
        .doc-card img { height: 160px; }
      }
      .doc-card-content {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        padding: 1.25rem 1.25rem 0.75rem 1.25rem;
      }
      .doc-card h2 {
        font-size: 1.15rem;
        font-weight: 600;
        margin: 0 0 0.5rem 0;
        color: #08428c;
      }
      .doc-card p {
        font-size: 0.95rem;
        color: #6B7280;
        margin-bottom: 1.25rem;
      }
      .doc-card a {
        margin-top: auto;
        padding: 0.5rem 1.25rem;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        background-color: #08428c;
        color: #fff;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
        box-shadow: 0 1px 4px 0 rgba(8,66,140,0.08);
      }
      .doc-card a:hover { background-color: #073575; }
      .blog-content img { max-width: 100%; border-radius: 1rem; margin-bottom: 1rem; }
      .blog-content { font-size: 1.1rem; line-height: 1.7; color: #333; }
    </style>
</head>
<body class="bg-gradient-to-br from-sky-50 to-white min-h-screen text-gray-800">
    <header class="bg-white py-4 shadow-md border-b border-gray-200">
      <div class="max-w-5xl mx-auto px-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
          <img src="../images/tachodocs_logo_2025.svg" alt="TachoDocs Logo" class="h-12 w-auto mx-auto sm:mx-0">
          <span class="text-center sm:text-left text-xl sm:text-2xl font-semibold text-sky-900">
            <?php if (!empty($post)): ?>
                <?= htmlspecialchars($post['title']) ?>
            <?php else: ?>
                Новинарски блог
            <?php endif; ?>
          </span>
        </div>
        <button type="button" onclick="window.location='news.php'" class="inline-flex items-center px-4 py-2 bg-[#08428c] text-white text-sm font-medium rounded-lg shadow hover:bg-[#073575] focus:outline-none focus:ring-2 focus:ring-[#08428c]">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          <?php if (!empty($post)): ?>Всички новини<?php else: ?>Назад<?php endif; ?>
        </button>
      </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-10">
      <?php if (!empty($not_found)): ?>
        <div class="bg-red-100 text-red-700 p-6 rounded-xl text-center text-lg">Новината не е намерена.</div>
      <?php elseif (!empty($post)): ?>
        <div class="bg-white rounded-xl shadow p-8 max-w-3xl mx-auto">
          <img src="../../admin/blog_media/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="w-full max-h-96 object-cover rounded-xl mb-6">
          <h1 class="text-3xl font-bold text-sky-900 mb-2"><?= htmlspecialchars($post['title']) ?></h1>
          <div class="text-gray-500 mb-6"><?= date('j F Y', strtotime($post['created_at'])) ?></div>
          <div class="blog-content"><?= nl2br(htmlspecialchars($post['content'])) ?></div>
        </div>
      <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <?php foreach ($posts as $post): ?>
            <div class="doc-card">
              <img src="../../admin/blog_media/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
              <div class="doc-card-content">
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <p><?= date('j F Y', strtotime($post['created_at'])) ?></p>
                <a href="news.php?slug=<?= urlencode($post['slug']) ?>">
                  Прочети още
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </main>
</body>
</html>
