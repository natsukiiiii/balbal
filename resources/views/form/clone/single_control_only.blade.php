<?php
    /**
     * Parameter List:
     * object: eg: $company, $material, $function
     * label: most left label of this whole control
     * name: input name of controls, eg: my_input_name => my_input_name[]
     * max_element: Max number of cloned elements
     * master_obj_list
     * master_key
     * master_value
     * searchable
     * pluck: others table column
     */
    $max_element_text = (isset($max_element) && $max_element) ? "max_element={$max_element}" : '';
?>
<div class="form-group row">
    <label class="col-sm-2 col-form-label {{ (isset($required) && $required) ? 'required' : '' }}">{!! $label !!}</label>
    <div class="col-sm-10">
        <div class="form-control {{ ($errors->has($name)) ? 'is-invalid' : '' }}">
            <div class="form-check-inline col-sm-5 ml-1 p-2 multi_element_base d-none" {{ $max_element_text }}>
                <select class="form-control col-sm {{ (isset($searchable) && $searchable) ? 'manual_searchable_select' : '' }}" name="{{ $name }}[]" disabled>
                    @foreach($master_obj_list as $master_obj)
                        <option value="{{ $master_obj->{$master_key} }}">{{ $master_obj->{$master_value} }}</option>
                    @endforeach
                </select>
                <div class="col-sm-2 text-right"><a href="" class="btn btn-danger multi_element_delete_button">削除</a></div>
            </div>
            <?php
                $control_data_list = $mode=='edit' && !\Session::has('keep_input') ? (isset($pluck)? $object->{$name}->pluck($pluck) : $object->{$name}) : old($name);
            ?>
            @if (isset($control_data_list))
                @foreach ($control_data_list as $control_data)
                    <div class="form-check-inline col-sm-5 ml-1 p-2 multi_element">
                        <select class="form-control col-sm {{ (isset($searchable) && $searchable) ? 'searchable_select' : '' }}" name="{{ $name }}[]">
                            @foreach($master_obj_list as $master_obj)
                                <option 
                                    value="{{ $master_obj->{$master_key} }}" 
                                    {{ $master_obj->{$master_key} == $control_data ? 'selected' : ''}}
                                >{{ $master_obj->{$master_value} }}</option>
                            @endforeach
                        </select>
                        <div class="col-sm-2 text-right"><a href="" class="btn btn-danger multi_element_delete_button">削除</a></div>
                    </div>
                @endforeach
            @endif
            <div class="text-right">
                <a href="" class="btn btn-primary multi_element_add_button">追加</a>
            </div>
        </div>
        <div class="invalid-feedback">{!! implode('<br>', $errors->get($name)) !!}</div>
    </div>
</div>