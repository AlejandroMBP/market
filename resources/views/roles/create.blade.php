<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear rol
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div>
                <div>
                    <form method="POST" action="">
                        @include('roles.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
