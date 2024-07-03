namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Transaksi;

class PemasukanPengeluaranChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->labels(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);

        $pemasukan = [];
        $pengeluaran = [];

        for ($i = 1; $i <= 12; $i++) {
            $pemasukan[] = Transaksi::whereMonth('created_at', $i)->where('jenis', 'pemasukan')->sum('jumlah');
            $pengeluaran[] = Transaksi::whereMonth('created_at', $i)->where('jenis', 'pengeluaran')->sum('jumlah');
        }

        $this->dataset('Pemasukan', 'bar', $pemasukan)->backgroundColor('#28a745');
        $this->dataset('Pengeluaran', 'bar', $pengeluaran)->backgroundColor('#dc3545');
    }
}
