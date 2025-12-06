<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table class="table-auto w-full">
                    <x-slot name="header">
                        <x-nav-link :href="route('merchant.dashboard')" :active="request()->routeIs('merchant.dashboard')">
                            {{ __('Back to Dashboard') }}
                        </x-nav-link>
                        
                    </x-slot>
                    <thead>
                        <tr>
                            @foreach ($product->getAttributes() as $key => $value)
                                <th class="px-4 py-2">{{ $key }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($product->getAttributes() as $key => $value)
                                <td class="border px-4 py-2">{{ $value }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    


</x-app-layout>
