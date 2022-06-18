@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center max-w-5xl mx-auto pt-12 pb-6">
    <h3 class="text-2xl font-semibold text-gray-900">
        @if($pagetype == 'PATCH')
        {{$item->merk . ' - ' . $item->serial_number}}
        @else
        Tambah item
        @endif
    </h3>
    <a href="{{ route('home') }}" class="text-gray-700 border border-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg px-2 pr-4 py-2.5 text-center flex justify-start items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-current">
            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
        </svg>
        <span class="">Kembali</span>
    </a>
</div>
<form class="create-wardrobe grid pb-12 lg:grid-cols-2 gap-8 max-w-5xl mx-auto" action="{{ $route; }}" method="POST" enctype="multipart/form-data"> @csrf
    @if ($pagetype == "PATCH")
    @method('PATCH')
    @endif
    <div class="flex flex-col w-full gap-4 h-full justify-center max-h-full">
        <div class="flex flex-col justify-center items-center w-full h-full min-h-[16rem]">
            <label for="thumbnail" class="relative flex flex-col justify-center items-center w-full h-full bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer hover:bg-gray-100">
                @if($pagetype == 'PATCH')
                <img src="{{'/uploads/wardrobe/'.$item->image_url}}" class="w-full object-cover">
                @else
                <div class="flex flex-col justify-center items-center h-full gap-2">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="-mt-2 text-gray-500">PNG, or JPG (MAX. 2MB)</p>
                </div>
                @endif
            </label>
            <input id="thumbnail" type="file" class="hidden" name="thumbnail" accept="image/jpeg,image/jpg,image/png" value="{{old('thumbnail')}}">
            @if ($errors->has('thumbnail'))
            <p class="text-red-500 text-sm mt-2 w-full thumbnailRequired">{{ $errors->first('thumbnail') }}</p>
            @endif
        </div>
    </div>
    <div class="w-full flex flex-col">
        <div class="grid gap-4 md:gap-6 md:grid-cols-2">
            <div class="w-full">
                <label for="merk" class="block mb-2 font-medium">Brand Name</label>
                <input type="text" id="merk" name="merk" class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Zara, etc.." @if($pagetype=='PATCH' ) value="{{$item->merk}}" @endif @if(old('merk')) value="{{old('merk')}}" @endif value="">
                @if ($errors->has('merk'))
                <p class="text-red-500 text-sm mt-2">{{ $errors->first('merk') }}</p>
                @endif
            </div>
            <div class="w-full">
                <label for="tipe" class="block mb-2 font-medium">Clothes Types</label>
                <select id="tipe" name="tipe" class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" @if($pagetype=='PATCH' ) value="{{$item->tipe}}" @endif value="{{old('tipe')}}">
                    <option value="">Choose a tipe</option>
                    <option @if($pagetype=='PATCH' && $item->tipe=="atasan") selected @endif @if(old('tipe')=="atasan" ) selected @endif value="atasan" >Atasan</option>
                    <option @if($pagetype=='PATCH' && $item->tipe=="bawahan") selected @endif @if(old('tipe')=="bawahan" ) selected @endif value="bawahan">Bawahan</option>
                </select>
                @if ($errors->has('tipe'))
                <p class="text-red-500 text-sm mt-2">{{ $errors->first('tipe') }}</p>
                @endif
            </div>
            <div class="w-full">
                <label for="price" class="block mb-2 font-medium">Price</label>
                <input type="number" id="price" name="price" class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="40000" @if($pagetype=='PATCH' ) value="{{$item->price}}" @endif value="{{old('price')}}" min="0">
                @if ($errors->has('price'))
                <p class="text-red-500 text-sm mt-2">{{ $errors->first('price') }}</p>
                @endif
            </div>
            <div class="w-full">
                <label for="category" class="block mb-2 font-medium">Category</label>
                <select id="category" name="category" class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" @if($pagetype=='PATCH' ) value="{{$item->category}}" @endif value="{{old('category')}}">
                    <option value="">Choose a category</option>
                    <option @if($pagetype=='PATCH' && $item->category=="baju wanita") selected @endif @if(old('category')=="baju wanita" ) selected @endif value="baju wanita">Wanita</option>
                    <option @if($pagetype=='PATCH' && $item->category=="baju pria") selected @endif @if(old('category')=="baju pria" ) selected @endif value="baju pria">Pria</option>
                </select>
                @if ($errors->has('category'))
                <p class="text-red-500 text-sm mt-2">{{ $errors->first('category') }}</p>
                @endif
            </div>
            <div class="w-full">
                <label for="size" class="block mb-2 font-medium">Size</label>
                <input type="text" id="size" name="size" class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="S, M, etc..." @if($pagetype=='PATCH' ) value="{{$item->size}}" @endif value="{{old('size')}}">
                @if ($errors->has('size'))
                <p class="text-red-500 text-sm mt-2">{{ $errors->first('size') }}</p>
                @endif

            </div>
            <div class="w-full">
                <label for="jenis" class="block mb-2 font-medium">Jenis</label>
                <select id="jenis" name="jenis_id" class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" @if($pagetype=='PATCH' ) value="{{$item->jenis_id}}" @endif value="{{old('jenis_id')}}">
                    <option value="">Choose a category</option>
                    @foreach($jenis as $row )
                    <option @if($pagetype=='PATCH' && $item->jenis_id==$row->id) selected @endif @if(old('jenis_id')==$row->id) selected @endif value="{{$row->id}}">{{$row->nama}}</option>
                    @endforeach
                </select>
                @if ($errors->has('jenis_id'))
                <p class="text-red-500 text-sm mt-2">{{ $errors->first('jenis_id') }}</p>
                @endif

            </div>
            <div class="w-full">
                <label for="Jumlah" class="block mb-2 font-medium">Jumlah</label>
                <input type="number" id="Jumlah" name="jumlah" class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="1,2,3..." @if($pagetype=='PATCH' ) value="{{$item->jumlah}}" @endif value="{{old('jumlah')}}" min="1">
                @if ($errors->has('jumlah'))
                <p class="text-red-500 text-sm mt-2">{{ $errors->first('jumlah') }}</p>
                @endif
            </div>
            <div class="w-full">
                <label for="serial" class="block mb-2 font-medium">Serial Number</label>
                <input type="text" id="serial" name="serial_number" class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="000000" min="6" @if($pagetype=='PATCH' ) value="{{$item->serial_number}}" @endif value="{{old('serial_number')}}">
                @if ($errors->has('serial_number'))
                <p class="text-red-500 text-sm mt-2">{{ $errors->first('serial_number') }}</p>
                @endif
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </div>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script>
    $(function() {
        if ($('.thumbnailRequired').length || $('[for="thumbnail"] img').length) sessionStorage.removeItem("thumbnail")
        if (sessionStorage.getItem('thumbnail')) $('#thumbnail').prev().html('<img src="' + sessionStorage.getItem('thumbnail') + '" class="m-auto w-full object-cover z-10">')
        $('#thumbnail').change(function() {
            const target = $(this).prev();
            const reader = new FileReader();

            reader.addEventListener('load', function(event) {
                target.html('<img src="' + event.target.result + '" class="m-auto w-full object-cover">');
                sessionStorage.setItem('thumbnail', event.target.result);
            });

            reader.addEventListener('progress', function() {
                target.html(`<div class="h-24 grid place-items-center"><svg role="status" class="w-8 h-8 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"></path></svg></div>`);
            });

            reader.addEventListener('error', function() {
                target.html('<p class="text-red-500 text-sm">Error loading image.</p>');
            });
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endsection