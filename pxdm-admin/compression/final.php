<?php
    // Require the autoload.
    require_once 'vendor/autoload.php';

    /**
     * Optimizes PNG file with pngquant 1.8 or later (reduces file size of 24-bit/32-bit PNG images).
     *
     * You need to install pngquant 1.8 on the server (ancient version 1.0 won't work).
     * There's package for Debian/Ubuntu and RPM for other distributions on http://pngquant.org
     *
     * @param $path_to_png_file string - path to any PNG file, e.g. $_FILE['file']['tmp_name']
     * @param $max_quality      int - conversion quality, useful values from 60 to 100 (smaller number = smaller file)
     *
     * @return string - content of PNG file after conversion
     * @throws Exception
     */
    function compress_png( $path_to_png_file, $max_quality = 70 )
    {
        if ( ! file_exists( $path_to_png_file ) ) {
            throw new Exception( "File does not exist: $path_to_png_file" );
        }

        // guarantee that quality won't be worse than that.
        $min_quality = 60;

        // '-' makes it use stdout, required to save to $compressed_png_content variable
        // '<' makes it read from the given file path
        // escapeshellarg() makes this safe to use with any path
        $compressed_png_content = shell_exec( "pngquant --quality=$min_quality-$max_quality - < " . escapeshellarg( $path_to_png_file ) );

        if ( ! $compressed_png_content ) {
            throw new Exception( "Conversion to compressed PNG failed. Is pngquant 1.8+ installed on the server?" );
        }

        return $compressed_png_content;
    }

    // Setup directory structures.
    $doc_root = $_SERVER[ 'DOCUMENT_ROOT' ];
    $thumbs_uploads_dir = $doc_root . '/uploads/thumbs/';
    $small_uploads_dir = $doc_root . '/uploads/small/';
    $medium_uploads_dir = $doc_root . '/uploads/medium/';
    $large_uploads_dir = $doc_root . '/uploads/large/';
    $raw_uploads_dir = $doc_root . '/uploads/raw/';

    // Put the image here for compression & resizing.
    // Only works for png files.
    $path_to_uncompressed_file = 'img/fashion.jpg';

    // Uploads the RAW file.
    $path_to_raw_file = $raw_uploads_dir . 'fashion.png';

    // Uploads the compressed
    $path_to_compressed_file = $large_uploads_dir . 'fashion.png';

    // Set the thumbnail image properties.
    $thumb_height = '100';
    $thumb_width = '100';

    // Set the medium image properties.
    $small_height = '200';
    $small_width = '200';

    // Set the medium image properties.
    $medium_height = '400';
    $medium_width = '400';

    imagepng(imagecreatefromstring(file_get_contents($path_to_uncompressed_file)), $path_to_raw_file);

    if ( file_exists( $path_to_raw_file ) ) {
      $compressed = compress_png($path_to_raw_file);
      file_put_contents($path_to_compressed_file, $compressed);
    }

    // Set the newly compress file to a new variable.
    $image_to_resize = $path_to_compressed_file;

    // Check for the newly created file before resizing.
    if ( file_exists( $path_to_compressed_file ) ) {
        // Create a new phMagick instance.
        $magic = new \phMagick\Core\Runner();

        // Generate the medium size.
        $resize = new \phMagick\Action\Resize\Proportional( $image_to_resize, $medium_uploads_dir . 'medium-fashion.png' );

        // Set the width for resizing the image.
        $resize->setWidth( $medium_width );

        // Run it through the resizing algorithm.
        $magic->run( $resize );

        // Generate the small size.
        $resize = new \phMagick\Action\Resize\Proportional( $image_to_resize, $small_uploads_dir . 'small-fashion.png' );

        // Set the width for resizing the image.
        $resize->setWidth( $small_width );

        // Run it through the resizing algorithm.
        $magic->run( $resize );

        // Generate the thumbnail size.
        $resize = new \phMagick\Action\Resize\Proportional( $image_to_resize, $thumbs_uploads_dir . 'thumb-fashion.png' );

        // Set the width for resizing the image.
        $resize->setWidth( $thumb_width );

        // Run it through the resizing algorithm.
        $magic->run( $resize );
    }

    echo "Thank you for using me :)";
