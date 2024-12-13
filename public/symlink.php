<?php
$targetFolder = '/home/ppdb.malhikdua.sch.id/public_html/storage/app/public';
$linkFolder = '/home/ppdb.malhikdua.sch.id/public_html/public/storage';
symlink($targetFolder,$linkFolder);
echo 'Symlink completed';