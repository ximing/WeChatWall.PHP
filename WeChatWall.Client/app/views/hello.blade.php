<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel PHP Framework</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap-theme.css">
    <script src="http://cdn.bootcss.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">微上墙</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">微上墙</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">blog</a></li>
                    <li><a href="#">github</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="bs-callout bs-callout-info">
        <h4>使用方法</h4>
        <p>定期刷新可以获得新消息</p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>名字</th>
                    <th>内容</th>
                    <th>上墙</th>
                </tr>
                </thead>
                <tbody>

                @foreach($list as $id => $value)
                <tr>
                    <td>{{{ $value['nick_name']}}}</td>
                    <td>{{{ $value['content']}}}</td>
                    <td>{{{ $value['date_time']}}}</td>
                    <td><a href="./add/{{$value['_id']}}">上墙</a> </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
