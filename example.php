<?php
date_default_timezone_set("Asia/Taipei") ;

require_once __DIR__.'/includes/config.php' ;
require_once __DIR__.'/vendor/autoload.php' ;

use MicrosoftAzure\Storage\Blob\BlobRestProxy ;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException ;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions ;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions ;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType ;

$blobClient = BlobRestProxy::createBlobService($connectionString) ;

//取得上次暫存
$test_log = 'test/data_'.date("Ymd").'.log';
$test_set = 0;

$blob = $blobClient->getBlob($containerName, $test_log);
$stream = $blob->getContentStream();
$test_set = stream_get_contents($stream);

echo $test_set."\n";

$test_set += 1;
$blobClient->createBlockBlob($containerName, $test_log, $test_set);
##

?>