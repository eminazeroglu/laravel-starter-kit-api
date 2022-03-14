<?php

namespace App\Models;

class SeoMetaTag extends BaseModel
{
    protected $fillable = [
        'url',
        'title',
        'description',
        'keywords',
        'bots',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function scopeUrl($q, $url)
    {
        return $q->where('url', $url);
    }

    public function scopeUrlLike($q, $url)
    {
        return $q->where('url', 'like', '%' . $url . '%');
    }

    public function scopeTitleLike($q, $title)
    {
        return $q->where('title', 'like', '%' . $title . '%');
    }
}
