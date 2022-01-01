<?php

return [
    /**
     * Maximum wait get data in seconds
     */
    'timeout' => env('SOUNDCLOUD_CONNECTION_TIMEOUT', 60),
    
    /**
     * Client ID for reqeust API services SoundCloud
     */
    'client_id' => env('SOUNDCLOUD_CLIENT_ID', null),
];