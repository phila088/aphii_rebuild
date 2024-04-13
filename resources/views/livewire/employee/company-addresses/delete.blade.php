<div>
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-700 dark:shadow-slate-700/[.7]">
        <div class="flex justify-between items-center border-b rounded-t-xl py-3 px-4 md:px-5 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                Delete address
            </h3>

            <div class="flex items-center gap-x-1">
                <div class="hs-tooltip inline-block">
                    <button type="button" wire:click="$dispatch('closeModal')" class="hs-tooltip-toggle size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-slate-700" role="tooltip">
                            Close
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="p-4 md:p-5">
            <p class="mb-3 text-gray-500 dark:text-gray-400">
                Are you sure you want to delete this address?
            </p>
            <div class="flex justify-end">
                <button class="btn-green btn-sm rounded mx-1" wire:click="confirmDelete">Yes</button>
                <button class="btn-red btn-sm rounded" wire:click="$dispatch('closeModal')">No</button>
            </div>
        </div>
    </div>
</div>
