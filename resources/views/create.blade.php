@extends('base::layouts.master')

@section('content')
    <form class="form-horizontal form-bordered" method="post" action="{{ route('menus.store') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-9">
                <div class="box box-info">
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