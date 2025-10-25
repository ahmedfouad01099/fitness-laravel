<form action="{{ route('envSetting') }}" method="POST" data-toggle="validator">
    @csrf
    <div class="col-md-12 mt-20">
        <div class="row">

        <input type="hidden" name="id" value="{{ $setting_value->id ?? '' }}" class="form-control">
        <input type="hidden" name="page" value="{{ $page }}" class="form-control">
        <input type="hidden" name="type" value="mail" class="form-control">
            @foreach(config('constant.MAIL_SETTING') as $key => $value)
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label text-capitalize">{{ strtolower(str_replace('_',' ',$key)) }}</label>
                        @if( !env('APP_DEMO') && auth()->user()->hasRole('admin'))
                            <input type="{{$key=='MAIL_PASSWORD'?'password':'text'}}" value="{{ $value }}" name="ENV[{{$key}}]" class="form-control" placeholder="{{ config('constant.MAIL_PLACEHOLDER.'.$key) }}">
                        @else
                            <input type="{{$key=='MAIL_PASSWORD'?'password':'text'}}" value="" name="ENV[{{$key}}]" class="form-control" placeholder="{{ config('constant.MAIL_PLACEHOLDER.'.$key) }}">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
<hr>
<button type="submit" class="btn btn-md btn-primary float-md-end">{{ __('message.save') }}</button>
</form>