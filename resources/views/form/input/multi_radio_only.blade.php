<div class="form-group row">
    <label class="col-sm-2 col-form-label {{ (isset($required) && $required) ? 'required' : '' }}">{!! $label !!}</label>
    <div class="col-sm-10">
        @foreach ($master_obj_list as $master_obj)
            <div class="form-check form-check-inline col-form-label col-sm-3">
                <input 
                    class="form-check-input {{ ($errors->has($name)) ? 'is-invalid' : '' }}" 
                    type="radio" 
                    value="{{ $master_obj->{$master_key} }}" 
                    id="{{ $name }}_{{ $master_obj->{$master_key} }}" 
                    name="{{ $name }}[]" 
                    @if (isset($pluck))
                        {{ $mode=='edit' && !\Session::has('keep_input') ? (@in_array($master_obj->{$master_key}, $object->{$name}->pluck($pluck)->toArray()) ? 'checked' : '') : (@in_array($master_obj->{$master_key}, old($name)) ? 'checked' : '') }}
                    @else
                        {{ $mode=='edit' && !\Session::has('keep_input') ? (@in_array($master_obj->{$master_key}, $object->{$name}) ? 'checked' : '') : (@in_array($master_obj->{$master_key}, old($name)) ? 'checked' : '') }}
                    @endif
                >
                <label class="form-check-label" for="{{ $name }}_{{ $master_obj->{$master_key} }}">{{ $master_obj->{$master_value} }}</label>
            </div>
        @endforeach
        <div class="invalid-feedback">{!! implode('<br>', $errors->get($name)) !!}</div>
    </div>
</div>