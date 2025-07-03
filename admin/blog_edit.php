<?php
defined('admin') or exit;

$pdo = pdo_connect_mysql();

date_default_timezone_set('Europe/Sofia');

// Get blog ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch blog post
$stmt = $pdo->prepare('SELECT * FROM blog WHERE id = ?');
$stmt->execute([$id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    exit('Blog post not found.');
}

$error = '';
$success = '';

// Update form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $media_id = trim($_POST['media_id'] ?? '');
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    $created_at = trim($_POST['created_at'] ?? $blog['created_at']);
    $updated_at = date('Y-m-d H:i:s');

    if ($title && $slug && $content) {
        $stmt = $pdo->prepare('UPDATE blog SET title = ?, slug = ?, content = ?, image = ?, is_published = ?, created_at = ?, updated_at = ? WHERE id = ?');
        $stmt->execute([$title, $slug, $content, $media_id, $is_published, $created_at, $updated_at, $id]);

        header('Location: index.php?page=blog');
        exit;
    } else {
        $error = 'Please fill in all required fields.';
    }
}

// Default values
$created_at_value = htmlspecialchars($blog['created_at']);
$image_value = htmlspecialchars($blog['image'] ?? '');
?>

<?=template_admin_header('Edit Blog', 'blog')?>

<div class="content-title">
    <div class="title">
        <h2>Edit Blog Post</h2>
        <p>Modify the blog post details below.</p>
    </div>
</div>

<?php if (!empty($error)): ?>
    <div class="msg error"><?= $error ?></div>
<?php endif; ?>

<!-- ✅ Edit Form -->
<form action="" method="post" class="form">
    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($blog['title']) ?>" required>

    <label>Slug:</label>
    <input type="text" name="slug" value="<?= htmlspecialchars($blog['slug']) ?>" required>

    <label>Content:</label>
    <textarea name="content" rows="10" required><?= htmlspecialchars($blog['content']) ?></textarea>

    <div class="pad-3 product-media-tab responsive-width-100">
        <h3 class="title1 mar-bot-5">Image</h3>

        <div id="selected-image" style="margin-bottom: 10px;">
            <?php if (!empty($image_value)): ?>
                <img src="blog_media/<?= $image_value ?>" alt="Blog Image" style="max-height:80px;">
            <?php else: ?>
                <p class="no-images-msg">No image selected.</p>
            <?php endif; ?>
        </div>

        <button type="button" onclick="openMediaModal()" class="btn mar-bot-2 mar-top-2">Choose Media</button>

        <input type="hidden" name="media_id" id="media_id" value="<?= $image_value ?>">
    </div>

    <label>
        <input type="checkbox" name="is_published" value="1" <?= $blog['is_published'] ? 'checked' : '' ?>>
        Published
    </label>

    <label>Created At:</label>
    <input type="text" name="created_at" value="<?= $created_at_value ?>" placeholder="<?= date('Y-m-d H:i:s') ?>">

    <input type="submit" value="Save Changes" class="btn">
</form>

<!-- ✅ Media Library Modal -->
<div id="mediaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-5 rounded-md w-[600px] max-h-[80vh] overflow-auto">
        <h3 class="text-lg font-semibold mb-4">Media Library</h3>

        <div class="overflow-y-auto max-h-[400px] mb-4 grid grid-cols-4 gap-3">
            <?php
            $media_dir = __DIR__ . '/blog_media/';
            $web_media_dir = 'blog_media/';
            $images = is_dir($media_dir) ? array_diff(scandir($media_dir), ['.', '..']) : [];
            foreach ($images as $image): ?>
                <img src="<?= $web_media_dir . htmlspecialchars($image) ?>"
                     alt=""
                     class="cursor-pointer hover:opacity-80"
                     style="max-height: 80px;"
                     onclick="selectImage('<?= htmlspecialchars($image) ?>')">
            <?php endforeach; ?>
        </div>

        <button type="button" onclick="closeMediaModal()" class="btn text-gray-700">Close</button>
    </div>
</div>

<!-- ✅ Scripts -->
<script>
function openMediaModal() {
    document.getElementById('mediaModal').classList.remove('hidden');
    document.getElementById('mediaModal').classList.add('flex');
}

function closeMediaModal() {
    document.getElementById('mediaModal').classList.add('hidden');
    document.getElementById('mediaModal').classList.remove('flex');
}

function selectImage(imageName) {
    document.getElementById('media_id').value = imageName;
    document.getElementById('selected-image').innerHTML =
        '<img src="blog_media/' + imageName + '" alt="Blog Image" style="max-height:80px;">';
    closeMediaModal();
}
</script>

<?=template_admin_footer()?>
