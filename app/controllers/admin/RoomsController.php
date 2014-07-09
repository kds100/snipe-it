<?php namespace Controllers\Admin;

use AdminController;
use Input;
use Lang;
use Room;
use Location;
use Redirect;
use Setting;
use DB;
use Sentry;
use Str;
use Validator;
use View;

class RoomsController extends AdminController {

    /**
     * Show a list of all the Rooms.
     *
     * @return View
     */

    public function getIndex()
    {
        // Grab all the Rooms
        $rooms = Room::orderBy('name', 'ASC')->paginate(Setting::getSettings()->per_page);

        // Show the page (WATCH CAPITALS and LOWER CASE HERE - rooms works, Rooms DOES NOT!!!)
        return View::make('backend/Rooms/index', compact('rooms'));
    }


    /**
     * Room create.
     *
     * @return View
     */
    public function getCreate()
    {
        // Show the page
        $Room_options = array('0' => 'Top Level') + Room::lists('name', 'id');
        return View::make('backend/Rooms/edit')->with('Room_options',$Room_options)->with('Room',new Room);
    }


    /**
     * Room create form processing.
     *
     * @return Redirect
     */
    public function postCreate()
    {

        // get the POST data
        $new = Input::all();

        // create a new Room instance
        $Room = new Room();

        // attempt validation
        if ($Room->validate($new))
        {

            // Save the Room data
            $Room->name            	= e(Input::get('name'));
//            $Room->address			= e(Input::get('address'));
//            $Room->address2			= e(Input::get('address2'));
//            $Room->city    			= e(Input::get('city'));
//            $Room->state    		= e(Input::get('state'));
//            $Room->country    		= e(Input::get('country'));
//            $Room->zip    		= e(Input::get('zip'));
//            $Room->user_id          = Sentry::getId();

            // Was the asset created?
            if($Room->save())
            {
                // Redirect to the new Room  page
                return Redirect::to("admin/settings/Rooms")->with('success', Lang::get('admin/Rooms/message.create.success'));
            }
        }
        else
        {
            // failure
            $errors = $Room->errors();
            return Redirect::back()->withInput()->withErrors($errors);
        }

        // Redirect to the Room create page
        return Redirect::to('admin/settings/Rooms/create')->with('error', Lang::get('admin/Rooms/message.create.error'));

    }


    /**
     * Room update.
     *
     * @param  int  $RoomId
     * @return View
     */
    public function getEdit($RoomId = null)
    {
        // Check if the Room exists
        if (is_null($Room = Room::find($RoomId)))
        {
            // Redirect to the blogs management page
            return Redirect::to('admin/settings/Rooms')->with('error', Lang::get('admin/Rooms/message.does_not_exist'));
        }

        // Show the page
        //$Room_options = array('' => 'Top Level') + Room::lists('name', 'id');

        $Room_options = array('' => 'Top Level') + DB::table('Rooms')->where('id', '!=', $RoomId)->lists('name', 'id');
        return View::make('backend/Rooms/edit', compact('Room'))->with('Room_options',$Room_options);
    }


    /**
     * Room update form processing page.
     *
     * @param  int  $RoomId
     * @return Redirect
     */
    public function postEdit($RoomId = null)
    {
        // Check if the Room exists
        if (is_null($Room = Room::find($RoomId)))
        {
            // Redirect to the blogs management page
            return Redirect::to('admin/settings/Rooms')->with('error', Lang::get('admin/Rooms/message.does_not_exist'));
        }



        // get the POST data
        $new = Input::all();


        // attempt validation
        if ($Room->validate($new))
        {

            // Update the Room data
            $Room->name            	= e(Input::get('name'));
//            $Room->address			= e(Input::get('address'));
//            $Room->address2			= e(Input::get('address2'));
//            $Room->city    			= e(Input::get('city'));
//            $Room->state    		= e(Input::get('state'));
//            $Room->country    		= e(Input::get('country'));
//            $Room->zip    		= e(Input::get('zip'));

            // Was the asset created?
            if($Room->save())
            {
                // Redirect to the saved Room page
                return Redirect::to("admin/settings/Rooms/$RoomId/edit")->with('success', Lang::get('admin/Rooms/message.update.success'));
            }
        }
        else
        {
            // failure
            $errors = $Room->errors();
            return Redirect::back()->withInput()->withErrors($errors);
        }

        // Redirect to the Room management page
        return Redirect::to("admin/settings/Rooms/$RoomId/edit")->with('error', Lang::get('admin/Rooms/message.update.error'));

    }

    /**
     * Delete the given Room.
     *
     * @param  int  $RoomId
     * @return Redirect
     */
    public function getDelete($RoomId)
    {
        // Check if the Room exists
        if (is_null($Room = Room::find($RoomId)))
        {
            // Redirect to the blogs management page
            return Redirect::to('admin/settings/Rooms')->with('error', Lang::get('admin/Rooms/message.not_found'));
        }


        if ($Room->has_users() > 0) {

            // Redirect to the asset management page
            return Redirect::to('admin/settings/Rooms')->with('error', Lang::get('admin/Rooms/message.assoc_users'));
        } else {

            $Room->delete();

            // Redirect to the Rooms management page
            return Redirect::to('admin/settings/Rooms')->with('success', Lang::get('admin/Rooms/message.delete.success'));
        }



    }



}
