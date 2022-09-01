<div class="md:col-span-1 flex justify-between">
    <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium bg-gray-100 dark:bg-gray-700 dark:text-white">{{ $title }}</h3>

        <p class="mt-1 text-sm bg-gray-100 dark:bg-gray-700 dark:text-white ">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
