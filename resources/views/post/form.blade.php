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
            <form action="{{ route('post.update', $id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
        @else
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
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
                            <a href="{{ route('post.index') }} " class="btn btn-sm btn-primary" role="button">{{ __('message.back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="title" class="form-control-label">{{ __('message.title') }} <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" value="{{ old('title', isset($data) ? $data->title : '') }}" placeholder="{{ __('message.title') }}" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tags_id" class="form-control-label">{{ __('message.tags') }} <span class="text-danger">*</span></label>
                                <select name="tags_id[]" id="tags_id" class="select2js form-group tags" multiple="multiple" data-placeholder="{{ __('message.select_name',[ 'select' => __('message.tags') ]) }}" data-ajax--url="{{ route('ajax-list', ['type' => 'tags']) }}" required>
                                    @if(isset($selected_tags) && !empty($selected_tags))
                                        @foreach($selected_tags as $tag_id => $tag_name)
                                            <option value="{{ $tag_id }}" selected>{{ $tag_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="category_ids" class="form-control-label">{{ __('message.category') }} <span class="text-danger">*</span></label>
                                <select name="category_ids[]" id="category_ids" class="select2js form-group category" multiple="multiple" data-placeholder="{{ __('message.select_name',[ 'select' => __('message.category') ]) }}" data-ajax--url="{{ route('ajax-list', ['type' => 'category']) }}" required>
                                    @if(isset($selected_category) && !empty($selected_category))
                                        @foreach($selected_category as $category_id => $category_name)
                                            <option value="{{ $category_id }}" selected>{{ $category_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="datetime" class="form-control-label">{{ __('message.datetime') }} <span class="text-danger">*</span></label>
                                <input type="text" name="datetime" id="datetime" value="{{ old('datetime', isset($data) ? $data->datetime : '') }}" placeholder="{{ __('message.datetime') }}" class="datetimepicker form-control" required>
                            </div>                                                                                                       
                            <div class="form-group col-md-4">
                                <label for="status" class="form-control-label">{{ __('message.status') }} <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control select2js" required>
                                    <option value="publish" {{ old('status', isset($data) ? $data->status : '') == 'publish' ? 'selected' : '' }}>{{ __('message.publish') }}</option>
                                    <option value="draft" {{ old('status', isset($data) ? $data->status : '') == 'draft' ? 'selected' : '' }}>{{ __('message.draft') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label">{{ __('message.featured') }}</label>
                                <div class="form-check">
                                    <div class="custom-control custom-radio d-inline-block col-4">
                                        <label class="form-check-label" for="is_featured-yes"> {{__('message.yes')}} </label>
                                        <input type="radio" name="is_featured" id="is_featured-yes" value="yes" class="form-check-input" {{ old('is_featured', isset($data) ? $data->is_featured : 'yes') == 'yes' ? 'checked' : '' }}>
                                    </div>
                                    <div class="custom-control custom-radio d-inline-block col-4">
                                        <label class="form-check-label" for="is_featured-no"> {{__('message.no')}} </label>
                                        <input type="radio" name="is_featured" id="is_featured-no" value="no" class="form-check-input" {{ old('is_featured', isset($data) ? $data->is_featured : '') == 'no' ? 'checked' : '' }}>
                                    </div>
                                </div>                               
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description" class="form-control-label">{{ __('message.description') }}</label>
                                <textarea name="description" id="description" class="form-control tinymce-description" placeholder="{{ __('message.description') }}">{{ old('description', isset($data) ? $data->description : '') }}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label" for="image">{{ __('message.image') }} </label>
                                <div class="">
                                    <input class="form-control file-input" type="file" name="post_image" accept="image/*">
                                </div>
                            </div> 
                            @if( isset($id) && getMediaFileExit($data, 'post_image'))
                                <div class="col-md-2 mb-2 position-relative">
                                    <img id="post_image_preview" src="{{ getSingleMedia($data,'post_image') }}" alt="post-image" class="avatar-100 mt-1">
                                    <a class="text-danger remove-file" href="{{ route('remove.file', ['id' => $data->id, 'type' => 'post_image']) }}"
                                        data--submit='confirm_form'
                                        data--confirmation='true'
                                        data--ajax='true'
                                        data-toggle='tooltip'
                                        title='{{ __("message.remove_file_title" , ["name" =>  __("message.image") ]) }}'
                                        data-title='{{ __("message.remove_file_title" , ["name" =>  __("message.image") ]) }}'
                                        data-message='{{ __("message.remove_file_msg") }}'
                                    >
                                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4" d="M16.34 1.99976H7.67C4.28 1.99976 2 4.37976 2 7.91976V16.0898C2 19.6198 4.28 21.9998 7.67 21.9998H16.34C19.73 21.9998 22 19.6198 22 16.0898V7.91976C22 4.37976 19.73 1.99976 16.34 1.99976Z" fill="currentColor"></path>
                                            <path d="M15.0158 13.7703L13.2368 11.9923L15.0148 10.2143C15.3568 9.87326 15.3568 9.31826 15.0148 8.97726C14.6728 8.63326 14.1198 8.63426 13.7778 8.97626L11.9988 10.7543L10.2198 8.97426C9.87782 8.63226 9.32382 8.63426 8.98182 8.97426C8.64082 9.31626 8.64082 9.87126 8.98182 10.2123L10.7618 11.9923L8.98582 13.7673C8.64382 14.1093 8.64382 14.6643 8.98582 15.0043C9.15682 15.1763 9.37982 15.2613 9.60382 15.2613C9.82882 15.2613 10.0518 15.1763 10.2228 15.0053L11.9988 13.2293L13.7788 15.0083C13.9498 15.1793 14.1728 15.2643 14.3968 15.2643C14.6208 15.2643 14.8448 15.1783 15.0158 15.0083C15.3578 14.6663 15.3578 14.1123 15.0158 13.7703Z" fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
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