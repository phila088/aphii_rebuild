@props(['id' => 'default'])
<div class="flex justify-between">
    <div class="flex justify-center items-center">

    </div>
    <div style="tw-flex tw-justify-start">
        <button type="submit" id="save-{{ $id }}" class="btn-green btn-sm mx-0.5 rounded ">
            Save
            <i class="fe fe-save"></i>
        </button>
        <button type="reset" class="btn-red btn-sm rounded">
            Reset
            <i class="bi bi-arrow-clockwise"></i>
        </button>
    </div>
</div>
