<?php

function getSingleMedia($model, $collection = 'image_icon', $skip = true)
{
    if (!Auth::check() && $skip) {
        return asset('images/avatars/01.png');
    }
    if ($model !== null) {
        $media = $model->getFirstMedia($collection);
    }
    $imgurl = isset($media) ? $media->getPath() : '';
    if (file_exists($imgurl)) {
        return $media->getFullUrl();
    } else {
        switch ($collection) {
            case 'image_icon':
                $media = asset('images/avatars/01.png');
                break;
            case 'profile_image':
                $media = asset('images/avatars/01.png');
                break;
            case 'site_favicon':
                $media = asset('images/favicon.ico');
                break;
            case 'site_logo':
                $media = asset('images/logo.png');
                break;
            case 'site_dark_logo':
                $media = asset('images/dark_logo.png');
                break;
            case 'site_mini_logo':
                $media = asset('images/site_mini_logo.png');
                break;
            case 'site_dark_mini_logo':
                $media = asset('images/site_dark_mini_logo.png');
                break;
            default:
                $media = asset('images/default.png');
                break;
        }
        return $media;
    }
}