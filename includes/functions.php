<?php

use crud\Crud;

function input( $name ) {

    $input = Crud::cols[$name];
    switch ( $input['type'] ) {
        case 'text':
        case 'email':
        case 'number':
        case 'file':
        case 'date':
            echo "<div class='input-group'><label for='{$name}'>{$input['title']}</label><input type='{$input['type']}' name='{$name}' id='{$name}'/></div>";
            break;
        case 'select':
            $options = '';
            foreach ( $input['options'] as $val => $cap ) {
                $options .= "<option value='{$val}'>{$cap}</option>";
            }
            echo "<div class='input-group'><label for='{$name}'>{$input['title']}</label><select name='{$name}' id='{$name}'>{$options}</select></div>";
            break;
        default:break;
    }
}

function update_input( $name, $val ) {
    $input = Crud::cols[$name];
    switch ( $input['type'] ) {
        case 'text':
        case 'email':
        case 'number':
        case 'file':
        case 'date':
            echo "<div class='input-group'><label for='{$name}'>{$input['title']}</label><input type='{$input['type']}' name='{$name}' id='{$name}' value='{$val}'/></div>";
            break;
        case 'select':
            $options = '';
            foreach ( $input['options'] as $valu => $cap ) {
                $selected = $valu == $val ? 'selected' : '';
                $options .= "<option value='{$valu}' {$selected}>{$cap}</option>";
            }
            echo "<div class='input-group'><label for='{$name}'>{$input['title']}</label><select name='{$name}' id='{$name}'>{$options}</select></div>";
            break;
        default:break;
    }
}
