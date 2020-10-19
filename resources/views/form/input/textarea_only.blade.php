<div class="form-group row">
    <label for="{{ $name }}" class="col-sm-2 col-form-label">
        <label class="{{ (isset($required) && $required) ? 'required' : '' }}">{!! $label !!}</label>
        @if (isset($text_count_limit) && $text_count_limit)
            　約<span class="text_count_limit">{{ $text_count_limit }}</span>字　後<span class="text_count_limit_remain">{{ $text_count_limit }}</span>字
        @endif
    </label>
    <div class="col-sm-10">
        <textarea
        	class="form-control {{ ($errors->has($name)) ? 'is-invalid' : '' }}"
        	id="{{ $name }}"
        	name="{{ $name }}"
        	rows="{{ (isset($rows) && $rows) ? $rows : '6' }}"
        	{{ ($mode=='edit' && isset($readonly) && $readonly) ? 'readonly' : '' }}
            {{ (isset($text_count_limit) && $text_count_limit) ? 'maxlength = '.$text_count_limit : '' }}
        >{{ $mode=='edit' && !\Session::has('keep_input') ? $object->{$name} : old($name)}}</textarea>
        <div class="invalid-feedback">{!! implode('<br>', $errors->get($name)) !!}</div>
    </div>
</div>