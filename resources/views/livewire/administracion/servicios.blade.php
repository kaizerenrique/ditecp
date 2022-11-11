<div>
    <div class="mt-4 mx-4">
        <div class="flex flex-wrap items-center px-4 py-2">
            <div class="relative w-full max-w-full flex-grow flex-1">
              <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Listado de usuarios Registrados</h3>
            </div>
            <div class="flex flex-col items-center w-full max-w-xl">            
                <input type="search" wire:model="buscar" placeholder="Buscar" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
            </div>
            <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                <button class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs 
                    font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" 
                    type="button" wire:click="servicioAdd">Nuevo Servicio
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
                            <th class="px-4 py-3">Tipo</th>
                            <th class="px-4 py-3">Costo</th>
                            <th class="px-4 py-3">Moneda</th>  
                            <th class="px-4 py-3">Descripción</th>                            
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($servicios as $servicio )
                            <tr class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">                                
                                <td class="px-4 py-3">
                                    {{$servicio->nombre}}
                                </td>
                                <td class="px-4 py-3">
                                    {{$servicio->tipo}}
                                </td>
                                <td class="px-4 py-3">
                                    {{$valor = round($servicio->costo , 3);}} <!-- Reduce los decimales a mostrar -->
                                </td>
                                <td class="px-4 py-3">
                                    {{$servicio->moneda}}
                                </td>
                                <td class="px-4 py-3">
                                    {{$servicio->descrip}}
                                </td> 
                                <td class="px-4 py-3">
                                    <button class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs 
                                    font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" 
                                        type="button" >Editar
                                    </button>                              
                                    <button class="bg-blue-500 dark:bg-red-700 text-white active:bg-blue-600 dark:text-red-200 
                                        dark:active:text-red-100 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 
                                        ease-linear transition-all duration-150" 
                                        type="button" >Eliminar
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
                    {{$servicios->links()}}
                </span>            
            </div>
        </div>
    <!-- \tabla -->
    </div>
    
    <!-- Inicio del Modal para Registrar usuario -->
    <x-jet-dialog-modal wire:model="modalAgregarServicio">
        <x-slot name="title">
            {{ __('Registrar Servicio') }}
        </x-slot>
        <x-slot name="content"> 
            <div class="flex flex-col">
                <x-jet-label for="nombre" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Nombre') }}" />
                <x-jet-input id="nombre" type="text" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="nombre"/>
                <x-jet-input-error for="nombre" class="mt-2 bg-gray-100 dark:bg-gray-700 dark:text-white" />                                                     
            </div>
            <div class="flex flex-col mt-2">
                <x-jet-label for="tipo" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Tipo de Servicio ') }}" />
                <select name="tipo" id="tipo" wire:model.defer="tipo" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                    <option value="" selected>Seleccionar Tipo de Servicio </option>
                    <option value="Apis">Apis</option>
                    <option value="Web">Web</option>
                </select>
            </div>
            <div class="flex flex-col">
                <x-jet-label for="costo" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Costo') }}" />
                <x-jet-input id="costo" type="number" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="costo"/>
                <x-jet-input-error for="costo" class="mt-2 bg-gray-100 dark:bg-gray-700 dark:text-white" />                                                     
            </div>
            <div class="flex flex-col mt-2">
                <x-jet-label for="moneda" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Moneda') }}" />
                <select name="moneda" id="moneda" wire:model.defer="moneda" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                    <option value="" selected>Seleccionar una Moneda </option>
                    <option value="BS">BS</option>
                    <option value="UDS">USD</option>
                </select>
            </div>
            <div class="flex flex-col">
                <x-jet-label for="descrip" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Descripción') }}" />
                <x-jet-input id="descrip" type="text" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="descrip"/>
                <x-jet-input-error for="descrip" class="mt-2 bg-gray-100 dark:bg-gray-700 dark:text-white" />                                                     
            </div>
        </x-slot>    
        <x-slot name="footer">            
            <x-jet-secondary-button wire:click="$toggle('modalAgregarServicio', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            <x-jet-danger-button class="ml-3" wire:click="guardarServicio()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
<!-- Fin del Modal para Registrar usuario -->
</div>
