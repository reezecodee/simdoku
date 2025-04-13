<div>
    <input class="form-control" autocomplete="off" wire:model.live.debounce.500ms="query" type="search" placeholder="Search..."
        aria-label="Search" data-width="250">
    <button class="btn" type="button"><i class="fas fa-search"></i></button>
    <div class="search-backdrop"></div>
    <div class="search-result">
        <div class="search-header">
            Beasiswa
        </div>
        @forelse ($scholarships as $item)
        <div class="search-item">
            <a href="{{ route('scholarship.modify', $item->id) }}" wire:navigate.hover>
                {{ Str::limit($item->nama ?? 'Beasiswa Tak Bernama', 30) }}
            </a>
        </div>
        @empty
        <div class="search-item">
            <a>Tidak ada hasil</a>
        </div>
        @endforelse
        <div class="search-header">
            Surat Pengajuan
        </div>
        @forelse ($letters as $item)
        <div class="search-item">
            <a href="{{ route('letter.modify', $item->id) }}" wire:navigate.hover>
                {{ Str::limit($item->perihal ?? 'Tak Berperihal', 30) }}
            </a>
        </div>
        @empty
        <div class="search-item">
            <a>Tidak ada hasil</a>
        </div>
        @endforelse
        <div class="search-header">
            Proposal
        </div>
        @forelse ($proposals as $item)
        <div class="search-item">
            <a href="{{ route('proposal.modify', $item->id) }}" wire:navigate.hover>
                {{ Str::limit($item->judul ?? 'Tak Berjudul', 30) }}
            </a>
        </div>
        @empty
        <div class="search-item">
            <a>Tidak ada hasil</a>
        </div>
        @endforelse
        <div class="search-header">
            Laporan
        </div>
        @forelse ($reports as $item)
        <div class="search-item">
            <a href="{{ route('report.modify', $item->id) }}" wire:navigate.hover>
                {{ Str::limit($item->judul ?? 'Tak Berjudul', 30) }}
            </a>
        </div>
        @empty
        <div class="search-item">
            <a>Tidak ada hasil</a>
        </div>
        @endforelse
        <div class="search-header">
            Formulir
        </div>
        @forelse ($formulirs as $item)
        <div class="search-item">
            <a href="{{ route('form.modify', $item->id) }}" wire:navigate.hover>
                {{ Str::limit($item->judul ?? 'Tak Berjudul', 30) }}
            </a>
        </div>
        @empty
        <div class="search-item">
            <a>Tidak ada hasil</a>
        </div>
        @endforelse
    </div>
</div>