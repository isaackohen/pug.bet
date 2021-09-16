<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ViplevelsCrudRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ViplevelsCrudCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ViplevelsCrudCrudController extends CrudController
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
        CRUD::setModel(\App\Models\VIP\VipLevels::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/viplevels-crud');
        CRUD::setEntityNameStrings('viplevel', 'viplevels');
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
        'name' => 'level',
        'type' => 'text',
        'label' => "Lv."
      ]);
      $this->crud->addColumn([
        'name' => 'level_name',
        'type' => 'text',
        'label' => "VIP Name"
      ]);

      $this->crud->addColumn([
        'name' => 'start',
        'type' => 'number',
        'label' => "Wager Req. ($)"
      ]);

      $this->crud->addColumn([
        'name' => 'rake_percent',
        'type' => 'number',
        'label' => "Rake (div. 100 in %)"
      ]);

      $this->crud->addColumn([
        'name' => 'promocode_bonus',
        'type' => 'number',
        'label' => "Promocode Bonus (%)"
      ]);

      $this->crud->addColumn([
        'name' => 'faucet_bonus',
        'type' => 'number',
        'label' => "Faucet Bonus (%)"
      ]);

      $this->crud->addColumn([
        'name' => 'fs_bonus',
        'type' => 'number',
        'label' => "Free Spins on Level"
      ]);

      $this->crud->addColumn([
        'name' => 'jackpot_bonus',
        'type' => 'text',
        'label' => "Jackpot Chance (%)"
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
        CRUD::setValidation(ViplevelsCrudRequest::class);

      $this->crud->addField([
        'name' => 'level',
        'type' => 'text',
        'label' => "Level"
      ]);
      $this->crud->addField([
        'name' => 'level_name',
        'type' => 'text',
        'label' => "Level Name"
      ]);

      $this->crud->addField([
        'name' => 'start',
        'type' => 'number',
        'label' => "Wager Requirement ($) to reach this VIP level"
      ]);

      $this->crud->addField([
        'name' => 'rake_percent',
        'type' => 'number',
        'label' => "Rake - divided by 100 in percentage - this amount is added to rake bank"
      ]);

      $this->crud->addField([
        'name' => 'promocode_bonus',
        'type' => 'number',
        'label' => "Promocode Bonus (%)"
      ]);

      $this->crud->addField([
        'name' => 'faucet_bonus',
        'type' => 'number',
        'label' => "Faucet Bonus (%)"
      ]);

      $this->crud->addField([
        'name' => 'fs_bonus',
        'type' => 'number',
        'label' => "Free Spins on Level - check settings tab to select the slotmachines to use free spin"
      ]);

      $this->crud->addField([
        'name' => 'jackpot_bonus',
        'type' => 'number',
        'label' => "Jackpot Extra Chance (%) - this is bonus rate, to change the base value of winning Jackpot, go to Settings tab"
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
