<?php

function paragraph($content)
{
    $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
    $content = str_replace("\u{A0}", ' ', $content);
    $content = preg_replace('/<div>\s*(.*?)\s*<\/div>/i', '<p>$1</p>', $content);
    $content = preg_replace('/(<br\s*\/?>\s*)+/', ' ', $content);
    $content = preg_replace('/<p>\s*/', '<p>', $content);
    $content = preg_replace('/\s*<\/p>/', '</p>', $content);

    return trim($content);
}

function generateBase64($path)
{
    $storagePath = storage_path('app/public/' . $path);
    $imageData = base64_encode(file_get_contents($storagePath));
    $result = 'data:image/' . pathinfo($storagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;

    return $result;
}
