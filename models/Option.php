<?php
require_once('models/Db.php');

class Option extends Db{
    public $id;
    public $name;
    public $value;
    public $description;
    public $type;
    public $created_at;
    public $updated_at;
    public $deleted_at;
}