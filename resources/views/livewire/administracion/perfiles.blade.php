<div>
    <div class="grid grid-cols-1 lg:grid-cols-3 p-4 gap-4">
        <!-- informacion de perfil -->
        <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
            <div class="relative max-w-md mx-auto md:max-w-2xl mt-6 min-w-0 break-words w-full mb-6 mt-10 p-4 ">
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full flex justify-center">
                            <div class="relative">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <div class="relative">
                                        <img class="h-32 w-32 rounded-full object-cover" src="{{ $usuario->profile_photo_url }}" alt="{{ $usuario->name }}" />
                                    </div>                              
                                @else
                                    <div class="relative">
                                        {{ $usuario->name }}
    
                                        <svg class="ml-2 -mr-0.5 h-32 w-32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>                                        
                                    </div>
                                @endif                              
                            </div>
                        </div>
                        <div class="w-full text-center mt-10">
                            <div class="flex justify-center lg:pt-4 pt-8 pb-0">
                                <div class="p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-slate-200">{{$usuario->tokens()->count()}}</span>
                                    <span class="text-sm text-slate-400">Generados</span>
                                </div>
                                <div class="p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-slate-200">{{$usuario->parametro->limite}}</span>
                                    <span class="text-sm text-slate-400">Limite</span>
                                </div>
            
                                <div class="p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-slate-200">{{$usuario->parametro->limite - $usuario->tokens()->count()}}</span>
                                    <span class="text-sm text-slate-400">Restantes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <h3 class="text-2xl text-slate-200 font-bold leading-normal mb-1">{{$usuario->name}}</h3>
                        <span class="text-xl text-slate-200">{{$usuario->email}}</span>                       
                    </div>
                </div>
            </div>
        </div>
        <!-- /informacion de perfil -->
        <!-- ultimos registros -->
        <div class="relative flex flex-col min-w-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
            <div class="rounded-t mb-0 px-0 border-0">
                <div class="flex flex-wrap items-center px-4 py-2">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                      <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Actividades Recientes</h3>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                              <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle 
                              border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 
                              border-r-0 whitespace-nowrap font-semibold text-left">Nombre</th>
                              <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle 
                              border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 
                              border-r-0 whitespace-nowrap font-semibold text-left">Actividad</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($tokenslis as $tokensli )
                                <tr class="text-gray-700 dark:text-gray-100">
                                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                        {{$tokensli->name}}
                                    </th>
                                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        @if ($tokensli->last_used_at)
                                            {{$tokensli->last_used_at->diffForHumans()}}
                                        @else
                                            <p>No Usado</p>
                                        @endif
                                    </td>
                                </tr>                            
                            @endforeach                        
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /ultimos registros -->
        <!-- servicios -->
        <div class="relative flex flex-col min-w-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
            
        </div>
        <!-- /servicios -->
    </div>
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
                type="button" >Crear Token
            </button>
        </div>
    </div>

    <!-- tabla -->
    <div class="mt-4 mx-4">
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Fecha de Registro</th>
                            <th class="px-4 py-3">Ultima Actividad</th>
                            <th class="px-4 py-3">Vencimiento</th>
                            <th class="px-4 py-3">Atributos</th>
                            <th class="px-4 py-3">Acciones</th>
                            <th class="px-4 py-3">WhatsApp</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($tokens as $token)
                            <tr class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <a href="{{route('informaciontoken',$token->id)}}">
                                        {{$token->name}}
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    {{$token->created_at}}
                                </td>
                                <td class="px-4 py-3">
                                    @if ($token->last_used_at)
                                        {{ $token->last_used_at->diffForHumans()}}
                                    @else
                                        <p>No Usado</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if ($token->expires_at)
                                        {{ $token->expires_at ->diffForHumans()}}
                                    @else
                                        <p>No Definido</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @foreach ($token->abilities as $abilitie)                                    
                                        {{$abilitie}}                                    
                                    @endforeach                                
                                </td>
                                <td class="px-4 py-3">
                                    <button class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs 
                                    font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" 
                                        type="button" wire:click="editarToken({{$token->id}})">Editar
                                    </button>                             
                                    <button class="bg-blue-500 dark:bg-red-700 text-white active:bg-blue-600 dark:text-red-200 
                                        dark:active:text-red-100 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 
                                        ease-linear transition-all duration-150" 
                                        type="button" wire:click="eliminarToken({{$token->id}})">Eliminar
                                    </button>                                    
                                </td>
                                <td class="px-4 py-3">
                                    @foreach ($token->abilities as $abilitie)                                    
                                        @if ($abilitie == 'WhatsApp' )
                                            <button class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs 
                                            font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" 
                                                type="button" wire:click="agregarWhatsApp({{$token->id}})" >Configuración
                                            </button>
                                            <button class="bg-blue-500 dark:bg-red-700 text-white active:bg-blue-600 dark:text-red-200 
                                                dark:active:text-red-100 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 
                                                ease-linear transition-all duration-150" 
                                                type="button" wire:click="eliminarTokenWhatsApp({{$token->id}})">Eliminar
                                            </button> 
                                        @endif                                   
                                    @endforeach 
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
    </div>    
