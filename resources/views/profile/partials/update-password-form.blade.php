<section class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sm:p-8">
    <header class="mb-8">
        <div class="flex items-center space-x-3 mb-4">
            <div class="p-3 bg-gray-100 rounded-lg">
                <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900">
                Actualizar Contraseña
            </h2>
        </div>

        <p class="text-sm text-gray-600 leading-relaxed">
            Asegúrate de que tu cuenta use una contraseña larga y aleatoria para mantenerla segura.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Contraseña Actual" class="text-base font-medium text-gray-700" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-2 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-200" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Nueva Contraseña" class="text-base font-medium text-gray-700" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-2 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-200" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Confirmar Contraseña" class="text-base font-medium text-gray-700" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-2 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-200" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4 pt-6 border-t border-gray-200">
            <x-primary-button class="w-full sm:w-auto justify-center px-6 py-3 text-base font-medium bg-blue-600 hover:bg-blue-700 transition duration-200">
                Guardar Cambios
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center space-x-2 bg-green-50 text-green-700 px-4 py-3 rounded-lg border border-green-200"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="font-medium text-sm">¡Contraseña actualizada exitosamente!</span>
                </div>
            @endif
        </div>
    </form>
</section>