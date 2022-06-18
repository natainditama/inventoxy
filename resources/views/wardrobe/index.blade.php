@extends('layouts.app')
@section('styles')
<style>
    .swal2-validation-message {
        margin: 0;
        padding: 0.4em 1.6em;
        background: transparent;
        justify-content: flex-start;
    }
</style>
@endsection
@section('content')
<div class="flex justify-between items-center pb-4 pt-12">
    <h1 class="text-2xl font-semibold">Wardrobe</h1>
    <div class="flex gap-4">
        <button type="button" class="add-jenis text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center flex">
            <span class="mr-2">Jenis</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: currentColor">
                <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path>
                <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
            </svg>
        </button>
        <a class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center" href="{{ route('wardrobe.create'); }}">
            Tambah item
        </a>
    </div>
</div>
<div class="flex flex-col lg:flex-row justify-between gap-6 items-center">
    <form action="{{ $routeFilter }}" class="hidden md:flex justify-center lg:justify-start gap-6 w-full space-y-2 md:space-y-0 order-2 lg:order-none" id="filter-menu">
        <select id="category-baju" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-max p-2.5 w-full">
            <option value="all">Semua Category</option>
            <option value="baju wanita">Wanita</option>
            <option value="baju pria">Pria</option>
        </select>
        <select id="tipe-baju" name="tipe" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-max p-2.5 w-full">
            <option value="all">Semua Tipe</option>
            <option value="atasan">Atasan</option>
            <option value="bawahan">Bawahan</option>
        </select>
        <select id="jenis-baju" name="jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-max p-2.5 w-full">
            <option value="all">Semua Jenis</option>
            @foreach($jenis as $item_jenis )
            <option value="{{$item_jenis->id}}">{{$item_jenis->nama}}</option>
            @endforeach
        </select>
    </form>
    <form class="flex gap-4 items-center max-w-[400px] w-full" action="#">
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="search" id="search" autocomplete="off" name="keyword" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300   rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search here..." value="" required="">
        </div>
        <button type="button" class="block md:hidden py-2.5 px-5 font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" id="filter-toggle" data-toggle="filter-menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill:inherit;">
                <path d="M7 11h10v2H7zM4 7h16v2H4zm6 8h4v2h-4z"></path>
            </svg>
        </button>

    </form>
</div>
<div class="pb-12 pt-4 wardrobes">
    @include('wardrobe.pagination')
</div>
@endsection
@section('wardobeModal')
<div class="flex justify-between items-start p-4 rounded-t border-b">
    <h3 class="text-xl font-semibold text-gray-900">
        Loading...
    </h3>
    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="wardrobeModal">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
<div class="p-6 space-y-6">
    <div class="h-24 grid place-items-center">
        <svg role="status" class="w-8 h-8 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"></path>
        </svg>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function() {
        $("img").on('error', function() {
            const alt = $(this).data('alt') ?? "Placeholder";
            $(this).attr('src', `http://placehold.jp/c0c0c0/ffffff/400x400.png?text=${alt.toLocaleLowerCase()}`)
            $(this).attr('srcSet', `http://placehold.jp/c0c0c0/ffffff/400x400.png?text=${alt.toLocaleLowerCase()}`)
        });
        const filterID = ['#jenis-baju', '#tipe-baju', '#category-baju']
        filterID.forEach(element => $(element).val('all'));
        let filterValue = {
            category: "all",
            tipe: "all",
            jenis: "all",
            keyword: "",
            page: 1,
            all: true
        }
        $('#jenis-baju, #tipe-baju, #category-baju').change(function() {
            const value = $(this).val();
            filterValue[$(this).attr('name')] = value;
            $(this).val(`${value}`);
            if (value != 'all') filterValue.all = false
            else filterValue.all = true
            fetchData()
        });
        $('#search').keyup(function(event) {
            setTimeout(() => {
                const value = $(this).val();
                filterValue[$(this).attr('name')] = value;
                $(this).val(value);
                if (value != '') filterValue.all = false
                else filterValue.all = true
                fetchData()
            }, 500);
        });
        $(document).on('click', '#page-link', function(event) {
            event.preventDefault();
            const page = $(this).attr('href').split('page=')[1];
            filterValue['page'] = page;
            fetchData();
        });
        $(document).on('click', '[data-modal-toggle="wardrobeModal"]', function(event) {
            $('#wardrobeModal').toggleClass('show');
            const id = $(this)?.data('id');
            if (id) {
                $("#wardrobeModal").find('.modal-content').html(`<div class="flex justify-between items-start p-4 rounded-t border-b"><h3 class="text-xl font-semibold text-gray-900">Loading...</h3><button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="wardrobeModal"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button></div><div class="p-6 space-y-6"><div class="h-24 grid place-items-center"><svg role="status" class="w-8 h-8 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"></path></svg></div></div>`)
                fetchShow(id);
            }
        });
        $('.add-jenis').click(function(event) {
            Swal.fire({
                title: 'Tambah Jenis Baju',
                html: `<div class="m-1"><input type="text" name="add-jenis" id="add-jenis" class="bg-white border border-gray-300 rounded-lg focus:border-blue-500 block w-full p-2.5" value="" placeholder="Enter a jenis baju"></div>`,
                showCancelButton: true,
                confirmButtonText: 'Tambah',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const currentJenis = [];
                    $('#jenis-baju option').each((i, el) => {
                        currentJenis.push($(el).text().toLowerCase())
                    });
                    if (!$('#add-jenis').val()) {
                        Swal.showValidationMessage(`Jenis tidak boleh kosong`)
                    } else if (currentJenis.includes($('#add-jenis').val())) {
                        Swal.showValidationMessage(`Jenis sudah ada`)
                    }
                    return [$('#add-jenis').val()]
                },
            }).then((result) => {
                if (result.value) {
                    $.post('{{ $routeJenis }}', {
                        nama: result.value[0]
                    }, function(res) {
                        Swal.fire({
                            title: res.message,
                            icon: res.type,
                            confirmButtonText: 'OK'
                        });
                        $.post('{{ $routeJenis }}', function(res) {
                            $('#jenis-baju').html("");
                            $('#jenis-baju').append(`<option value="all">Semua Jenis</option>`)
                            res.forEach(function(item) {
                                $('#jenis-baju').append(`<option value="${item.id}">${item.nama}</option>`)
                            });
                        });
                    })
                }
            })
        });
        $(document).on('click', '.delete-btn', function(event) {
            const id = $(this)?.data('id');
            const url = $(this)?.data('url');
            if (id && url) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url,
                            type: 'DELETE',
                            data: {
                                id,
                                "_method": 'DELETE',
                            },
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then(() => fetchData())
                            },
                            error: function(error) {
                                Swal.fire(
                                    'Error!',
                                    'Your file has not been deleted.',
                                    'error'
                                ).then(() => fetchData())
                            }
                        });
                    }
                })
            }
        });
        $('#filter-toggle').click(function() {
            $(`#${$(this).data("toggle")}`).slideToggle(50)
        })
        $('.wardrobe-image').click(function() {
            const id = $(this).data('id');
            fetchShow(id);
        })

        function fetchShow(id) {
            $.post('{{ $routeDetail }}', {
                id
            }, function(data) {
                $("#wardrobeModal").find('.modal-content').html(data);
            })
        }

        function fetchData() {
            $.post('{{ $routeFilter }}', {
                ...filterValue
            }, function(res) {
                $('.wardrobes').html(res);
            });
        }

    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection