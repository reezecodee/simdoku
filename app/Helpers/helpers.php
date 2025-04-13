<?php

function paragraph($content)
{
    $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');

    $content = str_replace("\u{A0}", ' ', $content);

    $content = preg_replace('/<div>\s*(.*?)\s*<\/div>/i', '<p>$1</p>', $content);

    $content = preg_replace('/(<br\s*\/?>\s*)+/', ' ', $content);

    $content = preg_replace('/<p>\s*/', '<p>', $content);
    $content = preg_replace('/\s*<\/p>/', '</p>', $content);

    $content = preg_replace('/[~@#$^&*|]/', '', $content);

    $content = preg_replace('/[\x{1F600}-\x{1F64F}]/u', '', $content);
    $content = preg_replace('/[\x{1F300}-\x{1F5FF}]/u', '', $content);
    $content = preg_replace('/[\x{1F680}-\x{1F6FF}]/u', '', $content);
    $content = preg_replace('/[\x{2600}-\x{26FF}]/u', '', $content);

    return trim($content);
}


function generateBase64($path)
{
    $storagePath = storage_path('app/public/' . $path);
    $imageData = base64_encode(file_get_contents($storagePath));
    $result = 'data:image/' . pathinfo($storagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;

    return $result;
}

function idr($number)
{
    return 'Rp ' . number_format($number, 0, ',', '.');
}


