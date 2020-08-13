<?php

namespace Programmit\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


/**
 *  version: 1.2
 *  date: 2019 - 1 - 4
 *  Author: Hassan Youssef Krayem
 *  email: developer.hassankrayem@gmail.com
 *  description: class for controlling components
 */

/**
 * views with the names of controller 
 *
 * Every class define an entity, and every entity has its own properties 
 * structure and methods. lets take users as our entity and start what
 * this class is for. Usauly, UserController is intended to have create,
 * update, read and delete methods CURD operations, and every operation
 * might have a separated view. in case if separated views, we are going
 * to receive a request for e.g user_createview_data1. we are going to
 * split the request on _ underscore so we have array of 3.
 * [ Controller Name, Method name, method parameters]. 
 * user@createview(data1) the parameters are optional. Moreover, this
 * class will create variables that holds viewpath, form id, html create
 * button and more .... this class also use the request it gets
 * user_createview_data1 to identify view location. On our example,
 * this class will return a view from user/createview/main.blade.php
 * as main.blade.php is the default file to look into for every request.
 * so our views directories will be the same of our controllers.
 * if we have UserController, CategoryController and ArticleController.
 * we will have user/create, user/update, user/read, user/delete
 * category/create, category/update etc...
 * but it kinda annoying that every operation has its own view isn't ?
 * what about more improved UX ? lets say we have a table for users
 * where we have drop down action button that shows as the following
 * options for each user: Full View, Edit, delete and send message.
 * how our class will handle it ? our UX design goes as follows.
 * 
 * Every main entity must has a request and sub operation goes under
 * this request. e.g we intend to make every entity / controller
 * has components which return a view for the operations.
 * 
 * lets say we have user@mainComponent
 * the mainComponent mehtod should return a view that has tabs in general
 * to different among different actions.
 * Tab to create new user
 * Tab to list users in a table and table has actions for this user delete/edit/send message etc...
 * Tab to view users that are blocked 
 * 
 *  
 * This class aims to simplify control panels and Content Managment Systems
 * easy for development from repect of views development and routing
 * This class recieves request as follows e.g platform_create_c1
 * and convert it into controller, method and parameters.
 * Method create will be invoked in platform controller.
 * 
 * The invoked method is intended to return a view
 * for dealing with a component in this controller.
 * 
 */

/**
 * for getting full and partial views [done]
 * for having views directories with the name of controllers [done]
 * for simplifiying determining if user has permission for certain feature [done]
 * 
 * 
 */

/**
 * controllers and methods are camelCase
 * views are snake_case
 * 
 */

/**
 * Create / platform@create with data -> url 'components/platform/create
 * 
 * Edit
 * view
 * delete
 * Search
 * set statuses
 * 
 * combine with another model / entity
 */

class ProgrammitComponentController extends \App\Http\Controllers\Controller
{
    protected $data;

    public function __construct()
    {
        $viewPath = 'cpanel/'; // not used
        
        /* // base Properties
        $baseUrl = 'cpanel';// not used
        $controllerName = explode("\\",get_class()); // not used
        $controllerName = end($controllerName); // not used
        $this->data['controllerName'] = $controllerName; // not used
        $this->data['baseUrl'] = $baseUrl; // not used */

        $this->data['viewPath'] = $viewPath; // not used
        $this->data['componentsBaseRoute'] = 'cpanel/';
        $this->data['componentsViewsRoot'] = ''; //laravel_project/resources/views/
        $this->data['componentsPlatformDirectory'] = '';
        $this->data['componentsControllerRoute'] = 'cpanel/component/';
    }


    public function main()
    {
        // Auth::user()->givePermissionTo('root_access');
        return view($this->data['viewPath'].'main');
    }


    /**
     * creates a button with component id to use by ease with
     * component ready functions.
     */
    public function createComponentFormActionButtonHTML($buttonAttr = '', $buttonClasses = '')
    {
        if(!empty($buttonClasses))
        {
            $buttonClasses = ' ' . $buttonClasses;
        }

        $buttonText = '<i class="fa fa-fw fa-save"></i> Create';
        if(isset($this->data['comp_form_btn_text']))
        {
            $buttonText = $this->data['comp_form_btn_text'];
        }

        return '<button type="button" id="'. $this->data['comp_form_btn_id'] . '" 
        class="btn btn-info'.$buttonAttr.'" ' . $buttonAttr .'> ' .  $buttonText . '  </button>';
    }


