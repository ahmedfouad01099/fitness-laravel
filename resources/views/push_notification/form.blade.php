@push('scripts')
    <script>
        $(document).ready(function () {
            $('.selectAll').click(function () {
                var usertype = $(this).attr('data-usertype');

                if ($(this).is(':checked')) {
                    $('#' + usertype + '_list').find('option').prop('selected', true);
                    $('#' + usertype + '_list').trigger('change');
                } else {
                    $('#' + usertype + '_list').find('option').prop('selected', false);
                    $('#' + usertype + '_list').trigger('change');
                }
            });
        }); 
    </script>
@endpush
<x-app-layout :assets="$assets ?? []">
    <div>
        <?php $id = $id ?? null;?>
        @if(isset($id))
            <form action="{{ route('pushnotification.update', $id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
        @else
                <form action="{{ route('pushnotification.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <a href="{{ route('pushnotification.index') }} " class="btn btn-sm btn-primary"
                                        role="button">{{ __('message.back') }}</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="user_list" class="form-control-label">{{ __('message.user') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="user[]" id="user_list" class="select2js form-control"
                                            multiple="multiple" required>
                                            @if(isset($user) && !empty($user))
                                                @foreach($user as $user_id => $user_name)
                                                    <option value="{{ $user_id }}" {{ (old('user') && in_array($user_id, old('user'))) || (isset($data) && in_array($user_id, $data->user ?? [])) ? 'selected' : '' }}>{{ $user_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <div class="custom-control custom-checkbox mt-4 pt-3">
                                            <input type="checkbox" class="custom-control-input selectAll" id="all_user"
                                                data-usertype="user">
                                            <label class="custom-control-label"
                                                for="all_user">{{ __('message.selectall') }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="title" class="form-control-label">{{ __('message.title') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title"
                                            value="{{ old('title', isset($data) ? $data->title : '') }}"
                                            placeholder="{{ __('message.title') }}" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="message" class="form-control-label">{{ __('message.message') }}
                                            <span class="text-danger">*</span></label>
                                        <textarea name="message" id="message" class="form-control textarea" rows="3"
                                            required
                                            placeholder="{{ __('message.message') }}">{{ old('message', isset($data) ? $data->message : '') }}</textarea>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-control-label"
                                            for="notification_image">{{ __('message.image') }}</label>
                                        <div class="">
                                            <input class="form-control file-input" type="file" name="notification_image"
                                                accept="image/*" data--target='notification_image_preview'>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <img id="notification_image_preview"
                                            src="{{ isset($data) && getMediaFileExit($data, 'notification_image') ? getSingleMedia($data, 'notification_image') : asset('images/default.png') }}"
                                            alt="image" class="attachment-image mt-1 notification_image_preview">
                                    </div>
                                </div>
                                <hr>
                                <button type="submit"
                                    class="btn btn-md btn-primary float-end">{{ __('message.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</x-app-layout>