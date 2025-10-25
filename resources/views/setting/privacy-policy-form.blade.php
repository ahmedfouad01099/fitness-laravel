@push('scripts')
    <script>
        (function($) {
            $(document).ready(function(){
                tinymceEditor('.tinymce-privacy_policy',' ',function (ed) {

                }, 450)
            
            });

        })(jQuery);
    </script>
@endpush
<x-app-layout :assets="$assets ?? []">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-block card-stretch">
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h5 class="font-weight-bold">{{ $pageTitle ?? __('message.list') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pages.privacy_policy_save') }}" method="POST" data-toggle="validator">
                        @csrf
                        <input type="hidden" name="id" value="{{ $setting_data->id ?? '' }}">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-control-label">{{ __('message.privacy_policy') }}</label>
                                <textarea name="value" class="form-control tinymce-privacy_policy" placeholder="{{ __('message.privacy_policy') }}">{{ old('value', $setting_data->value ?? '') }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary float-end">{{ __('message.save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>