<!-- \tabla -->

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

    <!-- Inicio del Modal para mensajes alertas-->
    <x-jet-dialog-modal wire:model="modalMensaje">
        <x-slot name="title">
            {{ $titulo }}
        </x-slot>
        <x-slot name="content">             
            {{$mensaje}}
        </x-slot>

        <x-slot name="footer">            
            <x-jet-secondary-button wire:click="$toggle('modalMensaje', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
    <!-- Fin del Modal para mensajes alertas -->

    <!-- Editar token -->
    <x-jet-dialog-modal wire:model="editarTokenModal">
        <x-slot name="title">
            {{ $titulo }}
        </x-slot>
        <x-slot name="content">
            <div class="flex flex-col">
                <x-jet-input id="token_id" type="hidden" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="token_id"/>
                                                                 
            </div>             
            <div class="flex flex-col">
                <x-jet-label for="name" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Nombre del Token') }}" />
                <x-jet-input id="name" type="text" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="name"/>
                <x-jet-input-error for="name" class="mt-2 bg-gray-100 dark:bg-gray-700 dark:text-white" />                                                     
            </div>
            <div class="flex flex-col mt-2">
                <x-jet-label for="rol" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Configuración') }}" />
                <select name="abilities" id="abilities" wire:model.defer="abilities" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                    <option value="" selected>Seleccionar Configuración</option>
                    @foreach ($listadeatributos as $lista)                            
                        <option value="{{ $lista['id'] }}">{{ $lista['atributo'] }}</option>                            
                    @endforeach                                           
                </select>
            </div>            
        </x-slot>

        <x-slot name="footer">            
            <x-jet-secondary-button wire:click="$toggle('editarTokenModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            <x-jet-danger-button class="ml-3" wire:click="guardarcambiodetoken()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
    <!-- Editar token -->

        <!-- Editar token -->
        <x-jet-dialog-modal wire:model="agregarconfigWhatsAppModal">
            <x-slot name="title">
                {{ $titulo }}
            </x-slot>
            <x-slot name="content">
                <div class="flex flex-col">
                    <x-jet-input id="usuario_id" type="hidden" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                    dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="usuario_id"/>
                                                                     
                </div>       
                <div class="flex flex-col">
                    <x-jet-input id="tokenapid" type="hidden" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                    dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="tokenapid"/>
                                                                     
                </div> 

                <div class="flex flex-col mt-2">
                    <x-jet-label for="rol" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Elegir Servicio ') }}" />
                    <select name="servicios_id" id="servicios_id" wire:model.defer="servicios_id" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                    dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                        <option value="" selected>Elegir Servicio </option>
                        @foreach ($servicios as $servicio)                            
                            <option value="{{$servicio->id}}">{{ $servicio->nombre }}</option>                            
                        @endforeach                                           
                    </select>
                </div>                 
                
                <div class="flex flex-col">
                    <x-jet-label for="token" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Token de WhatsApp') }}" />
                    <x-jet-input id="token" type="text" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                    dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="token"/>
                    <x-jet-input-error for="token" class="mt-2 bg-gray-100 dark:bg-gray-700 dark:text-white" />                                                     
                </div>

                <div class="flex flex-col">
                    <x-jet-label for="uri" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('URI de WhatsApp') }}" />
                    <x-jet-input id="uri" type="text" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                    dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="uri"/>
                    <x-jet-input-error for="uri" class="mt-2 bg-gray-100 dark:bg-gray-700 dark:text-white" />                                                     
                </div>

                <div class="flex flex-col">
                    <x-jet-label for="id_wha_buss" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Identificador de la cuenta de WhatsApp Business') }}" />
                    <x-jet-input id="id_wha_buss" type="text" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                    dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="id_wha_buss"/>
                    <x-jet-input-error for="id_wha_buss" class="mt-2 bg-gray-100 dark:bg-gray-700 dark:text-white" />                                                     
                </div>

                <div class="flex flex-col">
                    <x-jet-label for="id_tlf_buss" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Identificador de número de teléfono') }}" />
                    <x-jet-input id="id_tlf_buss" type="text" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                    dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="id_tlf_buss"/>
                    <x-jet-input-error for="id_tlf_buss" class="mt-2 bg-gray-100 dark:bg-gray-700 dark:text-white" />                                                     
                </div>

                <div class="flex flex-col">
                    <x-jet-label for="telefono_comercial" class="bg-gray-100 dark:bg-gray-700 dark:text-white" value="{{ __('Nro Telefono') }}" />
                    <x-jet-input id="telefono_comercial" type="text" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 
                    dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" wire:model.defer="telefono_comercial"/>
                    <x-jet-input-error for="telefono_comercial" class="mt-2 bg-gray-100 dark:bg-gray-700 dark:text-white" />                                                     
                </div>
                          
            </x-slot>
    
            <x-slot name="footer">            
                <x-jet-secondary-button wire:click="$toggle('agregarconfigWhatsAppModal', false)" wire:loading.attr="disabled">
                    {{ __('Cerrar') }}
                </x-jet-secondary-button>
                <x-jet-danger-button class="ml-3" wire:click="guardarconfigWhatsApp()" wire:loading.attr="disabled">
                    {{ __('Guardar') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
        <!-- Editar token -->
</div>