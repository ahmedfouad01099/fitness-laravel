<!-- Modal -->
<form action="{{ route('save.assignworkout') }}" method="POST" data-toggle="validator">
    @csrf
    <div class="row">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <div class="form-group col-md-12">
            <label class="form-control-label">{{ __('message.workout') }} <span class="text-danger">*</span></label>
            <select name="workout_id" class="select2js form-group workout" data-placeholder="{{ __('message.select_name',[ 'select' => __('message.workout') ]) }}" data-ajax--url="{{ route('ajax-list', ['type' => 'workout']) }}" required>
                <option value="">{{ __('message.select_name',[ 'select' => __('message.workout') ]) }}</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">{{ __('message.close') }}</button>
        <button type="submit" class="btn btn-md btn-primary" id="btn_submit" data-form="ajax" >{{ __('message.save') }}</button>
    </div>
</form> 
<script>
    $('#workout_id').select2({
        dropdownParent: $('#formModal'),
        width: '100%',
        placeholder: "{{ __('message.select_name',['select' => __('message.parent_permission')]) }}",
    });
</script>

