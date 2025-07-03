<?php
defined('admin') or exit;

$success_msgs = [];
$error_msgs = [];

date_default_timezone_set('Europe/Sofia');
$pdo = pdo_connect_mysql();

// ✅ Blog post insert logic
if (isset($_POST['create_blog'])) {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $media_id = trim($_POST['media_id'] ?? '');
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    $created_at = date('Y-m-d H:i:s', strtotime(str_replace('.', '-', $_POST['created_at'])));

    if ($title && $slug && $content) {
        $stmt = $pdo->prepare("INSERT INTO blog (title, slug, content, image, is_published, created_at) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$title, $slug, $content, $media_id, $is_published, $created_at])) {
            $success_msgs[] = "Blog post created successfully.";
        } else {
            $error_msgs[] = "Database error.";
        }
    } else {
        $error_msgs[] = "Please fill in all required fields.";
    }
}

// ✅ Media upload logic
if (isset($_POST['media_upload']) && !empty($_FILES['upload_media']['name'][0])) {
    $upload_dir = __DIR__ . '/blog_media/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

    foreach ($_FILES['upload_media']['tmp_name'] as $index => $tmp_name) {
        $file_name = basename($_FILES['upload_media']['name'][$index]);
        $target_file = $upload_dir . $file_name;
        $file_type = mime_content_type($tmp_name);

        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file_type, $allowed_types)) {
            $error_msgs[] = "Not an image: " . htmlspecialchars($file_name);
            continue;
        }

        if (file_exists($target_file)) {
            $error_msgs[] = "File exists: " . htmlspecialchars($file_name);
            continue;
        }

        if (move_uploaded_file($tmp_name, $target_file)) {
            $success_msgs[] = htmlspecialchars($file_name) . " uploaded successfully.";
        } else {
            $error_msgs[] = "Error uploading: " . htmlspecialchars($file_name);
        }
    }
}

$success_msg = implode('<br>', $success_msgs);
$error_msg = implode('<br>', $error_msgs);
?>

<?=template_admin_header('Create Blog', 'blog')?>

<div class="content-title">
    <div class="title">
        <h2>Create Blog Post</h2>
        <p>Fill out the form to create a new blog post.</p>
    </div>
</div>

<?php if (!empty($success_msg)): ?>
    <div class="msg success"><?= $success_msg ?></div>
<?php endif; ?>

<?php if (!empty($error_msg)): ?>
    <div class="msg error"><?= $error_msg ?></div>
<?php endif; ?>

<!-- ✅ Blog Post Form -->
<form method="post" class="form">
    <label>Title:</label>
    <input type="text" name="title" required>

    <label>Slug (for the URL):</label>
    <input type="text" name="slug" required>

    <label>Content:</label>
    <textarea name="content" rows="10" required></textarea>

    <div class="pad-3 product-media-tab responsive-width-100">
        <h3 class="title1 mar-bot-5">Image</h3>

        <div id="selected-image" style="margin-bottom: 10px;">
            <p class="no-images-msg">No image selected.</p>
        </div>

        <button type="button" onclick="openMediaModal()" class="btn mar-bot-2 mar-top-2">Choose Media</button>

        <input type="hidden" name="media_id" id="media_id" value="">
    </div>

    <label>
        <input type="checkbox" name="is_published" value="1" checked>
        Published
    </label>

    <label>Created At (dd.mm.yyyy):</label>
    <input type="text" name="created_at" value="<?= date('d.m.Y') ?>" required>

    <input type="submit" name="create_blog" value="Create Post" class="btn">
</form>

<!-- ✅ Media Library Modal -->
<div id="mediaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-5 rounded-md w-[600px] max-h-[80vh] overflow-auto">
        <h3 class="text-lg font-semibold mb-4">Media Library</h3>

        <!-- ✅ Show all images in media folder -->
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

        <!-- ✅ Upload Form -->
        <form method="post" enctype="multipart/form-data" class="flex flex-wrap gap-3">
            <input type="hidden" name="media_upload" value="1">
            <input type="file" name="upload_media[]" multiple required>
            <button type="submit" class="btn" style="background-color: #0e478a; color: white;">Upload</button>
            <button type="button" onclick="closeMediaModal()" class="btn text-gray-700">Close</button>
        </form>
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
