<?php
    /**
     * Parameter List:
     * object: eg: $company, $material, $function
     * label: most left label of this whole control
     * name: input name of controls, eg: my_input_name => my_input_name[]
     * required: show required mark or not
     * readonly: this control can't be edited in Edit Mode
     * limit: number of selectable check box
     * pluck: others table column
     */
    $limit_selected = (isset($limit) && ($limit > 0)) ? 'limit-selected' : '';
    $limit_number = (isset($limit) && ($limit > 0)) ? $limit : 0;
?>
<div class="form-group row">
    <label class="col-sm-2 col-form-label {{ (isset($required) && $required) ? 'required' : '' }}">{!! $label !!}</label>
    @if($limit_number > 0)
        <label class="d-none limit_number">{{ $limit_number }}</label>
    @endif
    <div class="col-sm-10 {{ $limit_selected }}">
        @foreach ($master_obj_list as $master_obj)
            <div class="form-check form-check-inline col-form-label col-sm-3">
                <input 
                    class="form-check-input {{ ($errors->has($name)) ? 'is-invalid' : '' }}" 
                    type="checkbox" 
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