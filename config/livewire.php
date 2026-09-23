<?php

return [
    'temporary_file_upload' => [
        'rules' => ['required', 'file', 'max:51200', 'mimes:jpg,jpeg,png,webp,gif,mp4,mov,webm,pdf,doc,docx'],
        'preview_mimes' => [
            'png', 'jpg', 'jpeg', 'webp', 'gif',
            'mp4', 'mov', 'webm',
            'pdf',
        ],
        'max_upload_time' => 10,
    ],
];
