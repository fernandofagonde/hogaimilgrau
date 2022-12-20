<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;

class Html
{


    /**
     * Tag Open
    *
    * @param string $Tag
    * @param string $Class
    * @param string $Id
    * @param string $TagS
    * @param string $Content
    * @param boolean $TagClose
    * @return void
    */

    public static function tag($Tag, $Class = '', $Id = '', $Attr = '', $Content = '', $TagClose = false) {

        return '<'. $Tag .
            (($Id != '') ? ' id="'. $Id .'"' : '') .''.
            (($Class != '') ? ' class="'. $Class .'"' : '') .''.
            (($Attr != '') ? ' '. $Attr : '') .'>' .
            (($Content != '') ? $Content : '') .
            (($TagClose) ? '</'. $Tag .'>' : '');

    }

    /**
     * Tag Simple
    *
    * @param string $Tag
    * @param string $Content
    * @return void
    */

    public static function tagSimple($Tag, $Content) {

        return "<{$Tag}>{$Content}</{$Tag}>";

    }

    /**
     * Tag Close
    *
    * @param string $Tag
    * @return void
    */

    public static function tagClose($Tag) {

        return '</'. $Tag .'>';

    }

    /**
     * Icon Tag
    *
    * @param string $Tag
    * @return void
    */

    public static function icon($Class) {

        return '<i class="'. $Class .'"></i>';

    }

    /**
     * svg
     *
     * @param  mixed $svg
     * @return void
     */
    public static function svg($file = '') {

        $filePath = base_path('assets/images/'. $file);
        $fileError = base_path('assets/image/svg-error.svg');

        if($svg !== '' && file_exists($filePath)) {
            $svgCode = file_get_contents($iconPath);
        }
        else {
            $svgCode = file_get_contents($fileError);
        }

        return $svgCode;

    }

    /**
     * Page Pre Loader
    *
    * @return void
    */

    public static function preLoader() {

        return self::tag('div', 'preloader', '', '', self::svg('svg/loader'), true);

    }

    /**
     * Bootstrap Alert
    *
    * @param string $Type
    * @param string $Message
    * @return void
    */

    public static function alert($Type = 'default', $Message = '') {

        return '<div class="alert alert-'. $Type .'">'. Main::minifyHtml($Message) .'</div>';

    }

    /**
     * Form Label
    *
    * @param string $For
    * @param string $Text
    * @return void
    */

    public static function label($For = '', $Text ='', $Class = 'form-label') {

        return '<label class="'. $Class .'" for="'. $For .'">'. $Text .'</label>';

    }

    /**
     * Form Help Text
    *
    * @param string $Id
    * @param string $Text
    * @return void
    */

    public static function help($Id = '', $Text = '') {

        return '<small id="'. $Id .'_Help" class="form-text text-muted">'. $Text .'</small>';

    }

    /**
     * numberedOptions
     *
     * @param  mixed $Total
     * @param  mixed $Default
     * @param  mixed $Start
     * @return void
     */
    public static function numberedOptions($Total, $Default = 0, $Start = 0) {

        $ITEMS = [];

        for($i=$Start; $i<= $Total; $i++) {

            $ITEMS[] = [
                'label' => $i,
                'value' =>  $i,
                'selected' => (($i == $Default) ? true : false)
            ];

        }


        return $ITEMS;

    }

    /**
     * Verify Required
    *
    * @param string $Class
    * @return void
    */

    private static function required($Class = '') {

        return (in_array('required', explode(' ', $Class)) || in_array('required-dyn', explode(' ', $Class))) ? ' required-form' : '';

    }

    /**
     * navTitle
     *
     * @param  mixed $module
     * @return void
     */
    public static function navTitle() {

        $Routes = explode('/', request()->path());

        switch($Routes[2] ?? '') {

            case 'add':
                $Action = ' / Adicionando';
                break;

            case 'edit':
                $Action = ' / Editando';
                break;

            default:
                $Action = ' / Listando';
                break;

        }

        return $Action;

    }


    /**
     * formOpen
     *
     * @param  mixed $view
     * @param  mixed $function (add/edit)
     * @return void
     */

    public static function formOpen($Route, $Function, $Multipart = false) {

        $Html = '
        <form action="'. $Route .'" method="POST" id="module-form" class="active" data-legend="'. (($Function == 'add') ? '  Adicionar' : '  Editar') .'"'. (($Multipart) ? ' enctype="multipart/form-data"' : '') .'>
            <input type="hidden" name="_return" id="_return" value="no" autocomplete="off">
            <input type="hidden" name="_function" value="'. $Function .'" autocomplete="off">
        ';

        switch ($Function) {
            case 'edit':
                $Html .= '<input type="hidden" name="_method" value="PUT">';
                break;

            case 'delete':
                $Html .= '<input type="hidden" name="_method" value="DELETE">';
                break;
        }

        return Main::minifyHtml($Html);

    }


    /**
     * formClose
     *
     * @return void
     */

    public static function formClose() {
        return '</form>';
    }


    /**
     * Form Fields Generator
     *
     * @param string $Type
     *      text, textarea, select, checkbox, ...
     *      see options below
     *
     * @param array $Attr
     *      [
     *          'label' => option, label text of element
     *          'name' => required
     *          'id' => option, name used if it isn't sended
     *          'class' - additional classes of element,
     *          'min' - set min value to number/range elements or minlenght to other field types
     *          'max' - set max value to number/range elements or maxlenght to other field types
     *          'witdh' - set width of element with style tag
     *          'height' - set height of element with style tag
     *          'help' - add help text after element
     *          'placeholder' - add placeholder text to element (input/textarea)
     *          'others' - another tag's like data tags (data-id, data-href...),
     *          'mask' - type of javascript mask (see in resources/js/includes/_masks.js)
     *          ... see more on formField function below
     *       ]
     * @return void
     */

