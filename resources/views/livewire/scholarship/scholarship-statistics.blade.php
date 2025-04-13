<div>
    <div wire:loading wire:target="downloadAll" class="loading-overlay">
        <div class="spinner"></div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('scholarship.modify', $id) }}" wire:navigate.hover>
                    <button class="btn btn-danger">Kembali</button>
                </a>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mr-2" wire:click="downloadAll">Download Semua</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Statistik Sekolah</p>
                            <img src="/charts/school_pie_chart.png" alt="" srcset="">
                            <a href="/charts/school_pie_chart.png" download>
                                <button class="btn btn-primary mt-3">Download</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Statistik Kelas</p>
                            <img src="/charts/class_pie_chart.png" alt="" srcset="">
                            <a href="/charts/class_pie_chart.png" download>
                                <button class="btn btn-primary mt-3">Download</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Statistik Jurusan</p>
                            <img src="/charts/major_pie_chart.png" alt="" srcset="">
                            <a href="/charts/major_pie_chart.png" download>
                                <button class="btn btn-primary mt-3">Download</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Statistik Rangking</p>
                            <img src="/charts/rangking_pie_chart.png" alt="" srcset="">
                            <a href="/charts/rangking_pie_chart.png" download>
                                <button class="btn btn-primary mt-3">Download</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Statistik Besaran Beasiswa</p>
                            <img src="/charts/scholarship_amount_pie_chart.png" alt="" srcset="">
                            <a href="/charts/scholarship_amount_pie_chart.png" download>
                                <button class="btn btn-primary mt-3">Download</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Statistik Status LoA</p>
                            <img src="/charts/status_loa_pie_chart.png" alt="" srcset="">
                            <a href="/charts/status_loa_pie_chart.png" download>
                                <button class="btn btn-primary mt-3">Download</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Statistik Status SK Rektor</p>
                            <img src="/charts/status_sk_rektor_pie_chart.png" alt="" srcset="">
                            <a href="/charts/status_sk_rektor_pie_chart.png" download>
                                <button class="btn btn-primary mt-3">Download</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Statistik Status Pembayaran</p>
                            <img src="/charts/payment_status_pie_chart.png" alt="" srcset="">
                            <a href="/charts/payment_status_pie_chart.png" download>
                                <button class="btn btn-primary mt-3">Download</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Statistik Tanggal Pengajuan</p>
                            <img src="/charts/submission_pie_chart.png" alt="" srcset="">
                            <a href="/charts/submission_pie_chart.png" download>
                                <button class="btn btn-primary mt-3">Download</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>