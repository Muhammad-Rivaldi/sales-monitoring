<div class="p-6 bg-gray-50 min-h-screen">

  <div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">Sales Report</h1>
    <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
      + Input Sales
    </button>
  </div>

  @if (session()->has('message'))
  <div class="bg-green-100 text-green-700 p-3 rounded mb-4 border border-green-200">
    {{ session('message') }}
  </div>
  @endif

  <div class="grid grid-cols-1 gap-6">

    <div class="bg-white p-4 rounded shadow">
      <h3 class="font-bold mb-4">Monthly Chart</h3>
      <canvas id="salesChart"></canvas>
    </div>

    <div class="bg-white p-4 rounded shadow overflow-x-auto">
      <h3 class="font-bold mb-4">Data Log</h3>
      <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-3">Date</th>
            <th class="p-3">Product</th>
            <th class="p-3 text-right">Amount</th>
            <th class="p-3 text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sales as $row)
          <tr class="border-b hover:bg-gray-50">
            <td class="p-3">{{ $row->date }}</td>
            <td class="p-3">{{ $row->product_name }}</td>
            <td class="p-3 text-right">Rp. {{ number_format($row->amount, 0, ',', '.') }}</td>
            <td class="p-3 text-center">
              <button wire:click="edit({{ $row->id }})" class="text-blue-500 mr-2">Edit</button>
              <button wire:click="delete({{ $row->id }})" class="text-red-500" onclick="confirm('Yakin?') || event.stopImmediatePropagation()">Del</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  @if($isModalOpen)
  <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-96">
      <h2 class="text-lg font-bold mb-4">{{ $sale_id ? 'Edit' : 'Add' }} Sales</h2>
      <form wire:submit.prevent="store">
        <div class="mb-3">
          <label class="block text-sm font-bold mb-1">Date</label>
          <input type="date" wire:model="date" class="w-full border p-2 rounded">
        </div>
        <div class="mb-3">
          <label class="block text-sm font-bold mb-1">Product</label>
          <input type="text" wire:model="product_name" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-1">Amount</label>
          <input type="number" wire:model="amount" class="w-full border p-2 rounded">
        </div>
        <div class="flex justify-end gap-2">
          <button type="button" wire:click="closeModal" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
        </div>
      </form>
    </div>
  </div>
  @endif

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    let chartInstance;
    const ctx = document.getElementById('salesChart');

    document.addEventListener('livewire:init', () => {
      Livewire.on('updateChart', (event) => {
        const payload = Array.isArray(event) ? event[0] : event;

        if (chartInstance) {
          chartInstance.data.labels = payload.labels;
          chartInstance.data.datasets[0].data = payload.data;
          chartInstance.update();
        } else {
          chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: payload.labels,
              datasets: [{
                label: 'Total Sales',
                data: payload.data,
                backgroundColor: '#2563EB'
              }]
            }
          });
        }
      });
    });
  </script>
</div>