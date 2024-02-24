if (!file_exists(base_path('storage/installed')) && !request()->is('install') && !request()->is('install/*')) {
    header("Location: install");
    exit;
}