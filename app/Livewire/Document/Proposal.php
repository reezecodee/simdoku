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

    private $kata_pengantar = '<div><i>Assalamualaikum WR WB</i></div>
                    <div>
                    Alhamdulillahi rabbil„alamin, dengan segala kerendahan hati, kami panjatkan puji dan syukur kehadirat Allah SWT, karena atas izin, rahmat serta hidayah Nya, proposal acara kegiatan Festival Budaya Jepang di Universitas Bina Sarana Informatika dengan tema “...” telah selesai disusun.
                    </div>
                    <div>
                    Proposal ini disusun berdasarkan rencana pelaksanaan kegiatan Panitia ..., yang dimana akan dilaksanakan pada tanggal .... Kami menyadari, terselesaikannya proposal ini tidak terlepas dari bantuan berbagai pihak, sehingga sepatutnya kami menghaturkan rasa terima kasih kepada seluruh pihak terkait yang telah memberikan bantuan
                    </div>
                    <div>
                    Dalam penyajian proposal ini kami tentu menyadari masih belum mendekati kesempurnaan. Oleh karena itu, besar harapan kami agar pembaca berkenan memberikan umpan balik berupa kritik dan saran yang sifatnya membangun demi terciptanya proposal yang lebih baik lagi di masa mendatang. Sebab tidak ada sesuatu yang sempurna tanpa disertai saran yang konstruktif. Akhir kata, semoga makalah ini bisa memberikan manfaat bagi berbagai pihak. Aamiin.
                    </div>
                    <div><i>Wassalamualakium WR WB</i></div>';

    private $latar_belakang = '<div>Maraknya acara/event yang sudah berlangsung di wilayah kota kota indonesia, membuat kami termotifasi ingin membuat acara tersebut di wilayah ... . Maka dari itu kami dari Markom bekerjasama dengan volunteer dari mahasiswa Universitas Bina Sarana Informatika Kampus Tasikmalaya ingin mengadakan acara tersebut untuk memeriahkan sekaligus mengisi kegiatan rutinitas kami dalam bidang budaya dan seni sekaligus memperkenalkan kampus kami dan sebagai upaya strategi markom branding dan Beasiswa ... .</div>';
    private $tujuan = '<div>Tujuan dari kegiatan ini:</div>
                    <ol>
                        <li>
                        </li>
                    </ol>';
    private $indikator_keberhasilan = '<div>Indikator keberhasilan dari kegiatan ini:
    </div>
    <ol>
        <li>
        </li>
    </ol>';
    private $tema_kegiatan = '<div>Tema Kegiatan ini adalah ".."</div>';
    private $deskripsi_kegiatan = '<div>Kegiatan ini dilaksanakan selama ... yang diselenggarakan secara offline di kampus UBSI Tasikmalaya, dengan rangkaian kegiatan yang terdiri dari :
    </div>
    <ol>
        <li>
        </li>
    </ol>';
    private $penyelenggara_kegiatan = '<div>Kegiatan ini diselenggarakan oleh Markom bekerjasama dengan mahasiswa Universitas Bina Sarana Informatika Kampus Kota Tasikmalaya</div>';
    private $peserta_kegiatan = '<div>Sasaran dari kegiatan ini adalah ... di Wilayah ...</div>';
    private $waktu_pelaksanaan = '<div>Kegiatan ini akan dilaksanakan secara ... di ... pada hari : </div> <div>Hari : </div> <div>Tanggal : </div> <div>Tempat : </div>';
    private $penutup = '<div>Demikian proposal ini disusun sebagai dasar dan bahan pertimbangan bagi pelaksanaan kegiatan yang dimaksud, diharapkan menjadi kegiatan yang bermanfaat bagi semua yang telah mendukung dan berpartisipasi didalamnya. Atas segala perhatian dan kerjasama Bapak/Ibu kami ucapkan terima kasih.</div>';


    public function createProposal()
    {
        $proposal = ModelsProposal::create([
            'tahun' => date('Y'),
            'kata_pengantar' => $this->kata_pengantar,
            'penutup' => $this->penutup
        ]);

        ProposalIntroduction::create([
            'proposal_id' => $proposal->id,
            'latar_belakang' => $this->latar_belakang,
            'tujuan_kegiatan' => $this->tujuan,
            'indikator_keberhasilan' => $this->indikator_keberhasilan
        ]);

        ProposalPlanActivity::create([
            'proposal_id' => $proposal->id,
            'tema_kegiatan' => $this->tema_kegiatan,
            'deskripsi_kegiatan' => $this->deskripsi_kegiatan,
            'penyelenggara_kegiatan' => $this->penyelenggara_kegiatan,
            'peserta_kegiatan' => $this->peserta_kegiatan,
            'waktu_pelaksanaan' => $this->waktu_pelaksanaan
        ]);

        return redirect()->to(route('proposal.modify', $proposal->id));
    }

    public function render()
    {
        return view('livewire.document.proposal');
    }
}
