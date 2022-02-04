<x-jet-form-section submit="generateResponsiveImages">
    <x-slot name="title">
        {{ __('Responsive Images') }}
    </x-slot>

    <x-slot name="description">
        <p class="mt-4">Since users of your website may be using a variety of devices which differ widely. Websites are
            viewable on
            different screen sizes and resolutions. Usually, what we did was to load the same image on all
            the devices.
        </p>
        <p class="mt-4">A better solution is to serve different images to different visitors. We want to serve a
            high-resolution
            image to the visitors using a 4K 32" monitor but ideally we search a much smaller image to users using a 5"
            mobile device.</p>

        <p class="mt-4">Behind the hood, this tool is using <a
                href="https://spatie.be/docs/laravel-medialibrary/v9/introduction" class="underline" target="_blank">this amazing
                package</a> by Spatie</p>
    </x-slot>

    <x-slot name="form">
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->

            <input type="file" class="hidden"
                   wire:model="image"
                   x-ref="photo"
                   x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            "/>


            <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
            </div>

            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Image') }}
            </x-jet-secondary-button>

            @error('image') <span class="error">{{ $message }}</span> @enderror

            <x-jet-input-error for="image" class="mt-2"/>
        </div>


    </x-slot>
    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="image">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>

</x-jet-form-section>
