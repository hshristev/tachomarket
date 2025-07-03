<?php
defined('admin') or exit;

$pdo = pdo_connect_mysql();

date_default_timezone_set('Europe/Sofia'); // Set timezone to Sofia

// Delete blog if requested
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $stmt = $pdo->prepare('DELETE FROM blog WHERE id = ?');
    $stmt->execute([$delete_id]);
    header('Location: index.php?page=blog');
    exit;
}

// Fetch all blogs, newest first
$stmt = $pdo->query("SELECT * FROM blog ORDER BY created_at DESC");
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_admin_header('Blog', 'blog')?>

<!-- Header -->
<div class="content-title">
    <div class="title flex items-center gap-4">
        <div class="icon bg-blue-100 p-2 rounded-full">
            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#08428c">
                <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
            </svg>
        </div>
        <div class="txt">
            <h2 class="text-2xl font-semibold text-gray-800">Blogs</h2>
            <p class="text-gray-500">View, edit, and create blog posts.</p>
        </div>
    </div>
</div>

<!-- Create Blog Button -->
<div class="content-header flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-6">
    <a href="index.php?page=blog_create" class="btn inline-flex items-center gap-2 bg-[#08428c] text-white px-4 py-2 rounded-md hover:bg-[#06306b] transition">
        <svg class="icon-left" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor">
            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
        </svg>
        Create Blog
    </a>
</div>

<!-- Blog List -->
<div class="content-block">
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>Title</td>
                    <td>Slug</td>
                    <td class="responsive-hidden">Published</td>
                    <td class="responsive-hidden">Created</td>
                    <td class="responsive-hidden">Updated</td>
                    <td class="align-center">Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php if (!$blogs): ?>
                <tr>
                    <td colspan="7" class="no-results">There are no blog posts.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($blogs as $blog): ?>
                <tr>
                    <td><?=$blog['id']?></td>
                    <td><?=htmlspecialchars($blog['title'])?></td>
                    <td><?=htmlspecialchars($blog['slug'])?></td>
                    <td class="responsive-hidden"><?=($blog['is_published'] ? 'Yes' : 'No')?></td>
                    <td class="responsive-hidden"><?=date('d.m.Y H:i', strtotime($blog['created_at']))?></td>
                    <td class="responsive-hidden">
                    <?=($blog['updated_at'] === '0000-00-00 00:00:00' || empty($blog['updated_at']))
                    ? 'Not Updated'
                    : date('d.m.Y H:i', strtotime($blog['updated_at']))?>
                    </td>

                    <td class="actions">
                        <div class="table-dropdown">
                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"/></svg>
                            <div class="table-dropdown-items">
                                <a href="index.php?page=blog_edit&id=<?=$blog['id']?>">Edit</a>
                                <a class="red" href="index.php?page=blog&delete=<?=$blog['id']?>" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?=template_admin_footer()?>
