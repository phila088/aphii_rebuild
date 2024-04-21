<?php

use App\Models\Company;
use Livewire\WithFileUploads;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

new class extends Component {
    use WithFileUploads;

    public Company $company;

    public ?Collection $companies = null;

    public ?int $parent_id = null;
    #[Validate('required|string|min:2|max:50|unique:companies,name,NULL,NULL,id,NULL')]
    public string $name = '';
    #[Validate('nullable|string|min:2|max:50')]
    public string $dba = '';
    #[Validate('required|string|min:1|max:10')]
    public string $abbreviation = '';
    #[Validate('nullable|string')]
    public string $iwo_prefix = '';
    #[Validate('nullable|int|min:1|max:10')]
    public ?int $iwo_max_length = null;
    #[Validate('nullable|int|min:1|max:999')]
    public ?int $iwo_postfix_increment = null;
    #[Validate('nullable|image|max:5120')]
    public $photo;
    #[Validate('nullable|string')]
    public $logo_path;

    public function mount(): void
    {
        $this->parent_id = $this->company->parent_id;
        $this->name = $this->company->name;
        $this->dba = $this->company->dba;
        $this->abbreviation = $this->company->abbreviation;
        $this->iwo_prefix = $this->company->iwo_prefix;
        $this->iwo_max_length = $this->company->iwo_max_length;
        $this->iwo_postfix_increment = $this->company->iwo_postfix_increment;
        $this->logo_path = $this->company->logo_path;

        $this->getCompanies();
    }

    public function getCompanies(): void
    {
        $this->companies = Company::get();
    }

    public function update()
    {
        $this->authorize('companies.edit');

        if ($this->iwo_max_length === null || $this->iwo_max_length === '') {
            $this->iwo_max_length = 6;
        }

        if ($this->iwo_postfix_increment === null || $this->iwo_postfix_increment === '') {
            $this->iwo_postfix_increment = 10;
        }

        $validated = $this->validate();

        if ($this->company->update($validated)) {

            if (!empty($this->photo)) {
                $path = 'public/brand-logos';
                $path = 'storage/' . $this->photo->storePublicly(path: $path);
                $path = str_replace('public/', '', $path);
                $this->company->forceFill([
                    'logo_path' => $path
                ])->save();
            }

            $this->dispatch('company-edit');
        }
    }
}; ?>

