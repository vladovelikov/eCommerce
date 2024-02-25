<?php

namespace App\Services;

use App\Models\Slider;
use App\Traits\ImageUploadTrait;

class SliderService
{

    use ImageUploadTrait;

    public function saveSlider(array $sliderData)
    {
        /* Handle image upload */
        $sliderData['image'] = $this->uploadImage($sliderData['image'], 'uploads');

        Slider::create($sliderData);
    }

    public function updateSlider(array $sliderData, string $sliderId)
    {
        $slider = Slider::findOrFail($sliderId);

        if (isset($sliderData['image']) && $sliderData['image']) {
            $sliderData['image'] = $this->uploadImage($sliderData['image'], 'uploads', 'uploads');
        } else {
            unset($sliderData['image']);
        }

        $slider->fill($sliderData);
        $slider->save();
    }

    public function deleteSlider($sliderId)
    {
        $slider = Slider::findOrFail($sliderId);
        $this->deleteImage($slider->image);

        $slider->delete();
    }
}
