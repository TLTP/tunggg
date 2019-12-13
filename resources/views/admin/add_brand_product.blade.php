@extends('admin_layout')
@section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            THÊM THƯƠNG HIỆU
                        </header>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post"
                                >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">TÊN THƯƠNG HIỆU</label>
                                    <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">MÔ TẢ THƯƠNG HIỆU</label>
                                    <textarea style="resize: none" rows="6" class="form-control"
                                    name="brand_product_desc"  id="exampleInputPassword1" placeholder="Mô tả danh mục"> </textarea>
                                </div>

                                <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thịc</label>
                                <select name="brand_product_status"class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị </option>
                                    </select>
                                
                                </div>
                                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                                  <?php
                                $message = Session::get('message');
                                if($message)
                                    {
                                        echo $message;
                                        Session::put('message',null);
                                    }
                            ?>
                            </form>
                            </div>

                        </div>
                    </section>
              
            </div>
@endsection   