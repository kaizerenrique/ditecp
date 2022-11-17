<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 p-4 gap-4">
        <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div class="text-right">
                <p class="text-2xl">Registros Totales: {{$registrostotales}}</p>
            </div>
        </div>
        <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div class="text-right">
                <p class="text-2xl">Consultas de USD: {{$usd}}</p>
            </div>
        </div>
        <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div class="text-right">
                <p class="text-2xl">Consultas del CNE: {{$cne}}</p>
            </div>
        </div>
        <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div class="text-right">
                <p class="text-2xl">Consulta de Pensionados: {{$pensionadoIVSS}}</p>
            </div>
        </div>
        <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div class="text-right">
                <p class="text-2xl">Consulta de Cuentas Individuales: {{$individualIVSS}}</p>
            </div>
        </div>
        <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div class="text-right">
                <p class="text-2xl">Whatsapp Enviados: {{$whatsapp}}</p>
            </div>
        </div>
    </div>

    <div class="p-4 gap-4">
        <!-- informacion del token -->
        <div class="relative flex flex-col min-w-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
            <div class="rounded-t mb-0 px-0 border-0">
                <div class="flex flex-wrap items-center px-4 py-2">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                      <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Información del tokens</h3>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle 
                                border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 
                                border-r-0 whitespace-nowrap font-semibold text-left">Propietario</th>

                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle 
                                border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 
                                border-r-0 whitespace-nowrap font-semibold text-left">Nombre</th>

                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle 
                                border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 
                                border-r-0 whitespace-nowrap font-semibold text-left">Atributos</th>

                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle 
                                border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 
                                border-r-0 whitespace-nowrap font-semibold text-left">Ultima Actividad</th>

                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle 
                                border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 
                                border-r-0 whitespace-nowrap font-semibold text-left">Vencimiento</th>
                            </tr>
                          </thead>
                          <tbody>                            
                            @foreach ($infotokens as $infotoken )
                                <tr class="text-gray-700 dark:text-gray-100">
                                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                        @foreach ($usuarios as $usuario)
                                            @if ($usuario->id == $infotoken->tokenable_id)
                                                {{$usuario->name}}
                                            @endif                                           
                                        @endforeach  
                                    </th>
                                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                        {{$infotoken->name}}
                                    </th>
                                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                        {{$infotoken->abilities}}                                 
                                    </th>
                                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        @if ($infotoken->last_used_at)
                                            {{ \Carbon\Carbon::parse($infotoken->last_used_at)->diffForHumans()}} 
                                        @else
                                            <p>No Usado</p>
                                        @endif                                        
                                    </td>
                                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        @if ($infotoken->expires_at)
                                            {{ \Carbon\Carbon::parse($infotoken->expires_at )->diffForHumans()}}
                                        @else
                                            <p>No Definido</p>
                                        @endif                                        
                                    </td>
                                </tr>                            
                            @endforeach                  
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--\ informacion del token -->
    </div>
</div>
