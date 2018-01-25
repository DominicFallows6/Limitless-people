<?php

namespace Powhr\ViewHelpers;

/**
 * Class IconMaps for getting the font-awesome
 * @package Powhr\ViewHelpers
 */
class IconMaps {

    protected $icons = array (
        'docx'=>'fa-file-word-o',
        'doc'=>'fa-file-word-o',
        'zip'=>'fa-file-archive-o',
        'rar'=>'fa-file-archive-o',
        'pdf' => 'fa-file-pdf-o',
        'xls' => 'fa-file-excel-o',
        'xlsx' => 'fa-file-excel-o',
        'ppt' => 'fa-file-powerpoint-o',
        'pptx' => 'fa-file-powerpoint-o',
        'jpg' => 'fa-file-image-o',
        'png' => 'fa-file-image-o',
        'jpeg' => 'fa-file-image-o',
        'gif' => 'fa-file-image-o',
    );

    protected $defaultIcon = 'fa-cloud-download';

    public function getIconReference($extension, $withHTML = true, $size = 'fa') {

        if (isset($this->icons[$extension])) {
            $icon = $this->icons[$extension];
        } else {
            $icon = $this->defaultIcon;
        }

        if ($withHTML) {
            return '<i class="'.$size.' '.$icon.'" aria-hidden="true"></i>';
        } else {
            return $icon;
        }



    }

}

