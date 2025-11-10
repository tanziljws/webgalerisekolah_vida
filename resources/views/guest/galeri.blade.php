@extends('layouts.app')

@section('title', 'Galeri - SMKN 4 BOGOR')

@section('content')
    <style>
        /* Grid default: 4 desktop, 3 tablet, 2 mobile */
        .gallery-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 24px; width:100%; }
        @media (max-width: 991.98px) { .gallery-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
        @media (max-width: 767.98px) { .gallery-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        /* Link pengklik memenuhi kartu */
        .gallery-link { position:absolute; inset:0; z-index:10; display:block; cursor:pointer; }

        /* Card */
        .gallery-card { position:relative; border-radius:16px; overflow:hidden; background:#fff; box-shadow: 0 6px 18px rgba(15,23,42,.08); aspect-ratio:4/3; transition: transform .18s ease; isolation:isolate; cursor:pointer; }
        .gallery-card:hover { transform: translateY(-2px) scale(1.01); }
        .gallery-card img { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; border-radius:inherit; pointer-events:none; }

        /* Overlay hover */
        .gallery-overlay { position:absolute; inset:0; display:flex; align-items:flex-start; justify-content:space-between; padding:.5rem; pointer-events:none; opacity:0; transition: opacity .35s ease; z-index:15; }
        .fade-slide { opacity:0; transform: translateY(-8px); transition: opacity .35s ease, transform .35s ease; pointer-events:none; }
        .gallery-card:hover .gallery-overlay { opacity:1; pointer-events:none; }
        .gallery-card:hover .fade-slide { opacity:1; transform: translateY(0); pointer-events:none; }
        .gallery-overlay .icon-btn { width:36px; height:36px; border-radius:999px; display:flex; align-items:center; justify-content:center; background: rgba(15,23,42,.75); color:#fff; border:1px solid rgba(255,255,255,.18); pointer-events:auto; position:relative; z-index:25; }
        .gallery-overlay .icon-btn:hover { background: rgba(15,23,42,.9); }

        /* Arrows (tampil jika >1 foto) */
        .gallery-arrow { position:absolute; top:50%; transform: translateY(-50%); width:36px; height:36px; border-radius:999px; display:none; align-items:center; justify-content:center; background: rgba(15,23,42,.6); color:#fff; border:none; z-index:25; cursor:pointer; pointer-events:auto; }
        .gallery-arrow.left { left:.5rem; }
        .gallery-arrow.right { right:.5rem; }
        .gallery-card.has-multi:hover .gallery-arrow { display:flex; }

        /* Dots di bawah foto - Perfect circles tanpa terpotong */
        .gallery-dots { 
            position:absolute; 
            left:0; 
            right:0; 
            bottom:1rem; 
            display:flex; 
            justify-content:center; 
            align-items:center; 
            pointer-events:none; 
            z-index:15; 
            padding:10px 16px;
            min-height:30px;
        }
        .gallery-dots .dots-scroll { 
            display:flex; 
            align-items:center; 
            justify-content:center;
            gap:10px; 
            max-width:160px; 
            overflow-x:auto; 
            overflow-y:visible !important; 
            scrollbar-width:none; 
            pointer-events:none; 
            padding:8px 6px;
        }
        .gallery-dots .dots-scroll::-webkit-scrollbar { display:none; }
        .gallery-dots .dot { 
            display:inline-block; 
            width:6px; 
            height:6px; 
            min-width:6px;
            min-height:6px;
            border-radius:50%; 
            background: rgba(255,255,255,.7); 
            flex-shrink:0; 
            flex-grow:0;
            transition: all .3s ease; 
            cursor:pointer; 
            pointer-events:auto;
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }
        .gallery-dots .dot.active { 
            background:#fff; 
            width:8px;
            height:8px;
            min-width:8px;
            min-height:8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.5);
        }

        /* Header chips (tetap) */
        .cats { display:flex; flex-wrap:wrap; gap:10px; }
        .cat-chip { display:inline-flex; align-items:center; justify-content:center; padding:.55rem .85rem; background:#0f172a; color:#fff; border-radius:8px; text-decoration:none; border:2px solid #0f172a; transition: all 0.2s ease; font-weight:600; font-size:14px; }
        .cat-chip:hover { background:#1e293b; transform: translateY(-1px); box-shadow: 0 4px 8px rgba(15,23,42,.15); }
        .cat-chip.is-light { background:#f1f5f9; color:#0f172a; border-color:#e2e8f0; }
        .cat-chip.is-light:hover { background:#e2e8f0; }
    </style>

    <section class="py-4">
        <div class="container">
            <div class="mb-4 text-center">
                <h2 class="h3 mb-3" style="font-weight:700; color:#0f172a;">Galeri Sekolah</h2>
                @isset($categories)
                    <div class="cats justify-content-center">
                        <a href="{{ request()->url() }}" class="cat-chip {{ !request('kategori') ? 'is-light' : '' }}">Semua</a>
                        @foreach($categories as $cat)
                            <a href="{{ request()->fullUrlWithQuery(['kategori' => $cat->id]) }}" 
                               class="cat-chip {{ request('kategori') == $cat->id ? 'is-light' : '' }}">
                                {{ $cat->judul }}
                            </a>
                        @endforeach
                    </div>
                @endisset
            </div>
            <div class="gallery-grid">
                @foreach($galeries as $galery)
                    @php($photos = $galery->fotos)
                    @php($first = $photos->first())
                    <div class="gallery-card {{ $photos->count() > 1 ? 'has-multi' : '' }}" id="g-{{ $galery->id }}">
                        <img src="{{ $first ? Storage::url($first->file) : 'https://via.placeholder.com/600x400?text=No+Image' }}" alt="" loading="lazy">
                        <a class="gallery-link" href="{{ route('guest.galeri.show', $galery) }}" aria-label="Buka galeri"></a>
                        <div class="gallery-overlay fade-slide">
                            <a class="icon-btn" title="Unduh" id="dl-{{ $galery->id }}" href="{{ $first ? Storage::url($first->file) : '#' }}" download onclick="event.stopPropagation();"><i class="bi bi-download"></i></a>
                            <button type="button" class="icon-btn" title="Simpan" onclick="return bookmarkTile(event, '{{ $galery->id }}')"><i class="bi bi-bookmark"></i></button>
                        </div>
                        <button type="button" class="gallery-arrow left" onclick="return cycleTile(event, '{{ $galery->id }}', -1)"><i class="bi bi-chevron-left"></i></button>
                        <button type="button" class="gallery-arrow right" onclick="return cycleTile(event, '{{ $galery->id }}', 1)"><i class="bi bi-chevron-right"></i></button>
                        <div class="gallery-dots" aria-hidden="false">
                            <div class="dots-scroll" id="dots-{{ $galery->id }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Section untuk Posts dengan kategori "Galeri Sekolah" --}}
            @if($galeriPosts->isNotEmpty())
            <div class="mt-5 pt-5">
                <h3 class="h4 mb-4" style="font-weight:700; color:#0f172a;">Konten Galeri</h3>
                <div class="row g-4">
                    @foreach($galeriPosts as $post)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s ease;">
                            <div class="card-body p-4">
                                <span class="badge bg-primary mb-3">{{ $post->kategori->judul }}</span>
                                <h5 class="card-title fw-bold mb-3">{{ $post->judul }}</h5>
                                <p class="card-text text-muted">{{ Str::limit(strip_tags($post->isi), 100) }}</p>
                                <div class="mt-3">
                                    <small class="text-muted">
                                        <i class="far fa-calendar me-1"></i>
                                        {{ $post->created_at->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
// Dataset foto per tile dan kontrol navigasi panah / hover dengan dots
(function(){
  const photos = {};
  @foreach($galeries as $galery)
    photos[{{ $galery->id }}] = [
      @foreach($galery->fotos as $f)
        @json(Storage::url($f->file)){{ !$loop->last ? ',' : '' }}
      @endforeach
    ];
  @endforeach

  const state = new Map(); // id -> {idx}

  function setImage(id, idx){
    const list = photos[id] || [];
    if (!list.length) return;
    const tile = document.getElementById('g-' + id);
    const img = tile?.querySelector('img');
    if (!img) return;
    img.src = list[idx];
    const dots = document.querySelectorAll('#dots-' + id + ' .dot');
    dots.forEach((d,i)=> d.classList.toggle('active', i === idx));
    const dl = document.getElementById('dl-' + id);
    if (dl) dl.href = list[idx];
    // scroll dots agar titik aktif tetap terlihat (centered)
    const wrap = document.querySelector('#dots-' + id);
    if (wrap && wrap.children[idx]) {
      const activeDot = wrap.children[idx];
      const wrapWidth = wrap.clientWidth;
      const dotLeft = activeDot.offsetLeft;
      const dotWidth = activeDot.clientWidth;
      const scrollLeft = dotLeft - (wrapWidth / 2) + (dotWidth / 2);
      wrap.scrollTo({ left: Math.max(0, scrollLeft), behavior: 'smooth' });
    }
    state.set(id, { idx });
  }

  window.bookmarkTile = function(ev, id){
    if (ev) { ev.preventDefault(); ev.stopPropagation(); }
    const btn = ev.currentTarget;
    btn.classList.toggle('active');
    btn.innerHTML = btn.classList.contains('active') ? '<i class="bi bi-bookmark-fill"></i>' : '<i class="bi bi-bookmark"></i>';
    return false;
  }

  window.cycleTile = function(ev, id, step){
    if (ev) { ev.preventDefault(); ev.stopPropagation(); }
    const list = photos[id] || [];
    if (!list.length) return false;
    const cur = state.get(id)?.idx || 0;
    const next = (cur + step + list.length) % list.length;
    setImage(id, next);
    return false;
  }

  document.querySelectorAll('.gallery-card').forEach(tile => {
    const id = parseInt(tile.id.replace('g-',''));
    const list = photos[id] || [];
    if (!list.length) return;
    // build dots sesuai jumlah foto
    const dotsWrap = document.getElementById('dots-' + id);
    if (dotsWrap) {
      dotsWrap.innerHTML = '';
      list.forEach((_, i) => {
        const d = document.createElement('span');
        d.className = 'dot' + (i === 0 ? ' active' : '');
        d.addEventListener('click', (e)=> { e.stopPropagation(); setImage(id, i); });
        dotsWrap.appendChild(d);
      });
      // sembunyikan dots jika hanya 1
      const dotsContainer = dotsWrap.closest('.gallery-dots');
      if (dotsContainer) dotsContainer.style.display = list.length > 1 ? 'flex' : 'none';
    }
    // tampilkan arrows hanya jika >1
    tile.classList.toggle('has-multi', list.length > 1);
    setImage(id, 0);

    // Swipe support (touch)
    let tsX = 0, tsY = 0, swiping = false;
    tile.addEventListener('touchstart', (e)=>{
      if (!list || list.length < 2) return;
      const t = e.changedTouches[0]; tsX = t.clientX; tsY = t.clientY; swiping = false;
    }, {passive:true});
    tile.addEventListener('touchmove', (e)=>{
      if (!list || list.length < 2) return;
      const t = e.changedTouches[0];
      const dx = t.clientX - tsX; const dy = t.clientY - tsY;
      if (Math.abs(dx) > 12 && Math.abs(dx) > Math.abs(dy)) { swiping = true; }
    }, {passive:true});
    tile.addEventListener('touchend', (e)=>{
      if (!list || list.length < 2) return;
      const t = e.changedTouches[0];
      const dx = t.clientX - tsX; const dy = t.clientY - tsY;
      if (Math.abs(dx) > 40 && Math.abs(dx) > Math.abs(dy)) {
        e.preventDefault(); e.stopPropagation();
        const step = dx < 0 ? 1 : -1;
        const cur = state.get(id)?.idx || 0;
        const next = (cur + step + list.length) % list.length;
        setImage(id, next);
      }
      swiping = false;
    }, {passive:false});

    // Prevent following the link if it was a swipe gesture
    const link = tile.querySelector('.gallery-link');
    if (link) {
      link.addEventListener('click', (e)=>{ if (swiping) { e.preventDefault(); e.stopPropagation(); } });
    }
  });

})();
</script>
@endpush
