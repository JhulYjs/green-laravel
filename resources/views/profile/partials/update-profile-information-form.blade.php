<section class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sm:p-8">
    <header class="mb-8">
        <div class="flex items-center space-x-3 mb-4">
            <div class="p-3 bg-gray-100 rounded-lg">
                <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900">
                Información del Perfil
            </h2>
        </div>

        <p class="text-sm text-gray-600 leading-relaxed">
            Actualiza la información de tu perfil y dirección de email.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Nombre Completo -->
        <div>
            <x-input-label for="nombre_completo" value="Nombre Completo" class="text-base font-medium text-gray-700" />
            <x-text-input 
                id="nombre_completo" 
                name="nombre_completo" 
                type="text" 
                class="mt-2 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-200" 
                :value="old('nombre_completo', $user->nombre_completo)" 
                required 
                autofocus 
                autocomplete="nombre_completo"
            />
            <x-input-error class="mt-2" :messages="$errors->get('nombre_completo')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" class="text-base font-medium text-gray-700" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="mt-2 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-200" 
                :value="old('email', $user->email)" 
                required 
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <!-- Verificación de Email -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-4">
                    <div class="flex items-center space-x-2 mb-3">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <p class="text-sm font-medium text-yellow-800">
                            Tu dirección de email no está verificada.
                        </p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row items-center gap-3">
                        <button form="send-verification" class="inline-flex items-center justify-center px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Reenviar verificación
                        </button>
                        
                        @if (session('status') === 'verification-link-sent')
                            <div class="flex items-center space-x-2 bg-green-50 text-green-700 px-3 py-2 rounded-lg border border-green-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-sm font-medium">Nuevo enlace enviado</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Botones de Acción -->
        <div class="flex flex-col sm:flex-row items-center gap-4 pt-6 border-t border-gray-200">
            <x-primary-button class="w-full sm:w-auto justify-center px-6 py-3 text-base font-medium bg-blue-600 hover:bg-blue-700 transition duration-200">
                Guardar Cambios
            </x-primary-button>

            <!-- Mensaje de Confirmación -->
            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center space-x-2 bg-green-50 text-green-700 px-4 py-3 rounded-lg border border-green-200"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19-7"/>
                    </svg>
                    <span class="font-medium text-sm">¡Cambios guardados exitosamente!</span>
                </div>
            @endif
        </div>
    </form>
</section>
<!-- Cambio de estilos por Joha -->
