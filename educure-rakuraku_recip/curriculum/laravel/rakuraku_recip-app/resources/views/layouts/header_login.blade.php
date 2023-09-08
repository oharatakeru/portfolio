<header>
    <div class="login-header header-flex">
        <div>
            <p><a href="{{ route('top') }}">らくらくレシピ</a></p> 
        </div>
        <div class="keyword">
            <form class="header_login" action="{{ route('recipe.search') }}" method="post"> 
                @csrf
                <input type="text" name="keyword" id="keyword" class="global_search_keyword" placeholder="レシピ名・食材名" autocomplete="off">
                <input type="submit" name="commit" value="レシピ検索" id="submit_button" class="commit-btn global_search_keyword">
            </form>
        </div>
        <div>
            <form class="header_login" action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </div>
    </div>
</header>
