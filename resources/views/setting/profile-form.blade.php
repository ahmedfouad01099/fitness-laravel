<div class="col-md-12">
    <div class="row ">
		<div class="col-md-3">
			<div class="user-sidebar">
				<div class="user-body user-profile text-center">
					<div class="user-img">
						<img class="rounded-circle avatar-100 image-fluid profile_image_preview" src="{{ getSingleMedia($user_data,'profile_image', null) }}" alt="profile-pic">
					</div>
					<div class="sideuser-info">
						<span class="mb-2">{{ $user_data->display_name }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="user-content">
				<form action="{{ route('updateProfile') }}" method="POST" data-toggle="validator" enctype="multipart/form-data" id="user-form">
				@csrf
				    <input type="hidden" name="id" value="{{ $user_data->id ?? '' }}" placeholder="id" class="form-control">
				    <div class="row ">
						<div class="form-group col-md-6">
							<label class="form-control-label">{{ __('message.first_name') }} <span class="text-danger">*</span></label>
							<input type="text" name="first_name" value="{{ old('first_name', $user_data->first_name ?? '') }}" placeholder="{{ __('message.first_name') }}" class="form-control" required>
						</div>
						
						<div class="form-group col-md-6">
							<label class="form-control-label">{{ __('message.last_name') }} <span class="text-danger">*</span></label>
							<input type="text" name="last_name" value="{{ old('last_name', $user_data->last_name ?? '') }}" placeholder="{{ __('message.last_name') }}" class="form-control" required>
						</div>
						
						<div class="form-group col-md-6">
							<label class="form-control-label">{{ __('message.username') }} <span class="text-danger">*</span></label>
							<input type="text" name="username" value="{{ old('username', $user_data->username ?? '') }}" placeholder="{{ __('message.username') }}" class="form-control" required>
						</div>

						<div class="form-group col-md-6">
							<label class="form-control-label">{{ __('message.email') }} <span class="text-danger">*</span></label>
							<input type="email" name="email" value="{{ old('email', $user_data->email ?? '') }}" placeholder="{{ __('message.email') }}" class="form-control" required>
						</div>

				        <div class="form-group col-md-6">
							<label class="form-control-label">{{ __('message.phone_number') }} <span class="text-danger">*</span></label>
							<input type="text" name="phone_number" value="{{ old('phone_number', $user_data->phone_number ?? '') }}" placeholder="{{ __('message.phone_number') }}" class="form-control" required>
						</div>

				        <div class="form-group col-md-6">
							<label class="form-control-label col-md-12">{{ __('message.choose_profile_image') }}</label>
							<div class="">
								<input type="file" name="profile_image" class="form-control" id="profile_image" accept="image/*">
							</div> 
				        </div>

				        <div class="col-md-12">
							<button type="submit" class="btn btn-md btn-primary float-md-end">{{ __('message.update') }}</button>
				        </div>
				    </div>
				</form>
			</div>
		</div>
    </div>
</div>

<script>
	$(document).ready(function (){
				
        $(document).on('change','#profile_image',function(){
			readURL(this);
		})
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				var res=isImage(input.files[0].name);

				if(res==false){
					var msg = "{{ __('message.image_png_jpg') }}";
					Swal.fire({
						icon: 'error',
						title: "{{ __('message.opps') }}",
						text: msg,
						confirmButtonColor: "var(--bs-primary)",
                    	confirmButtonText: "{{ __('message.ok') }}"
					});
					return false;
				}

				reader.onload = function(e) {
				$('.profile_image_preview').attr('src', e.target.result);
					$("#imagelabel").text((input.files[0].name));
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		function getExtension(filename) {
			var parts = filename.split('.');
			return parts[parts.length - 1];
		}

		function isImage(filename) {
			var ext = getExtension(filename);
			switch (ext.toLowerCase()) {
			case 'jpg':
			case 'jpeg':
			case 'png':
			case 'gif':
				return true;
			}
			return false;
		}
	})
</script>