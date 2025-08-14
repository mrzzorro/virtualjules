<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class VideoHelper
{
    public static function getYouTubeThumbnail($url)
    {
        $videoId = self::getYouTubeVideoId($url);
        if ($videoId) {
            return "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
        }
        return null;
    }

    public static function getYouTubeVideoId($url)
    {
        $videoId = null;
        $patterns = [
            '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/i',
            '/youtu\.be\/([a-zA-Z0-9_-]+)/i',
            '/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/i',
            '/youtube\.com\/v\/([a-zA-Z0-9_-]+)/i',
            '/youtube\.com\/attribution_link\?a=\S*&u=\/watch\%3Fv\%3D([a-zA-Z0-9_-]+)(?:\S*)/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                $videoId = $matches[1];
                break;
            }
        }
        return $videoId;
    }

    public static function getVimeoThumbnail($url)
    {
        $videoId = self::getVimeoVideoId($url);
        if ($videoId) {
            $client = new Client();
            try {
                $response = $client->get("http://vimeo.com/api/v2/video/{$videoId}.json");
                $data = json_decode($response->getBody()->getContents(), true);
                if (isset($data[0]['thumbnail_large'])) {
                    return $data[0]['thumbnail_large'];
                }
            } catch (\Exception $e) {
                // Log the error or handle it as needed
                return null;
            }
        }
        return null;
    }

    public static function getVimeoVideoId($url)
    {
        $videoId = null;
        $patterns = [
            '/vimeo\.com\/([0-9]+)/i',
            '/player\.vimeo\.com\/video\/([0-9]+)/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                $videoId = $matches[1];
                break;
            }
        }
        return $videoId;
    }

    public static function getEmbedCode($url)
    {
        $youtubeId = self::getYouTubeVideoId($url);
        if ($youtubeId) {
            return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $youtubeId . '" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>';
        }

        $vimeoId = self::getVimeoVideoId($url);
        if ($vimeoId) {
            return '<iframe src="https://player.vimeo.com/video/' . $vimeoId . '" width="640" height="360" frameborder="0" allow="fullscreen; picture-in-picture" allowfullscreen loading="lazy"></iframe>';
        }

        return null;
    }
}
