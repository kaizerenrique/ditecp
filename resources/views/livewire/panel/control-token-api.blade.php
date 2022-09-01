<div class="mt-4 mx-4">
    <div class="flex flex-wrap items-center px-4 py-2">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Listado de Tokens para la APIs</h3>
        </div>
        <div class="flex flex-col items-center w-full max-w-xl">            
            <input type="search" wire:model="buscar" placeholder="Buscar" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
        </div>
        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
            <button class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs 
                font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" 
                type="button" wire:click="tokenAdd">Crear Token
            </button>
        </div>
    </div>
    <!-- tabla -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Fecha de Registro</th>
                        <th class="px-4 py-3">Ultima Actividad</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($tokens as $token)
                        <tr class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                {{$token->name}}
                            </td>
                            <td class="px-4 py-3">
                                {{$token->created_at}}
                            </td>
                            <td class="px-4 py-3">
                                @if ($token->last_used_at)
                                    {{ $token->last_used_at->diffForHumans() }}
                                @else
                                    <p>No Usado</p>
                                @endif
                            </td>
                            <td class="px-4 py-3">                              
                                <button class="bg-blue-500 dark:bg-red-700 text-white active:bg-blue-600 dark:text-red-200 
                                    dark:active:text-red-100 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 
                                    ease-linear transition-all duration-150" 
                                    type="button" wire:click="eliminarToken({{ $token->id }})">Eliminar
                                </button>
                            </td>
                            
                        </tr>                                
                    @endforeach
                </tbody>                        
            </table>
        </div>
        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-base uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9
                     dark:text-gray-300 dark:bg-gray-800">
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                {{$tokens->links()}}
            </span>            
        </div>
    </div>
    <!-- \tabla -->

<!-- Inicio del Modal para Registrar token -->
    <x-jet-dialog-modal wire:model="agregarToken">
        <x-slot name="title">
            {{ __('Registrar Token') }}
        </x-slot>
        <x-slot name="content">             
            <div class="flex flex-col">
                <x-jet-label for="name" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Nombre') }}" />
                <x-jet-input id="name" type="text" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="name"/>
                <x-jet-input-error for="name" class="mt-2 bg-gray-100 dark:bg-gray-700 dark:text-white" />                                                     
            </div>
        </x-slot>

        <x-slot name="footer">            
            <x-jet-secondary-button wire:click="$toggle('agregarToken', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            <x-jet-danger-button class="ml-3" wire:click="generarToken()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
<!-- Fin del Modal para Registrar token -->

<!-- Inicio del Modal para ver token de api  -->
<x-jet-dialog-modal wire:model="mostrarTokenApi">
    <x-slot name="title">
        {{ __('Token') }}
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-col">
            <x-jet-label for="token" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Token para la API') }}" />
            <x-jet-input id="token" type="text" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
            dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="token" disabled/>
        </div> 
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('mostrarTokenApi', false)" wire:loading.attr="disabled">
            {{ __('Cerrar') }}
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
<!-- Fin del Modal para ver token de api  -->

<!-- Inicio del Modal para Eliminar token -->
<x-jet-dialog-modal wire:model="eliminatoken">
    <x-slot name="title">
        {{ __('Borrar Token') }}
    </x-slot>
    <x-slot name="content">             
        {{$mensaje}}
    </x-slot>

    <x-slot name="footer">            
        <x-jet-secondary-button wire:click="$toggle('eliminatoken', false)" wire:loading.attr="disabled">
            {{ __('Cerrar') }}
        </x-jet-secondary-button>
        <x-jet-danger-button class="ml-3" wire:click="borrarToken({{$identificador}})" wire:loading.attr="disabled">
            {{ __('Eliminar') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
<!-- Fin del Modal para Eliminar token -->
</div>
