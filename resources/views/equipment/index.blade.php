@extends('dashboard')

@section('content')
    <div class="grid grid-cols-2 gap-6 p-6">
        @foreach($equipment as $item)
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-xl font-bold">{{ $item->name }}</h2>
                <p class="text-gray-600 italic">{{ $item->category }}</p>
                <p class="mt-2">{{ $item->description }}</p>
                <ul class="mt-2 text-sm text-gray-700">
                    @foreach(json_decode($item->stats, true) as $stat => $value)
                        <li>{{ ucfirst($stat) }}: {{ $value }}</li>
                    @endforeach
                </ul>
                <button class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-800">
                    Wield
                </button>
            </div>
        @endforeach
    </div>
@endsection