    /**
     * Split coming request and return array
     * with Requested Controller, method and
     * view names.
     */
    function prepareComponentSource($componentSource)
    {

        // e.g public_platform.home
        // portion 1 : public_platform
        // portion 2 : home
        
        $portion = explode('.', $componentSource);

        if(isset($portion[0]))
        {
            $controller = str_replace('_', '', ucwords($portion[0], "_"));//ucfirst($portion[0]);
        }
        else
        {
            // controller portion isn't set.
            return  response()->json([
                'errors' => ['no view found #1'],
            ]
            , 404); // Status code here
        }

        if(isset($portion[1]))
        {
            $method = str_replace('_', '', ucwords($portion[1], "_"));
        }
        else
        {
            // method portion isn't set.
            return  response()->json([
                'errors' => ['no view found #2'],
            ]
            , 404); // Status code here
        }

        $main_page = 'main';
        if(isset($portion[2]))
        {
            $main_page = $portion[2];//parse_str($portion[2], $parameters);
        }

        $componentResource = [
            'comp_orginal_id' => $componentSource,
            'viewDirectory' => $portion[0] . '.' .  $this->data['componentsPlatformDirectory'] . $portion[1] . '.',
            'controller' => $controller,
            'orginal_controller' => $portion[0],
            'method' => $method,
            'main_page' => $main_page,
            'route' => strtolower($controller . '/' . $method),            
        ];

        return $componentResource;
    }

    public function componentRequest($componentSource, $model_id = null, Request $request)
    {
        $componentResource = self::prepareComponentSource($componentSource);
        $componentClassName = "\App\Http\Controllers\\" .$componentResource['controller'] . 'Controller';
        if(class_exists($componentClassName))
        {
            $componentClass = new $componentClassName; // creating instance of controller.

            // method to use for valadting using of components, good for checking for payment, auth, expire etc..
            $componentClassMethodName = "componenRequestValidAction"; 

            // checking and invoking common method if exists.
            if(method_exists($componentClass, $componentClassMethodName))
            {
                $v = $componentClass->{$componentClassMethodName}($request);
                if($v !== true)
                {
                    return $v;
                }
            }

            $componentClassMethodName = "componentRequestBoot"; // setting the name of common method of all components.
            // checking and invoking common method if exists.
            if(method_exists($componentClass, $componentClassMethodName))
            {
                $componentClass->{$componentClassMethodName}($request);
            }
            
            if($request->isMethod('post'))
            {
                $methodName = $componentResource['method'] . 'CRP';
            }
            else if($request->isMethod('get'))
            {
                $methodName = $componentResource['method'] . 'CRG';
            }
            else
            {
                $methodName = $componentResource['method'] . 'CR';
            }
            
            //dd(method_exists($componentClass, $methodName), $componentClassName, $methodName);
            // Checking and calling component method if exists, else return error 404.
            if(method_exists($componentClass, $methodName))
            {                
                return $componentClass->{$methodName}($request);
            }
            else
            {
                // no method exists
                return  response()->json([
                    'errors' => ['no CR found #3'],
                ]
                , 404); // Status code here
            }
        }

    }


