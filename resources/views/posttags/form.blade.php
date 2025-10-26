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
            <form action="{{ route('tags.update', $id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
        @else
            <form action="{{ route('tags.store') }}" method="POST" enctype="multipart/form-data">
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
                            <a href="{{ route('tags.index') }} " class="btn btn-sm btn-primary" role="button">{{ __('message.back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title" class="form-control-label">{{ __('message.title') }} <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" value="{{ old('title', isset($data) ? $data->title : '') }}" placeholder="{{ __('message.title') }}" class="form-control" required>
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