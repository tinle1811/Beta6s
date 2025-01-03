@extends('user.layouts.app')
@section('title',$viewData['title'])
@section('content')
    @include('user.layouts.breadcrumbs')
        <!--contact map start-->
        <div class="contact_map mt-60">
        <div class="map-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2484.6701389278105!2d-0.13442558407566274!3d51.48256882033922!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760532743b90e1%3A0x790260718555a20c!2sU.S.%20Embassy%2C%20London!5e0!3m2!1sen!2sbd!4v1623927462716!5m2!1sen!2sbd"  style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
    <!--contact map end-->

        <!--contact area start-->
        <div class="contact_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message content">
                        <h3>contact us</h3>
                        <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum
                            est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum
                            formas human. qui sequitur mutationem consuetudium lectorum. Mirum est notare quam</p>
                        <ul>
                            <li><i class="fa fa-fax"></i> Address : Your address goes here.</li>
                            <li><i class="fa fa-envelope-o"> </i> Email: <a
                                    href="mailto:demo@example.com">demo@example.com </a>
                            </li>
                            <li><i class="fa fa-phone"></i> Phone:<a href="tel: 0123456789"> 0123456789 </a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message form" id="contact-form-section">
                        <h3>Hãy cho chúng tôi biết ý kiến của bạn</h3>
                    
                        <form id="contact-form" method="POST" action="{{ route('contact.form') }}">
                            @csrf
                            @guest
                            <p>
                                <label> Họ tên</label>
                                <input name="name" value="{{ old('name') }}" placeholder="Họ tên..." type="text">
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger">Vui lòng nhập họ tên</div>
                                @endif
                            </p>
                            <p>
                                <label> Email</label>
                                <input name="email" value="{{ old('email') }}" placeholder="Email..." type="email">
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger">Vui lòng nhập email</div>
                                @endif
                            </p>
                            @else
                            <p>
                                <label> Họ tên</label>
                                <input name="name" value="{{ old('name',$viewData['taikhoan']->TenDN) }}" placeholder="Họ tên..." type="text">
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger">Vui lòng nhập họ tên</div>
                                @endif
                            </p>
                            <p>
                                <label> Email</label>
                                <input name="email" value="{{ old('email', $viewData['taikhoan']->Email) }}" placeholder="Email..." type="email">

                                @if ($errors->has('email'))
                                    <div class="alert alert-danger">Vui lòng nhập email</div>
                                @endif
                            </p>
                            @endguest
                            <p>
                                <label> Số điện thoại</label>
                                <input name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại..." type="text">
                                @if ($errors->has('phone'))
                                    <div class="alert alert-danger">Vui lòng nhập số điện thoại</div>
                                @endif
                            </p>
                            <div class="contact_textarea">
                                <label> Nội dung</label>
                                <textarea placeholder="Điền nội dung..." name="message" class="form-control2">{{ old('message') }}</textarea>
                                @if ($errors->has('message'))
                                    <div class="alert alert-danger">Vui lòng nhập nội dung</div>
                                @endif
                            </div>
                            <button type="submit" class="btn-submit"> Gửi</button>
                    
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </form>
                    </div>                   
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--contact area end-->
@endsection