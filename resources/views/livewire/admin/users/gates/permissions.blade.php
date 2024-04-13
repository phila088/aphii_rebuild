<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Collection as StdCollection;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

new class extends Component {
    public StdCollection $models;
    public array $actions;
    public bool $status;
    public array $permissions;

    public function mount(): void
    {
        $this->models = $this->getModels();

        $this->actions = (__('selects.actions'));

        $this->buildPermissionsArray();

        $this->getStatus();
    }

    public function buildPermissionsArray(): void
    {
        foreach ($this->models as $model) {
            foreach ($this->actions as $action) {
                $this->permissions[] = Str::plural(Str::camel($model)) . '.' . $action;
            }
        }
    }

    #[On('permissions-rebuilt')]
    public function getStatus(): void
    {
        $status = null;

        foreach ($this->permissions as $permission) {
            $status = Permission::where('name', '=', $permission)->exists();

            if (!$status) break;
        }

        $this->status = $status;
    }

    public function fixPermissions(): void
    {
        DB::table('permissions')->delete();

        foreach($this->permissions as $permission) {

            Permission::updateOrCreate(['name' => $permission]);
        }

        $this->dispatch('permissions-rebuilt');
    }

    function getModels(): StdCollection
    {
        $models = collect(File::allFiles(app_path()))
            ->map(function ($item) {
                $path = $item->getRelativePathName();
                return sprintf('\%s%s',
                    Container::getInstance()->getNamespace(),
                    strtr(substr($path, 0, strrpos($path, '.')), '/', '\\'));
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
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="flex justify-between items-center w-full">
                <h2>Permissions status</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="tw-w-full">
                <div class="tw-flex tw-justify-between">
                    <p class="tw-font-bold">Status: </p>
                    @if($status)
                        <p class="tw-text-green-500 tw-font-bold">Ok!</p>
                    @else
                        <p class="tw-text-red-500 tw-font-bold">Error!</p>
                    @endif
                </div>
                <div class="tw-flex tw-justify-between">
                    <p class="tw-font-bold">Records: </p>
                    <p class="tw-font-bold">{{ Permission::count() }} / {{ count($permissions) }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer tw-flex tw-justify-end">
            <button type="button" wire:click.prevent="fixPermissions" class="btn-red btn-sm rounded-md disabled:bg-red-200/75 disabled:hover:bg-red-200/85" @if(Permission::count() === count($permissions)) disabled @endif>Fix permissions</button>
        </div>
    </div>
    <div class="card custom-card">
        <div class="card-header">
            <h2>
                All permissions
            </h2>
        </div>
        <div class="card-body">
            <livewire:permission-table />
        </div>
    </div>
</div>
