<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Collection $users;
    public Collection $roles;

    public string $user = '';
    public string $role = '';
    public string $email = '';

    public function mount(): void
    {
        $this->getUsers();
        $this->getRoles();
    }

    #[On('user-role-created')]
    public function getUsers(): void
    {
        $this->users = User::orderBy('name')->get();
    }

    public function getRoles(): void
    {
        $this->roles = Role::orderBy('name')
            ->get();
    }

    public function updateUsers(string $partial): void
    {
        if (empty($partial)) {
            $this->getUsers();
        } else {
            $this->users = User::where('name', 'like', '%' . $partial . '%')
                ->orWhere('email', 'like', '%' . $partial . '%')
                ->get();
        }
    }

    public function createUserRole(): void
    {
        $email = preg_match('/<(.*)>/i', $this->user, $matches);

        if (!empty($matches[1])) {
            $user = User::where('email', '=', $matches[1])
                ->get();

            $role = Role::where('name', '=', $this->role)
                ->get();

            $user[0]->syncRoles($role[0]);

            $this->dispatch('user-role-created');

            $this->user = '';
            $this->role = '';
        } else {
            $this->dispatch('error');
        }
    }
}; ?>

<div">
<form wire:submit="createUserRole" class="needs-validation" novalidate autocomplete="off">
    <div class="card custom-card">
        <div class="card-header">
            <h2>Assign a user a role</h2>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-12">
                <div class="col-span-4">
                    <div class="flex justify-between items-center">
                        <label for="user" class="block text-sm font-medium mb-2 dark:text-white">User</label>
                    </div>
                    <input
                        type="text"
                        id="user"
                        wire:model="user"
                        list="users-list"
                        x-on:input="$wire.updateUsers($el.value)"
                        class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                    >
                    <datalist id="users-list">
                        <option></option>
                        @foreach ($users as $user)
                            <option value="{{ $user->name }} <{{ $user->email }}>">{{ $user->name }} <{{ $user->email }}></option>
                        @endforeach
                    </datalist>
                </div>
                <div class="col-span-4">
                    <label for="role" class="block text-sm font-medium mb-2 dark:text-white">Role</label>
                    <select
                        id="role"
                        wire:model="role"
                        class="py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                    >
                        <option></option>
                        @foreach ($roles as $role)
                            <option vlaue="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <x-submit id="role-permission-create"/>
        </div>
    </div>
</form>
</div>
