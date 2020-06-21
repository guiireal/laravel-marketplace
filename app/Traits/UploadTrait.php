<?php

namespace App\Traits;

trait UploadTrait
{
    public function uploadPhotos($photos, string $imageColumn = null): array
    {
        $uploadedPhotos = [];
        if (is_array($photos)) {
            foreach ($photos as $photo) {
                $uploadedPhotos[] = [$imageColumn => $photo->store('products', 'public')];
            }
        } else {
            $uploadedPhotos = $photos->store('logo', 'public');
        }
        return $uploadedPhotos;
    }
}
