<?php

return [
    'cloud_url' => env('CLOUDINARY_URL'),

    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET', 'ml_default'),

    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),
];
