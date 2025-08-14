@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Photo Post') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo_type" class="col-md-4 col-form-label text-md-right">{{ __('Photo Type') }}</label>
                            <div class="col-md-6">
                                <select id="photo_type" class="form-control @error('photo_type') is-invalid @enderror" name="photo_type" required>
                                    <option value="single" {{ old('photo_type') == 'single' ? 'selected' : '' }}>Single Image</option>
                                    <option value="carousel" {{ old('photo_type') == 'carousel' ? 'selected' : '' }}>Carousel</option>
                                </select>
                                @error('photo_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="single_photo_field" style="display: {{ old('photo_type') == 'carousel' ? 'none' : 'flex' }};">
                            <label for="single_photo" class="col-md-4 col-form-label text-md-right">{{ __('Upload Image') }}</label>
                            <div class="col-md-6">
                                <input id="single_photo" type="file" class="form-control-file @error('single_photo') is-invalid @enderror" name="single_photo">
                                @error('single_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="carousel_photos_field" style="display: {{ old('photo_type') == 'carousel' ? 'flex' : 'none' }};">
                            <label for="carousel_photos" class="col-md-4 col-form-label text-md-right">{{ __('Upload Images (for carousel)') }}</label>
                            <div class="col-md-6">
                                <input id="carousel_photos" type="file" class="form-control-file @error('carousel_photos') is-invalid @enderror" name="carousel_photos[]" multiple>
                                @error('carousel_photos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cta_label" class="col-md-4 col-form-label text-md-right">{{ __('CTA Button Label (Optional)') }}</label>
                            <div class="col-md-6">
                                <input id="cta_label" type="text" class="form-control @error('cta_label') is-invalid @enderror" name="cta_label" value="{{ old('cta_label') }}">
                                @error('cta_label')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cta_url" class="col-md-4 col-form-label text-md-right">{{ __('CTA Redirect URL (Optional)') }}</label>
                            <div class="col-md-6">
                                <input id="cta_url" type="url" class="form-control @error('cta_url') is-invalid @enderror" name="cta_url" value="{{ old('cta_url') }}">
                                @error('cta_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit Photo Post') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const photoTypeSelect = document.getElementById('photo_type');
        const singlePhotoField = document.getElementById('single_photo_field');
        const carouselPhotosField = document.getElementById('carousel_photos_field');

        function toggleFields() {
            if (photoTypeSelect.value === 'single') {
                singlePhotoField.style.display = 'flex';
                carouselPhotosField.style.display = 'none';
            } else {
                singlePhotoField.style.display = 'none';
                carouselPhotosField.style.display = 'flex';
            }
        }

        photoTypeSelect.addEventListener('change', toggleFields);
        toggleFields(); // Call on load to set initial state
    });
</script>
@endsection
