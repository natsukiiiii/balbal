<?php
    /**
     * Parameter List:
     * object: eg: $company, $material, $function
     * name: attribute name of object
     * master_obj_list
     * master_key
     * master_value
     * delimiter
     */
?>
{{ implode($delimiter, array_map(function($object_cd) use ($master_obj_list, $master_key, $master_value) {
		foreach ($master_obj_list as $master_obj) {
		 	if ($master_obj->{$master_key} == $object_cd) {
		 		return $master_obj->{$master_value};
		 	}
		}
		return '';
	}, $object->{$name})) }}