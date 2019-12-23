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

    function tentheloai($parent) {
        if($parent == 0) {
            echo 'Root';
        } else {
            // first() lấy 1 cái
            return DB::table('category')->where('id', $parent)->first()->name;
        }

    }
?>
