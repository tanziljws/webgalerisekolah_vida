<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'foto';
    protected $fillable = ['galery_id', 'file'];

    public function galery()
    {
        return $this->belongsTo(Galery::class);
    }

    /**
     * Get the URL for the foto file (with proper URL encoding)
     */
    public function getUrlAttribute()
    {
        if (!$this->file) {
            return null;
        }

        // Use Storage::disk('public')->url() which handles URL generation correctly
        // This will return a URL like: https://domain.com/storage/fotos/filename.jpg
        $url = Storage::disk('public')->url($this->file);
        
        // Parse the URL to properly encode the filename
        $parsedUrl = parse_url($url);
        
        if (!$parsedUrl) {
            // If parsing fails, return the URL as-is
            return $url;
        }
        
        // Extract path components
        $path = $parsedUrl['path'] ?? '';
        
        if (empty($path)) {
            return $url;
        }
        
        // Split path into parts
        $pathParts = explode('/', trim($path, '/'));
        
        if (empty($pathParts)) {
            return $url;
        }
        
        // Get filename (last part) and directory (all other parts)
        $filename = end($pathParts);
        $directoryParts = array_slice($pathParts, 0, -1);
        
        // URL encode only the filename (spaces and special chars need encoding)
        $encodedFilename = rawurlencode($filename);
        
        // Rebuild the URL with encoded filename
        $scheme = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] . '://' : '';
        $host = $parsedUrl['host'] ?? '';
        $port = isset($parsedUrl['port']) ? ':' . $parsedUrl['port'] : '';
        $directory = !empty($directoryParts) ? '/' . implode('/', $directoryParts) : '';
        
        // Build final URL: scheme://host:port/directory/encoded_filename
        $finalUrl = $scheme . $host . $port . $directory . '/' . $encodedFilename;
        
        // Add query string and fragment if they exist
        if (isset($parsedUrl['query'])) {
            $finalUrl .= '?' . $parsedUrl['query'];
        }
        if (isset($parsedUrl['fragment'])) {
            $finalUrl .= '#' . $parsedUrl['fragment'];
        }
        
        return $finalUrl;
    }
}
