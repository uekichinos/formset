<?php

return [

    /*
    |--------------------------------------------------------------------------
    | column name reserve
    |--------------------------------------------------------------------------
    |
    | this is system auto generated column.
    | you may add more reserve column name but avoid to edit/change default reserve column name.
    |
    */

    'column_name_reserve' => [
        'id' => 'increments',
        'created_at' => 'datetime',
        'modified_at' => 'datetime',
    ],

    /*
    |--------------------------------------------------------------------------
    | create table migration file
    |--------------------------------------------------------------------------
    |
    | change the value to false if you wish to disabled the button.
    | default: true
    | value: true/false
    |
    */

    'table_migration_btn' => true,

    /*
    |--------------------------------------------------------------------------
    | list of fieldset
    |--------------------------------------------------------------------------
    |
    | list fo fieldset in drop down menu
    |
    */

    'fieldsets' => [
        'integer' => [
            'name' => 'Integer',
        ],
        'double' => [
            'name' => 'Double',
        ],
        'char' => [
            'name' => 'Character',
        ],
        'text' => [
            'name' => 'Text',
        ],
        'boolean' => [
            'name' => 'Boolean',
        ],
        'date' => [
            'name' => 'Date',
        ],
        'time' => [
            'name' => 'Time',
        ],
        'datetime' => [
            'name' => 'Date Time',
        ],
        'binary' => [
            'name' => 'Binary',
        ],
    ],

];
