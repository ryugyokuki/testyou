<?php
// Azure Blob Storageからの画像表示

// Azure Blob Storageのクライアントライブラリをロードする
require_once "vendor/autoload.php";

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;

// Azure Blob Storageの接続文字列を取得する
$connectionString = getenv('AZURE_STORAGE_CONNECTION_STRING');
$blobClient = BlobRestProxy::createBlobService($connectionString);

// BlobコンテナーとBlob名を指定する
$containerName = "ryutestblob";
$blobName = "testryu.jpg";

// Blobをダウンロードして、HTTPレスポンスのコンテンツとして返す
$blob = $blobClient->getBlob($containerName, $blobName);
$content = stream_get_contents($blob->getContentStream());
header("Content-Type: image/jpeg");
echo $content;

?>
