<?php
$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/ericshop/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/ericshop/public/storage';
symlink($targetFolder,$linkFolder);
echo 'Success';
?>