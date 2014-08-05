<?php

namespace Karma\Controllers;

use Illuminate\Routing\Controller;

class BaseController extends Controller 
{
    protected $layout;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (!is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
