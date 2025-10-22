<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Image Backend
    |--------------------------------------------------------------------------
    |
    | This option specifies the default image backend to use for generating
    | QR codes. You may use either "imagick" or "gd" as the backend.
    |
    */
    'imageBackend' => 'gd', // FORCE GD

    /*
    |--------------------------------------------------------------------------
    | Formats
    |--------------------------------------------------------------------------
    |
    | This option specifies the default format to use for generating QR codes.
    | You may use either "svg", "eps", or "png" as the format.
    |
    */
    'format' => 'png',

    /*
    |--------------------------------------------------------------------------
    | Size
    |--------------------------------------------------------------------------
    |
    | This option specifies the default size to use for generating QR codes.
    | The size is specified in pixels.
    |
    */
    'size' => 120,

    /*
    |--------------------------------------------------------------------------
    | Margin
    |--------------------------------------------------------------------------
    |
    | This option specifies the default margin to use for generating QR codes.
    | The margin is specified in pixels.
    |
    */
    'margin' => 1,

    /*
    |--------------------------------------------------------------------------
    | Error Correction
    |--------------------------------------------------------------------------
    |
    | This option specifies the default error correction level to use for
    | generating QR codes. You may use either "L", "M", "Q", or "H".
    |
    */
    'errorCorrection' => 'H',

    /*
    |--------------------------------------------------------------------------
    | Colors
    |--------------------------------------------------------------------------
    |
    | This option specifies the default colors to use for generating QR codes.
    | The foreground color is specified as an array of RGB values.
    |
    */
    'colors' => [
        'foreground' => [0, 0, 0],
        'background' => [255, 255, 255],
    ],

    /*
    |--------------------------------------------------------------------------
    | Style
    |--------------------------------------------------------------------------
    |
    | This option specifies the default style to use for generating QR codes.
    | You may use either "square", "dot", or "round".
    |
    */
    'style' => 'square',

    /*
    |--------------------------------------------------------------------------
    | Eye Style
    |--------------------------------------------------------------------------
    |
    | This option specifies the default eye style to use for generating QR codes.
    | You may use either "square" or "circle".
    |
    */
    'eyeStyle' => 'square',

    /*
    |--------------------------------------------------------------------------
    | Encoding
    |--------------------------------------------------------------------------
    |
    | This option specifies the default encoding to use for generating QR codes.
    | You may use either "ISO-8859-1", "UTF-8", or "Shift_JIS".
    |
    */
    'encoding' => 'UTF-8',
];