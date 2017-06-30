<?php
defined('JPATH_BASE') or die;

function classOverride($input) {
    switch (true) {
        case strpos($input, 'new');
            $class = "k-icon-plus";
            break;
        case strpos($input, 'edit');
            $class = "k-icon-pencil";
            break;
        case strpos($input, 'delete');
            $class = "k-icon-trash";
            break;
        case strpos($input, 'trash');
            $class = "k-icon-trash";
            break;
        case strpos($input, 'refresh');
            $class = "k-icon-reload";
            break;
        case strpos($input, 'options');
            $class = "k-icon-cog";
            break;
        case strpos($input, 'default');
            $class = "k-icon-star";
            break;
        case strpos($input, 'copy');
            $class = "k-icon-file";
            break;
        case strpos($input, 'unpublish');
            $class = "k-icon-x";
            break;
        case strpos($input, 'publish');
            $class = "k-icon-check";
            break;
        case strpos($input, 'checkin');
            $class = "k-icon-task";
            break;
        case strpos($input, 'unblock');
            $class = "k-icon-circle-check";
            break;
        case strpos($input, 'apply');
            $class = "k-icon-task";
            break;
        case strpos($input, 'save');
            $class = "k-icon-check";
            break;
        case strpos($input, 'cancel');
            $class = "k-icon-x";
            break;
    }
    return $class;
}

// Add `k-form-control` class to textfields
function addFormControlClass($input) {

    // If the field is an input-append
    if (strpos($input, 'class="input-append') !== false) {
        $input = str_replace('class="input-append', 'class="k-input-group ', $input);
        $input = str_replace('<button', '<div class="k-input-group__button"><button', $input);
        $input = str_replace('class="btn', 'class="k-button k-button--default', $input);
        $input = str_replace('class="input-medium', 'class="k-form-control', $input);
        $input = str_replace('</button>', '</button></div>', $input);
    }

    // If the field is not a text field or textarea; return original
    if (strpos($input, 'type="text') === false && strpos($input, '<textarea') === false) {
        return $input;
    }

    // If the $input is not strictly an input field or textarea but has more markup for example; return original
    elseif (substr($input, 0, strlen('<input')) !== '<input' && substr($input, 0, strlen('<textarea')) !== '<textarea') {
        return $input;
    } else {
        // If there's no class attribute yet
        if (strpos($input, 'class="') === false) {
            if (substr($input, 0, strlen('<input')) === '<input') {
                $field = str_replace('<input ', '<input class="k-form-control" ', $input);
            }
            if (substr($input, 0, strlen('<textarea')) === '<textarea') {
                $field = str_replace('<textarea ', '<textarea class="k-form-control" ', $input);
            }

            // If there's already a class attribute
        } else {
            $field = str_replace('class="', 'class="k-form-control ', $input);
        }
        return $field;
    }
}

// Set input attribute(s)
function setFormInputAttributes($input, $array) {
    $field = $input;
    foreach($array as $key => $item) {
        if (strpos($field, $key.'="') === false) {
            $field = str_replace('<input ', '<input '.$key.'="'.$item.'" ', $field);
        } else {
            $field = str_replace($key.'="', $key.'="'.$item.' ', $field);
        }
    }
    return $field;
}