    public static function formField($Type = '', $Attr = []) {

        /* Default Elements Class */
        $DefaultClass  = 'form-control form-control-lg';

        /* Element Attributes */
        $Class = (isset($Attr['class']) && $Attr['class'] !== '') ? ' '. $Attr['class'] : '';
        $Min = (isset($Attr['min']) && $Attr['min'] > 0) ? ((isset($Attr['type']) && in_array($Attr['type'], [ 'number', 'range' ])) ? ' min="'. $Attr['min'] .'" data-min="'. $Attr['min'] .'" ' : ' minlength="'. $Attr['min'] .'" ') : '';
        $Max = (isset($Attr['max']) && $Attr['max'] > 0) ? ((isset($Attr['type']) && $Attr['type'] == 'number') ? ' max="'. $Attr['max'] .'" data-max="'.$Attr['max'].'" ' : ' maxlength="'. $Attr['max'] .'" ') : '';
        $Width = (isset($Attr['width']) && $Attr['width'] > 0) ? 'width:'.$Attr['width'].'px !important;' : '';
        $Height = (isset($Attr['height']) && $Attr['height'] > 0) ? 'height:'.$Attr['height'].'px !important;' : '';
        $Others = (isset($Attr['others']) && $Attr['others'] != '') ? ' '.$Attr['others'] : '';
        $Placeholder = (isset($Attr['placeholder']) && $Attr['placeholder'] != '') ? ' placeholder="'. $Attr['placeholder'] .'"' : '';

        /* Autocomplete Config */
        $AutoComplete = ' autocomplete="on" ';

        /* Help Text */
        $HelpText = (isset($Attr['help']) && $Attr['help'] !== '') ? self::help($Attr['name'], $Attr['help']) : '';

        /* Required Class */
        $Required = self::required($Class);

        /* Element Label */
        $Label = (isset($Attr['label']) && trim($Attr['label']) != '') ? self::label($Attr['name'], $Attr['label']) : '';

        /* MASK */
        $Mask = (isset($Attr['mask']) && $Attr['mask'] !== '') ? ' data-mask="'. $Attr['mask'] .'" ' : '';
        $DefaultClass .= ($Mask != '') ? ' masked' : '';

        /* Final Attribute Tags */
        $Attributes = $Min . $Max . (($Width !== '' || $Height !== '') ? ' style="'. $Width . $Height .'"' : '') . $Others . $Placeholder . $Mask . $AutoComplete;

        /* Attr Id */
        $Attr['id'] = (isset($Attr['id'])) ? $Attr['id'] : $Attr['name'];

        /* Select */
        if($Type == 'select') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ label, name, items, optionals... ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'items' - required, array element like below
                    [
                        [
                            'label' => 'Category Name',
                            'value' => '829',
                            'selected' => true/false
                        ],
                        ...
                    ]

                'items_tags' - optional, string with additional tags, setted to all options received on items array (data-id="1", ...)

                'append' - optional, receives an html string and code are appended after element

            */

            $ItemsTags = $Attr['items_tags'] ?? '';

            $Append = (isset($Attr['append']) && $Attr['append'] != '') ? $Attr['append'] : '';

            $FormHtml = self::tag('div', 'form-group'. $Required)

                . $Label

                . '<div class="select-wrapper">

                    <select
                        name="'. $Attr['name'] .'"
                        id="'. $Attr['name'] .'"
                        class="form-control '. $Class .'"
                        data-label="'. ($Attr['label'] ?? '') .'"'
                        . $Attributes
                    . '>';

                    if(isset($Attr['items']) && sizeof($Attr['items']) > 0) {

                        for($i=0; $i<sizeof($Attr['items']); $i++) {

                            $ITEM = $Attr['items'][$i];

                            $DATA_TAGS = (isset($ITEM['data_fields']) && $ITEM['data_fields'] != '') ? $ITEM['data_fields'] : '';
                            $Class_TAG = (isset($ITEM['class'])) ? ' class="'. $ITEM['class'] .'" ' : '';

                            $FormHtml .= '
                            <option
                                value="'. $ITEM['value'] .'"'
                                . $Class_TAG .' '
                                . $ItemsTags .' '
                                . $DATA_TAGS .
                                (($ITEM['selected']) ? ' selected="selected"' : '')
                            . '>'
                                . $ITEM['label']
                            . '</option>';

                        }

                    }
                    else {

                        $FormHtml .= '<option value="">Nenhuma opção</option>';

                    }

                    $FormHtml .= '</select>

                </div>'
                . $Append
                . $HelpText

            . self::tagClose('div');

        }

        /* Input Text Readonly */
        else if($Type == 'input-text') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ label, text, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'addon-left' - insert the content on box at left of element
                'addon-right' - insert the content on box at right of element

            */

            $AddonLeft = '';
            $AddonRight = '';

            if(isset($Attr['addon-left']) && $Attr['addon-left'] != '') {
                $AddonLeft = '<div class="input-group-prepend"><span class="input-group-text" id="addon-left-' . $Attr['name'] . '">' . $Attr['addon-left'] . '</span></div>';
                $Described = 'aria-describedby="addon-left-' . $Attr['name'] . '"';
            }

            if(isset($Attr['addon-right']) && $Attr['addon-right'] != '') {
                $AddonRight = '<div class="input-group-append"><span class="input-group-text" id="addon-left-' . $Attr['name'] . '">' . $Attr['addon-right'] . '</span></div>';
                $Described = ($AddonLeft != '') ? '' : 'aria-describedby="addon-right-' . $Attr['name'] . '"';
            }

            $FormHtml = self::tag('div', 'form-group')

                . $Label

                . (($AddonLeft != '' || $AddonRight != '') ? '<div class="input-group">' . $AddonLeft : '')

                . '<input type="text" name="'. $Attr['name'] .'" id="'. $Attr['name'] .'" readonly class="no-post form-control-plaintext" value="'. $Attr['text'] .'">'

                . (($AddonLeft != '' || $AddonRight != '') ? $AddonRight . '</div>' : '')

