@push('scripts')
    <script>
        (function($) {
            $(document).ready(function(){
                tinymceEditor('.tinymce-description',' ',function (ed) {
                }, 450)

            });
        })(jQuery);
    </script>
@endpush

<x-app-layout :assets="$assets ?? []">
    <div>
        <?php $id = $id ?? null;?>
        @if(isset($id))
            <form action="{{ route('package.update', $id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
        @else
            <form action="{{ route('package.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $pageTitle }}</h4>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('package.index') }} " class="btn btn-sm btn-primary" role="button">{{ __('message.back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="name" class="form-control-label">{{ __('message.name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name', isset($data) ? $data->name : '') }}" placeholder="{{ __('message.name') }}" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="duration_unit" class="form-control-label">{{ __('message.duration_unit') }}</label>
                                <select name="duration_unit" id="duration_unit" class="form-control select2js" required>
                                    <option value="monthly" {{ old('duration_unit', isset($data) ? $data->duration_unit : '') == 'monthly' ? 'selected' : '' }}>{{ __('message.monthly') }}</option>
                                    <option value="yearly" {{ old('duration_unit', isset($data) ? $data->duration_unit : '') == 'yearly' ? 'selected' : '' }}>{{ __('message.yearly') }}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="duration" class="form-control-label">{{ __('message.duration') }} <span class="text-danger">*</span></label>
                                <select name="duration" id="duration" class="form-control select2js" required>
                                    <option value="1" {{ old('duration', isset($data) ? $data->duration : '') == '1' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('duration', isset($data) ? $data->duration : '') == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ old('duration', isset($data) ? $data->duration : '') == '3' ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ old('duration', isset($data) ? $data->duration : '') == '4' ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ old('duration', isset($data) ? $data->duration : '') == '5' ? 'selected' : '' }}>5</option>
                                    <option value="6" {{ old('duration', isset($data) ? $data->duration : '') == '6' ? 'selected' : '' }}>6</option>
                                    <option value="7" {{ old('duration', isset($data) ? $data->duration : '') == '7' ? 'selected' : '' }}>7</option>
                                    <option value="8" {{ old('duration', isset($data) ? $data->duration : '') == '8' ? 'selected' : '' }}>8</option>
                                    <option value="9" {{ old('duration', isset($data) ? $data->duration : '') == '9' ? 'selected' : '' }}>9</option>
                                    <option value="10" {{ old('duration', isset($data) ? $data->duration : '') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="11" {{ old('duration', isset($data) ? $data->duration : '') == '11' ? 'selected' : '' }}>11</option>
                                    <option value="12" {{ old('duration', isset($data) ? $data->duration : '') == '12' ? 'selected' : '' }}>12</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="price" class="form-control-label">{{ __('message.price') }} <span class="text-danger">($)*</span></label>
                                <input type="number" name="price" id="price" value="{{ old('price', isset($data) ? $data->price : '') }}" class="form-control" min="0" step="any" required placeholder="{{ __('message.price') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status" class="form-control-label">{{ __('message.status') }} <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control select2js" required>
                                    <option value="active" {{ old('status', isset($data) ? $data->status : '') == 'active' ? 'selected' : '' }}>{{ __('message.active') }}</option>
                                    <option value="inactive" {{ old('status', isset($data) ? $data->status : '') == 'inactive' ? 'selected' : '' }}>{{ __('message.inactive') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description" class="form-control-label">{{ __('message.description') }}</label>
                                <textarea name="description" id="description" class="form-control tinymce-description" placeholder="{{ __('message.description') }}">{{ old('description', isset($data) ? $data->description : '') }}</textarea>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-md btn-primary float-end">{{ __('message.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</x-app-layout>