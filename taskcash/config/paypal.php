<?php 
return [ 
    'client_id' => 'AdrM4zlTmm5_E2lh35HYJ5yOgBtq4lHRsjTzX1viGqjU3WIuKoxFA_s1ZgI6C4xah-zDQtlWewm0ipMX',
    'secret' => 'EOq1BR8VjweTEZGaBugqghiJCJcdmgUBRyDBXCzcD4vjXiKMzoVBEOpRY1kL2sIdEhoQPN0gPTD4U8Qw',
    'settings' => array(
        'mode' => env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];