<?php
/**
 * This file contains the DefaultController class.
 * 
 * PHP version 5.3
 * 
 * LICENSE: This file is part of Nuggets-PHP.
 * Nuggets-PHP is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * Nuggets-PHP is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Nuggets-PHP. If not, see <http://www.gnu.org/licenses/>. 
 */
namespace nuggets;

/**
 * This class represents the default behaviour of the framework in response to an URL request.
 * 
 * @package    nuggets\Controller
 * @category   PHP
 * @author     Rajdeep Das <das.rajdeep97@gmail.com>
 * @copyright  Copyright 2012 Rajdeep Das
 * @license    http://www.gnu.org/licenses/gpl.txt  The GNU General Public License
 * @version    GIT: v3.5
 * @link       https://github.com/dasrajdeep/nuggets-php
 * @since      Class available since Release 1.0
 */
class DefaultController extends Controller {
    
    /**
     * Contains a flag to check whether the controller uses a model.
     * 
     * @var boolean
     */
    public $usesModel=true;
    
    /**
     * Contains a flag to check whether the controller uses a view.
     * 
     * @var boolean
     */
    public $usesView=true;
    
    /**
     * Contains the helpers required by the controller.
     * 
     * @var string[]
     */
    public $helpers=array('html','css');
    
    /**
     * Contains the layout type.
     * 
     * @var string
     */
    public $layout='default';
    
    /**
     * Contains the type fo view used.
     * 
     * @var string
     */
    public $viewType='HTML';
	
	/**
	 * Renders the default view for the framework.
	 */
    public function loadDefaultView() {
        $this->view->renderView('default');
    }
}

?>
