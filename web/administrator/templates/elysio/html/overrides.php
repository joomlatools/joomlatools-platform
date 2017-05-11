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
            $class = "k-icon-x";
            break;
        case strpos($input, 'refresh');
            $class = "k-icon-reload";
            break;
        case strpos($input, 'options');
            $class = "k-icon-cog";
            break;
    }
    return $class;
}