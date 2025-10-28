<form action="#" method="POST">
    @csrf
    <div class="form-group">
        <label class="form-label">role title</label>
        <input type="text" name="title" id="role-title" class="form-control" placeholder="Role Title"
            value="{{ old('title') }}" required>
    </div>
    <label class="form-label">Status</label>
    <div class="form-check">
        <input type="radio" name="status" value="1" class="form-check-input" id="roleassigned" {{ old('status') == '1' ? 'checked' : '' }}>
        <label class="form-check-label" for="roleassigned">yes</label>
    </div>
    <div class="mb-3 form-check">
        <input type="radio" name="status" value="0" class="form-check-input" id="rolenotassigned" {{ old('status') == '0' ? 'checked' : '' }}>
        <label class="form-check-label" for="rolenotassigned">no</label>
    </div>
    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
</form>