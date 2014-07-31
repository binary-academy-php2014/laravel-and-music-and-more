<?php

namespace Karma\Entities;

/**
 * This class represents resource which could be used to log in.
 **/

class Social extends \Eloquent
{
    protected $fillable = array('id', 'name');
    public $timestamps = false;

}
