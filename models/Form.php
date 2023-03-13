<?php

class Form{
    private $name;
    private $action;
    private $method;

    /**
     * Form constructor.
     * @param $name
     * @param $action
     * @param $method
     */

    public function __construct($name, $action='?', $method='POST')
    {
        $this->name = $name;
        $this->action = $action;
        $this->method = $method;
    }

    public function open_form($class='form-group',$extra=null){
        echo '<form 
                action="'.$this->action.'" 
                name="'.$this->name .'" 
                method="'.$this->method.'" 
                class="'.$class.'" '.$extra.'>';
    }


    public function add_input($name, $type, $class='form-control', $value = null, $extra=null){
        echo '<div class="mb-3">';
        echo '<label class="form-label" for="'.$name.'">'.ucfirst($name).'</label>';
        echo '<input 
            class="form-control"
                name="'.$name.'" 
                id="'.$name.'" 
                placeholder="'.ucfirst($name).'" 
                type="'.$type.'" 
                value="'.$value.'" 
                class="'.$class.'" 
                '.$extra.'/>';
        echo '</div>';
    }

    public function add_text_input($name, $class='form-control', $value = null, $extra=null){
        $this->add_input($name, 'text', $class, $value, $extra);
    }

    public function add_password_input($name, $class='form-control', $value = null, $extra=null){
        $this->add_input($name, 'password', $class, $value, $extra);
    }

    public function add_email_input($name, $class='form-control', $value = null, $extra=null){
        $this->add_input($name, 'email', $class, $value, $extra);
    }

    public function add_hidden_input($name, $class='form-control', $value = null, $extra=null){
        $this->add_input($name, 'hidden', $class, $value, $extra);
    }

    public function add_submit($name, $value){
            $this->add_input($name, 'submit', 'form-control', $value, null);
    }

    public function add_text_area($name, $rows, $cols, $class='form-control', $value = null, $extra=null){
        echo '<textarea 
                name="'.$name.'" 
                id="'.$name.'" 
                cols="'.$cols.'" 
                rows="'.$rows.'" 
                class="'.$class.'"
                '.$extra.'>';
        echo $value;
        echo '</textarea>';
    }

    public function add_select($name, $array){
        echo '<select name="'.$name.'">';
        foreach ($array as $item) {
            echo '<option value="'.$item.'">'.ucfirst($item).'</option>';
        }
        echo '</select>';
    }

    public function add_select2($name,$array){
        echo '<select name="'.$name.'">';
        foreach ($array as $key=>$value) {
            echo '<option value="'.$key.'">'.ucfirst($value).'</option>';
        }
        echo '</select>';
    }

    public function close_form(){
        echo '</form>';
    }
}