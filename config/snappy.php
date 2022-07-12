<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Snappy PDF / Image Configuration
    |--------------------------------------------------------------------------
    |
    | This option contains settings for PDF generation.
    |
    | Enabled:
    |
    |    Whether to load PDF / Image generation.
    |
    | Binary:
    |
    |    The file path of the wkhtmltopdf / wkhtmltoimage executable.
    |
    | Timout:
    |
    |    The amount of time to wait (in seconds) before PDF / Image generation is stopped.
    |    Setting this to false disables the timeout (unlimited processing time).
    |
    | Options:
    |
    |    The wkhtmltopdf command options. These are passed directly to wkhtmltopdf.
    |    See https://wkhtmltopdf.org/usage/wkhtmltopdf.txt for all options.
    |
    | Env:
    |
    |    The environment variables to set while running the wkhtmltopdf process.
    |
    */

    // FOR LINUX

    'pdf' => array(
        'enabled' => true,
        'binary' => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf"',
        'timeout' => false,
        'options' => array(
            // 'enable-local-file-access' => true,
            'enable-javascript' => true,
            'disable-javascript' => false,
            'page-size' => 'LEGAL',
            'margin-top' => 20,
            'margin-bottom' => 20,
            'margin-left' => 20,
            'margin-right' => 5,
            'footer-right' => 'Page [page] of [toPage]',
            'footer-font-size' => 12,
        ),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage"',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    // 'pdf' => [
    //     'enabled' => true,
    //     'binary'  => 'C:\xampp\htdocs\Hazwaste\vendor\bin\wkhtmltopdf-amd64',
    //     'timeout' => false,
    //     'options' => [
    //         'page-size' => 'LEGAL',
    //         'margin-top' => 15,
    //         'margin-bottom' => 20,
    //         'margin-left' => 5,
    //         'margin-right' => 5,
    //         'footer-right' => 'Page [page] of [toPage]',
    //         'footer-font-size' => 8,
    //     ],
    //     'env'     => [],
    // ],

    // 'image' => [
    //     'enabled' => true,
    //     'binary'  => 'C:\xampp\htdocs\Hazwaste\vendor\bin\wkhtmltoimage-amd64',
    //     'timeout' => false,
    //     'options' => [],
    //     'env'     => [],
    // ],
];
