<!-- resources/views/partials/post.blade.php -->
<div class="post-card mb-4">
    <div class="post-header d-flex align-items-center">
        <img src="{{ $post->user->profile_picture }}" alt="{{ $post->user->username }}" class="rounded-circle me-2" width="32" height="32">
        <a href="{{ route('profile.show', $post->user->username) }}" class="text-dark text-decoration-none">
            <span class="fw-bold">{{ $post->user->username }}</span>
        </a>
        <button class="btn btn-link ms-auto text-dark">
            <i class="fas fa-ellipsis-h"></i>
        </button>
    </div>
    @if($post->image_url)
        <img src="{{ $post->image_url }}" class="post-image" alt="Post Image">
    @endif
    <div class="post-actions p-3">
        <button class="btn btn-link p-0 me-3" id="likeBtn{{ $post->id }}">
            <i class="{{ $post->likes->where('user_id', Auth::id())->count() ? 'fas' : 'far' }} fa-heart"></i>
        </button>
        <button class="btn btn-link p-0 me-3">
            <i class="far fa-comment"></i>
        </button>
        <button class="btn btn-link p-0 float-end" id="saveBtn{{ $post->id }}">
            <i class="{{ $post->savedPosts->where('user_id', Auth::id())->count() ? 'fas' : 'far' }} fa-bookmark"></i>
        </button>
    </div>
    <div class="post-footer p-3">
        <p class="likes mb-2 fw-bold">
            <span id="likeCount{{ $post->id }}">{{ $post->likes->count() }}</span> вподобань
        </p>
        <p class="caption"><strong>{{ $post->user->username }}</strong> {{ $post->caption }}</p>
        <p class="text-muted small">{{ $post->created_at->diffForHumans() }}</p>
    </div>
    <div class="post-comments p-3 border-top">
        <input type="text" class="form-control" placeholder="Додати коментар...">
    </div>
</div>
