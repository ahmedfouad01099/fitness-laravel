<x-app-layout :assets="$assets ?? []">
    <div>
        <?php
            $id = $id ?? null;
        ?>
        @if(isset($id))
            <form action="{{ route('users.update', $id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
        @else
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
        @endif
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $pageTitle }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="profile-img-edit position-relative">
                                <img src="{{ $profileImage ?? asset('images/avatars/01.png')}}" alt="User-Profile" class="profile-pic rounded avatar-100">
                                <div class="upload-icone bg-primary">
                                    <svg class="upload-button" width="14" height="14" viewBox="0 0 24 24">
                                        <path fill="#ffffff" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                    </svg>
                                    <input class="file-upload" type="file" accept="image/*" name="profile_image">
                                </div>
                            </div>
                            
                            <div class="img-extension mt-3">
                                <div class="d-inline-block align-items-center">
                                    <span>{{ __('message.only') }}</span>

                                    @if(config('constant.IMAGE_EXTENTIONS'))
                                        @foreach(config('constant.IMAGE_EXTENTIONS') as $extention)
                                            <a href="javascript:void();">.{{  __('message.'.$extention) }}</a>
                                        @endforeach
                                    @endif
                                    <span>{{ __('message.allowed') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('message.status') }}</label>
                            <div class="grid" style="--bs-gap: 1rem">
                                <div class="form-check g-col-6">
                                    <input type="radio" name="status" value="active" class="form-check-input" id="status-active" {{ old('status', isset($data) ? $data->status : 'active') == 'active' ? 'checked' : '' }}>
                                    <label for="status-active" class="form-check-label">{{ __('message.active') }}</label>
                                </div>
                                <div class="form-check g-col-6">
                                    <input type="radio" name="status" value="inactive" class="form-check-input" id="status-inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                    <label for="status-inactive" class="form-check-label">{{ __('message.inactive') }}</label>
                                </div>
                                <div class="form-check g-col-6">
                                    <input type="radio" name="status" value="pending" class="form-check-input" id="status-pending" {{ old('status') == 'pending' ? 'checked' : '' }}>
                                    <label for="status-pending" class="form-check-label">{{ __('message.pending') }}</label>
                                </div>
                                <div class="form-check g-col-6">
                                    <input type="radio" name="status" value="banned" class="form-check-input" id="status-banned" {{ old('status') == 'banned' ? 'checked' : '' }}>
                                    <label for="status-banned" class="form-check-label">{{ __('message.banned') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">{{ __('message.role') }} <span class="text-danger">*</span></label>
                            <select name="user_type" class="select2js form-group role" data-placeholder="{{ __('message.select_name',[ 'select' => __('message.role') ]) }}" required>
                                <option value="">{{ __('message.select_name',[ 'select' => __('message.role') ]) }}</option>
                                @foreach($roles as $key => $value)
                                    <option value="{{ $key }}" {{ old('user_type', isset($data) ? $data->user_type : '') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $pageTitle }} {{ __('message.information') }}</h4>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('users.index') }} " class="btn btn-sm btn-primary" role="button">{{ __('message.back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="new-user-info">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">{{ __('message.first_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" value="{{ old('first_name', isset($data) ? $data->first_name : '') }}" placeholder="{{ __('message.first_name') }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-control-label">{{ __('message.last_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" value="{{ old('last_name', isset($data) ? $data->last_name : '') }}" placeholder="{{ __('message.last_name') }}" class="form-control" required>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">{{ __('message.email') }} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ old('email', isset($data) ? $data->email : '') }}" placeholder="{{ __('message.email') }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-control-label">{{ __('message.username') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="username" value="{{ old('username', isset($data) ? $data->username : '') }}" class="form-control" required placeholder="{{ __('message.username') }}">
                                </div>

                                @if(!isset($id))
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label">{{ __('message.password') }} <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" placeholder="{{ __('message.password') }}">
                                    </div>
                                @endif

                                <div class="form-group col-md-6">
                                    <label class="form-control-label">{{ __('message.phone_number') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="phone_number" value="{{ old('phone_number', isset($data) ? $data->phone_number : '') }}" placeholder="{{ __('message.phone_number') }}" class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-control-label">{{ __('message.gender') }} <span class="text-danger">*</span></label>
                                    <select name="gender" class="form-control select2js" required>
                                        <option value="">{{ __('message.select_name',[ 'select' => __('message.gender') ]) }}</option>
                                        <option value="male" {{ old('gender', isset($data) ? $data->gender : '') == 'male' ? 'selected' : '' }}>{{ __('message.male') }}</option>
                                        <option value="female" {{ old('gender', isset($data) ? $data->gender : '') == 'female' ? 'selected' : '' }}>{{ __('message.female') }}</option>
                                        <option value="other" {{ old('gender', isset($data) ? $data->gender : '') == 'other' ? 'selected' : '' }}>{{ __('message.other') }}</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-md btn-primary float-end">{{ __('message.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</x-app-layout>
