<?php

namespace App\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator extends DefaultPathGenerator implements PathGenerator
{
    protected function getBasePath(Media $media): string
    {
        $prefix = config('media-library.prefix', '');

        if ($prefix !== '') {
            return $prefix.'/'.$media->getAttribute('uuid');
        }

        return $media->getAttribute('uuid');
    }
}
