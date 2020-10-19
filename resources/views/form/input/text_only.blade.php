<?php
    /**
     * Parameter List:
     * object: eg: $company, $material, $function
     * label: most left label of this whole control
     * name: input name of controls, eg: my_input_name => my_input_name[]
     * required: show required mark or not
     * readonly: this control can't be edited in Edit Mode
     * readonly_all: this control can't be edited every time
     * text_count_limit: word count controller will be applied for this control or not?
     * col: col-sm value, default value = 10
     * default_create_mode_text: the default value when this control is in creating screen (initial value)
     */
    $col = (isset($col) && ($col > 0)) ? $col : 10;
?>
<div class="form-group row">
    <label for="{{ $name }}" class="col-sm-2 col-form-label">
        <label class="{{ (isset($required) && $required) ? 'required' : '' }}">{!! $label !!}</label>
        @if (isset($text_count_limit) && $text_count_limit)
            　約<span class="text_count_limit">{{ $text_count_limit }}</span>字　後<span class="text_count_limit_remain">{{ $text_count_limit }}</span>字
        @endif
    </label>
    <div class="col-sm-{{ $col }}">
        <input 
        	type="text" 
        	class="form-control {{ ($errors->has($name)) ? 'is-invalid' : '' }}" 
        	id="{{ $name }}" name="{{ $name }}" 
        	value="{{ $mode=='create' && is_null(old($name)) && isset($default_create_mode_text) && $default_create_mode_text && !\Session::has('keep_input') ? $default_create_mode_text : '' }}{{ $mode=='edit' && !\Session::has('keep_input') ? $object->{$name} : old($name) }}" 
        	{{ ($mode=='edit' && isset($readonly) && $readonly || @$readonly_all) ? 'readonly' : '' }}
        >
        <div class="invalid-feedback">{!! implode('<br>', $errors->get($name)) !!}</div>
    </div>
</div>