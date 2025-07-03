<?php
defined('admin') or exit;

$upload_dir = __DIR__ . '/blog_media/';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['upload_media']['name'][0])) {
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

    foreach ($_FILES['upload_media']['tmp_name'] as $index => $tmp_name) {
        $file_name = basename($_FILES['upload_media']['name'][$index]);
        move_uploaded_file($tmp_name, $upload_dir . $file_name);
    }

    // Redirect to reload the images
    header("Location: media_manager.php");
    exit;
}

$media_dir = __DIR__ . '/blog_media/';
$web_media_dir = 'blog_media/';
$images = is_dir($media_dir) ? array_diff(scandir($media_dir), ['.', '..']) : [];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Media Manager</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .gallery { display: flex; flex-wrap: wrap; gap: 10px; }
        .gallery div { cursor: pointer; border: 2px solid transparent; padding: 5px; }
        .gallery img { max-height: 100px; }
    </style>
    <script>
    function selectImage(imageName) {
        window.opener.document.getElementById('media_id').value = imageName;
        window.opener.document.getElementById('selected-image').innerHTML = '<img src="blog_media/' + imageName + '" alt="Blog Image" style="max-height:80px;">';
        window.close();
    }
    </script>
</head>
<body>
<h2>Media Manager</h2>

<div class="gallery">
<?php foreach ($images as $image): ?>
    <div onclick="selectImage('<?= htmlspecialchars($image) ?>')">
        <img src="<?= $web_media_dir . htmlspecialchars($image) ?>" alt="">
    </div>
<?php endforeach; ?>
</div>

<hr>

<form action="" method="post" enctype="multipart/form-data">
    <label>Add Media:</label>
    <input type="file" name="upload_media[]" multiple required>
    <button type="submit" style="background-color: #0e478a; color: white;">Upload</button>
</form>

</body>
</html>
