<?php 

return [
    'configuration' => [
        
        'logging_enabled'   => true,
        'logging_path'      => '../logs/error.log',
        'debug'             => true

    ],
    'app' => [

        'app_name'                  => 'My First Blog',
        'env'                       => 'development',
        'posts_dir'                 => '/../../posts/',
        'post_preview_text_limit'   => 200,
        'debug'                     => true,
        'allowed_post_file_types'   => 
        [
            
            [ 'txt', 'json', 'post' ] 
            
        ]
        
    ]
];