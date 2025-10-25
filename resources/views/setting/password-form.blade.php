<form action="{{ route('changePassword') }}" method="POST" data-toggle="validator" id="user-password">
    @csrf
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <input type="hidden" name="id" value="{{ $user_data->id ?? '' }}" placeholder="id" class="form-control">
            <div class="form-group has-feedback">
                <label class="form-control-label col-md-12">{{ __('message.old_password') }} <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="password" name="old" class="form-control" id="old_password" placeholder="{{ __('message.old_password') }}" required>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label class="form-control-label col-md-12">{{ __('message.new_password') }} <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="password" name="password" class="form-control" id="password" placeholder="{{ __('message.new_password') }}" required>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label class="form-control-label col-md-12">{{ __('message.confirm_new_password') }} <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="{{ __('message.confirm_new_password') }}" required>
                </div>
            </div>
            <div class="form-group ">
                <div class="col-md-12">
                    <button type="submit" id="submit" class="btn btn-md btn-primary float-md-end mt-15">{{ __('message.save') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>