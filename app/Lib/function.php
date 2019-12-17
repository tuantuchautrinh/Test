<?php
    function theloaicha($data, $selected, $parent = 0, $str = '') {
        foreach($data as $item) {
            if($item->parent == $parent) {
                if($selected == $item->id) {
                    echo '<option value="' . $item->id . '"selected>' . $str . $item->name . '</option>';
                } else {
                    echo '<option value="' . $item->id . '">' . $str . $item->name . '</option>';
                }

                    theloaicha($data, $selected, $item->id, $str . '---| ');
            }
        }
    }
?>
