<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$blogs = App\Models\Blog::all();
foreach ($blogs as $blog) {
    if (str_starts_with($blog->image_path, '/images/')) {
        $filename = basename($blog->image_path);
        $sourcePath = public_path('images/' . $filename);
        $destPath = storage_path('app/public/blogs/' . $filename);
        
        if (!file_exists(storage_path('app/public/blogs'))) {
            mkdir(storage_path('app/public/blogs'), 0755, true);
        }
        
        if (file_exists($sourcePath)) {
            copy($sourcePath, $destPath);
            $blog->image_path = 'blogs/' . $filename;
            $blog->save();
            echo 'Migrated ' . $filename . PHP_EOL;
        } else {
            echo 'Source not found: ' . $sourcePath . PHP_EOL;
        }
    }
}
echo "Done.";
