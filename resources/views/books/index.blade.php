@extends('dashboard')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <div class="container">
        <h1 class="text-center">Danh sách Sản Phẩm</h1>
        <div class="col-12">
            @if (Session::has('success'))
                <p class="text-success">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    {{ Session::get('success') }}
                </p>
            @endif
        </div>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus"></i>
            Thêm Sách
        </a>
        <hr />
        <table class="table table-bordered" border="2" style="width: 1000px">

            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Sách</th>
                    <th>ISBN</th>
                    <th>Tác Giả</th>
                    <th>Thể loại</th>
                    <th>Số Trang</th>
                    <th>Năm Xuất Bản</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $key => $book)
                    <tr class="item-{{ $book->id }}">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->book_id }} </td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category }}</td>
                        <td>{{ $book->number_page }}</td>
                        <td>{{ $book->year }}</td>
                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Sửa</a>
                            <a data-url="{{ route('books.destroy', $book->id) }}"
                                id="{{ $book->id }}"class="btn btn-light deleteIcon">Xóa</i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $books->onEachSide(5)->links() }}
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $('#createNew').click(function() {
            $('#ajaxModelAdd').modal('show');
        });
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let url = $(this).data('url');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Bạn Có Chắc Chắn Xóa',
                text: "Bạn sẽ không thể hoàn tác !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng Ý'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(res) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            $('.item-' + id).remove();
                        }
                    });
                }
            });
        });
    </script>
@endsection
