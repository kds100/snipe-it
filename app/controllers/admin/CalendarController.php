<?php namespace Controllers\Admin;

use AdminController;
use Input;
use Lang;
use Asset;
use Calendar;
use User;
use Setting;
use Redirect;
use DB;
use Model;
use Sentry;
use Str;
use Validator;
use View;

class CalendarController extends AdminController {

	/**
	 * Show a list of all the calendar items.
	 *
	 * @return View
	 */

	public function getIndex()
	{
		// Grab all the assets
		//$assets = Asset::orderBy('purchase_date', 'ASC')->where('warranty_months', '>', 0)->where('physical', '=', 1)->get();
		return View::make('backend/calendar/index');
	}


}
