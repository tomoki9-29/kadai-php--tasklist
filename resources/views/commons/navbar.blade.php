<header>
    <!--ヘッダーの黒い帯-->
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!--小さな□削除 class="navbar-toggle collapsed"-->                       
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapsed" data-target="#bs-example-navbar-collapse-1" area-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--左上のタイトル-->
                <a class="navbar-brand" href="/" >Tasklist</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <!--黒い帯の右上に新規タスクの投稿（リンク先create.blade.php）を追加--> 
                    <li>{!! link_to_route('tasklists.create','新規タスクの投稿') !!}</li> 
                    <li><a href="#">Signup</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>