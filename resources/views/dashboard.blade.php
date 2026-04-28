<x-app-layout>
    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="ml-64 p-8">
        <h1 class="text-3xl font-bold mb-6">Welcome, Human</h1>
        @yield('content')
    </main>
</x-app-layout>
