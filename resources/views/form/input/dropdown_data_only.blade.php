<?php
    /**
     * Parameter List:
     * object: eg: $company, $material, $function
     * label: most left label of this whole control
     * name: input name of controls, eg: my_input_name => my_input_name[]
     * master_obj_list
     * master_key
     * master_value
     * searchable
     * col: number of column in col-sm-
     */
    $required_text = (isset($required) && $required) ? 'required' : '';
    $searchable_text = (isset($searchable) && $searchable) ? 'searchable_select' : '' ;
?>
<div class="form-group row">
    <label for="{{ $name }}" class="col-sm-2 col-form-label {{ $required_text }}">{!! $label !!}</label>
    <div class="col-sm-{{ $col }}">   
        <select class="form-control {{ $searchable_text }} {{ ($errors->has($name)) ? 'is-invalid' : '' }}" id="{{ $name }}" name="{{ $name }}">
            <option value="">&nbsp;</option>
            @foreach($master_obj_list as $master_obj)
                <option value="{{ $master_obj->{$master_key} }}"  {{ $mode=='edit' && !\Session::has('keep_input') ? (($object->{$name} && $object->{$name} == $master_obj->{$master_key}) ? 'selected' : '') : ((old($name) && old($name)==$master_obj->{$master_key}) ? 'selected' : '') }}>{{ $master_obj->{$master_value} }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">{!! implode('<br>', $errors->get($name)) !!}</div>
    </div>
</div>