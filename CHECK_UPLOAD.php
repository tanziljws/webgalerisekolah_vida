<!DOCTYPE html>
<html>
<head>
    <title>Check Upload Configuration</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .check { background: white; padding: 20px; margin: 10px 0; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .ok { color: #28a745; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
        .warning { color: #ffc107; font-weight: bold; }
        h2 { color: #333; border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        pre { background: #f8f9fa; padding: 10px; border-radius: 4px; overflow-x: auto; }
        .fix { background: #fff3cd; padding: 10px; margin-top: 10px; border-left: 4px solid #ffc107; }
    </style>
</head>
<body>
    <h1>🔍 Diagnostic Check - Upload Foto Profil</h1>

    <?php
    // 1. Check PHP Configuration
    echo '<div class="check">';
    echo '<h2>1. PHP Upload Configuration</h2>';
    
    $upload_max = ini_get('upload_max_filesize');
    $post_max = ini_get('post_max_size');
    $file_uploads = ini_get('file_uploads');
    
    echo '<p><strong>file_uploads:</strong> ';
    echo $file_uploads ? '<span class="ok">✓ ON</span>' : '<span class="error">✗ OFF</span>';
    echo '</p>';
    
    echo '<p><strong>upload_max_filesize:</strong> ' . $upload_max;
    if (intval($upload_max) < 2) {
        echo ' <span class="warning">⚠ Terlalu kecil!</span>';
    } else {
        echo ' <span class="ok">✓ OK</span>';
    }
    echo '</p>';
    
    echo '<p><strong>post_max_size:</strong> ' . $post_max;
    if (intval($post_max) < 2) {
        echo ' <span class="warning">⚠ Terlalu kecil!</span>';
    } else {
        echo ' <span class="ok">✓ OK</span>';
    }
    echo '</p>';
    
    if (!$file_uploads || intval($upload_max) < 2 || intval($post_max) < 2) {
        echo '<div class="fix">';
        echo '<strong>🔧 SOLUSI:</strong><br>';
        echo '1. Buka: <code>C:\xampp\php\php.ini</code><br>';
        echo '2. Cari dan ubah:<br>';
        echo '<pre>file_uploads = On
upload_max_filesize = 10M
post_max_size = 10M</pre>';
        echo '3. Restart Apache di XAMPP';
        echo '</div>';
    }
    echo '</div>';

    // 2. Check Storage Directory
    echo '<div class="check">';
    echo '<h2>2. Storage Directory</h2>';
    
    $storage_path = __DIR__ . '/storage/app/public';
    $profiles_path = $storage_path . '/profiles';
    $public_storage = __DIR__ . '/public/storage';
    
    echo '<p><strong>storage/app/public:</strong> ';
    echo is_dir($storage_path) ? '<span class="ok">✓ Exists</span>' : '<span class="error">✗ Not Found</span>';
    echo '</p>';
    
    echo '<p><strong>storage/app/public/profiles:</strong> ';
    echo is_dir($profiles_path) ? '<span class="ok">✓ Exists</span>' : '<span class="error">✗ Not Found</span>';
    echo '</p>';
    
    echo '<p><strong>public/storage (symlink):</strong> ';
    echo is_link($public_storage) || is_dir($public_storage) ? '<span class="ok">✓ Exists</span>' : '<span class="error">✗ Not Found</span>';
    echo '</p>';
    
    if (!is_dir($profiles_path) || (!is_link($public_storage) && !is_dir($public_storage))) {
        echo '<div class="fix">';
        echo '<strong>🔧 SOLUSI:</strong><br>';
        echo '1. Jalankan di Command Prompt:<br>';
        echo '<pre>cd C:\xampp\htdocs\ujikom
php artisan storage:link
mkdir storage\app\public\profiles</pre>';
        echo 'ATAU<br>';
        echo '2. Double-click file: <code>setup_storage.bat</code>';
        echo '</div>';
    }
    echo '</div>';

    // 3. Check Permission
    echo '<div class="check">';
    echo '<h2>3. Folder Permissions</h2>';
    
    echo '<p><strong>storage writable:</strong> ';
    echo is_writable($storage_path) ? '<span class="ok">✓ Yes</span>' : '<span class="error">✗ No</span>';
    echo '</p>';
    
    if (is_dir($profiles_path)) {
        echo '<p><strong>profiles writable:</strong> ';
        echo is_writable($profiles_path) ? '<span class="ok">✓ Yes</span>' : '<span class="error">✗ No</span>';
        echo '</p>';
    }
    
    if (!is_writable($storage_path)) {
        echo '<div class="fix">';
        echo '<strong>🔧 SOLUSI:</strong><br>';
        echo 'Jalankan di Command Prompt (sebagai Administrator):<br>';
        echo '<pre>cd C:\xampp\htdocs\ujikom
icacls storage /grant Everyone:(OI)(CI)F /T</pre>';
        echo '</div>';
    }
    echo '</div>';

    // 4. Check Database
    echo '<div class="check">';
    echo '<h2>4. Database Connection</h2>';
    
    try {
        $envFile = __DIR__ . '/.env';
        if (file_exists($envFile)) {
            $env = parse_ini_file($envFile);
            $host = $env['DB_HOST'] ?? 'localhost';
            $db = $env['DB_DATABASE'] ?? '';
            $user = $env['DB_USERNAME'] ?? 'root';
            $pass = $env['DB_PASSWORD'] ?? '';
            
            if ($db) {
                $conn = @new mysqli($host, $user, $pass, $db);
                if ($conn->connect_error) {
                    echo '<span class="error">✗ Connection Failed: ' . $conn->connect_error . '</span>';
                } else {
                    echo '<span class="ok">✓ Connected to: ' . $db . '</span>';
                    
                    // Check users table
                    $result = $conn->query("SHOW COLUMNS FROM users LIKE 'profile_photo_path'");
                    echo '<p><strong>Column profile_photo_path:</strong> ';
                    echo $result && $result->num_rows > 0 ? '<span class="ok">✓ Exists</span>' : '<span class="error">✗ Not Found</span>';
                    echo '</p>';
                    
                    $conn->close();
                }
            } else {
                echo '<span class="warning">⚠ Database name not found in .env</span>';
            }
        } else {
            echo '<span class="error">✗ .env file not found</span>';
        }
    } catch (Exception $e) {
        echo '<span class="error">✗ Error: ' . $e->getMessage() . '</span>';
    }
    echo '</div>';

    // 5. Test Upload Form
    echo '<div class="check">';
    echo '<h2>5. Test Upload Form</h2>';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['test_upload'])) {
        $file = $_FILES['test_upload'];
        echo '<h3>Upload Test Result:</h3>';
        echo '<pre>';
        echo 'Filename: ' . $file['name'] . "\n";
        echo 'Type: ' . $file['type'] . "\n";
        echo 'Size: ' . number_format($file['size'] / 1024, 2) . ' KB' . "\n";
        echo 'Temp: ' . $file['tmp_name'] . "\n";
        echo 'Error: ' . $file['error'] . "\n";
        
        if ($file['error'] === 0) {
            echo "\n<span class='ok'>✓ File uploaded successfully to temp!</span>\n";
            
            // Try to move file
            if (is_dir($profiles_path)) {
                $target = $profiles_path . '/test_' . time() . '.jpg';
                if (move_uploaded_file($file['tmp_name'], $target)) {
                    echo "<span class='ok'>✓ File moved to: profiles/test_" . time() . ".jpg</span>\n";
                } else {
                    echo "<span class='error'>✗ Failed to move file</span>\n";
                }
            }
        } else {
            echo "\n<span class='error'>✗ Upload Error Code: " . $file['error'] . "</span>\n";
            echo "\nError Meanings:\n";
            echo "1 = File too large (upload_max_filesize)\n";
            echo "2 = File too large (MAX_FILE_SIZE)\n";
            echo "3 = Partial upload\n";
            echo "4 = No file uploaded\n";
            echo "6 = Missing temp folder\n";
            echo "7 = Failed to write to disk\n";
        }
        echo '</pre>';
    } else {
        echo '<form method="POST" enctype="multipart/form-data">';
        echo '<p>Upload test file (gambar apapun):</p>';
        echo '<input type="file" name="test_upload" accept="image/*" required>';
        echo '<button type="submit" style="margin-left:10px; padding:8px 16px; background:#007bff; color:white; border:none; border-radius:4px; cursor:pointer;">Test Upload</button>';
        echo '</form>';
    }
    echo '</div>';

    // Summary
    echo '<div class="check">';
    echo '<h2>📋 Summary</h2>';
    echo '<p>Setelah semua check di atas <strong class="ok">✓ OK</strong>, coba:</p>';
    echo '<ol>';
    echo '<li>Restart Apache di XAMPP</li>';
    echo '<li>Clear browser cache (Ctrl+Shift+Delete)</li>';
    echo '<li>Login sebagai user</li>';
    echo '<li>Edit Profile → Upload Foto</li>';
    echo '</ol>';
    echo '<p><strong>Jika masih error, screenshot halaman ini dan error yang muncul!</strong></p>';
    echo '</div>';
    ?>
</body>
</html>
