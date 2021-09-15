<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UsersRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UsersCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UsersCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/users');
        CRUD::setEntityNameStrings('user', 'user');

    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'name' => 'table',
            'label' => 'Table',
            'type' => 'table',
            'columns' => [
                'name'  => 'Name',
                'desc'  => 'Description',
                'price' => 'Price',
            ]
        ]);
    }
    protected function setupListOperation()
    {

        $this->crud->addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning');
        $this->crud->addColumn([
          'name' => 'name', // The db column name
          'label' => "Name", // Table column heading
          'type' => 'Text'
        ]);

        $this->crud->addColumn([
          'name' => 'email', // The db column name
          'label' => "E-mail", // Table column heading
          'type' => 'email'
        ]);

$this->crud->addColumn([
    'name'        => 'viplevel',
    'label'       => 'VIP Level',
    'type'        => 'radio',
    'options'     => [
        0 => 'Level 0',
        1 => 'Level 1',
        2 => 'Level 2',
        3 => 'Level 3',
        4 => 'Level 4',
        5 => 'Level 5',
        6 => 'Level 6',
        7 => 'Level 7',
        8 => 'Level 8',
        9 => 'Level 9',
        10 => 'Level 10'
    ]
]);

$this->crud->enableExportButtons();


        /**
        'name',
        'email',
        'password',
        'token',
        'usd',
        'bonus',
        'deposited',
        'rake',
        'freespins',
        'withdrawn',
        'arcade',
        'poker',
        'viplevel'

         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UsersRequest::class);
      $this->crud->addField([
        'name' => 'name',
        'type' => 'text',
        'label' => "Name"
      ]);
      $this->crud->addField([
        'name' => 'email',
        'type' => 'text',
        'label' => "E-mail Address"
      ]);
      $this->crud->addField([
        'name' => 'viplevel',
        'type' => 'text',
        'label' => "VIP Level"
      ]);

        //CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
