<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Email List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                     @unless ($emailLists->isEmpty())
                        <x-table :headers="[ '#', __('Email List'), __('Subscribers'), __('Actions'),
                             
                            
                            ]">


                            <x-slot name="body">
                                @foreach ($emailLists as $list)
                                    <tr>
                                        <x-table.td> {{ $list->id}} </x-table.td>
                                        <x-table.td> {{ $list->title}} </x-table.td>
                                        <x-table.td> {{ $list->subscribers()->count() }} </x-table.td>
                                    </tr>
                                @endforeach

                            </x-slot>

                        </x-table>
                        
                        @else
                            <div class="flex justify-center">
                                <x-link-button :href="route('email-list.create')">
                                    {{__('Crie sua primeira lista de email aqui!')}}
                                </x-link-button>
                            </div>
                        
                    @endunless
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
