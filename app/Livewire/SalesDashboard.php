<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sales;
use Illuminate\Support\Facades\DB;

class SalesDashboard extends Component
{
  // SETUP VARIABLE
  public $sales;
  public $date, $amount, $product_name, $sale_id;
  public $isModalOpen = false;

  // EVENT LISTENER
  protected $listeners = ['refreshComponent' => '$refresh'];

  // RENDER (VIEW)
  public function render()
  {
    $this->sales = Sales::orderBy('date', 'desc')->get();

    // Siapkan Data Chart
    $chartData = Sales::select(
      DB::raw("DATE_FORMAT(date, '%Y-%m') as month"),
      DB::raw('SUM(amount) as total_amount')
    )
      ->groupBy('month')
      ->orderBy('month')
      ->get();

    // Kirim update ke Chart JS
    $this->dispatch('updateChart', [
      'labels' => $chartData->pluck('month'),
      'data' => $chartData->pluck('total_amount')
    ]);

    return view('livewire.sales-dashboard');
  }

  // CRUD LOGIC
  public function create()
  {
    $this->resetInputFields();
    $this->isModalOpen = true;
  }

  // fungsi edit untuk mengambil data berdasarkan id dan menampilkan di form modal
  public function edit($id)
  {
    $sale = Sales::findOrFail($id);
    $this->sale_id = $id;
    $this->date = $sale->date;
    $this->amount = $sale->amount;
    $this->product_name = $sale->product_name;
    $this->isModalOpen = true;
  }

  // fungsi store untuk menyimpan data baru atau update data yang sudah ada
  public function store()
  {
    $this->validate([
      'date' => 'required|date',
      'amount' => 'required|numeric',
      'product_name' => 'required',
    ]);

    Sales::updateOrCreate(['id' => $this->sale_id], [
      'date' => $this->date,
      'amount' => $this->amount,
      'product_name' => $this->product_name,
    ]);

    session()->flash('message', $this->sale_id ? 'Updated.' : 'Created.');
    $this->isModalOpen = false;
    $this->resetInputFields();
  }

  public function delete($id)
  {
    Sales::find($id)->delete();
    session()->flash('message', 'Deleted.');
  }

  public function closeModal()
  {
    $this->isModalOpen = false;
  }

  private function resetInputFields()
  {
    $this->reset(['date', 'amount', 'product_name', 'sale_id']);
  }
}
