<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;

class ChangeEmailForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [
        'email' => '',
    ];

    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
    }

    
    /**
     * Update the user's password.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserPasswords  $updater
     * @return void
     */
    public function update(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update(Auth::user(), $this->state);

        $this->state = [
            'email' => '',
        ];

        $this->emit('saved');
    }

    /** 
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty() 
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.profile.change-email-form');
    }
}
