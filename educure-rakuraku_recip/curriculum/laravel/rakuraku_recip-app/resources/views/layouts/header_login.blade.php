<header>
    <div class="login-header header-flex sp-none">
        <div>
            <p><a href="{{ route('top') }}">らくらくレシピ</a></p> 
        </div>
        <div class="keyword">
            <form class="header_login" action="{{ route('recipe.search') }}" method="post" target="_blank"> 
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

    <div class="login-header header-flex pc-none">
        <div class="header-sp">
            <p><a href="{{ route('top') }}">らくらくレシピ</a></p> 
            <form class="header_login header-form-sp" action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </div>
        <div class="keyword mt10">
            <form class="header_login header-keyword" action="{{ route('recipe.search') }}" method="post" target="_blank"> 
                 @csrf
                <input type="text" name="keyword" id="keyword" class="global_search_keyword" placeholder="レシピ名・食材名" autocomplete="off">
                <input type="submit" name="commit" value="レシピ検索" id="submit_button" class="commit-btn global_search_keyword">
            </form>
        </div>
    </div>
</header>
