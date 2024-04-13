<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

new class extends Component {
    public $roles;
    public $permissions;

    public Collection $models;

    public string $model = '';
    public string $action = '';
    public string $search = '%';

    public $values = [];
    public $actions = [];
    public bool $no_permissions = false;

    public function mount(): void
    {
        $this->getRoles();
        $this->getPermissions();
        $this->models = $this->getModels();

        $this->actions = (__('selects.actions'));

        $this->getRolePermissions();
    }

    public function createRolePermission(): void
    {
        $this->authorize('rolepermission.create');

        foreach ($this->values as $kp => $vp) {
            $role = $kp;
            $obj = Role::select('id')->where('name', '=', $kp)->limit(1)->get();
            $roleId = $obj[0]->id;

            foreach ($vp as $kc => $vc) {
                $model = $kc;

                foreach ($vc as $kgc => $vgc) {
                    $action = $kgc;

                    $objGc = Permission::select('id')->where('name', '=', Str::camel($model) . '.' . $action)->limit(1)->get();
                    $permId = $objGc[0]->id;

                    if ($vgc) {
                        DB::table('role_has_permissions')->insertOrIgnore(['permission_id' => $permId, 'role_id' => $roleId]);
                    } else {
                        if (DB::table('role_has_permissions')->where('role_id', $roleId)->where('permission_id', $permId)->exists()) {
                            DB::table('role_has_permissions')->where('role_id', $roleId)->where('permission_id', $permId)->delete();
                        }
                    }
                }
            }
        }

        $this->dispatch('roles-permission-created');
    }

    #[On('roles-permission-created')]
    #[On('permission-created')]
    #[On('role-created')]
    public function getRolePermissions(): void
    {
        foreach ($this->roles as $role) {
            $roleName = $role->name;

            $roleId = $role->id;

            foreach ($this->models as $model) {
                $modelName = $model;

                $modelAsPermission = Str::camel($model);

                foreach ($this->actions as $action) {
                    $permission = $modelAsPermission . '.' . $action;

                    $obj = Permission::select('id')->where('name', '=', $permission)->limit(1)->get();
                    if (!empty($obj[0])) {
                        $permissionId = $obj[0]->id;

                        $rolePermission = DB::table('role_has_permissions')->where('role_id', '=', $roleId)->where('permission_id', '=', $permissionId)->limit(1)->get();

                        if (!empty($rolePermission[0])) {
                            $this->values[$roleName][$modelName][$action] = true;
                        } else {
                            $this->values[$roleName][$modelName][$action] = false;
                        }
                    }
                }
            }
        }
    }

    #[On('role-created')]
    public function getRoles(): void
    {
        $this->roles = Role::orderBy('name')
            ->get();
    }

    #[On('permission-created')]
    public function getPermissions(): void
    {
        $this->permissions = Permission::orderBy('name')
            ->get();
    }

    function getModels(): Collection
    {
        $models = collect(File::allFiles(app_path()))
            ->map(function ($item) {
                $path = $item->getRelativePathName();
                $class = sprintf('\%s%s',
                    Container::getInstance()->getNamespace(),
                    strtr(substr($path, 0, strrpos($path, '.')), '/', '\\'));
                return $class;
            })
            ->filter(function ($class) {
                $valid = false;

                if (class_exists($class)) {
                    $reflection = new \ReflectionClass($class);
                    $valid = $reflection->isSubclassOf(Model::class) &&
                        !$reflection->isAbstract();
                }

                return $valid;
            });

        foreach ($models as $k => $v) {
            $model = substr($v, strrpos($v, '\\') + 1);
            $modelName = Str::plural(Str::camel($model));
            $models[$k] = $modelName;
        }

        return $models->values();
    }

    public function makeSearchString()
    {
        $this->search = $this->makePattern([Str::plural($this->model), $this->action]);
        $this->dispatch('filter-changed');
    }

    private function makePattern($patterns = [])
    {
        $pattern = "";
        foreach ($patterns as $value) {
            $pattern .= (!empty($value) ? $value : '%') . '.';
        }
        return substr($pattern, 0, -1);
    }

    #[On('filter-changed')]
    public function filterPermissions(): void
    {
        $this->permissions = Permission::where('name', 'like', $this->search)
            ->orderBy('name')
            ->get();
    }
};

?>
<div>
    <form wire:submit="createRolePermission" class="needs-validation" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                    <h2>Role permissions</h2>
                </div>
            </div>
            <div class="card-body">
                @if($no_permissions)
                    <x-no-data />
                @else
                    @foreach($roles as $role)
                        @if ($role->name !== 'Super Admin')
                            <div class="card" :key="$role->id">
                                <div class="card-header">
                                    <h1>
                                        {{ $role->name }}
                                    </h1>
                                </div>
                                <div class="card-body">
                                    <table id="admin-role-permissions-create-{{ $role->name }}-table" class="table-fixed text-xs">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="">Model</th>
                                            @foreach($actions as $action)
                                                @if($action === '*')
                                                    <th scope="col" class="" :key="$action">Any</th>
                                                @else
                                                    <th scope="col"
                                                        class="" :key="header-{{ $action }}">{{ ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0', $action)) }}</th>
                                                @endif
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($models as $model)
                                            <tr>
                                                <th scope="row" :key="$model">{{ Str::headline($model) }}</th>
                                                @foreach($actions as $action)
                                                    <td class="" :key="body-{{ $action }}">
                                                        <div class="w-fit mx-auto">
                                                            <input type="checkbox"
                                                                   id="values-{{ $role->name }}-{{ $model }}-{{ $action }}"
                                                                   wire:model="values.{{ $role->name }}.{{ $model }}.{{ $action }}"
                                                                   class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                            />
                                                            <label
                                                                for="values-{{ $role->name }}-{{ $model }}-{{ $action }}"
                                                                class="sr-only">
                                                                testing-{{ $role->name }}-{{ $model }}-{{ $action }}
                                                            </label>
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="card-footer">
                <x-submit id="role-permission-create"/>
            </div>
        </div>
    </form>
</div>
