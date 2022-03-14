<?php

namespace App\Models;

class Menu extends BaseModel
{
    protected     $fillable = [
        'parent_id',
        'link',
        'type',
        'photo_path',
        'translates',
    ];
    protected     $appends  = ['photo', 'name'];
    public string $path     = 'menu';

    public function scopeType($q, $type)
    {
        return $q->where('type', $type);
    }

    public function scopeLink($q, $url)
    {
        return $q->where('link', $url);
    }

    public function scopeLinkLike($q, $url)
    {
        return $q->where('link', 'like', '%' . $url . '%');
    }
}
