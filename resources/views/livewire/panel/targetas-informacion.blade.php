<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 p-4 gap-4">
    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div class="text-right">
            <p class="text-2xl">{{$usd}}</p>
            <p>BCV</p>
        </div>
    </div>
    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
        </div>
        <div class="text-right">
            <p class="text-2xl">{{$tokensNumero}}</p>
            <p>Tokens Generados</p>
        </div>
    </div>
    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <div class="text-right">
            <p class="text-2xl">{{$tokensTotales}}</p>
            <p>Total Tokens Disponibles</p>
        </div>
    </div>
    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l3.182-5.511m-3.182 5.51l-5.511-3.181" />
            </svg>
        </div>
        <div class="text-right">
            <p class="text-2xl">{{$tokensRestantes}}</p>
            <p>Tokens Restantes</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 p-4 gap-4">
    <!-- ultimas conexiones -->
    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
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
    <!-- /ultimas conexiones -->
    <!-- ultimos registros -->
    <div class="relative flex flex-col min-w-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
        <div class="rounded-t mb-0 px-0 border-0">
            <div class="flex flex-wrap items-center px-4 py-2">
                <div class="relative w-full max-w-full flex-grow flex-1">
                  <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Pasivos</h3>
                </div>
            </div>
            <div class="block w-full">
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
                        @foreach ($tokenslis2 as $tokensli2 )
                            <tr class="text-gray-700 dark:text-gray-100">
                                <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    {{$tokensli2->name}}
                                </th>
                                <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    @if ($tokensli2->last_used_at)
                                        {{ $tokensli2->last_used_at->diffForHumans() }}
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
    <!-- ultimos registros -->
    <div class="relative flex flex-col min-w-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
        <div class="rounded-t mb-0 px-0 border-0">
            <div class="flex flex-wrap items-center px-4 py-2">
                <div class="relative w-full max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Ultimas consultas</h3>
                </div>
            </div>
            <div class="block w-full">
                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                        <tr>
                            <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle 
                            border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 
                            border-r-0 whitespace-nowrap font-semibold text-left">Función</th>
                            <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle 
                            border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 
                            border-r-0 whitespace-nowrap font-semibold text-left">Actividad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registros as $registro )
                            <tr class="text-gray-700 dark:text-gray-100">                                                                
                                <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    {{$registro->operacion}}                                                                          
                                </th> 
                                <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    {{ \Carbon\Carbon::parse($registro->created_at)->diffForHumans() }}                                                                        
                                </th>                                   
                            </tr>                            
                        @endforeach                        
                    </tbody>
                </table>                
            </div>
        </div>
    </div>
    <!-- /ultimos registros -->
</div>  
