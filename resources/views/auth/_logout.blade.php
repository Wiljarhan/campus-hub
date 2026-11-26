<form method="POST" action="{{ route('logout') }}" class="inline">
    @csrf
    <button
        type="submit"
        class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition"
    >
        Keluar
    </button>
</form>
