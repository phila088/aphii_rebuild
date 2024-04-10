<x-app-layout>
    @section('styles')

    @endsection
    @section ('title')
        Dashboard
    @endsection
    @section('content')
        <div class="card custom-card w-1/4">
            <div class="card-header">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-500">
                    Featured
                </p>
            </div>
            <div class="p-4 md:p-5">
                <p class="card-body">
                    With supporting text below as a natural lead-in to additional content.
                </p>
            </div>
        </div>
    @endsection
</x-app-layout>
