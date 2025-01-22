<?php

namespace App\Livewire\Document;

use App\Models\Proposal as ModelsProposal;
use App\Models\ProposalIntroduction;
use App\Models\ProposalPlanActivity;
use Livewire\Attributes\Title;
use Livewire\Component;

class Proposal extends Component
{
    #[Title('Proposal Kegiatan')]

    private $kata_pengantar = '<i>Assalamualaikum WR WB</i>
                    <br>
                    Alhamdulillahi rabbil„alamin, dengan segala kerendahan hati, kami panjatkan puji dan syukur kehadirat Allah SWT, karena atas izin, rahmat serta hidayah Nya, proposal acara kegiatan Festival Budaya Jepang di Universitas Bina Sarana Informatika dengan tema “<b>{isi judul tema}</b>” telah selesai disusun.
                    <br>
                    Proposal ini disusun berdasarkan rencana pelaksanaan kegiatan Panitia <b>{isi judul tema}</b>, yang dimana akan dilaksanakan pada tanggal <b>{tanggal bulan tahun</b>. Kami menyadari, terselesaikannya proposal ini tidak terlepas dari bantuan berbagai pihak, sehingga sepatutnya kami menghaturkan rasa terima kasih kepada seluruh pihak terkait yang telah memberikan bantuan
                    <br>
                    Dalam penyajian proposal ini kami tentu menyadari masih belum mendekati kesempurnaan. Oleh karena itu, besar harapan kami agar pembaca berkenan memberikan umpan balik berupa kritik dan saran yang sifatnya membangun demi terciptanya proposal yang lebih baik lagi di masa mendatang. Sebab tidak ada sesuatu yang sempurna tanpa disertai saran yang konstruktif. Akhir kata, semoga makalah ini bisa memberikan manfaat bagi berbagai pihak. Aamiin.
                    <br>
                    <i>Wassalamualakium WR WB</i>';

    private $tujuan = 'Tujuan dari kegiatan ini:
                    <br>
                    <ol>
                        <li>
                        </li>
                    </ol>';
    private $indikator_keberhasilan = 'Indikator keberhasilan dari kegiatan ini:
    <br>
    <ol>
        <li>
        </li>
    </ol>';
    private $deskripsi_kegiatan = 'Kegiatan ini dilaksanakan selama <b>{waktu}</b> yang diselenggarakan secara offline di kampus UBSI Tasikmalaya, dengan rangkaian kegiatan yang terdiri dari :
    <br>
    <ol>
        <li>
        </li>
    </ol>';
    private $penyelenggara_kegiatan = 'Kegiatan ini diselenggarakan oleh Markom bekerjasama dengan mahasiswa Universitas Bina Sarana Informatika Kampus Kota Tasikmalaya';
    private $waktu_pelaksanaan = ' <p>
                        Kegiatan ini akan dilaksanakan secara ... di ... pada hari :	
                    </p>
                    <p>Hari	: </p>			
                    <p>Tanggal	: </p>			
                    <p>Tempat	: </p>';
    private $penutup = 'Demikian proposal ini disusun sebagai dasar dan bahan pertimbangan bagi pelaksanaan kegiatan yang dimaksud, diharapkan menjadi kegiatan yang bermanfaat bagi semua yang telah mendukung dan berpartisipasi didalamnya. Atas segala perhatian dan kerjasama Bapak/Ibu kami ucapkan terima kasih.';


    public function createProposal()
    {
        $proposal = ModelsProposal::create([
            'tahun' => date('Y'),
            'kata_pengantar' => $this->kata_pengantar,
            'penutup' => $this->penutup
        ]);

        ProposalIntroduction::create([
            'proposal_id' => $proposal->id,
            'tujuan_kegiatan' => $this->tujuan,
            'indikator_keberhasilan' => $this->indikator_keberhasilan
        ]);

        ProposalPlanActivity::create([
            'proposal_id' => $proposal->id,
            'deskripsi_kegiatan' => $this->deskripsi_kegiatan,
            'penyelenggara_kegiatan' => $this->penyelenggara_kegiatan,
            'waktu_pelaksanaan' => $this->waktu_pelaksanaan
        ]);

        return redirect()->to(route('proposal.modify', $proposal->id));
    }

    public function render()
    {
        return view('livewire.document.proposal');
    }
}
