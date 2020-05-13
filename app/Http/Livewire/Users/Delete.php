<?php

namespace App\Http\Livewire\Users;

use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Delete extends Component
{
    use AuthorizesRequests;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return void
     */
    public function destroy()
    {
        $this->authorize('delete', $this->user);

        $this->user->delete();

        $this->emit('user.deleted', $this->user->id);

        event(new \App\Events\Users\DeletedEvent($this->user));
    }

    /**
     * @param \App\User $user
     * @return void
     */
    public function mount(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('users.delete');
    }
}
