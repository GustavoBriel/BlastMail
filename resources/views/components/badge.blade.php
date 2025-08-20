@props([
    'danger' => null,
    'warning' => null,
    ])


<span {{$attributes->class([
    'rounded-xl w-fit border border-danger bg-danger px-2 py-1 text-xs font-medium text-on-danger dark:border-danger dark:bg-danger dark:text-on-danger',
    'bg-red-500' => $danger,
    'bg-amber-500' => $warning,
    
    ]) }}>

    
    {{ $slot }}

</span>