<?php

namespace Karma\Entities;

class Setting extends Eloquent
{
	protected $fillable = array('id', 'user_id', 'key', 'value');
    protected $timestamps = false;
    
    public function user()
    {
        return $this->hasOne('User');
    }
}