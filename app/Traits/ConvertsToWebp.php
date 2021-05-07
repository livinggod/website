<?php

namespace App\Traits;

use Spatie\Image\Image;

trait ConvertsToWebp
{
    protected function getImageProperty()
    {
        if (!isset($this->imageProperty)) {
            return 'image';
        }

        return $this->imageProperty;
    }

    public function imageExists()
    {
        return $this->{$this->getImageProperty()} !== null;
    }

    public function imageIsWebp()
    {
        return explode('.', $this->{$this->getImageProperty()})[1] === 'webp';
    }

    public function convertImage(): void
    {
        $filePath = explode('.', $this->{$this->getImageProperty()})[0];
        $oldImagePath = storage_path('app/public/' . $this->{$this->getImageProperty()});

        Image::load($oldImagePath)->format('webp')->save(storage_path('app/public/' . $filePath . '.webp'));

        $this->{$this->getImageProperty()} = explode('.', $this->{$this->getImageProperty()})[0] . '.webp';

        $this->save();
    }
}
