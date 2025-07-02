<?php
// tachodocs.php

// 1) DEV: turn on all errors (remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2) Minimal header & footer functions
if (! function_exists('template_header')) {
    function template_header(string $title, string $inlineCss = ''): void {
        echo <<<HTML
<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="utf-8">
  <title>{$title}</title>
  <style>
{$inlineCss}
  </style>
</head>
<body>
HTML;
    }
}

if (! function_exists('template_footer')) {
    function template_footer(): void {
        echo "\n</body>\n</html>";
    }
}

// 3) Document‐scanning helper
if (! function_exists('getDocuments')) {
    function getDocuments(string $dir): array {
        $out = [];
        if (! is_dir($dir)) {
            return $out;
        }
        foreach (scandir($dir) as $f) {
            if ($f === '.' || $f === '..') continue;
            $path = "{$dir}/{$f}";
            if (is_file($path)) {
                $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                if (in_array($ext, ['pdf','doc','docx','xls','xlsx','txt'], true)) {
                    $name  = pathinfo($f, PATHINFO_FILENAME);
                    $title = ucwords(str_replace(['_','-'], ' ', $name));
                    $out[] = ['file' => $f, 'title' => $title];
                }
            }
        }
        usort($out, fn($a, $b) => strcmp($a['title'], $b['title']));
        return $out;
    }
}

// 4) Fetch docs
$techDocs   = getDocuments(__DIR__ . '/docs/technicians');
$driverDocs = getDocuments(__DIR__ . '/docs/drivers');

// 5) Page CSS with left navbar and extra paragraphs
$inlineCss = <<<CSS
* { margin: 0; padding: 0; box-sizing: border-box; }
body { background-color: #f9fafb; color: #333; font-family: 'Ubuntu', sans-serif; }
.layout { display: flex; }
.sidebar { width: 200px; background-color: #0086b1; color: #fff; min-height: 100vh; padding: 2rem 1rem; position: fixed; }
.sidebar ul { list-style: none; }
.sidebar li { margin: 1rem 0; }
.sidebar a { color: #fff; text-decoration: none; font-weight: 500; }
.sidebar a:hover { text-decoration: underline; }
.main { margin-left: 200px; flex: 1; padding: 2rem; }
.container { max-width: 1100px; margin: 0 auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 30px; }
.heading { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.heading h1 { font-size: 2.4rem; color: #0086b1; }
.heading p { font-size: 1.1rem; color: #555; }
.btn-back { background-color: #0086b1; color: #fff; text-decoration: none; font-weight: 500; padding: 0.5rem 1rem; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: background-color 0.3s, transform 0.1s; }
.btn-back:hover { background-color: #006a8a; transform: translateY(-2px); }
.btn-back:active { transform: translateY(0); }
.text-row { display: flex; gap: 2rem; margin: 2rem 0; }
.text-col { flex: 1; }
.text-col p { margin-bottom: 1rem; }
.docs-container { display: flex; flex-wrap: wrap; gap: 2rem; }
.doc-section { flex: 1 1 300px; background: #f9f9f9; border-radius: 8px; padding: 20px; box-shadow: 0 1px 5px rgba(0,0,0,0.05); }
.doc-section h2 { font-size: 1.8rem; color: #f5874f; margin-bottom: 15px; border-bottom: 2px solid #f5874f; display: inline-block; padding-bottom: 5px; }
.doc-section ul { list-style: disc inside; margin-top: 10px; }
.doc-section li { margin: 0.5rem 0; }
.doc-section a { color: #0086b1; text-decoration: none; font-weight: 500; }
.doc-section a:hover { text-decoration: underline; }
@media (max-width: 600px) {
  .heading { flex-direction: column; align-items: flex-start; }
  .heading h1 { font-size: 1.8rem; }
  .heading p { margin-top: 0.5rem; }
  .doc-section h2 { font-size: 1.4rem; }
  .text-row { flex-direction: column; }
}
CSS;

// 6) Render
template_header('TachoDocs', $inlineCss);
?>
<div class="layout">
  <nav class="sidebar">
    <ul>
      <li><a href="#">Начало</a></li>
      <li><a href="#tech">Техници</a></li>
      <li><a href="#drivers">Шофьори</a></li>
      <li><a href="#contact">Контакти</a></li>
    </ul>
  </nav>
  <div class="main">
    <div class="container">
      <div class="heading">
        <a href="javascript:history.back()" class="btn-back">← Предишна</a>
        <div class="title">
          <h1>TachoDocs</h1>
          <p>Технически документи за техници, шофьори и транспортни мениджъри</p>
        </div>
      </div>

      <div class="text-row">
        <div class="text-col">
          <p>Примерен текст на абзац 1.</p>
          <p>Примерен текст на абзац 2.</p>
        </div>
        <div class="text-col">
          <p>Примерен текст на абзац 3.</p>
          <p>Примерен текст на абзац 4.</p>
        </div>
      </div>

      <div class="docs-container">
        <div class="doc-section" id="tech">
          <h2>Документи за Техници</h2>
          <?php if ($techDocs): ?>
            <ul>
              <?php foreach ($techDocs as $d): ?>
                <li><a href="docs/technicians/<?= rawurlencode($d['file']) ?>" target="_blank"><?= htmlspecialchars($d['title'], ENT_QUOTES|ENT_HTML5) ?></a></li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <p>Все още няма добавени документи за техници.</p>
          <?php endif; ?>
        </div>
        <div class="doc-section" id="drivers">
          <h2>Документи за Шофьори и Мениджъри</h2>
          <?php if ($driverDocs): ?>
            <ul>
              <?php foreach ($driverDocs as $d): ?>
                <li><a href="docs/drivers/<?= rawurlencode($d['file']) ?>" target="_blank"><?= htmlspecialchars($d['title'], ENT_QUOTES|ENT_HTML5) ?></a></li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <p>Все още няма добавени документи за шофьори и мениджъри.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
template_footer();
?>
