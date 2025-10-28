<form action="#" method="POST">
    @csrf
    <div class="form-group">
        <label class="form-label">permission title</label>
        <input type="text" name="title" id="permission-title" class="form-control" placeholder="Permission Title"
            value="{{ old('title') }}" required>
    </div>
    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
</form>