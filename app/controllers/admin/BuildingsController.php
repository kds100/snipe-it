<?php namespace Controllers\Admin;

use AdminController;
use Input;
use Lang;
use Building;
use Location;
use Redirect;
use Setting;
use DB;
use Sentry;
use Str;
use Validator;
use View;

class BuildingsController extends AdminController {

    /**
     * Show a list of all the Buildings.
     *
     * @return View
     */

    public function getIndex()
    {
        // Grab all the Buildings
        //$assets = Asset::with('model','assigneduser','assetloc','assetstatus')->orderBy('asset_tag', 'ASC')->where('physical', '=', 1)->get();

        //assignedlocation

        $buildings = Building::with('assignedlocation')->orderBy('name', 'ASC')->get();


        // Show the page (WATCH CAPITALS and LOWER CASE HERE - buildings works, Buildings DOES NOT!!!)
        return View::make('backend/Buildings/index', compact('buildings'));
    }


    /**
     * Building create.
     *
     * @return View
     */
    public function getCreate()
    {
        // Show the page
        $Building_options = array('0' => 'Top Level') + Building::lists('name', 'id');
        return View::make('backend/Buildings/edit')->with('Building_options',$Building_options)->with('Building',new Building);
    }


    /**
     * Building create form processing.
     *
     * @return Redirect
     */
    public function postCreate()
    {

        // get the POST data
        $new = Input::all();

        // create a new Building instance
        $Building = new Building();

        // attempt validation
        if ($Building->validate($new))
        {

            // Save the Building data
            $Building->name            	= e(Input::get('name'));
//            $Building->address			= e(Input::get('address'));
//            $Building->address2			= e(Input::get('address2'));
//            $Building->city    			= e(Input::get('city'));
//            $Building->state    		= e(Input::get('state'));
//            $Building->country    		= e(Input::get('country'));
//            $Building->zip    		= e(Input::get('zip'));
//            $Building->user_id          = Sentry::getId();

            // Was the asset created?
            if($Building->save())
            {
                // Redirect to the new Building  page
                return Redirect::to("admin/settings/Buildings")->with('success', Lang::get('admin/Buildings/message.create.success'));
            }
        }
        else
        {
            // failure
            $errors = $Building->errors();
            return Redirect::back()->withInput()->withErrors($errors);
        }

        // Redirect to the Building create page
        return Redirect::to('admin/settings/Buildings/create')->with('error', Lang::get('admin/Buildings/message.create.error'));

    }


    /**
     * Building update.
     *
     * @param  int  $BuildingId
     * @return View
     */
    public function getEdit($buildingId = null)
    {
        // Check if the Building exists
        if (is_null($building = Building::find($buildingId)))
        {
            // Redirect to the buildings management page
            return Redirect::to('admin/settings/Buildings')->with('error', Lang::get('admin/Buildings/message.does_not_exist'));
        }

        // Show the page
        //$Building_options = array('' => 'Top Level') + Building::lists('name', 'id');

        $Building_options = array('' => 'Top Level') + DB::table('Buildings')->where('id', '!=', $buildingId)->lists('name', 'id');

        // Included List of Locations/Buildings/Rooms for given Asset
        $location_list = array('' => '') + Location::orderBy('name', 'asc')->lists('name', 'id');

        return View::make('backend/Buildings/edit', compact('building'))->with('Building_options',$Building_options)->with('location_list',$location_list);
    }


    /**
     * Building update form processing page.
     *
     * @param  int  $BuildingId
     * @return Redirect
     */
    public function postEdit($BuildingId = null)
    {
        // Check if the Building exists
        if (is_null($Building = Building::find($BuildingId)))
        {
            // Redirect to the blogs management page
            return Redirect::to('admin/settings/Buildings')->with('error', Lang::get('admin/Buildings/message.does_not_exist'));
        }



        // get the POST data
        $new = Input::all();


        // attempt validation
        if ($Building->validate($new))
        {

            // Update the Building data
            $Building->name            	= e(Input::get('name'));
//            $Building->address			= e(Input::get('address'));
//            $Building->address2			= e(Input::get('address2'));
//            $Building->city    			= e(Input::get('city'));
//            $Building->state    		= e(Input::get('state'));
//            $Building->country    		= e(Input::get('country'));
//            $Building->zip    		= e(Input::get('zip'));

            // Was the asset created?
            if($Building->save())
            {
                // Redirect to the saved Building page
                return Redirect::to("admin/settings/Buildings/$BuildingId/edit")->with('success', Lang::get('admin/Buildings/message.update.success'));
            }
        }
        else
        {
            // failure
            $errors = $Building->errors();
            return Redirect::back()->withInput()->withErrors($errors);
        }

        // Redirect to the Building management page
        return Redirect::to("admin/settings/Buildings/$BuildingId/edit")->with('error', Lang::get('admin/Buildings/message.update.error'));

    }

    /**
     * Delete the given Building.
     *
     * @param  int  $BuildingId
     * @return Redirect
     */
    public function getDelete($BuildingId)
    {
        // Check if the Building exists
        if (is_null($Building = Building::find($BuildingId)))
        {
            // Redirect to the blogs management page
            return Redirect::to('admin/settings/Buildings')->with('error', Lang::get('admin/Buildings/message.not_found'));
        }


        if ($Building->has_users() > 0) {

            // Redirect to the asset management page
            return Redirect::to('admin/settings/Buildings')->with('error', Lang::get('admin/Buildings/message.assoc_users'));
        } else {

            $Building->delete();

            // Redirect to the Buildings management page
            return Redirect::to('admin/settings/Buildings')->with('success', Lang::get('admin/Buildings/message.delete.success'));
        }



    }



}
