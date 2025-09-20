<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class YouTubeService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('YOUTUBE_API_KEY');
    }

    /**
     * Get channel information
     */
    public function getChannelInfo($channelHandle = '@pertajampolapikir')
    {
        $cacheKey = 'youtube_channel_info_' . str_replace('@', '', $channelHandle);
        
        return Cache::remember($cacheKey, 3600, function () use ($channelHandle) {
            try {
                $response = $this->client->get('https://www.googleapis.com/youtube/v3/channels', [
                    'query' => [
                        'part' => 'snippet,statistics,brandingSettings',
                        'forHandle' => $channelHandle,
                        'key' => $this->apiKey
                    ]
                ]);

                $data = json_decode($response->getBody(), true);
                
                if (isset($data['items'][0])) {
                    $channel = $data['items'][0];
                    return [
                        'id' => $channel['id'],
                        'title' => $channel['snippet']['title'],
                        'description' => $channel['snippet']['description'],
                        'thumbnail' => $channel['snippet']['thumbnails']['high']['url'] ?? $channel['snippet']['thumbnails']['default']['url'],
                        'subscriber_count' => $this->formatNumber($channel['statistics']['subscriberCount'] ?? 0),
                        'video_count' => $this->formatNumber($channel['statistics']['videoCount'] ?? 0),
                        'view_count' => $this->formatNumber($channel['statistics']['viewCount'] ?? 0),
                        'custom_url' => $channel['snippet']['customUrl'] ?? '',
                        'banner_url' => $channel['brandingSettings']['image']['bannerExternalUrl'] ?? null
                    ];
                }
            } catch (\Exception $e) {
                Log::error('YouTube API Error: ' . $e->getMessage());
            }

            return null;
        });
    }

    /**
     * Get latest videos from channel
     */
    public function getChannelVideos($channelHandle = '@pertajampolapikir', $maxResults = 6)
    {
        $cacheKey = 'youtube_videos_' . str_replace('@', '', $channelHandle) . '_' . $maxResults;
        
        return Cache::remember($cacheKey, 1800, function () use ($channelHandle, $maxResults) {
            try {
                // Get channel ID from handle
                $channelInfo = $this->getChannelInfo($channelHandle);
                if (!$channelInfo) {
                    return [];
                }

                $channelId = $channelInfo['id'] ?? null;
                if (!$channelId) {
                    return [];
                }

                // Get channel's uploads playlist
                $channelResponse = $this->client->get('https://www.googleapis.com/youtube/v3/channels', [
                    'query' => [
                        'part' => 'contentDetails',
                        'id' => $channelId,
                        'key' => $this->apiKey
                    ]
                ]);

                $channelData = json_decode($channelResponse->getBody(), true);
                $uploadsPlaylistId = $channelData['items'][0]['contentDetails']['relatedPlaylists']['uploads'] ?? null;

                if (!$uploadsPlaylistId) {
                    return [];
                }

                // Get videos from uploads playlist
                $playlistResponse = $this->client->get('https://www.googleapis.com/youtube/v3/playlistItems', [
                    'query' => [
                        'part' => 'snippet',
                        'playlistId' => $uploadsPlaylistId,
                        'maxResults' => $maxResults,
                        'order' => 'date',
                        'key' => $this->apiKey
                    ]
                ]);

                $playlistData = json_decode($playlistResponse->getBody(), true);
                $videoIds = collect($playlistData['items'])->pluck('snippet.resourceId.videoId')->implode(',');

                // Get video details
                $videosResponse = $this->client->get('https://www.googleapis.com/youtube/v3/videos', [
                    'query' => [
                        'part' => 'snippet,contentDetails,statistics',
                        'id' => $videoIds,
                        'key' => $this->apiKey
                    ]
                ]);

                $videosData = json_decode($videosResponse->getBody(), true);
                
                $videos = [];
                foreach ($videosData['items'] as $video) {
                    $videos[] = [
                        'id' => $video['id'],
                        'title' => $video['snippet']['title'],
                        'description' => $video['snippet']['description'],
                        'thumbnail' => $video['snippet']['thumbnails']['high']['url'] ?? $video['snippet']['thumbnails']['medium']['url'],
                        'duration' => $this->formatDuration($video['contentDetails']['duration']),
                        'views' => $this->formatNumber($video['statistics']['viewCount'] ?? 0),
                        'upload_date' => $video['snippet']['publishedAt'],
                        'video_url' => 'https://www.youtube.com/embed/' . $video['id'],
                        'watch_url' => 'https://www.youtube.com/watch?v=' . $video['id']
                    ];
                }

                return $videos;

            } catch (\Exception $e) {
                Log::error('YouTube Videos API Error: ' . $e->getMessage());
                return [];
            }
        });
    }

    /**
     * Search videos by category/playlist
     */
    public function getVideosByCategory($channelHandle, $category = 'uploads', $maxResults = 6)
    {
        // For now, return the same videos for all categories
        // This can be extended to handle different playlists
        return $this->getChannelVideos($channelHandle, $maxResults);
    }

    /**
     * Format large numbers
     */
    private function formatNumber($number)
    {
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'K';
        }
        return $number;
    }

    /**
     * Format ISO 8601 duration to readable format
     */
    private function formatDuration($duration)
    {
        $interval = new \DateInterval($duration);
        
        $hours = $interval->h;
        $minutes = $interval->i;
        $seconds = $interval->s;
        
        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            return sprintf('%d:%02d', $minutes, $seconds);
        }
    }

    /**
     * Clear cache for channel data
     */
    public function clearCache($channelHandle = '@pertajampolapikir')
    {
        $handleKey = str_replace('@', '', $channelHandle);
        Cache::forget('youtube_channel_info_' . $handleKey);
        Cache::forget('youtube_videos_' . $handleKey . '_6');
        Cache::forget('youtube_videos_' . $handleKey . '_12');
    }
}