<?php
    /**
     * Parameter List:
     * object: eg: $company, $material, $function
     * label: most left label of this whole control
     * url_label: url name label
     * url: input name of url, eg: my_input_name => my_input_name[]
     * url_name: input name of url info
     * url_data: url data attribute name
     * url_info: url info attribute name
     * max_element: Max number of cloned elements
     */
    $max_element_text = (isset($max_element) && $max_element) ? "max_element={$max_element}" : '';
?>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">{!! $label !!}</label>
    <div class="col-sm-10">
        <div class="form-control">
            <div class="row ml-1 mb-2 p-1 multi_element_base d-none" {{ $max_element_text }}>
                <div class="col-12 row mb-1">
                    <label class="col-sm-2 col-form-label">URL</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="{{ $url }}[]" value="" disabled>
                    </div>    
                </div>
                <div class="col-12 row">
                    <label class="col-sm-2 col-form-label">{!! $url_label !!}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="{{ $url_name }}[]" value="" disabled>
                    </div> 
                    <div class="col-sm-2 text-right"><a href="" class="btn btn-danger multi_element_delete_button">削除</a></div>
                </div>
            </div>
            <?php
                $master_obj_list = $mode=='edit' && !\Session::has('keep_input') ? $object->$url_data : @array_map(function($url, $url_name) use ($url_info){
                        return (object) [
                            'url' => $url,
                            $url_info => $url_name,
                        ];
                }, old($url), old($url_name));
            ?>
            @if (isset($master_obj_list))
                @foreach ($master_obj_list as $master_obj)
                    <div class="row ml-1 mb-2 p-1 multi_element">
                        <div class="col-12 row mb-1">
                            <label class="col-sm-2 col-form-label">URL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="{{ $url }}[]" value="{{ $master_obj->url }}">
                            </div>    
                        </div>
                        <div class="col-12 row">
                            <label class="col-sm-2 col-form-label">{!! $url_label !!}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="{{ $url_name }}[]" value="{{ $master_obj->{$url_info} }}">
                            </div> 
                            <div class="col-sm-2 text-right"><a href="" class="btn btn-danger multi_element_delete_button">削除</a></div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="text-right">
                <a href="" class="btn btn-primary multi_element_add_button">追加</a>
            </div>
        </div>
    </div>
</div>