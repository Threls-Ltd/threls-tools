<?php

namespace App\Http\Livewire;

use App\Models\ResponsiveImage;
use Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;
use ZipArchive;

class ResponsiveImagesTool extends Component
{
    use WithFileUploads;

    public $image;

    public function updatedImage()
    {
        $this->validate([
                            'image' => 'image',
                        ]);
    }

    public function generateResponsiveImages()
    {

        $responsive = new ResponsiveImage();
        $responsive->save();

        $media = $responsive->addMedia($this->image)->withResponsiveImages()->toMediaCollection();

        $publicPath = storage_path("app/public/$media->uuid");
        File::put(
            "{$publicPath}/img.html",
            view('components.responsive-image', ['media' => $responsive->getFirstMedia()])->render()
        );

        $zip = new ZipArchive;

        $uuid = Str::uuid();
        $fileName = "app/public/responsive-images/{$uuid}.zip";
        if (! File::exists(storage_path('app/public/responsive-images'))) {
            File::makeDirectory(storage_path('app/public/responsive-images'));
        }
        if ($zip->open(storage_path($fileName), ZipArchive::CREATE) === true) {

            $files = File::allFiles($publicPath);

            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }

            $zip->close();
        }

        return response()->download(storage_path($fileName));
    }

    public function render()
    {
        return view('livewire.responsive-images-tool');
    }
}
