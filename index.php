<?php

include 'vendor/autoload.php';
include 'config.php';

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

$client = new S3Client([
    'credentials' => [
        'key'    => $key,/* set in config.php */
        'secret' => $secret,/* set in config.php */
    ],
    'region' => 'nyc3',
    'version' => 'latest',
    'endpoint' => 'https://nyc3.digitaloceanspaces.com',
]);

$adapter = new AwsS3Adapter($client, $bucket /* set in config.php */);

$filesystem = new Filesystem($adapter);

if($filesystem->has('test.txt') && $filesystem->getVisibility('test.txt') == 'private') {
    $filesystem->setVisibility('test.txt', 'public');
}
