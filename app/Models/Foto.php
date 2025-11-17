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

        // Check if the file actually exists before generating URL
        if (!Storage::disk('public')->exists($this->file)) {
            // Return null if file doesn't exist to avoid 403/404 errors
            return null;
        }

        // Get the file path
        $filePath = $this->file;
        
        // Use Laravel's Storage URL generation, which handles encoding
        $baseUrl = Storage::disk('public')->url('');
        
        // Properly encode the file path, especially filenames with spaces
        // Split the path into directory and filename parts
        $pathParts = explode('/', $filePath);
        $filename = end($pathParts);
        $directory = implode('/', array_slice($pathParts, 0, -1));
        
        // URL encode the filename to handle spaces and special characters
        $encodedFilename = rawurlencode($filename);
        
        // Rebuild the path with encoded filename
        if ($directory) {
            $encodedPath = $directory . '/' . $encodedFilename;
        } else {
            $encodedPath = $encodedFilename;
        }
        
        // Combine base URL with encoded path
        // Remove trailing slash from baseUrl if present, then add encoded path
        $baseUrl = rtrim($baseUrl, '/');
        $finalUrl = $baseUrl . '/' . $encodedPath;
        
        return $finalUrl;
    }
}