    /**
     * This method will receive $componentSource as: platform_board_abc
     * and will call PlatformController@boardComponent(abc)
     * with cpanel/platform/board/main.blade.php as view
     * and pass special variables that has form unqiue id, view path etc..
     */
    public function components($componentSource, $model_id = null, Request $request)
    {   

        $componentResource = self::prepareComponentSource($componentSource);

        // check if error is found    
        if(gettype($componentResource) == 'object')
            return $componentResource;

        // we can determin $root of view by some properties like user permissions etc...
        /* if(Auth::user()->role == 2)
        {
            $root = 'members_panel.';
        }
        else if(Auth::user()->role == 5)
        {
            $root = 'members_panel.';
        } */
        
        $viewBase =  strtolower($this->data['componentsViewsRoot'] . $componentResource['viewDirectory']);
        
        if(Auth::check())
        {
            $this->data['user'] = Auth::user();
        }


        $this->data['viewRoot'] = $this->data['componentsViewsRoot'];
        $this->data['viewBase'] = $viewBase;
        $this->data['componentBaseView'] = $viewBase;
        $this->data['view_controller'] = $componentResource['orginal_controller'];
        $this->data['component_model_id'] = $model_id; // If these is a request with a certain ID.

        // Checking if there is a request for component header title.
        if($request->input('headerTitle'))
        {
            $this->data['componentHeaderTitle'] = $request->input('headerTitle');
        }
        else
        {
            // using header title from controller and method.
            $this->data['componentHeaderTitle'] = $componentResource['controller'] . ' ' . $componentResource['method'];
        }

        $this->data['componentName'] = $componentResource['method'];
        // Adding s to try to stay on naming conventions 
        $this->compViewRouteName = '/component/' . $componentResource['orginal_controller']  . '.';
        $this->compRequestRouteName = '/component_request/' . $componentResource['orginal_controller']  . '.';

        /* // checking if the this class has method for this component.
        if(method_exists(get_class(), $componentResource['method']))
        {
            $this::$method($main_page, $request);
        } */

        // should be same for all components
        $controllerAndMethod = strtolower($componentResource['controller'] . '_' . $componentResource['method']);
        $this->data['comp_orginal_id'] = $componentResource['comp_orginal_id'];
        $this->data['current_entity_id'] = '';
        $this->data['comp_edit_status_html_attributes'] = '';
        $this->data['comp_container_id'] = 'container_' . $controllerAndMethod;
        $this->data['comp_form_id'] = 'form_' . $controllerAndMethod;
        $this->data['comp_table_id'] = 'table_' . $controllerAndMethod;
        $this->data['comp_form_current_method'] = 'post';
        $this->data['comp_form_btn_id'] = $this->data['comp_form_id'] . '_ac_btn';
        $this->data['comp_partial_id_start'] = 'component_partial_' . $controllerAndMethod;
        $this->data['comp_tab_id'] = 'tab_' . $controllerAndMethod;
        //$this->data['comp_controller_name'] = strtolower($componentResource['controller']);
        $this->data['comp_method_name'] = $componentResource['method'];
        $this->data['btn_label'] = 'btn_' . self::generateRandomString() . '_';

        // Routes Methods
        $this->data['comp_store_route_method'] = 'post';
        $this->data['comp_delete_route_method'] = 'post';
        $this->data['comp_edit_route_method'] = 'get';
        $this->data['comp_update_route_method'] = 'post';
        
        // Routes 
        $this->data['comp_view_route'] = $this->compViewRouteName; // cpanel/componentName/store
        $this->data['comp_request_route'] = $this->compRequestRouteName; // cpanel/componentName/store
        $this->data['comp_store_route'] = $this->compRequestRouteName . 'store'; // cpanel/componentName/store
        $this->data['comp_edit_route'] = $this->compRequestRouteName . 'edit'; // cpanel/componentName/store
        $this->data['comp_update_route'] = $this->compRequestRouteName . 'update'; // cpanel/componentName/store
        $this->data['comp_list_route'] = $this->compRequestRouteName . 'list'; // cpanel/componentName/list   
        $this->data['comp_delete_route'] = $this->compRequestRouteName . 'delete'; // cpanel/componentName/delete
        

        // Component View Path
        $main_page = $componentResource['main_page'];
        $componentClassName = "\App\Http\Controllers\\" .$componentResource['controller'] . 'Controller';
        
        if(class_exists($componentClassName))
        {
            $componentClass = new $componentClassName; // creating instance of controller.

            // method to use for valadting using of components, good for checking for payment, auth, expire etc..
            $componentClassMethodName = "componentValidAction"; 

            // checking and invoking common method if exists.
            if(method_exists($componentClass, $componentClassMethodName))
            {
                $v = $componentClass->{$componentClassMethodName}($main_page, $request, $this->data);
                if($v !== true)
                {
                    return $v;
                }
            }


            $componentClassMethodName = "componentBoot"; // setting the name of common method of all components.

            // checking and invoking common method if exists.
            if(method_exists($componentClass, $componentClassMethodName))
            {
                $componentClass->{$componentClassMethodName}($main_page, $request, $this->data);
            }
            
            
            // Checking and calling component method if exists, else return error 404.
            if(method_exists($componentClass, $componentResource['method'] . 'Component')) 
            {                
                $r = $componentClass->{$componentResource['method'] . 'Component'}($main_page, $request, $this->data);                
                if (!empty($r)) {
                    return $r;
                }
            }
            else
            {
                // no method exists
                return  response()->json([
                    'errors' => ['no view found #3'],
                ]
                , 404); // Status code here
            }
        }
        else
        {
            // no controller found
            return  response()->json([
                'errors' => ['no view found #4'],
            ]
            , 404); // Status code here
        }

        if(!empty($this->data['current_entity_id']))
        {
            $this->data['comp_form_btn_id'] = $this->data['comp_form_id'] . '_' .$this->data['current_entity_id'] . '_update_ac_btn';
            $this->data['comp_form_id'] = $this->data['comp_form_id'] . '_update_' . $this->data['current_entity_id'];
        }
        
        if(!isset($this->data['comp_form_btn']))
            $this->data['comp_form_btn'] = self::createComponentFormActionButtonHTML();
        
        if(!isset($this->data['comp_search_query']))
        {
            $this->data['comp_search_query'] = false;
        }
        
        $this->data['componentViewPath'] = $viewBase . $main_page;
        $this->data['master_comp'] = 'component'; // programmit_legos/views/component.blade.php
        $this->data['comp_roles'] = 'component_fields.';
        $this->data['comp_role_legos'] = 'component_field_legos.';

        return view($this->data['componentViewPath'], $this->data);
    }


