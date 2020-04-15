<?

namespace App\Exports;

use App\Movimiento;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoicesExport implements FromView
{
    public function view(): View
    {
        return view('excel.moviexcel', [
            'movimiento' => Movimiento::all()
        ]);
    }
}