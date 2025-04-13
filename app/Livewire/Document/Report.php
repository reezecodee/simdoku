<?php

namespace App\Livewire\Document;

use App\Models\Report as ModelsReport;
use App\Models\ReportCommittee;
use App\Models\ReportEvaluation;
use App\Models\ReportIntroduction;
use App\Models\ReportPlanActivity;
use Livewire\Attributes\Title;
use Livewire\Component;

class Report extends Component
{
    #[Title('Report Kegiatan')]

    private $kata_pengantar = '<div><i>Assalamu’alaikum Wr. Wb.</i></div><div>Dengan mengucap Puji Syukur Kehadirat Allah Yang Maha Kuasa yang telah melimpahkan Rahmat dan Hidayah-Nya kepada kami semua, sehingga kami dapat menyelesaikan Laporan pengajuan acara dengan tema <i><b>“”.</i></b></div><div>Tujuan penyusun Laporan ini sebagai pelaporan hasil pelaksanaan kegiatan dan gambaran yang mendetail mengenai acara tersebut</div><div>Kami menyadari bahwasannya dalam menyusun laporan ini jauh dari kata sempurna, oleh karena itu   saran serta kritik membangun sangat kami harapkan sebagai bahan masukan bagi kami agar kedepannya lebih baik.</div><div>Kami juga memohon maaf atas segala kekurangan dan kekhilafan dalam meyusun laporan ini, semoga acara ini dapat terselenggara dengan lancar dan dapat bermanfaat bagi semua.Amin.</div><div><i>Wassalamu’alaikum Wr. Wb.</i></div>';
    private $penutup = '<div>Demikianlah laporan dengan tema "" kami sampaikan. Besar harapan kami demi kelancaran kegiatan ini partisipasi dari semua pihak sangat kami harapkan demi keberhasilan kegiatan ini. Atas perhatian bapak/ibu serta semua pihak yang ada, kami ucapkan banyak terima kasih.</div>';
    private $tujuan_kegiatan = '<div>Tujuan dari kegiatan ini:</div>
                    <ol>
                        <li>
                        </li>
                    </ol>';
    private $manfaat_kegiatan = '<div>Manfaat dari kegiatan ini:</div>
                    <ol>
                        <li>
                        </li>
                    </ol>';
    private $indikator_keberhasilan = '<div>Indikator keberhasilan dari kegiatan ini diantaranya:</div>
                    <ol>
                        <li>
                        </li>
                    </ol>';
    private $tema_kegaiatan = '<div>Tema kegiatan ini adalah ""</div>';
    private $penyelenggara_kegiatan = '<div>Kegiatan ini diselenggarakan oleh Universitas Bina Sarana Informatika Kampus Tasikmalaya.</div>';
    private $pemateri_narasumber = '<div>Kegiatan ini mendatangkan beberapa Narasumber, yaitu:</div>
                    <ol>
                        <li>
                        </li>
                    </ol>';
    private $peserta_kegiatan = '<div>Kegiatan ini mengundang siswa dan guru sekolah dari Kota dan Kabupaten Tasikmalaya, relasi sekolah UBSI Tasikmalaya, mahasiswa serta masyarakat umum lainnya</div>';
    private $waktu_pelaksanaan = '<div>Kegiatan ini dilaksanakan pada: </div> <div>Hari : </div> <div>Tanggal : </div> <div>Tempat : </div> <div>Waktu : </div>';


    public function createReport()
    {
        $report = ModelsReport::create([
            'kata_pengantar' => $this->kata_pengantar,
            'penutup' => $this->penutup,
        ]);

        ReportIntroduction::create([
            'laporan_id' => $report->id,
            'tujuan_kegiatan' => $this->tujuan_kegiatan,
            'manfaat_kegiatan' => $this->manfaat_kegiatan,
            'indikator_keberhasilan' => $this->indikator_keberhasilan
        ]);

        ReportPlanActivity::create([
            'laporan_id' => $report->id,
            'tema_kegiatan' => $this->tema_kegaiatan,
            'penyelenggara_kegiatan' => $this->penyelenggara_kegiatan,
            'pemateri_narasumber' => $this->pemateri_narasumber,
            'peserta_kegiatan' => $this->peserta_kegiatan,
            'waktu_pelaksanaan' => $this->waktu_pelaksanaan
        ]);

        ReportEvaluation::create([
            'laporan_id' => $report->id
        ]);

        ReportCommittee::create([
            'laporan_id' => $report->id
        ]);

        $this->redirect(route('report.modify', $report->id));
    }

    public function render()
    {
        return view('livewire.document.report');
    }
}
