@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<!-- Tailwind (scoped usage for this page) and AOS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.10/dist/tailwind.min.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<style>
 .profile-wrap { max-width: 1080px; margin: 0 auto; }
 .back-btn { position: sticky; top: 76px; left: 0; z-index: 5; display: inline-flex; align-items: center; gap: 8px; color: #0f172a; text-decoration: none; font-weight: 600; padding: 8px 12px; border-radius: 999px !important; background: #f1f5f9; border: 1px solid #e2e8f0; }
 .back-btn:hover { background: #e2e8f0; }
 .avatar { width: 108px; height: 108px; border-radius: 999px !important; display: flex; align-items: center; justify-content: center; background: #e2e8f0; color: #64748b; font-size: 42px; font-weight: 800; border: 3px solid #fff; box-shadow: 0 6px 18px rgba(15,23,42,.08); overflow: hidden; }
 .avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50% !important; }
 .name { font-size: 1.5rem; font-weight: 800; color: #0f172a; }
 .username { color: #64748b; font-weight: 600; }
 .edit-btn { border-radius: 999px !important; padding: 6px 12px; font-weight: 600; }
 .tab-btn { border: 1px solid #e2e8f0; background: transparent; color: #0f172a; padding: 10px 16px; font-weight: 700; border-radius: 999px !important; }
 .tab-btn:hover { background: #f1f5f9; }
 .tab-btn.active { background: transparent; color: #0f172a; border-color: #0f172a; }
 .tabs { display: inline-flex; gap: 10px; background: transparent; padding: 6px; border-radius: 999px !important; }
 .gallery-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 20px; width:100%; }
 @media (max-width: 991.98px) { .gallery-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
 @media (max-width: 767.98px) { .gallery-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
 .gallery-card { position:relative; border-radius:16px !important; overflow:hidden; background:#fff; box-shadow: 0 6px 18px rgba(15,23,42,.08); aspect-ratio:4/3; transition: transform .18s ease, box-shadow .18s ease; isolation:isolate; }
 .gallery-card:hover { transform: translateY(-2px) scale(1.01); box-shadow: 0 12px 24px rgba(15,23,42,.12); }
 .gallery-card img { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; border-radius:inherit; }
 .gallery-overlay { position:absolute; inset:0; display:flex; align-items:flex-start; justify-content:space-between; padding:.5rem; pointer-events:none; opacity:0; transition: opacity .35s ease; z-index:2; }
 .fade-slide { opacity:0; transform: translateY(-8px); transition: opacity .35s ease, transform .35s ease; }
 .gallery-card:hover .gallery-overlay { opacity:1; }
 .gallery-card:hover .fade-slide { opacity:1; transform: translateY(0); pointer-events:auto; }
 /* Ikon aksi tanpa background (like/komentar/download) */
 .gallery-overlay .icon-btn { width:auto; height:auto; border-radius:0 !important; display:flex; align-items:center; justify-content:center; background: transparent !important; color:#ffffff; border:none !important; padding: 0; box-shadow:none; }
 .gallery-overlay .icon-btn i, .gallery-overlay .icon-btn svg { font-size: 18px; filter: drop-shadow(0 1px 1px rgba(0,0,0,.35)); }
 .gallery-arrow { position:absolute; top:50%; transform: translateY(-50%); width:36px; height:36px; border-radius:999px; display:none; align-items:center; justify-content:center; background: rgba(15,23,42,.6); color:#fff; border:none; z-index:3; cursor:pointer; }
 .gallery-arrow.left { left:.5rem; }
 .gallery-arrow.right { right:.5rem; }
 .gallery-card.has-multi:hover .gallery-arrow { display:flex; }
 .gallery-dots { position:absolute; left:0; right:0; bottom:.5rem; display:flex; justify-content:center; gap:6px; pointer-events:auto; }
 .gallery-dots .dots-scroll { display:flex; gap:6px; max-width:112px; overflow-x:auto; overflow-y:hidden; scrollbar-width:none; }
 .gallery-dots .dots-scroll::-webkit-scrollbar { height:4px; background:transparent; }
 .gallery-dots .dot { display:inline-block; width:12px; height:12px; border-radius:9999px !important; background: rgba(255,255,255,.55); flex:0 0 auto; transition: background .25s ease, transform .25s ease; }
 .gallery-dots .dot.active { background:#fff; transform: scale(1.05); }
 .tab-pane { transition: opacity .28s ease, transform .28s ease; opacity: 0; transform: translateY(8px); display: none; }
 .tab-pane.active { opacity: 1; transform: translateY(0); display: block; }
</style>

<section class="py-4">
    <div class="container profile-wrap" data-aos="fade-up" data-aos-duration="600">
        @php(
            $authU = auth('user')->user()
        )
        @php(
            $likedGaleries = isset($likedGaleries) ? $likedGaleries : ( $authU ? \App\Models\Galery::whereHas('likes', function($q) use ($authU){ $q->where('user_id', $authU->id); })->with('fotos')->latest()->get() : collect() )
        )
        @php(
            $savedGaleries = isset($savedGaleries) ? $savedGaleries : ( $authU ? \App\Models\Galery::whereHas('bookmarks', function($q) use ($authU){ $q->where('user_id', $authU->id); })->with('fotos')->latest()->get() : collect() )
        )
        <div class="mb-3" data-aos="fade-down" data-aos-duration="600">
            <a href="{{ url()->previous() }}" class="back-btn"><span class="me-1">←</span><span>Kembali</span></a>
        </div>

        <div class="d-flex flex-column align-items-center text-center mb-3" data-aos="zoom-in" data-aos-duration="700">
            @if(!empty($user?->profile_photo_path))
                <div class="avatar" style="cursor:pointer;" onclick="showPhotoModal('{{ asset('storage/'.$user->profile_photo_path) }}?v={{ time() }}')">
                    <img src="{{ asset('storage/'.$user->profile_photo_path) }}?v={{ time() }}" alt="avatar" style="width:100%;height:100%;object-fit:cover;">
                </div>
            @else
                <div class="avatar">{{ strtoupper(substr($user?->name ?? 'U',0,1)) }}</div>
            @endif
            <div class="mt-3 w-100" style="max-width:720px;">
                <h4 class="fw-bold mb-1" style="color:#0f172a;">{{ $user?->name ?? 'Pengguna' }}</h4>
                <p class="text-muted mb-2" style="font-size:15px;">{{ '@' . ($user?->username ?? Str::of($user?->name ?? 'user')->slug('')) }}</p>
                <a href="{{ route('user.profile.edit') }}" class="btn btn-outline-primary btn-sm edit-btn px-4">
                    <i class="bi bi-pencil-square me-1"></i>Edit Profil
                </a>
            </div>
        </div>

        <div class="d-flex justify-content-center mb-3" data-aos="fade-up" data-aos-duration="600">
            <div class="tabs">
                <button class="tab-btn active" data-target="#tab-liked">❤️ Disukai</button>
                <button class="tab-btn" data-target="#tab-saved">📑 Disimpan</button>
            </div>
        </div>

        <div id="tab-liked" class="tab-pane active">
            @if($likedGaleries && $likedGaleries->count() > 0)
                <div class="gallery-grid">
                    @foreach($likedGaleries as $galery)
                        @php($photos = $galery->fotos ?? collect())
                        @php($first = $photos->first())
                        <div class="gallery-card group {{ ($photos->count() > 1) ? 'has-multi' : '' }}" id="lg-{{ $galery->id }}" data-aos="fade-up" data-aos-duration="500">
                            <img src="{{ $first ? Storage::url($first->file) : 'https://via.placeholder.com/600x400?text=No+Image' }}" alt="" loading="lazy">
                            <a class="gallery-link" href="{{ route('guest.galeri.show', $galery) }}" aria-label="Buka galeri" style="position:absolute;inset:0;z-index:1;display:block;"></a>
                            <div class="gallery-overlay fade-slide">
                                <a class="icon-btn" id="dl-lg-{{ $galery->id }}" href="{{ $first ? Storage::url($first->file) : '#' }}" download><i class="bi bi-download"></i></a>
                                <span class="icon-btn"><i class="bi bi-heart-fill"></i></span>
                            </div>
                            <button type="button" class="gallery-arrow left" data-cycle="-1" data-id="lg-{{ $galery->id }}"><i class="bi bi-chevron-left"></i></button>
                            <button type="button" class="gallery-arrow right" data-cycle="1" data-id="lg-{{ $galery->id }}"><i class="bi bi-chevron-right"></i></button>
                            <div class="gallery-dots"><div class="dots-scroll" id="dots-lg-{{ $galery->id }}"></div></div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5" data-aos="fade-up">
                    <i class="bi bi-heart" style="font-size:3rem;color:#e2e8f0;"></i>
                    <p class="text-muted mt-3">Belum ada galeri yang disukai.</p>
                    <a href="{{ route('guest.galeri') }}" class="btn btn-primary btn-sm mt-2">Jelajahi Galeri</a>
                </div>
            @endif
        </div>

        <div id="tab-saved" class="tab-pane">
            @if($savedGaleries && $savedGaleries->count() > 0)
                <div class="gallery-grid">
                    @foreach($savedGaleries as $galery)
                        @php($photos = $galery->fotos ?? collect())
                        @php($first = $photos->first())
                        <div class="gallery-card group {{ ($photos->count() > 1) ? 'has-multi' : '' }}" id="sv-{{ $galery->id }}" data-aos="fade-up" data-aos-duration="500">
                            <img src="{{ $first ? Storage::url($first->file) : 'https://via.placeholder.com/600x400?text=No+Image' }}" alt="" loading="lazy">
                            <a class="gallery-link" href="{{ route('guest.galeri.show', $galery) }}" aria-label="Buka galeri" style="position:absolute;inset:0;z-index:1;display:block;"></a>
                            <div class="gallery-overlay fade-slide">
                                <a class="icon-btn" id="dl-sv-{{ $galery->id }}" href="{{ $first ? Storage::url($first->file) : '#' }}" download><i class="bi bi-download"></i></a>
                                <span class="icon-btn"><i class="bi bi-bookmark-fill"></i></span>
                            </div>
                            <button type="button" class="gallery-arrow left" data-cycle="-1" data-id="sv-{{ $galery->id }}"><i class="bi bi-chevron-left"></i></button>
                            <button type="button" class="gallery-arrow right" data-cycle="1" data-id="sv-{{ $galery->id }}"><i class="bi bi-chevron-right"></i></button>
                            <div class="gallery-dots"><div class="dots-scroll" id="dots-sv-{{ $galery->id }}"></div></div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5" data-aos="fade-up">
                    <i class="bi bi-bookmark" style="font-size:3rem;color:#e2e8f0;"></i>
                    <p class="text-muted mt-3">Belum ada galeri yang disimpan.</p>
                    <a href="{{ route('guest.galeri') }}" class="btn btn-primary btn-sm mt-2">Jelajahi Galeri</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Photo Viewer -->
    <div id="photoModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.9); z-index:9999; justify-content:center; align-items:center; backdrop-filter:blur(5px);">
        <button onclick="closePhotoModal()" style="position:absolute; top:20px; right:20px; background:rgba(255,255,255,0.2); border:2px solid white; color:white; width:50px; height:50px; border-radius:50%; cursor:pointer; font-size:24px; display:flex; align-items:center; justify-content:center; transition:all 0.3s ease; backdrop-filter:blur(10px);" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
            <i class="bi bi-x-lg"></i>
        </button>
        <div style="max-width:90%; max-height:90%; position:relative;">
            <img id="modalPhoto" src="" alt="Profile Photo" style="max-width:100%; max-height:90vh; border-radius:16px; box-shadow:0 20px 60px rgba(0,0,0,0.5); animation:zoomIn 0.3s ease;">
        </div>
    </div>

    <style>
        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        #photoModal {
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .avatar:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
    </style>
    </section>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function(){
    if (window.AOS) { AOS.init({ duration: 600, once: true }); }
  });
</script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  const tabs = document.querySelectorAll('.tab-btn');
  tabs.forEach(btn=>{
    btn.addEventListener('click', function(){
      tabs.forEach(b=>b.classList.remove('active'));
      this.classList.add('active');
      document.querySelectorAll('.tab-pane').forEach(p=>p.classList.remove('active'));
      const t = document.querySelector(this.dataset.target);
      if (t) t.classList.add('active');
    });
  });

  const photos = {};
  @isset($likedGaleries)
    @foreach($likedGaleries as $galery)
      photos['lg-{{ $galery->id }}'] = [
        @foreach(($galery->fotos ?? collect()) as $f)
          @json(Storage::url($f->file)){{ !$loop->last ? ',' : '' }}
        @endforeach
      ];
    @endforeach
  @endisset
  @isset($savedGaleries)
    @foreach($savedGaleries as $galery)
      photos['sv-{{ $galery->id }}'] = [
        @foreach(($galery->fotos ?? collect()) as $f)
          @json(Storage::url($f->file)){{ !$loop->last ? ',' : '' }}
        @endforeach
      ];
    @endforeach
  @endisset

  const state = new Map();
  function setImage(tileId, idx){
    const list = photos[tileId] || [];
    if (!list.length) return;
    const tile = document.getElementById(tileId);
    const img = tile?.querySelector('img');
    if (!img) return;
    img.src = list[idx];
    const dots = document.querySelectorAll('#dots-' + tileId + ' .dot');
    dots.forEach((d,i)=> d.classList.toggle('active', i === idx));
    const dl = document.getElementById('dl-' + tileId);
    if (dl) dl.href = list[idx];
    const wrap = document.querySelector('#dots-' + tileId);
    if (wrap) {
      const active = wrap.children[idx];
      if (active) {
        const left = active.offsetLeft - Math.max(0, (wrap.clientWidth - active.clientWidth)/2);
        wrap.scrollTo({ left, behavior: 'smooth' });
      }
    }
    state.set(tileId, { idx });
  }

  document.querySelectorAll('.gallery-card').forEach(tile => {
    const id = tile.id;
    const list = photos[id] || [];
    if (!list.length) return;
    const dotsWrap = document.getElementById('dots-' + id);
    if (dotsWrap) {
      dotsWrap.innerHTML = '';
      list.forEach((_, i) => {
        const d = document.createElement('span');
        d.className = 'dot' + (i === 0 ? ' active' : '');
        d.addEventListener('click', (e)=> { e.stopPropagation(); setImage(id, i); });
        dotsWrap.appendChild(d);
      });
      const dotsContainer = dotsWrap.closest('.gallery-dots');
      if (dotsContainer) dotsContainer.style.display = list.length > 1 ? 'flex' : 'none';
    }
    tile.classList.toggle('has-multi', list.length > 1);
    setImage(id, 0);
  });

  document.querySelectorAll('.gallery-arrow').forEach(btn => {
    btn.addEventListener('click', function(e){
      e.preventDefault(); e.stopPropagation();
      const id = this.getAttribute('data-id');
      const step = parseInt(this.getAttribute('data-cycle')) || 0;
      const list = photos[id] || [];
      if (!list.length) return;
      const cur = state.get(id)?.idx || 0;
      const next = (cur + step + list.length) % list.length;
      setImage(id, next);
    });
  });
});

// Photo modal popup
function showPhotoModal(photoUrl) {
  const modal = document.getElementById('photoModal');
  const modalImg = document.getElementById('modalPhoto');
  modal.style.display = 'flex';
  modalImg.src = photoUrl;
  document.body.style.overflow = 'hidden';
}

function closePhotoModal() {
  const modal = document.getElementById('photoModal');
  modal.style.display = 'none';
  document.body.style.overflow = 'auto';
}

// Close modal saat klik di luar foto
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('photoModal');
  if (modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === this) {
        closePhotoModal();
      }
    });
  }
  
  // Close dengan ESC key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closePhotoModal();
    }
  });
});
</script>
@endpush
