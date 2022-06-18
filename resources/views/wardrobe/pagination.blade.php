@if (count($data) > 0)
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 place-items-center">
  @foreach($data as $row)
  <div class="bg-white p-2 md:p-3 shadow mb-4 wardrobe-image cursor-pointer" data-id="{{ $row->id }}" data-modal-toggle="wardrobeModal">
    <img src="{{asset('/uploads/wardrobe/'.$row->image_url)}}" class="object-cover mx-auto" data-alt="{{ $row->merk}}" >
  </div>
  @endforeach
</div>
<div class="flex mt-6 justify-center gap-4">
  {!! $data->links() !!}
</div>
@else
<div class="flex justify-center items-center flex-1 h-full py-4">
  <h1 class="text-2xl font-semibold">Data Kosong</h1>
</div>
@endif