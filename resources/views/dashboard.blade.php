<x-app-layout>

    {{-- di dalam file dashboard.blade.php --}}
    @if (auth()->user()->is_admin)
        <div class="bg-white shadow-sm rounded-lg p-4 mb-4">
            <h3 class="font-bold text-lg">Status Replikasi Database</h3>
            <div id="replication-status" class="mt-2">
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-yellow-500" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Memeriksa status...
                </span>
            </div>
            <pre id="replication-details" class="mt-4 bg-gray-100 p-2 rounded text-xs overflow-auto hidden"></pre>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('{{ route('admin.replication.status') }}')
                    .then(response => response.json())
                    .then(data => {
                        const statusDiv = document.getElementById('replication-status');
                        let badgeHtml = '';
                        if (data.connected) {
                            badgeHtml =
                                `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">${data.message}</span>`;
                        } else {
                            badgeHtml =
                                `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">${data.message}</span>`;
                        }
                        statusDiv.innerHTML = badgeHtml;

                        // Tampilkan detail jika ada
                        if (data.details) {
                            const detailsPre = document.getElementById('replication-details');
                            detailsPre.textContent = JSON.stringify(data.details, null, 2);
                            detailsPre.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching replication status:', error);
                        const statusDiv = document.getElementById('replication-status');
                        statusDiv.innerHTML =
                            `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">Error: Tidak dapat menghubungi server untuk cek status.</span>`;
                    });
            });
        </script>
    @endpush
</x-app-layout>
