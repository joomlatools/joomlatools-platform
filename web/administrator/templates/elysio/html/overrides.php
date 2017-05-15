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