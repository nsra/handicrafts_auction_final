@extends('layouts.main_layout')
@section('style')
    <style>
        input[type="file"] {
            display: block;
        }

        .imageThumb {
            height: 300px;
            width: 200px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Create Product') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('craftsman.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="image">Product mage</label>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mt-1 text-center">
                                    <input type="file" id="images" name="images[]" placeholder="Choose images" multiple>
                                </div>
                                @error('images')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>



                        </div>
                        @error('images')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="title">{{ __('title') }} </label>
                            <input required type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="orderNowPrice">{{ __('orderNowPrice') }}</label>
                            <input required type="number" class="form-control @error('orderNowPrice') is-invalid @enderror"
                                name="orderNowPrice" value="{{ old('orderNowPrice') }}">
                            @error('orderNowPrice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('description') }} </label>
                            <textarea required type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description">
                                                {{ old('description') }}
                                            </textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id">{{ __('Choose_Category') }} </label>
                            <select name="category_id" id="category_id" @error('category_id') is-invalid @enderror>
                                <option value=""> {{ __('Options') }} </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-action text-center">
                            <button type="submit" class="btn btn-warning">{{ __('Create') }}</button>

                            <a href="{{ route('craftsman.products', $craftsman->id) }}" name="cancel"
                                class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>

            </div>
            <br>
            <br>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#images").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\" />" +
                                "<br /><button class=\"remove\">Remove image</span>" +
                                "</span>").insertAfter("#images");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });
                        });
                        fileReader.readAsDataURL(f);
                    }
                    console.log(files);
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
    </script>

@endsection
