<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">{{ __('Editar Perfil') }}</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="row g-4 justify-content-center">

                {{-- Módulo: Atualizar Perfil --}}
                @include('profile.partials.update-profile-information-form')

                {{-- Módulo: Atualizar Senha --}}
                @include('profile.partials.update-password-form')

                {{-- Módulo: Deletar Conta --}}
                @include('profile.partials.delete-user-form')

            </div>
        </div>
    </div>
</x-app-layout>
