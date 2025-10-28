<!-- Modal -->
<form action="{{ route('permission.save') }}" method="POST" data-toggle="validator">
    @csrf
    <input type="hidden" name="type" value="{{ $type }}">
    <input type="hidden" name="id" value="-1">

    <div class="row">
        <div class="col-md-12 form-group">
            <label for="name" class="form-control-label">{{ __('message.name') }} <span
                    class="text-danger">*</span></label>
            <input type="text" name="name" id="name" placeholder="{{ __('message.name') }}" class="form-control"
                required>
        </div>
    </div>

    @if($type == 'permission')
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="parent_id" class="form-control-label">{{ __('message.parent_permission') }}</label>
                <select name="parent_id" id="parent_id" class="select2js form-control"
                    data-ajax--url="{{ route('ajax-list', ['type' => 'permission']) }}" data-ajax--cache="true">
                    <!-- Options will be loaded via AJAX -->
                </select>
            </div>
        </div>
    @endif

    <div class="modal-footer">
        <button type="button" class="btn btn-md btn-secondary"
            data-bs-dismiss="modal">{{ __('message.close') }}</button>
        <button type="submit" class="btn btn-md btn-primary" id="btn_submit"
            data-form="ajax">{{ __('message.save') }}</button>
    </div>
</form>

<script>
    $('#parent_id').select2({
        dropdownParent: $('#formModal'),
        width: '100%',
        placeholder: "{{ __('message.select_name', ['select' => __('message.parent_permission')]) }}",
    });
</script>