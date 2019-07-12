<template>
    <div>
        <form action="/comments/{{ $item->id }}" method="POST">
                @csrf
            <div class="p-item__container1">
                <textarea name="comment" cols="30" rows="8" class="p-item__input">

                </textarea>
                <button type="submit" class="btn btn-lightblue">コメントする</button>
            </div>
        </form>
    </div>
</template>
