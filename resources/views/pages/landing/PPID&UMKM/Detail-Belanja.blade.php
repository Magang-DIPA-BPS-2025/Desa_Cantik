@extends('layouts.landing.app', ['title' => $belanja->judul])

@push('styles')
<style>
    .product-header h2 {
        font-weight: 700;
        font-size: 2rem;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .card-body h3 {
        color: #28a745;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .rating-stars span {
        font-size: 1.8rem;
        cursor: pointer;
        transition: all 0.2s ease;
        filter: drop-shadow(1px 1px 2px rgba(0,0,0,0.1));
    }

    .price {
        font-weight: 700;
        color: #28a745;
        font-size: 1.3rem;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        transition: 0.3s;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .review-item {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    .product-meta {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .product-meta .price-rating {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .star-rating {
        cursor: pointer;
        display: flex;
        gap: 8px;
    }

    .star-rating .star {
        transition: all 0.3s ease;
        position: relative;
    }

    .star-transparent {
        opacity: 0.3 !important;
        color: #6c757d !important;
    }

    .star-selected {
        opacity: 1 !important;
        color: #ffc107 !important;
        transform: scale(1.1);
        filter: drop-shadow(0 0 4px rgba(255, 193, 7, 0.5));
    }

    .star-hover {
        opacity: 0.7 !important;
        color: #ffc107 !important;
        transform: scale(1.05);
    }

    .rating-hint {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.5rem;
        min-height: 20px;
    }

    .rating-value {
        font-size: 0.9rem;
        color: #28a745;
        font-weight: 600;
        margin-left: 8px;
    }

    /* PERBAIKAN: Styling untuk tombol dengan jarak */
    .button-group {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px; /* Jarak antara tombol */
        margin-top: 1rem;
    }

    /* PERBAIKAN: Badge kategori dengan teks putih */
    .category-badge {
        background: #28a745 !important;
        color: white !important;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
        display: inline-block;
    }

    @media (max-width: 576px) {
        .product-header h2 {
            font-size: 1.5rem;
        }
        
        .rating-stars span {
            font-size: 1.6rem;
        }
        
        .star-rating {
            gap: 6px;
        }

        /* PERBAIKAN: Responsive tombol di mobile */
        .button-group {
            gap: 8px;
            justify-content: flex-start;
        }

        .button-group .btn {
            flex: 1;
            min-width: 140px;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    {{-- Card Produk --}}
    <div class="card shadow-sm mb-4 fade-in-up">
        @if($belanja->foto)
            <img src="{{ asset('storage/' . $belanja->foto) }}" 
                 alt="{{ $belanja->judul }}" 
                 class="w-100" style="height:350px; object-fit:cover;">
        @endif

        <div class="card-body product-meta">
            <h3 class="mb-3">{{ $belanja->judul }}</h3>

            {{-- Harga & Rating --}}
            <div class="price-rating">
                <div class="price">
                    Rp {{ number_format($belanja->harga, 0, ',', '.') }}
                </div>
                <div class="text-warning fw-bold d-flex align-items-center gap-1">
                    @php
                        $avg = $belanja->averageRating();
                        $fullStars = floor($avg);
                        $halfStar = $avg - $fullStars >= 0.5;
                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                    @endphp

                    @for($i = 1; $i <= $fullStars; $i++)
                        <span>⭐</span>
                    @endfor

                    @if($halfStar)
                        <span>⭐</span>
                    @endif

                    @for($i = 1; $i <= $emptyStars; $i++)
                        <span style="opacity: 0.3;">⭐</span>
                    @endfor

                    <small class="text-muted">({{ $belanja->ratingCount() }} ulasan)</small>
                </div>
            </div>

            {{-- Kategori - PERBAIKAN: Teks putih --}}
            @if($belanja->kategori)
                <span class="category-badge">
                    <i class="fas fa-tag me-1"></i>{{ $belanja->kategori }}
                </span>
            @endif

            {{-- Deskripsi --}}
            <p class="text-muted mb-4">{{ $belanja->deskripsi }}</p>

            {{-- Tombol - PERBAIKAN: Dengan jarak --}}
            <div class="button-group">
                @if($belanja->wa)
                    <a href="https://wa.me/{{ $belanja->wa }}" target="_blank" class="btn btn-success">
                        <i class="fab fa-whatsapp me-1"></i> Hubungi via WhatsApp
                    </a>
                @endif
                <a href="{{ route('belanja') }}" class="btn btn-outline-success">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke UMKM
                </a>
            </div>
        </div>
    </div>

    {{-- Form Rating Interaktif --}}
    <div class="card shadow-sm mb-4 fade-in-up p-4">
        <h5 class="fw-bold mb-3 text-success">
            <i class="fas fa-star me-2"></i>Beri Rating Produk Ini
        </h5>

        {{-- Tampilkan pesan error --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('belanja.rating', $belanja->id) }}" method="POST" id="ratingForm">
            @csrf
            <div class="mb-3">
                <label for="nama_user" class="form-label">Nama Anda</label>
                <input type="text" name="nama_user" class="form-control" placeholder="Masukkan nama" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Pilih Rating:</label>
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <div class="star-rating">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="star star-transparent" data-value="{{ $i }}">⭐</span>
                        @endfor
                    </div>
                    <span class="rating-value" id="ratingValue"></span>
                </div>
                <div class="rating-hint" id="ratingHint">Klik bintang untuk memilih rating</div>
                <input type="hidden" name="rating" id="ratingInput" required>
                @error('rating')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Komentar (opsional):</label>
                <textarea name="komentar" class="form-control" rows="3" placeholder="Bagaimana pendapat Anda tentang produk ini?">{{ old('komentar') }}</textarea>
                @error('komentar')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success" id="submitBtn" disabled>
                <i class="fas fa-paper-plane me-1"></i> Kirim Rating
            </button>
        </form>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif
    </div>

    {{-- Daftar Ulasan --}}
    <div class="card shadow-sm border-0 fade-in-up p-4">
        <h5 class="fw-bold mb-3 text-success">
            <i class="fas fa-comments me-2"></i>Ulasan Pembeli
            <span class="badge bg-success ms-2">{{ $belanja->ratingCount() }}</span>
        </h5>

        @forelse($belanja->ratings as $r)
            <div class="review-item">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <strong class="text-dark">{{ $r->nama_user ?? 'nama_user' }}</strong>
                        <small class="text-muted ms-2">{{ $r->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $r->rating ? 'text-warning' : 'text-muted' }}" style="{{ $i <= $r->rating ? '' : 'opacity: 0.3;' }}">⭐</span>
                        @endfor
                    </div>
                </div>

                @if($r->komentar)
                    <p class="mb-0 text-dark">{{ $r->komentar }}</p>
                @else
                    <p class="mb-0 text-muted fst-italic">Tidak ada komentar</p>
                @endif
            </div>
        @empty
            <div class="text-center py-4">
                <i class="fas fa-comment-slash text-muted fa-2x mb-3"></i>
                <p class="text-muted mb-0">Belum ada ulasan untuk produk ini.</p>
                <small class="text-muted">Jadilah yang pertama memberikan rating!</small>
            </div>
        @endforelse
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingInput');
    const ratingHint = document.getElementById('ratingHint');
    const ratingValue = document.getElementById('ratingValue');
    const submitBtn = document.getElementById('submitBtn');
    let selectedRating = 0;

    const ratingTexts = {
        1: 'Tidak Puas - Produk tidak sesuai harapan',
        2: 'Kurang Puas - Ada beberapa kekurangan',
        3: 'Cukup - Produk sesuai ekspektasi',
        4: 'Puas - Produk bagus dan memuaskan',
        5: 'Sangat Puas - Produk luar biasa!'
    };

    const ratingEmojis = {
        1: '😞',
        2: '😐', 
        3: '🙂',
        4: '😊',
        5: '😍'
    };

    function updateStars(rating, isHover = false) {
        stars.forEach(star => {
            const starValue = parseInt(star.dataset.value);
            
            star.classList.remove('star-transparent', 'star-selected', 'star-hover');
            
            if (starValue <= rating) {
                if (isHover) {
                    star.classList.add('star-hover');
                } else {
                    star.classList.add('star-selected');
                }
            } else {
                star.classList.add('star-transparent');
            }
        });
    }

    function resetStars() {
        if (selectedRating === 0) {
            stars.forEach(star => {
                star.classList.remove('star-selected', 'star-hover');
                star.classList.add('star-transparent');
            });
            ratingHint.textContent = 'Klik bintang untuk memilih rating';
            ratingValue.textContent = '';
            submitBtn.disabled = true;
        }
    }

    function setRating(value) {
        selectedRating = value;
        ratingInput.value = value;
        
        updateStars(value);
        ratingHint.textContent = ratingTexts[value] || `Rating: ${value} bintang`;
        ratingValue.textContent = `${value}/5 ${ratingEmojis[value] || ''}`;
        ratingValue.style.opacity = '1';
        submitBtn.disabled = false;
    }

    stars.forEach(star => {
        const value = parseInt(star.dataset.value);

        star.addEventListener('click', function() {
            setRating(value);
        });

        star.addEventListener('mouseover', function() {
            if (selectedRating === 0) {
                updateStars(value, true);
                ratingHint.textContent = ratingTexts[value] || `Beri rating ${value} bintang`;
                ratingValue.textContent = `${value}/5 ${ratingEmojis[value] || ''}`;
                ratingValue.style.opacity = '0.7';
            }
        });

        star.addEventListener('mouseout', function() {
            if (selectedRating === 0) {
                resetStars();
            } else {
                updateStars(selectedRating);
                ratingHint.textContent = ratingTexts[selectedRating] || `Rating: ${selectedRating} bintang`;
                ratingValue.textContent = `${selectedRating}/5 ${ratingEmojis[selectedRating] || ''}`;
                ratingValue.style.opacity = '1';
            }
        });
    });

    document.getElementById('ratingForm').addEventListener('submit', function(e) {
        console.log('Submitting rating:', ratingInput.value);
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mengirim...';
        submitBtn.disabled = true;
    });

    resetStars();
    
    stars.forEach((star, index) => {
        star.style.animationDelay = `${index * 0.1}s`;
    });
});
</script>
@endpush