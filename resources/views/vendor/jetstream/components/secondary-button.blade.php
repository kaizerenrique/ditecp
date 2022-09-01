<button {{ $attributes->merge(['type' => 'button', 'class' => 'bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs 
    font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150']) }}>
    {{ $slot }}
</button>
