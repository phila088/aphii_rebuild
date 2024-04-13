@props(['id' => 'default'])
<div class="flex justify-between">
    <div class="flex justify-center items-center">

    </div>
    <div style="tw-flex tw-justify-start">
        <button type="submit" id="save-{{ $id }}" class="btn-green btn-sm mx-0.5 rounded">
            Save
            <i class="fe fe-save"></i>
        </button>
        <button class="btn-red btn-sm rounded" wire:click.prevent="cancel">
            Cancel
            <i class="bi bi-x-octagon"></i>
        </button>
    </div>
</div>
