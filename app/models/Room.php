<?php

class Room extends Elegant {

    protected $guarded = 'id';
    protected $table = 'rooms';
    protected $softDelete = true;
    protected $rules = array(
        'name'  		=> 'required|alpha_space|min:3',

    );

    public function assignedbuilding()
    {
        return $this->belongsTo('Building', 'building_id');
    }

    // Attach the Room Location for Drop Down List
    public function room()
    {
        return $this->belongsTo('Building');
    }
}
