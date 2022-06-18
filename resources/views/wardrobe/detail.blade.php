  <div class="flex justify-between items-start p-4 rounded-t border-b">
    <h3 class="text-xl font-semibold text-gray-900">
      {{$data->merk . ' - ' . $data->serial_number}}
    </h3>
    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="wardrobeModal">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
      </svg>
    </button>
  </div>
  <div class="p-6 space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 h-full gap-2">
      <div class="flex justify-center items-start">
        <img src="{{asset('/uploads/wardrobe/'.$data->image_url)}}" class="object-cover h-60" alt="{{ $data->name}}">
      </div>
      <div class="md:col-span-2 flex justify-center items-center">
        <div class="relative overflow-x-auto w-full capitalize">
          <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-gray-700 uppercase">
              <tr class="bg-gray-100">
                <th scope="col" class="px-6 py-3">
                  Field
                </th>
                <th scope="col" class="px-6 py-3">
                  Value
                </th>
              </tr>
            </thead>
            <tbody>
              <tr class="bg-white border-b text-gray-700">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                  Merk
                </th>
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                  {{$data->merk}}
                </th>
              </tr>
              <tr class="bg-white border-b text-gray-700">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                  jumlah
                </th>
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                  {{$data->jumlah}}
                </th>
              </tr>
              <tr class="bg-white border-b text-gray-700">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                  tipe
                </th>
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                  {{$data->tipe}}
                </th>
              </tr>
              <tr class="bg-white border-b text-gray-700">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                  ukuran
                </th>
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                  {{$data->size}}
                </th>
              </tr>
              <tr class="bg-white text-gray-700">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                  category
                </th>
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                  {{$data->category}}
                </th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="flex items-center p-4 space-x-2 rounded-b border-t border-gray-200">
    <a href="{{route('wardrobe.edit', $data->id)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</a>
    <button data-id="{{$data->id}}" data-url="{{ route('wardrobe.destroy', $data->id) }}" data-modal-toggle="wardrobeModal" class="delete-btn text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">Delete</button>
  </div>