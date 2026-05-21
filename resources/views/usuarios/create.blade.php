<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear usuario
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{route('usuarios.store')}}">
                        @csrf
                        @include('usuarios.form', ['textoBoton' => 'Guardar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
