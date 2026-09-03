<?php

return [
    'temporary_file_upload' => [
        'rules' => ['required', 'file', 'max:51200'],
        'preview_mimes' => [
            'png', 'jpg', 'jpeg', 'webp', 'gif',
            'mp4', 'mov', 'webm',
            'pdf',
        ],
        'max_upload_time' => 10,
    ],
];
