@extends('base::layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/core/plugins/iCheck/all.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/core/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.css') }}">
@endpush

@section('content')
    <form class="form-horizontal form-bordered" method="post" action="{{ route('menus.store') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">基本信息</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">菜单名称</label>
                            <div class="col-md-6">
                                <input type="text"
                                       name="name"
                                       title="name"
                                       class="form-control"
                                       autocomplete="off"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">别名</label>
                            <div class="col-md-6">
                                <input type="text"
                                       name="slug"
                                       title="slug"
                                       class="form-control"
                                       autocomplete="off"
                                >
                            </div>
                        </div>
                        <div class="form-group last">
                            <label class="col-md-2 control-label">排序</label>
                            <div class="col-md-6">
                                <input type="text"
                                       name="order"
                                       title="order"
                                       class="form-control"
                                       autocomplete="off"
                                       value="0"
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="box-group" id="accordion">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">页面</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    @if(!$pages->isEmpty())
                                        <ul class="list-unstyled scroller border">
                                            @foreach($pages as $pages)
                                                <li>
                                                    <input type="checkbox" class="form-control minimal">
                                                    {{ $pages->title }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        还没有页面，请添加页面
                                    @endif
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="text-right">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                            添加到菜单
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="box box-primary collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">分类</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    @if(!empty($categories))
                                        {!! $categories !!}
                                    @else
                                        还没有分类，请添加分类
                                    @endif
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="text-right">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                            添加到菜单
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="box box-primary collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">标签</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <div class="box-body">
                                    @if(!$tags->isEmpty())
                                        <ul class="list-unstyled scroller border">
                                            @foreach($tags as $tag)
                                                <li>
                                                    <input type="checkbox" class="form-control minimal">
                                                    {{ $tag->title }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        还没有标签，请添加标签
                                    @endif
                                </div>
                                <div class="box-footer">
                                    <div class="text-right">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                            添加到菜单
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="box box-primary collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">外部链接</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>链接标题</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>链接地址</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>链接图标</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>css样式</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>打开方式</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="text-right">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                            添加到菜单
                                        </a>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">菜单结构</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">发布</h3>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script src="{{ asset('vendor/core/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('vendor/core/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.js') }}"></script>
@endpush

@push('js')
<script>
    $('input[type="checkbox"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue'
    });
    $(".scroller").mCustomScrollbar({
        theme: "minimal-dark",
        autoHideScrollbar: true
    });
</script>
@endpush