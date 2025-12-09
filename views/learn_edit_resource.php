<?php
$pageTitle = 'Edit Learning Resource';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Educator';

// Resource data is passed from controller
$resource = $resource ?? null;
if (!$resource) {
    header('Location: /learn');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> · Enersave</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: #f9fafb;
        }
        .form-container {
            max-width: 800px;
            margin: 48px auto;
            padding: 0 24px;
        }
        .form-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        .form-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 8px 0;
        }
        .form-subtitle {
            font-size: 1rem;
            color: #6b7280;
            margin: 0 0 32px 0;
        }
        .form-group {
            margin-bottom: 24px;
        }
        .form-label {
            display: block;
            font-size: 0.9375rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }
        .form-label .required {
            color: #ef4444;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }
        .form-input:focus {
            border-color: #27ae60;
            box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
        }
        .form-textarea {
            width: 100%;
            min-height: 120px;
            padding: 12px 16px;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.2s;
            resize: vertical;
            box-sizing: border-box;
        }
        .form-textarea:focus {
            border-color: #27ae60;
            box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
        }
        .file-upload-area {
            border: 2px dashed #e5e7eb;
            border-radius: 8px;
            padding: 32px;
            text-align: center;
            background: #f9fafb;
            transition: border-color 0.2s, background 0.2s;
            cursor: pointer;
        }
        .file-upload-area:hover {
            border-color: #27ae60;
            background: #f0fdf4;
        }
        .file-upload-area.dragover {
            border-color: #27ae60;
            background: #f0fdf4;
        }
        .file-upload-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            color: #6b7280;
        }
        .file-upload-text {
            font-size: 0.9375rem;
            color: #6b7280;
            margin-bottom: 8px;
        }
        .file-upload-hint {
            font-size: 0.875rem;
            color: #9ca3af;
        }
        .file-input {
            display: none;
        }
        .file-selected {
            margin-top: 16px;
            padding: 12px 16px;
            background: #f0fdf4;
            border: 1px solid #27ae60;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .file-selected-name {
            font-size: 0.9375rem;
            color: #065f46;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .file-remove {
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        .file-remove:hover {
            background: #fee2e2;
        }
        .current-file {
            margin-top: 12px;
            padding: 12px 16px;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.875rem;
            color: #6b7280;
        }
        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }
        .checkbox-input {
            width: 20px;
            height: 20px;
            margin-top: 2px;
            cursor: pointer;
            accent-color: #27ae60;
        }
        .checkbox-label {
            font-size: 0.9375rem;
            color: #111827;
            cursor: pointer;
            flex: 1;
        }
        .checkbox-hint {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 4px;
        }
        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }
        .btn-submit {
            background: #27ae60;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
            flex: 1;
        }
        .btn-submit:hover {
            background: #229954;
        }
        .btn-cancel {
            background: white;
            color: #111827;
            padding: 12px 24px;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-cancel:hover {
            background: #f9fafb;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/partials/uniform_header.php'; ?>
    <div class="form-container">
        <div class="form-card">
            <h1 class="form-title">Edit Learning Resource</h1>
            <p class="form-subtitle">Update the learning resource information</p>

            <form method="POST" action="/learn/edit-resource" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($resource['id']); ?>">
                
                <!-- Title Field -->
                <div class="form-group">
                    <label class="form-label" for="title">
                        Title <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        class="form-input" 
                        placeholder="Enter resource title"
                        value="<?php echo htmlspecialchars($resource['title'] ?? ''); ?>"
                        required
                    >
                </div>

                <!-- Description Field -->
                <div class="form-group">
                    <label class="form-label" for="description">
                        Description <span class="required">*</span>
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        class="form-textarea" 
                        placeholder="Enter resource description"
                        required
                    ><?php echo htmlspecialchars($resource['description'] ?? ''); ?></textarea>
                </div>

                <!-- Video Upload Field -->
                <div class="form-group">
                    <label class="form-label" for="video">
                        Upload Video (Optional - leave empty to keep current file)
                    </label>
                    <?php if (isset($resource['video_file']) && !empty($resource['video_file'])): ?>
                        <div class="current-file">
                            Current file: <?php echo htmlspecialchars(basename($resource['video_file'])); ?>
                        </div>
                    <?php endif; ?>
                    <div class="file-upload-area" id="uploadArea" onclick="document.getElementById('video').click()">
                        <svg class="file-upload-icon" width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="14" r="2" fill="currentColor"/>
                        </svg>
                        <div class="file-upload-text">Click to upload or drag and drop</div>
                        <div class="file-upload-hint">MP4, MOV, AVI (Max 500MB)</div>
                        <input 
                            type="file" 
                            id="video" 
                            name="file" 
                            class="file-input" 
                            accept="video/*"
                            onchange="handleFileSelect(this)"
                        >
                    </div>
                    <div id="fileSelected" style="display: none;" class="file-selected">
                        <div class="file-selected-name">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4H16V16H4V4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 8L12 12L8 12V8Z" fill="currentColor"/>
                            </svg>
                            <span id="fileName"></span>
                        </div>
                        <button type="button" class="file-remove" onclick="removeFile()">Remove</button>
                    </div>
                </div>

                <!-- Downloadable Checkbox -->
                <div class="form-group">
                    <div class="checkbox-group">
                        <input 
                            type="checkbox" 
                            id="is_downloadable" 
                            name="is_downloadable" 
                            class="checkbox-input"
                            value="1"
                            <?php echo (isset($resource['is_downloadable']) && $resource['is_downloadable']) ? 'checked' : ''; ?>
                        >
                        <label class="checkbox-label" for="is_downloadable">
                            <div>Make downloadable by community users</div>
                            <div class="checkbox-hint">If checked, community users will be able to download this resource</div>
                        </label>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">Update Resource</button>
                    <a href="/learn" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function handleFileSelect(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                document.getElementById('fileName').textContent = file.name;
                document.getElementById('fileSelected').style.display = 'block';
                document.getElementById('uploadArea').style.display = 'none';
            }
        }

        function removeFile() {
            document.getElementById('video').value = '';
            document.getElementById('fileSelected').style.display = 'none';
            document.getElementById('uploadArea').style.display = 'block';
        }

        // Drag and drop functionality
        const uploadArea = document.getElementById('uploadArea');
        
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('video').files = files;
                handleFileSelect(document.getElementById('video'));
            }
        });
    </script>
<?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>

