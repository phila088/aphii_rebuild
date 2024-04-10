<x-app-layout>
    @section('styles')

    @endsection
    @section ('title')
        {{ __('Dashboard') }}
    @endsection
    @section ('breadcrumbs')
        <ol class="flex items-center whitespace-nowrap">
            <li class="inline-flex items-center text-xs font-semibold text-gray-50 truncate dark:!text-slate-800" aria-current="page">
                {{ __('Dashboard') }}
            </li>
        </ol>
    @endsection
    @section('content')
        <div class="card custom-card w-full xl:w-1/4">
            <div class="card-header">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-500">
                    Featured
                </p>
            </div>
            <div class="card-body">
                    With supporting text below as a natural lead-in to additional content.
            </div>
        </div>
    @endsection
</x-app-layout>
