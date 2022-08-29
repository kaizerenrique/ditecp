<div class="mt-4 mx-4">
    <div class="flex flex-wrap items-center px-4 py-2">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Listado de Tokens para la APIs</h3>
        </div>
        <div class="bg-white rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm border border-gray-200">
            <button class="outline-none focus:outline-none">
              <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
            <input type="search" name="" id="" placeholder="Search" class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent">
        </div>
        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
            <button class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs 
                font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" 
                type="button">Crear Token
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
                                <button class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs 
                                    font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" 
                                    type="button">Ver Token
                                </button>                                
                                <button class="bg-blue-500 dark:bg-red-700 text-white active:bg-blue-600 dark:text-red-200 
                                    dark:active:text-red-100 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 
                                    ease-linear transition-all duration-150" 
                                    type="button">Eliminar
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
                {{$tokens->links('pagination::tailwind')}}
            </span>            
        </div>
    </div>
    <!-- \tabla -->
</div>