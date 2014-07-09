<?php namespace Controllers;

//use BaseController;
use Input;
use Lang;
use Redirect;
use Setting;
use DB;
use Sentry;
use Str;
use Validator;
use View;

class HumorController extends \BaseController {

    /**
     * Show a list of all the Humor.
     *
     * @return View
     */

    public function getIndex()
    {
        // Show the page (WATCH CAPITALS and LOWER CASE HERE - buildings works, Humor DOES NOT!!!)
        return View::make('backend/humor/index');
    }

}