    /**
     * Components Prepaering Methods Names are like following e.g.:
     *   MyComponentNamePreperComponent()
     *   AnotherComponentPreperComponent()
     *   SliderPreperComponent()
     * 
     * These methods are use to preper the needed
     * data for the view component e.g. users model , articles etc...
     */

    public function platformPreperComponent()
    {
        //$this->data['platformsTypes'] = \App\PlatformType::all();
        $this->data['boardsFacesTypes'] = \App\BoardFaceType::all();
        $this->data['platformsViewsTypes'] = \App\PlatformViewType::all();
    }


    public function RolesAndPermissionsPreperComponent()
    {
        // Create Permissions
        
       /*  Permission::create(['name' => 'create users', 'group_name' => 'user']);
        Permission::create(['name' => 'update users', 'group_name' => 'user']);
        Permission::create(['name' => 'delete users', 'group_name' => 'user']);
        Permission::create(['name' => 'assign roles', 'group_name' => 'user']);
        Permission::create(['name' => 'create roles', 'group_name' => 'user']);
        Permission::create(['name' => 'change users status', 'group_name' => 'user']);

        Permission::create(['name' => 'create articles', 'group_name' => 'article']);
        Permission::create(['name' => 'update articles', 'group_name' => 'article']);
        Permission::create(['name' => 'view articles', 'group_name' => 'article']);
        Permission::create(['name' => 'delete articles', 'group_name' => 'article']);
        Permission::create(['name' => 'change articles status', 'group_name' => 'article']);
        
        Permission::create(['name' => 'view roles and permissions', 'group_name' => 'role_and_permissions']);



        // Create Roles
        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Supervisor']);

        Role::create(['name' => 'Editor']);
        Role::create(['name' => 'Author']);
        Role::create(['name' => 'Observer']);
        
        
        $user->roles->pluck('name');
        $user->getRoleNames();
        */


        // Note: Sort permissions on the added group_name attribute.
        $this->data['roles'] = Role::all();
        $this->data['permissions'] = Permission::all();
    }

    function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

    // public function rolesAndP
}
