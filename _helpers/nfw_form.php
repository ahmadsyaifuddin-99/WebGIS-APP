<?php
function label($a, $b = '', $c = '')
{
    if ($b != '') {
        $b = ' ' . $b;
    }
    if ($c != '') {
        $c = ' ' . $c;
    }
    return '<label class="control-label' . $b . '"' . $c . '>' . $a . '</label>' . "\n";
}
function input_text($a, $b, $c = '', $d = '')
{
    if(!is_array($c)){

        if ($c != '') {
            $c = ' ' . $c;
        }
        if ($d != '') {
            $d = ' ' . $d;
        }
        return '<input type="text" name="' . $a . '" value="' . $b . '" class="form-control' . $c . '"' . $d . '>' . "\n";
    }
    else{
        $set='';
        foreach ($c as $key => $value) {
            $set.=' '.$key.'="'.$value.'" ';
        }
        $c=$set;
        return '<input type="text" name="' . $a . '" value="' . $b . '" '.$c.'>' . "\n";

    }
}
function input_file($a, $b, $c = '', $d = '')
{
    if ($c != '') {
        $c = ' ' . $c;
    }
    if ($d != '') {
        $d = ' ' . $d;
    }
    return '<input type="file" name="' . $a . '" value="' . $b . '" class="form-control' . $c . '"' . $d . '>' . "\n";
}
function input_time($a, $b, $c = '', $d = '')
{
    if ($c != '') {
        $c = ' ' . $c;
    }
    if ($d != '') {
        $d = ' ' . $d;
    }
    return '<input type="time" name="' . $a . '" value="' . $b . '" class="form-control' . $c . '"' . $d . '>' . "\n";
}
function input_date($a, $b, $c = '', $d = '')
{
    if ($c != '') {
        $c = ' ' . $c;
    }
    if ($d != '') {
        $d = ' ' . $d;
    }
    return '<input type="date" name="' . $a . '" value="' . $b . '" class="form-control' . $c . '"' . $d . '>' . "\n";
}
function input_number($a, $b, $c = '', $d = '')
{
    if ($c != '') {
        $c = ' ' . $c;
    }
    if ($d != '') {
        $d = ' ' . $d;
    }
    return '<input type="number" name="' . $a . '" value="' . $b . '" class="form-control' . $c . '"' . $d . '>' . "\n";
}
function input_color($a, $b, $c = '', $d = '')
{
    if ($c != '') {
        $c = ' ' . $c;
    }
    if ($d != '') {
        $d = ' ' . $d;
    }
    return '<input type="color" name="' . $a . '" value="' . $b . '" class="form-control' . $c . '"' . $d . '>' . "\n";
}
function textarea($a, $b, $c = '', $d = '')
{
    if(!is_array($c)){
        if ($c != '') {
            $c = ' ' . $c;
        }
        if ($d != '') {
            $d = ' ' . $d;
        }
        return '<textarea name="' . $a . '" class="form-control' . $c . '"' . $d . '>' . $b . '</textarea>' . "\n";
    }
    else{
        $set='';
        foreach ($c as $key => $value) {
            $set.=' '.$key.'="'.$value.'" ';
        }
        $c=$set;
        
    return '<textarea name="' . $a . '" class="form-control' . $c . '"' . $d . '>' . $b . '</textarea>' . "\n";
        return '<textarea name="' . $a . '" '.$c.'>' . $b . '</textarea>' . "\n";
    }
}
function input_hidden($a, $b, $c = '')
{
   
    if(!is_array($c)){

        if ($c != '') {
            $c = ' ' . $c;
        }
        return '<input type="hidden" name="' . $a . '" value="' . $b . '" class="form-control' . $c . '">' . "\n";
    }
    else{
        $set='';
        foreach ($c as $key => $value) {
            $set.=' '.$key.'="'.$value.'" ';
        }
        $c=$set;
        return '<input type="hidden" name="' . $a . '" value="' . $b . '" '.$c.'>' . "\n";

    }
}
function input_password($a, $b, $c = '', $d = '')
{
    if ($c != '') {
        $c = ' ' . $c;
    }
    if ($d != '') {
        $d = ' ' . $d;
    }
    return '<input type="password" name="' . $a . '" value="' . $b . '" class="form-control' . $c . '"' . $d . '>';
}
function input_submit($a, $b)
{
    return '<input type="submit" name="' . $a . '" value="' . $b . '" class="btn btn-info">';
}
function select($a, $b = array(), $c = array(), $d = '', $e = '')
{
    if(!is_array($d)){
        $data = '';
        if (!is_array($c)) {
            $c = array(
                $c
            );
        }
        if (count($c) === 0) {
            if (isset($_POST[$a])) {
                $c = array(
                    $_POST[$a]
                );
            }
        }
        if ($d != '') {
            $d = ' ' . $d;
        }
        if ($e != '') {
            $e = ' ' . $e;
        }
        foreach ($b as $key => $val) {
            $sel = (in_array($key, $c)) ? ' selected="selected"' : '';
            $data .= "\t\t\t\t\t\t<option value=\"" . $key . "\"" . $sel . ">" . (string) $val . "</option>\n";
        }
        return '<select name="' . $a . '" class="form-control' . $d . '"' . $e . '>' . "\n" . $data . "\t\t\t\t\t" . '</select>' . "\n\t\t\t\t";
    }
    else{
        $set='';
        foreach ($d as $key => $value) {
            $set.=' '.$key.'="'.$value.'" ';
        }
        $d=$set;
        $data = '';
        if (!is_array($c)) {
            $c = array(
                $c
            );
        }
        if (count($c) === 0) {
            if (isset($_POST[$a])) {
                $c = array(
                    $_POST[$a]
                );
            }
        }
        if ($d != '') {
            $d = ' ' . $d;
        }
        if ($e != '') {
            $e = ' ' . $e;
        }
        foreach ($b as $key => $val) {
            $sel = (in_array($key, $c)) ? ' selected="selected"' : '';
            $data .= "\t\t\t\t\t\t<option value=\"" . $key . "\"" . $sel . ">" . (string) $val . "</option>\n";
        }
        return '<select name="' . $a . '" '. $d . '"' . $e . '>' . "\n" . $data . "\t\t\t\t\t" . '</select>' . "\n\t\t\t\t";

    }
    
}
function radio($a, $b, $c = '', $d = '', $e = '')
{
    if ($d != '') {
        $d = ' ' . $d;
    }
    if ($e != '') {
        $e = ' ' . $e;
    }
    if ($b == $c) {
        $c = ' checked="checked" ';
    }
    return '<input type="radio" name="' . $a . '" value="' . $b . '" class="' . $d . '"' . $e . '' . $c . '>';
}
function checkbox($a, $b, $c = '', $d = '', $e = '')
{
    if ($d != '') {
        $d = ' ' . $d;
    }
    if ($e != '') {
        $e = ' ' . $e;
    }
    if ($b == $c) {
        $c = ' checked="checked" ';
    }
    return '<input type="checkbox" name="' . $a . '" value="' . $b . '" class="' . $d . '"' . $e . '' . $c . '>';
}
function button($a, $b, $c = '')
{
    if ($c != '') {
        $c = ' ' . $c;
    }
    return '<button type="button" name="' . $a . '" class="btn' . $c . '">' . $b . '</button>';
}
function button_submit($a, $b, $c = '')
{
    if ($c != '') {
        $c = ' ' . $c;
    }
    return '<button type="submit" name="' . $a . '" class="btn' . $c . '">' . $b . '</button>';
}
function button_submit_danger($a, $b)
{
    return '<button type="submit" name="' . $a . '" class="btn btn-danger">' . $b . '</button>';
} 
function info_success($a)
{
    return _info_template($a, 'alert-success');
}
function info_warning($a)
{
    return _info_template($a, 'alert-warning');
}
function info_danger($a)
{
    return _info_template($a, 'alert-danger');
}
function _info_template($a, $b)
{
    return '<div class="alert alert-dismissable ' . $b . '" style="margin-left:0px;margin-top:10px"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> ' . $a . ' </div>';
}