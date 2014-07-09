<?php

class Building extends Elegant {

    protected $guarded = 'id';
    protected $table = 'buildings';
    protected $softDelete = true;
    protected $rules = array(
        'name'  		=> 'required|alpha_space|min:3',

    );

    public function assignedlocation()
    {
        return $this->belongsTo('Location', 'location_id');
    }

    /**
     * Get the building's location based on the assigned user
     **/
    public function assetloc()
    {
        return $this->assigneduser->userloc();
    }

    public function has_users()
    {
        return $this->hasMany('User', 'building_id')->count();
    }

    public function has_rooms()
    {
        return $this->hasMany('Room', 'building_id')->count();
    }

    // Added to pull along Location to Index display view
    public function location()
    {
        return $this->belongsTo('Location','location_id');
    }
    //public function rooms()
    //{
    //    return $this->hasMany('Room', 'building_id');
   // }

    // Attach the Building Location for Drop Down List
    public function building()
    {
        return $this->belongsTo('Location');
    }

    // Link the Rooms for this Location - Drop down list
    public function rooms(){
        return $this->hasMany('Room');
    }
}
