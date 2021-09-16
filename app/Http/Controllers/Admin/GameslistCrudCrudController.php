<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GameslistCrudRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GameslistCrudCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GameslistCrudCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Slotslist::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/gameslist-crud');
        CRUD::setEntityNameStrings('game', 'gameslist');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->addColumn([
          'name' => 'n', // The db column name
          'label' => "Name", // Table column heading
          'type' => 'text'
        ]);
       $this->crud->addColumn([
          'name' => 'desc', // The db column name
          'label' => "Desc", // Table column heading
          'type' => 'text'
        ]);
       $this->crud->addColumn([
          'name' => 'p', // The db column name
          'label' => "Provider", // Table column heading
          'type' => 'text'
        ]);

       $this->crud->addColumn([
          'name' => 'type', // The db column name
          'label' => "Game Type", // Table column heading
          'type' => 'text'
        ]);

       $this->crud->addField([
          'name' => 'd', // The db column name
          'label' => "Disabled", // Table column heading
          'type' => 'boolean'
        ]);

    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(GameslistCrudRequest::class);

        $this->crud->addField([
          'name' => '_id', // The db column name
          'label' => "Game ID", // Table column heading
          'type' => 'text',
            'attributes' => [
                'required' => true,
            ],
        ]);

        $this->crud->addField([
          'name' => 'n', // The db column name
          'label' => "Game Name", // Table column heading
          'type' => 'text',
            'attributes' => [
                'required' => true,
            ],
        ]);
       $this->crud->addField([
          'name' => 'desc', // The db column name
          'label' => "Game Description", // Table column heading
          'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'type',
            'label' => "Template",
            'type' => 'select_from_array',
            'options' => ['slots' => 'Slots', 'live' => 'Live', 'arcade' => 'Arcade'],
            'allows_null' => false,
            'default' => 'one',
        ]);

        $this->crud->addField([
            'name' => 'ext',
            'label' => "API Version",
            'type' => 'select_from_array',
            'options' => ['c2' => 'Standard Bulk.bet API', 'rise' => 'Extended Bulk.bet API'],
            'allows_null' => false,
            'default' => 'one',
        ]);

       $this->crud->addField([
          'name' => 'd', // The db column name
          'label' => "Disabled", // Table column heading
          'type' => 'boolean',
            'attributes' => [
                'required' => true,
            ],
        ]);
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