<div>
    <form wire:submit="update">
        <div class="card custom-card">
            <div class="card-body">
                <div class="form-grid">
                    <div class="cols-3">
                        <label for="parent_id" class="input-label">Parent company</label>
                        <select id="parent_id" wire:model="parent_id" class="input">
                            <option></option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cols-3">
                        <x-input id="name" model="name" label="Name" />
                    </div>
                    <div class="cols-3">
                        <x-input id="dba" model="dba" label="DBA" />
                    </div>
                    <div class="cols-3">
                        <x-input id="abbreviation" model="abbreviation" label="abbreviation" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <div class="form-grid">
                    <div class="col-span-12">
                        <dl>
                            <dl>You can control the internal work order number that is generated automatically.</dl>
                            <dt>Prefix</dt>
                            <dl>The prefix added before an internal work order number. This can be useful if you are running
                                multiple brands.
                            </dl>
                            <dt>Length</dt>
                            <dl>
                                This is the total length of work order number. When you enter a work order number, the system will
                                automatically truncate the last x characters of the work order numbers of the work order number
                                entered,
                                where x is the number entered below, or 6 by default.
                            </dl>
                            <dt>Postfix increment</dt>
                            <dl>
                                As a work order is assigned, and reassigned, the system will automatically append a postfix. You can
                                control the increment of the postfix here.
                            </dl>
                        </dl>
                    </div>
                    <div class="cols-2">
                        <x-input id="iwo-prefix" model="iwo_prefix"
                                 label="Prefix" />
                    </div>
                    <div class="cols-2">
                        <x-input id="iwo-max-length" model="iwo_max_length" live="false"
                                 label="Length" x-mask="99" />
                    </div>
                    <div class="cols-2">
                        <x-input id="iwo-postfix-increment"
                                 model="iwo_postfix_increment"
                                 label="Increment"
                                 x-mask="999"
                                 wire:ignore.self
                        />
                    </div>
                    <div class="col-span-12" wire:ignore>
                        <p class="font-bold">Example: </p>
                        <p><span class="semibold">Input: </span><span id="example-work-order-input"></span></p>
                        <p><span class="semibold">Output: </span><span id="example-work-order-output"></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <div class="col-span-12 lg:col-span-12 mb-3">
                    <div
                        class="pb-2 flex items-center text-xs text-gray-400 uppercase before:flex-[1_1_0%] before:border-t before:border-gray-200 before:me-6 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-gray-500 dark:before:border-gray-600 dark:after:border-gray-600">
                        Current logo
                    </div>
                    <div class="flex items-center justify-center w-full">
                        <div
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <span
                                class="w-full h-full bg-contain bg-no-repeat bg-center inline-block"
                                x-bind:style="'background-image: url(\'{{ asset($logo_path) }}\');'"
                                id="logo-preview"
                            >
                            </span>
                        </div>
                    </div>
                </div>
                <div
                    class="form-grid"
                    x-data="{
                            upload: false,
                            photoName: null,
                            photoPreview: null,
                            uploading: false,
                            progress: 0
                        }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="
                            uploading = false
                        "
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <!-- Dropzone and input -->
                    <div class="col-span-12 lg:col-span-6">
                        <div
                            class="pb-2 flex items-center text-xs text-gray-400 uppercase before:flex-[1_1_0%] before:border-t before:border-gray-200 before:me-6 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-gray-500 dark:before:border-gray-600 dark:after:border-gray-600">
                            Logo upload
                        </div>
                        <div id="droparea" class="flex items-center justify-center w-full">
                            <label for="photo"
                                   class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
                                </div>
                                <input
                                    type="file"
                                    id="photo"
                                    class="hidden"
                                    accept="image/*"
                                    wire:model.live="photo"
                                    x-ref="photo"
                                    x-on:change="
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.photo.files[0]);

                                            upload = true;
                                        "
                                />
                            </label>
                        </div>
                    </div>

                    <!-- Previewer -->
                    <div class="col-span-12 lg:col-span-6">
                        <div
                            class="pb-2 flex items-center text-xs text-gray-400 uppercase before:flex-[1_1_0%] before:border-t before:border-gray-200 before:me-6 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-gray-500 dark:before:border-gray-600 dark:after:border-gray-600">
                            Logo preview
                        </div>
                        <div class="flex items-center justify-center w-full">
                            <div
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div x-show="uploading" class="">
                                    <div class="progress" role="progressbar" aria-label="Upload progress" aria-valuenow="0"
                                         aria-valuemin="0" aria-valuemax="100">
                                        <progress class="progress-bar" max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                <span
                                    x-bind:class="(progress === 100 && !uploading) ? 'inline-block' : 'hidden'"
                                    class="w-full h-full bg-contain bg-no-repeat bg-center"
                                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
                                    id="logo-preview"
                                >
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="company-create" />
            </div>
        </div>
    </form>
    @script
    <script>
        const e = document.querySelector("#droparea"), a = document.querySelector("#photo");

        function u(e) {
            e.preventDefault(), e.stopPropagation()
        }

        e.addEventListener("drop", (e => {
            a.files = e.dataTransfer.files, a.dispatchEvent(new Event("change")), e.preventDefault()
        })), ["dragenter", "dragover", "dragleave"].forEach((t => {
            e.addEventListener(t, u, !1)
        }));

        const iwoPrefix = document.querySelector("#iwo-prefix"),
            iwoMaxLength = document.querySelector("#iwo-max-length"),
            iwoPostfixIncrement = document.querySelector("#iwo-postfix-increment"),
            iwoExampleInput = document.querySelector("#example-work-order-input"),
            iwoExampleOutput = document.querySelector("#example-work-order-output");
        let iwoText = "123456789";
        iwoExampleInput.innerText = iwoText, iwoExampleOutput.innerText = iwoPrefix.value + iwoText.substring(iwoText.length - ("" !== iwoMaxLength.value && 0 !== iwoMaxLength.value ? iwoMaxLength.value : 6), iwoText.length) + "-" + ("" !== iwoPostfixIncrement.value && 0 !== iwoPostfixIncrement.value ? iwoPostfixIncrement.value : 10), [iwoPrefix, iwoMaxLength, iwoPostfixIncrement].forEach((e => {
            e.addEventListener("change", (() => {
                iwoExampleOutput.innerText = iwoPrefix.value + iwoText.substring(iwoText.length - ("" !== iwoMaxLength.value && 0 !== iwoMaxLength.value ? iwoMaxLength.value : 6), iwoText.length) + "-" + ("" !== iwoPostfixIncrement.value && 0 !== iwoPostfixIncrement.value ? iwoPostfixIncrement.value : 10)
            }))
        }));

    </script>
    @endscript
</div>
