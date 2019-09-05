<div class="c-search">
    <form action="{{ url('priceSearch') }}" method="GET">
        <div class="c-search__wrapper">
            <input type="number" class="c-search__input" name="lowPrice"> ~
            <input type="number" classs="c-search__input" name="highPrice">
            <span class="c-search__btnWrap">
                <button class="c-search__btn btn-yellow" type="submit">
                    <i class="fa fa-search fa-fw"></i>価格で絞り込む
                </button>
            </span>
        </div>
    </form>
</div>