            . self::tagClose('div');

        }

        /* Standard Input */
        else if($Type == 'input') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ label, name, type, value, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'type' => 'text' default
                'mask' - type of javascript mask (see in resources/js/includes/_masks.js)
                'min' and 'max' - define the min and max lenght of field
            */

            $FormHtml = self::tag('div', 'form-group'. $Required)

                . ((isset($Attr['label']) && trim($Attr['label']) != '') ? self::label($Attr['name'], $Attr['label']) : '')

                . '<input
                    type="'. ($Attr['type'] ?? 'text') .'"
                    name="'. $Attr['name'] .'"
                    id="'. $Attr['id'] .'"
                    class="'. $DefaultClass . $Class .'"
                    value="'. $Attr['value'] .'"'
                    . $Attributes
                . '>'
                . $HelpText;

            $FormHtml .= self::tagClose('div');

        }

        /* Hidden Input */
        else if($Type == 'input-hidden') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ name, value, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'others' => another tags of your need
            */

            $FormHtml = '
            <input
                type="hidden"
                name="'. $Attr['name'] .'"
                id="'. $Attr['id'] .'"
                value="'. $Attr['value'] .'"
                class="'. $DefaultClass . $Class .'"'
                . $Attributes
            . '>';

        }

        /* Color Picker Input */
        else if($Type == 'input-color') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ label, name, value, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'type' => 'text' default
                'mask' - type of javascript mask (see in resources/js/includes/_masks.js)
            */

            $Attr['value'] = (isset($Attr['value']) && $Attr['value'] != '') ? $Attr['value'] : ((isset($Attr['clean']) && $Attr['clean']) ? '' : '#000000');

            $FormHtml = self::tag('div', 'form-group'. $Required)

                . self::label($Attr['name'], $Attr['label'])

                . self::tag('div', 'input-group')
                    . '<div class="input-group-prepend"><span class="input-group-text" id="addon-'. $Attr['name'] .'"><i class="icon-sliders"></i></span></div>'
                    . '<input
                        type="color"
                        aria-describedby="addon-'. $Attr['name'] .'"
                        name="'. $Attr['name'] .'"
                        id="'. $Attr['id'] .'"
                        class="prepend '. $DefaultClass .' align-center'. $Class .'"
                        value="'. $Attr['value'] .'"
                        '. $Attributes
                    . '>'
                . self::tagClose('div')

                . $HelpText

            . self::tagClose('div');

        }

        /* Money Input with Addon */
        else if($Type == 'input-money') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ label, name, value, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'type' => 'tel' default, enable just numeric keyboard on mobile devices
                'mask' - type of javascript mask (see in resources/js/includes/_masks.js)
                'min' and 'max' - define the number of digits
            */

            $FormHtml = self::tag('div', 'form-group'. $Required)

                . $Label

                . self::tag('div', 'input-group')

                    . '<div class="input-group-prepend"><span class="input-group-text" id="addon-'. $Attr['name'] .'">R$</span></div>

                        <input
                            type="'. ((isset($Attr[ 'type'])) ? $Attr[ 'type'] : 'tel') .'"
                            aria-describedby="addon-'. $Attr['name'] .'"
                            name="'. $Attr['name'] .'"
                            id="'. $Attr['id'] .'"
                            class="'. $DefaultClass . $Class .' align-right"
                            value="'.$Attr[ 'value'] .'"
                            '. $Attributes
                        . '>'

                . self::tagClose('div')

                . $HelpText

            . self::tagClose('div');

        }

        /* Percent Input with Addon */
        else if($Type == 'input-percent') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ label, name, value, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'type' => 'tel' default, enable just numeric keyboard on mobile devices
                'mask' - type of javascript mask (see in resources/js/includes/_masks.js)
                'min' and 'max' - define the number of digits
            */

            $FormHtml = self::tag('div', 'form-group'. $Required)

                . $Label

                . self::tag('div', 'input-group')

                    . '<input
                        type="'. $Attr['type'] ?? 'tel' .'"
                        aria-describedby="addon-'. $Attr['name'] .'"
                        name="'.$Attr['name'].'"
                        id="'. $Attr['id'] .'"
                        class="'. $DefaultClass . $Class .' align-right"
                        value="'. $Attr[ 'value'] .'"'
                        . $Attributes
                    . '>
                    <div class="input-group-append"><span class="input-group-text" id="addon-'. $Attr['name'] .'">%</span></div>'

                . self::tagClose('div')

                . $HelpText

            . self::tagClose('div');

        }

        /* URL Input with Addon */
        else if($Type == 'input-url') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ label, name, value, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'prepend' - optional content like '/category/', default '/'
                'min' and 'max' - define the min and max lenght of field
            */

            $FormHtml = self::tag('div', 'form-group'. $Required)

                . self::label($Attr['name'], $Attr['label'])

                . self::tag('div', 'input-group')

                    . '<div class="input-group-prepend"><span class="input-group-text" id="addon-'. $Attr['name'] .'">'. $Attr['prepend'] ?? '/' .'</span></div>
                    <input
                        type="text"
                        aria-describedby="addon-'. $Attr['name'] .'"
                        name="'. $Attr['name'] .'"
                        id="'. $Attr['id'] .'"
                        class="'. $DefaultClass . $Class .' friendly-urls"
                        value="'. $Attr['value'] .'"
                        '. $Attributes
                    . '>'

                . self::tagClose('div')

                . $HelpText

            . self::tagClose('div');

        }

        /* Other Non-Listed Input Types */
        else if($Type == 'input-others') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ label, type, name, value, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------
                'type' - option, default 'text'
                'addon-left' - optional content like icon or text
                'addon-right' - option content like icon, text, action button
            */
            /**
            * Pattern of Data Array
            * array('label', 'name', 'type', 'class', 'value', 'placeholder', 'min', 'max', 'width', adc)
            */

            $Mask = (isset($Attr['mask']) && $Attr['mask'] !== '') ? ' data-mask="'. $Attr['mask'] .'" ' : '';

            $Described = '';

            $AddonLeft = '';
            $AddonRight = '';

            if(isset($Attr['addon-left']) && $Attr['addon-left'] != '') {
                $AddonLeft = '<div class="input-group-prepend"><span class="input-group-text"  id="addon-left-'. $Attr['name'] .'">'. $Attr['addon-left'] .'</span></div>';
                $Described = 'aria-describedby="addon-left-'. $Attr['name'] .'"';
            }

            if(isset($Attr['addon-right']) && $Attr['addon-right'] != '') {
                $AddonRight = '<div class="input-group-append"><span class="input-group-text"  id="addon-left-'. $Attr['name'] .'">'. $Attr['addon-right'] .'</span></div>';
                if($AddonLeft != '') { $Described =  ''; } else { $Described =  'aria-describedby="addon-right-'. $Attr['name'] .'"'; }
            }

            $FormHtml = self::tag('div', 'form-group'. $Required)

                . $Label

                . self::tag('div', 'input-group', $Width)

                    . $AddonLeft

                    . '<input
                        type="'. $Attr['type'] ?? 'text' .'"
                        name="'. $Attr['name'] .'"
                        id="'. $Attr['id'] .'"
                        class="'. $DefaultClass . $Class .'"
                        value="'. $Attr['value'] .'"
                        placeholder="'. ((isset($Attr['placeholder'])) ? $Attr['placeholder'] : '') .'"
                        data-label="'. strip_tags(($Attr['label'] ?? '')) .'"'
                        . $Described
                        . $Attributes
                    . '>'

                    . $AddonRight

                . self::tagClose('div')

                . $HelpText

            . self::tagClose('div');

        }

        /* Textarea with or without Quill Editor */
        else if($Type == 'textarea') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ label, name, value, editor, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'editor' - no, standard, code or syntax
                'mode' - required with syntax editor (css or js)
                'rows' - used in textareas without Quill Editor enabled
                'height' - optional inline style, works on both (enabled and disabled Quill Editor)
                'min' and 'max' - define the min and max lenght of field
            */

            $_class = explode(' ', $Class);

            $Height = 'height: '. ((isset($Attr['height']) && $Attr['height'] !== '') ? $Attr['height'] : 500) .'px';

            $FormHtml = self::tag('div', 'form-group'. $Required)

                . $Label;

                    if(isset($Attr['editor']) && $Attr['editor'] == 'standard') {

                        $ToolbarConfig = (isset($Attr['basic'])) ? "toolbarOptionsMin" : "toolbarOptions";

                        $FormHtml .= '<div class="div-editor'. ((in_array('dyn-form', $_class)) ? ' dyn-form npp' : '') .'">
                            <div
                            id="'. $Attr['id'] .'"
                            name="'. $Attr['name'] .'"
                            data-toolbar="'. $ToolbarConfig .'"
                            data-placeholder="'. ((isset($Attr['placeholder'])) ? $Attr['placeholder'] : '') .'"
                            class="editor '. $Required .' required-editor"
                            style="'. $Height .'">'. $Attr['value'] .'</div>
                        </div>';

                    }
                    else if(isset($Attr['editor']) && $Attr['editor'] == 'code') {

                        $FormHtml .= '<div id="'. $Attr['id'] .'" class="editor-code"><pre>'. $Attr['value'] .' </pre></div>';

                    }
                    else if(isset($Attr['editor']) && $Attr['editor'] == 'syntax') {

                        $FormHtml .= '<pre id="'. $Attr['name'] .'_Syntax" data-id="'. $Attr['name'] .'" class="syntax-editor" data-mode="ace/mode/'. $Attr['mode'] .'">'. $Attr['value'] .'</pre>';

                    }
                    else {

                        $Rows = (isset($Attr['rows']) && $Attr['rows'] != '') ? ' rows="'.$Attr['rows'].'"' : '';

                        $FormHtml .= '<textarea
                            id="'. $Attr['id'].'"
                            name="'. $Attr['name'].'"
                            class="'. $DefaultClass . $Class .'"'
                            . $Placeholder
                            . (($Height != '') ? 'style="'. $Height .'"' : '')
                            . $Rows
                            . $Attributes
                        . '>'
                            . $Attr['value']
                        . '</textarea>';

                    }

                $FormHtml .= $HelpText;

            $FormHtml .= self::tagClose('div');

        }

        /* Standard Checkbox */
        else if($Type == 'checkbox') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ label, name, text, value, checked, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'checked' - true / false
                'parent-class' - optional, applied in the parent element, use if you need references to add an event or capture action
            */

            $Checked = (!isset($Attr['checked']) || $Attr['checked']) ? ' checked="checked" ' : '';
            $ParentClass = (isset($Attr['parent-class'])) ? ' '. $Attr['parent-class'] : '';
            $Icon = '<i class="icon ' . ((!isset($Attr['checked']) || $Attr['checked']) ? 'icon-check-box' : 'icon-check-box-alt') .'"></i>';

            $FormHtml = self::tag('div', 'form-group'. $Required)

                . $Label

                . self::tag('div', 'div-checkbox'. $ParentClass)

                    . '<input type="checkbox" name="'. $Attr['name'] .'" id="'. $Attr['id'] .'" class="'. $Class .'" value="'. $Attr['value'].'"'. $Others . $Checked . $AutoComplete .'>'
                    . self::tag('label', '', '', 'for="'. $Attr['name'] .'"', $Icon . $Attr['text'], true)

                . self::tagClose('div')

            . self::tagClose('div');

        }

        /* Checkbox without Top Label */
        else if($Type == 'checkbox-simple') {

           /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ name, text, value, checked, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'checked' - true / false
                'parent-class' - optional, applied in the parent element, use if you need references to add an event or capture action
            */

            $Checked = (!isset($Attr['checked']) || $Attr['checked']) ? ' checked="checked" ' : '';
            $ParentClass = (isset($Attr['parent-class'])) ? ' '. $Attr['parent-class'] : '';

            $FormHtml = self::tag('div', 'form-group'. $Required)

                . self::tag('div', 'div-checkbox'. $ParentClass)

                . '<input type="checkbox" name="'. $Attr['name'] .'" id="'. $Attr['id'] .'" class="'. $Class .'" value="'. $Attr['value'].'"'. $Others . $Checked . $AutoComplete .'> &nbsp; '

                . self::tag('label', '', '', 'for="'. $Attr['name'] .'"', $Attr['text'], true)

                . self::tagClose('div')

            . self::tagClose('div');

        }

        /* Terms Checkbox */
        else if($Type == 'terms') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ name, text, value, checked, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'checked' - true / false
                'parent-class' - optional, applied in the parent element, use if you need references to add an event or capture action
            */

            $Checked = (!isset($Attr['checked']) || $Attr['checked']) ? ' checked="checked" ' : '';
            $ParentClass = (isset($Attr['parent-class'])) ? ' '. $Attr['parent-class'] : '';
            $Icon = '<i class="icon ' . ((!isset($Attr['checked']) || $Attr['checked']) ? 'con-check-box' : 'icon-check-box-alt') . '"></i>';

            $FormHtml = self::tag('div', 'form-group required-form')

                . $Label

                . self::tag('div', 'div-checkbox'. $ParentClass)

                    . '<input type="checkbox" name="'. $Attr['name'] .'" data-label="'. ($Attr['label'] ?? '[nao-informado]') .'" id="'. $Attr['id'] .'" class="'. $Class .'" value="'. $Attr['value'].'"'. $Checked . $Attributes .'>'
                    . self::tag('label', ' terms', '', 'for="'. $Attr['name'] .'"', $Icon . $Attr['text'], true)

                . self::tagClose('div')

            . self::tagClose('div');

        }

        /* Switch ON/OFF */
        else if($Type == 'switch') {

            /*
                ---------------------
                Attributes Pattern
                ---------------------

                [ name, text, value, status, off-text, off-value, on-text, on-value, optionals ]

                --------------------------------
                Attributes Details and Optionals
                --------------------------------

                'status' - true (active) / false (disabled)
                'off-text' - visible info when this option is selected
                'off-value' - sended value when the switch option is off
                'on-text' - visible info when this option is selected
                'on-value' - sended value when the switch option is on
            */

            $Disabled = (isset($Attr['disabled']) && $Attr['disabled']) ? true : false;

            $FormHtml = self::tag('div', 'form-group'. $Required)

                . $Label

                . self::tag('div', 'switch'. (($Disabled) ? ' disabled' : ''))

                    . '<input name="'. $Attr['name'] .'" id="'. $Attr['id'] .'" data-txtoff="'. $Attr['txt1'] .'" data-txton="'. $Attr['txt2'] .'" class="switch-toggle switch-toggle-round" type="checkbox" '
                    . 'autocomplete="off" value="'. (($Attr['FNC'] == 'ADD') ? '1' : $Attr['value']) .'"'. (($Attr['value'] == '0' || $Attr['value'] == 'N') ? '' : ' checked="checked"') .'>';

                    if(!$Disabled) {

                        $FormHtml .= self::label($Attr['name'], '', '');
                        $AddOn = '';

                    }
                    else  {

                        $AddOn = ($Attr['value'] == '0') ? '<i class="icon icon-times text-gray" style="margin: 0 10px 0 0;"></i>' : '<i class="icon icon-check text-success" style="margin: 0 10px 0 0;"></i>';

                    }

                    $FormHtml .= self::tag('div', 'switch-info', '', '', $AddOn . $Attr['value-text'], true)

                . self::tagClose('div')

            . self::tagClose('div');

        }

        // Minify Return
        return Main::minifyHtml($FormHtml);

    }


    /**
     * Divider
     */

    public static function divider() {

        return self::tag('hr', 'featurette-divider');

    }


    /**
     *
     */
    public static function tableSwitch($Route, $Id, $Actual, $Values = [ 'Y', 'N' ], $Class = 'switch-published', $Function = 'published') {

        $AUTOCOMPLETE = ' autocomplete="off" ';

        $SwitchId = md5($Id . $Route);

        $HTML = '<div class="switch">
            <input
            id="switch-p-'. $SwitchId .'"
            data-route="'. $Route .'"
            data-id="'. $Id .'"
            data-function="'. $Function .'"
            data-selected="'. $Values[0] .'"
            data-unselected="'. $Values[1] .'"
            class="switch-toggle switch-toggle-round list-switch '. $Class .'"
            type="checkbox" '. $AUTOCOMPLETE .'
            value="'. $Actual .'"'. ((in_array($Actual, [ 1, 'ACTIVE', 'PUBLISHED', 'Y' ])) ? ' checked="checked"' : '') .'>
            <label for="switch-p-'. $SwitchId .'"></label>
        </div>';

        return $HTML;

    }


    /**
     * Image Tester
     *
     * @param string $FilePath
     * @return boolean
     */

    private function isImage($FilePath = '') {

        $allowedTypes = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
        $detectedType = exif_imagetype($FilePath);

        return(!in_array($detectedType, $allowedTypes));

    }

    /**
     * Upload Field & File List
     *
     * @param array $Attr
     * @return void
     */

    public static function uploadField($Attributes = []) {

        /*
            --------------------------
            Element Attributes Pattern
            --------------------------

            [ label, name, route, main, sortable, subtitled, limit-files, limit-size, optionals ]

            --------------------------------
            Attributes Details and Optionals
            --------------------------------
            'route' - point the route to upload and file treatment
            'uploader-class' - visible info when this option is selected
            'main' - true / false, highlight the first box, default false
            'sortable' - true / false, allows you to sort the registered items
            'sortable-class' - optional, references to our own javascript code
            'sortable-fnc' - optional, customized function of submit, if sended require manual implementation of order function
            'subtitled' - true / false, input field to set an subtitle text
            'crop' - option, default false, allows cut the original image and regenerate necessary files (thumb, large, ...)
            'delete-class' - customized class of delete button, if sended require manual implementation of delete function
            'hide' - true / false, toggle visibility of uploader
            'limit-files' - set the limit of files to send or already registered
            'limit-size' - set the limit of megabytes to one or multiple files
            'extensions' - optional, default '.webp,.jpg,.png,.gif', use this pattern (.ext,.ext,.ext...)
            'type-files' - optional, default 'images', available 'images/movies', 'movies', 'documents'
            'files' - associative array to show already registered files
            'upload-button' - true/false, show or hide upload button on edit form, default false
            'list-style' - grid / lines, default grid

            -------------------------
            Document Files Array Pattern
            -------------------------

            [ id, type, name, filesize, url ]

            -------------------------
            Image Files Array Pattern
            -------------------------

            [ id, type, filesize, thumb-url, large-url, subtitle-text ] * for documents send only large-url

        */

        /* Default Elements Class */
        $DefaultClass  = 'form-control form-control-lg';

        $Attributes['placeholder'] = isset($Attributes['placeholder']) ? $Attributes['placeholder'] : 'Selecione o(s) arquivo(s) para upload. Siga as instruções.';

        /* Config Array */
        $UploaderConfig = [

            /* UPLOADER */
            'UPLOADER-RAND-ID' => \Safeurl::make($Attributes['name'], [ 'maxlength' => 120 ]),
            'UPLOADER-CLASS' => (isset($Attributes['uploader-class']) && $Attributes['uploader-class'] != '') ? ' '.$Attributes['uploader-class'] : '',
            'UPLOADER-HIDE' => ((isset($Attributes['hide']) && $Attributes['hide']) ? ' style="display:none;"' : ''),

            /* MAIN */
            'MAIN-STATUS' => (!isset($Attributes['main'])) ? false : $Attributes['main'],
            'MAIN-CLASS' => (isset($Attributes['main']) && $Attributes['main']) ? ' has-principal' : '',

            /* SORT */
            'SORTABLE-STATUS' => (!isset($Attributes['sortable'])) ? true : $Attributes['sortable'],
            'SORTABLE-CLASS' => (isset($Attributes['sortable']) && $Attributes['sortable']) ? ((isset($Attributes['sortable-class']) && $Attributes['sortable-class'] != '') ?  $Attributes['sortable_class'] : 'sortable-files') : '',
            'SORTABLE-FNC' => (!isset($Attributes['sortable-fnc'])) ? '' : ' data-func="'. $Attributes['sortable-fnc'] .'"',

            /* SUBTITLE */
            'SUBTITLED-STATUS' => (!isset($Attributes['subtitled'])) ? false : $Attributes['subtitled'],

            /* DELETING */
            'DELETE-FNC' => (!isset($Attributes['delete-fnc'])) ? 'DEL-FILE' : $Attributes['delete-fnc'],
            'DELETE-CLASS' => (isset($Attributes['delete-class']) && $Attributes['delete-class'] != '') ? $Attributes['delete-class'] : 'btn-delete-file',

            /* REQUIRED */
            'REQUIRED' => self::required(trim($Attributes['class'] ?? '')),

            /* SUBTITLE */
            'UPLOAD-BUTTON' => (!isset($Attributes['upload-button'])) ? false : $Attributes['upload-button'],

            /* LIST STYLE */
            'LIST-STYLE' => (isset($Attributes['list-style']) && $Attributes['list-style']) ? 'list-lines' : '',

            /* AUTOCOMPLETE */
            'AUTOCOMPLETE' => ' autocomplete="off" ',

            /* EXTENSIONS */
            'EXTENSIONS' => (!isset($Attributes['extensions']) || $Attributes['extensions'] == '') ? '.webp,.jpg,.jpeg,.png,.gif' : $Attributes['extensions'],

        ];

        /* Prepare Files List Html */
        $FileList = '';

        if(isset($Attributes['files']) && is_array($Attributes['files']) && sizeof($Attributes['files']) > 0) {

            $CountFiles = 0;

            foreach($Attributes['files'] AS $File) {

                $parts = array_reverse(explode('.', basename($File['path'])));
                $extension = explode('?', $parts[0])[0];

                if(isset($Attributes['type-files']) && $Attributes['type-files'] == 'documents') {

                    $FileList .= '<div class="list-item list-item-file" id="file-item-'. $File['image-id'] .'">

                        <div>';

                            if(isset($File['has_name'])) {

                                $FileList .= '<div class="list-item-file-name">
                                    <input type="text" maxlength="50" class="'. $DefaultClass .' attchment-name" value="'. $File['name'] .'" data-id="'. $File['id'] .'" data-idi="'. $File['image_id'] .'" '. $UploaderConfig['AUTOCOMPLETE'] .' />
                                    </div>';

                            }
                            else {

                                $FileList .= '<div class="list-item-file-name"><i class="icon-file"></i> '. basename($File['path']) .'</div>';

                            }

                            $FileList .= '
                            <div class="list-item-file-size">'. $File['filesize'] .'</div>

                            <div class="list-item-file-buttons">' .
                                ((in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) ?
                                    '<a class="glightbox-item button button-warning button-icon button-sm" href="'. $File['full'] .'"><i class="icon-image"></i></a>'
                                :
                                    ''
                                ) .
                                '<a href="'. $File['url'] .'" class="button button-info button-icon button-sm" download><i class="icon-download"></i></a>
                                <button type="button" class="button button-block button-danger button-icon button-sm btn-delete-file" data-fnc="'. $UploaderConfig['DELETE-FNC'] .'" data-id="'. $File['id'] .'" data-idi="'. $File['image-id'] .'"><i class="icon-trash"></i><span>APAGAR</span></button>
                            </div>

                        </div>

                    </div>';

                }
                else {

                    $IsImage = in_array($extension, [ 'webp', 'jpeg', 'jpg', 'png', 'gif' ]);
                    $IsVideo = in_array($extension, [ 'mp4', 'ogg' ]);

                    $MainStatusFile = ($UploaderConfig['MAIN-STATUS'] && $CountFiles == 0) ? ' box-principal' : '';
                    $CropStatus = (isset($Attributes['crop']) && $Attributes['crop']);

                    $RandId = bin2hex(random_bytes(20));

                    $FileDimHtml = '';
                    $FileSizeHtml = '';

                    /* Image Dimensions */
                    if($IsImage && isset($File['width']) && isset($File['height']) && $File['width'] > 0 && $File['height'] > 0) {

                        $FileDimHtml = '<small class="image-dim">
                            <i class="icon icon-zoom-out"></i>'. $File['width'] .' x '. $File['height'] .' px
                        </small>';

                    }

                    /* File Size */
                    $FileSizeHtml .= '<small class="'. (($IsVideo) ? 'video-size' : 'image-size') .'">';

                        if($IsImage) {
                            $FileSizeHtml .= '<i class="icon-image"></i>'. $File['filesize'];
                        }
                        else {
                            $FileSizeHtml .= '<i class="icon-play"></i>'. $File['filesize'];
                        }

                    $FileSizeHtml .= '</small>';

                    /* Item Box */
                    $FileList .= '<div class="list-item" data-id="'. $File['id'] .'" data-idi="'. $File['image-id'] .'">';

                        $FileList .= '<div class="list-item-body'. $MainStatusFile .'">';

                            $FileList .= '<div class="align-items-center">';

                                $FileList .= '<div class="col-pic align-center">';

                                    if($IsImage) {
                                        $FileList .= '<a class="glightbox-item nl" data-href="'. $File['full'] .'"><div class="embed-responsive embed-responsive-4by3" style="background-image: url('. $File['thumb'] .'?rnd='. time() .');">'. $File_SIZES_HTML . $FileSizeHtml .'</div></a>';
                                    }
                                    else if($IsVideo) {
                                        $FileList .= '<div class="embed-video embed-responsive embed-responsive-4by3"><video controls><source src="'. $File['source'] .'" type="video/mp4"></video>'. $FileSizeHtml .'</div></a>';
                                    }
                                    else {

                                        if($File['type'] == 'audio') {

                                            $Html_AUDIO = '<audio controls>';
                                                $Html_AUDIO.= '<source src="'. $File['source'] .'">';
                                                $Html_AUDIO.= 'Seu navegador não suporta o player de áudio.';
                                            $Html_AUDIO.= '</audio>' . $FileSizeHtml;

                                            $FileSizeHtml = $Html_AUDIO;

                                        }

                                        $FileList .= '<div class="file-icon bg-alternativa embed-responsive embed-responsive-4by3"><i class="icon icon-file"></i>'. $FileSizeHtml .'</div>';

                                    }

                                    if($SUBTITLED-STATUS) {

                                        $SUBTITLE_CLASS = (isset($File['subtitle-class'])) ? $File['subtitle-class'] : 'file-subtitle';
                                        $FileList .= '<div class="form-group"><label class="subtitle-label">Legenda/Créditos</label><input type="text" id="subtitle-'. $File['image-id'] .'" class="form-control form-subtitle '. $SUBTITLE_CLASS .'" data-id="'. $File['image-id'] .'" value="'. ($File['subtitle'] ?? '') .'" placeholder="Ex: Lorem Ipsum dolor..."'. (($Disabled) ? ' disabled' : '') . $AutoComplete .'></div>';
                                    }

                                    if($UploaderConfig['MAIN-STATUS']) {
                                        //$FileList .= '<div class="image-principal"><input type="checkbox" id="principal-'. $File['id'] .'" name="principal-'. $File['id'] .'" data-id="'. $File['id'] .'" '. $AutoComplete .' class="imagem-principal" '. ((isset($File['principal']) && $File['principal']) ? 'checked' : '')  .' />&nbsp; <label for="principal-'. $File['id'] .'"><i class="icon-fire star-principal"></i><span>Principal</span></label></div>';
                                    }

                                $FileList .= '</div>';

                                $FileList .= '<div class="col-btn align-center file-buttons">';

                                    if($CropStatus) {

                                        $FileList .= '<button type="button" class="button button-block button-info button-sm crop-image  nl" data-form="uploader-'. $UploaderConfig['UPLOADER-RAND-ID'] .'" data-mod="'. $Attr['mod'] .'" data-fnc="'. ((isset($Attr['crop-fnc']) && $Attr['crop-fnc'] != '') ? $Attr['crop-fnc'] : 'CROP') .'" data-id="'. $File['id'] .'" data-idi="'. $File['image-id'] .'"><i class="icon-crop"></i>Recortar</button>';

                                    }

                                    $FileList .= '<button type="button" class="button button-block button-danger '. $UploaderConfig['DELETE-CLASS'] .' nl" data-form="uploader-'. $UploaderConfig['UPLOADER-RAND-ID'] .'" data-mod="'. $Attr['mod'] .'" data-fnc="'. $Attr['fnc'] .'" data-id="'. $File['id'] .'" data-idi="'. $File['image-id'] .'"'. (($Disabled) ? ' disabled' : '') .'><i class="icon-trash"></i>'. (($HAS_CROP) ? '' : 'Apagar') .'</button>';

                                $FileList .= '</div>';

                            $FileList .= '</div>';

                        $FileList .= '</div>';

                    $FileList .= '</div>';

                    $CountFiles++;

                }

            }

        }

        /* Upload Input */
        $FormHtml  = '<div id="uploader-'. $UploaderConfig['UPLOADER-RAND-ID'] .'" class="uploader form-upload-box'. $UploaderConfig['UPLOADER-CLASS'] .'" data-route="'. $Attributes['route'] .'" data-id="'. $Attributes['name'] .'">

            <div class="input-group-upload '. $UploaderConfig['REQUIRED'] .'"'. $UploaderConfig['UPLOADER-HIDE'] .'>

                <label class="form-label">'. $Attributes['label'] .'</label>

                <div class="form-upload">

                    <label class="form-upload-label" for="'. $Attributes['name'] .'">

                        <span class="label-placeholder" data-placeholder="'. $Attributes['placeholder'] .'">'. $Attributes['placeholder'] .'</span>
                        <span class="label-folder"></span>'

                            . (($UploaderConfig['UPLOAD-BUTTON']) ?
                                '<button type="button" class="button button-info nl button-icon btn-upload" data-input="'. $Attributes['name'] .'"><i class="icon-upload"></i><span>ENVIAR</span></button>'
                                :
                                ''
                            )

                            . '<button type="button" class="button button-danger button-icon btn-remover nl"><i class="icon-trash"></i><span>REMOVER</span></button>' .
                        '</label>' .
                        '<input type="file" class="form-upload-input dyn-form npp" id="'. $Attributes['name'] .'" name="'. $Attributes['name'] .'" '. $UploaderConfig['AUTOCOMPLETE'] .' accept="'. $UploaderConfig['EXTENSIONS'] .'" '. (($Attributes['limit-files'] > 1) ? 'multiple="multiple" ' : '') .'limit="'. $Attributes['limit-files'] .'" '. (($Attributes['limit-size'] != '') ? 'data-limit="'. $Attributes['limit-size'] .'" ' : '') .' title="Nenhum arquivo selecionado">' .
                    '</div>' .

                '</div>' .

                '<div class="progress-wrp"><div class="progress-bar"></div></div>

            <div class="list-files'. $UploaderConfig['MAIN-CLASS'] .' glightbox" id="list-files-'. $UploaderConfig['UPLOADER-RAND-ID'] .'" data-selector="#list-files-'. $UploaderConfig['UPLOADER-RAND-ID'] .' .glightbox-item">
                <div class="list-files-grid '. $UploaderConfig['SORTABLE-CLASS'] . $UploaderConfig['LIST-STYLE'] .'"'.  $UploaderConfig['SORTABLE-FNC'] .'>'. $FileList .'</div>
            </div>

        </div>';

        return Main::minifyHtml($FormHtml);

    }

    /**
     * Upload Field & File List
     *
     * @param array $Attr
     * @param boolean $DEL
     * @param string $Class
     * @return void
     */

    public static function listSwitch($Id, $Status, $Route, $Class = 'switch-status', $Fnc = 'STATUS') {

        $AutoComplete = ' autocomplete="off" ';

        $Html = '<div class="switch">';
            $Html .= '<input id="switch-p-'. md5($Id . $Fnc) .'" data-mod="'. $Route .'" data-id="'. $Id .'" data-fnc="'. $Fnc .'" class="switch-toggle switch-toggle-round table-switch '. $Class .'" type="checkbox" '. $AutoComplete .' value="'. $Status .'"'. (($Status == 1 || $Status == 'ACTIVE' || $Status == 'PUBLISHED' || $Status == 'Y') ? ' checked="checked"' : '') .'>';
            $Html .= '<label for="switch-p-'. md5($Id . $Fnc) .'"></label>';
        $Html .= '</div>';

        return $Html;

    }

    /**
     * Form Buttons by Type
     *
     * @param integer $Type
     * @param string $Fnc
     * @param boolean $DEL
     * @return void
     */

    public static function formButtons($Id, $Route, $Type = 'standard', $Add = '') {

        global $request;

        $html = '';

        /* Config */
        $AutoComplete = ' data-module="'. $Route .'" autocomplete="off" ';

        /* Icons */
        $SAVE = self::icon('icon-save');
        $TRASH = self::icon('icon-trash');

        // STANDARD
        if($Type == 'standard') {

            $html = '
            <button type="button" class="button button-success" id="btn-form-save"'. $AutoComplete .'><i class="icon-save"></i>Gravar</button>
            <button type="button" class="button button-danger" id="btn-form-del" data-id="'. $Id .'"'. $AutoComplete .'><i class="icon-trash"></i>Apagar</button>
            ';

        }

        // STANDARD + SAVE & ADD
        else if($Type == 'save-add') {

            $html = '
            <button type="button" class="button button-success" id="btn-form-save"'. $AutoComplete .'>'. $SAVE .'Gravar</button>
            <button type="button" class="button button-success" id="btn-form-save-add"'. $AutoComplete .'>'. $SAVE .'Gravar & Adicionar Outro</button>
            <button type="button" class="button button-danger" id="btn-form-del" data-id="'. $Id .'"'. $AutoComplete .'>'. $TRASH .'Apagar</button>
            ';

        }

        // STANDARD + SAVE & EDIT
        else if($Type == 'save-edit') {

            $html = '
            <button type="button" class="button button-success" id="btn-form-save"'. $AutoComplete .'>'. $SAVE .'Gravar</button>
            <button type="button" class="button button-success" id="btn-form-save-continue"'. $AutoComplete .'>'. $SAVE .'Gravar & Editar</button>
            <button type="button" class="button button-danger" id="btn-form-del" data-id="'. $Id .'"'. $AutoComplete .'>'. $TRASH .'Apagar</button>
            ';

        }

        // CONFIG
        else if($Type === 'save-config') {

            $html = '<button type="button" class="button button-success" id="btn-form-save-continue"'. $AutoComplete .'>'. $SAVE .'Gravar</button>';

        }

        // SAVE SIMPLE
        else if($Type == 'save') {

            $html = '<button type="button" class="button button-success" id="btn-form-save"'. $AutoComplete .'>'. $SAVE .'Gravar</button>';

        }

        // NEWSLETTER
        else if($Type == 'newsletter') {

            $html = '
            <button type="button" class="button button-success" id="btn-form-save-continue"'. $AutoComplete .'>'. $SAVE .'Gravar / Enviar</button>
            <button type="button" class="button button-danger" id="btn-form-del" data-id="'. $Id .'"'. $AutoComplete .'>'. $TRASH .'Apagar</button>
            ';

        }

        // ONLY BACK BUTTON
        else if($Type == 'back') {

            $html .= '
            <button type="button" class="button button-info" id="btn-form-back"'. $AutoComplete .'><i class="icon-chevron-left"></i>Voltar</button>
            ';

        }

        // CUSTOM & CONTINUE BUTTONS
        else if($Type == 'custom-continue') {

            $html = '
            <button type="button" class="button button-success" id="btn-form-save-pers"'. $AutoComplete .'>'. $SAVE .'Gravar</button>
            <button type="button" class="button button-success" id="btn-form-save-continue-pers"'. $AutoComplete .'>'. $SAVE .'Gravar & Editar</button>
            <button type="button" class="button button-danger" id="btn-form-del" data-id="'. $Id .'"'. $AutoComplete .'>'. $TRASH .'Apagar</button>
            ';

        }

        // CUSTON BUTTON
        else if($Type == 'custom') {

            $html = '<button type="button" class="button button-success" id="btn-form-save-pers"'. $AutoComplete .'>'. $SAVE .'Gravar</button>';

        }

        // CUSTON BUTTON
        else if($Type === 'custom-save-only') {

            $html = '
            <button type="button" class="button button-success" id="btn-form-save"'. $AutoComplete .'>'. $SAVE .'Gravar</button>
            <button type="button" class="button button-success" id="btn-form-save-continue"'. $AutoComplete .'>'. $SAVE .'Gravar & Editar</button>
            ';

        }

        // DELETE
        else if($Type == 'delete') {

            $html = '
            <button type="button" class="button button-danger" id="btn-form-del" data-id="'. $Id .'"'. $AutoComplete .'>'. $TRASH .'Apagar</button>
            ';

        }

        /* BACK BUTTON */
        if($Type != 'back' && $Type != 'save-config') {

            $html .= '
            <button type="button" class="button button-info" id="btn-form-back"'. $AutoComplete .'><i class="icon-chevron-left"></i>Voltar</button>
            ';

        }

        return Main::minifyHtml($html . $Add);

    }

    /**
     * No Registries Buttons
     *
     * @param integer $Type
     * @return void
     */

    public static function noRegButtons($Type = 'not-found') {

        global $request;

        $html = self::tag('div', '', 'form-buttons');

            /* ROUTE */
            $Route = explode('/', $request->path());
            $Route = $Route[1];

            /* DEFAULT CLASS */
            $DefaultClass = 'button button-round button-icon';

            /* NO REGISTRYS FOUND */
            if($Type == 'not-found') {

                $html .= '
                <button type="button" class="'. $DefaultClass.' button-success btn-add"><i class="icon icon-plus"></i>Adicionar</button>
                <button type="button" class="'. $DefaultClass.' button-info btn-refresh" data-route="'. $Route .'"><i class="icon icon-chevron-left"></i>Listar Todos os Registros</button>
                <button type="button" class="'. $DefaultClass.' button-info btn-dashboard"><i class="icon icon-speed"></i>Dashboard</button>
                ';

            }

            /* STANDARD */
            else if($Type == 'no-registers') {

                $html .= '
                <button type="button" class="'. $DefaultClass.' button-success btn-add" data-route="'. $Route .'"><i class="icon icon-plus"></i>Adicionar</button>
                <button type="button" class="'. $DefaultClass.' button-info btn-refresh" data-route="'. $Route .'"><i class="icon icon-repeat"></i>Atualizar Listagem</button>
                <button type="button" class="'. $DefaultClass.' button-info btn-dashboard"><i class="icon icon-speed"></i>Dashboard</button>
                ';

            }

            /* ONLY REFRESH */
            else if($Type == 'only-refresh') {

                $html .= '
                <button type="button" class="'. $DefaultClass.' button-info btn-refresh" data-route="'. $Route .'"><i class="icon icon-repeat"></i>Atualizar Listagem</button>
                <button type="button" class="'. $DefaultClass.' button-info btn-dashboard"><i class="icon icon-speed"></i>Dashboard</button>
                ';

            }

            /* SEARCH WITHOUT ADD BUTTON */
            else if($Type == 'only-search') {

                $html .= '
                <a href="/admin/'. $Route[1] .'" class="link-preto"><button type="button" class="'. $DefaultClass.' button-info"><i class="icon icon-chevron-left"></i>Listar Todos os Registros</button></a>
                <a href="/admin" class="link-preto"><button type="button" class="'. $DefaultClass.' button-info"><span class="icon icon-speed"></span>Dashboard</button></a>
                ';

            }

        $html .= self::tagClose('div');

        return ($html);

    }

    /**
     * List Pagination
    *
    * @param integer $Total
    * @param integer $Limit
    * @param integer $Pages
    * @param integer $Pg
    * @param integer $Pg2
    * @return void
    */
    public static function pagination($Route, $Total = 0, $Limit = 0, $Pages = 0, $Pg = 0, $Pg2 = 0, $UrlComplement = '') {

        if($Total > $Limit) {

            $RouteULE_URL = '/admin/'. $Route . $UrlComplement;

            $html = '<div class="pagination-list">

                <ul class="pagination">';

                    /* Previous Button */
                    if($Pg > 1) {

                        $PAGE_PREVIOUS = ($Pg > 2) ? $Pg - 1 : 0;
                        $PAGE_URL = $RouteULE_URL . (($PAGE_PREVIOUS > 0) ? '&pg=' . $PAGE_PREVIOUS : '');

                        $html .= '<li>
                            <a href="'. $PAGE_URL .'" rel="nofollow" title="Página Anterior">'. self::icon('icon-chevron-left') .'</a>
                        </li>';

                    }
                    else {

                        $html .= '<li class="page-item disabled">
                            <a>'. self::icon('icon-chevron-left') .'</a>
                        </li>';

                    }

                    /* Limit Steps of 10 */
                    if (
                        ((strlen($Pg) > 1) && (substr($Pg, -1) > 0)) ||
                        ((strlen($Pg) == 1) && $Pg > 1)
                    ) {

                        /* somando... */
                        for ($i=1;$i<=9;$i++) {

                            $END_POS = $Pg + $i;
                            if (substr($END_POS, -1) == 0) { break; }

                        }

                        /* subtraindo... */
                        for ($o=1;$o<=9;$o++) {

                            if($Pg > 0) {
                                $Start_POS = $Pg-$o;
                                if (strlen($Pg)==1)
                                    if (substr($Start_POS, -1)==1) break;
                                if (strlen($Pg)>1)
                                    if (substr($Start_POS, -1)==0) break;
                            }
                            else
                            {
                                $Start_POS = 0;
                                break;
                            }
                        }

                    }
                    else {

                        $Start_POS = ($Pg > 0) ? $Pg-1 : 1;

                        $END_POS = (strlen($Pg) == 1) ? $Pg + 1 : $Pg + 10;

                    }

                    /* Loop of Pagination Links */
                    $comma = 0;

                    for($POS=$Start_POS;$POS<=$END_POS;$POS++) {

                        $Pgnum = $POS;

                        $class = '';

                        if ($POS > 1 && !isset($t) && ($Start_POS > 10)) {

                            $html .= '<li>
                                <a href="'. $RouteULE_URL .'" rel="nofollow" title="Página 1">'. 1 .'</a>
                            </li>';

                            $html .= '<li class="space">...</li>';

                            $t = true;

                        }

                        if($Pg == $Pgnum || ($Pgnum == 1 && $Pg == 0)) { $class=' class="active"'; }

                        $html .= '<li'. $class .'>
                            <a href="'. $RouteULE_URL . (($Pgnum > 1) ? '&pg='. $Pgnum : '') .'"  rel="nofollow" title="Página '. $Pgnum .'">'. $Pgnum .'</a>
                        </li>';

                        $comma++;

                        if ($POS == $Pages) { break; }

                    }

                    if($Pg2 < $Pages) {

                        $proxima = ($Pg > 0) ? $Pg + 1 : 2;
                        $PAGE_URL = '';
                        $html .= '<li>
                            <a href="'. $RouteULE_URL .'&pg='. $proxima .'" rel="nofollow" title="Próxima Página">'. self::icon('icon-chevron-right') .'</a>
                        </li>';

                    }
                    else {

                        $html .= '<li class="page-item disabled"><a>'. self::icon('icon-chevron-right') .'</a></li>';

                    }

                $html .= '</ul>

            </div>';

            return $html;

        }


    }


    /**
     * addRestrict
     * Show restrict message for ADD function
     * @return void
     */
    public static function addRestrict() {

        return self::alert('danger', '<strong>Atenção!</strong><br>Esta funcionalidade não está disponível, utilize apenas os links e botões disponíveis na página, não tente acessar digitando na barra de endereço.');

    }

    /**
     * userRestrict
     * Show restrict message for unvailable link
     *
     * @return void
     */
    public static function userRestrict() {

        return self::alert('danger', '<strong>Atenção!</strong><br>Esta funcionalidade não está disponível, utilize apenas os links e botões disponíveis na página, não tente acessar digitando na barra de endereço.');

    }


    /**
     * editError
     * Show error on edit item
     * @return void
     */
    public static function editError($type = '') {

        /* ROUTE */
        $Route = explode('/', $request->path());
        $Context = $Route[0];
        $Route = $Route[1];

        switch($type) {

            case 'config':
                $message = self::alert('danger', '<strong>Configuração Não Encontrada!</strong><br>Não há configuração cadastrada, solicite suporte.<br><br>'. self::icon('icon-chevron-left') .' <a href="/'. $Context .'">Voltar ao Dashboard</a>');
                break;

            default:
                $message = self::alert('danger', '<strong>Registro Não Encontrado!</strong><br>Infelizmente não foi possível localizar o registro que você solicitou, retorne e tente novamente.<br><br>'. self::icon('icon-chevron-left') .' <a href="'. route($Route) .'">Voltar à Listagem</a>');
                break;

        }

        return $message;

    }

}
