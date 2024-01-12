<div class="list-group">
    @foreach ($following as $follows)
        <a href="/profile/{{ $follows->userBeingFollowed->username }}" class="list-group-item list-group-item-action">
            <img class="avatar-tiny" src="{{ $follows->userBeingFollowed->avatar }}" />
            {{ $follows->userBeingFollowed->username }}
        </a>
    @endforeach
</div>
