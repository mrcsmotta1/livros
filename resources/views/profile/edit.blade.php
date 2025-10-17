<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">{{ __('Editar Perfil') }}</h2>
    </x-slot>

    <div class="py-2">
        <div class="container">
            <div class="row g-4 justify-content-center">
                {{-- Botão Voltar --}}
                <div class="mb-2 col-12 col-md-8 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><strong>Editar perfil:</strong> {{ $user->name }}</h4>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>Voltar
                    </a>
                </div>

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
