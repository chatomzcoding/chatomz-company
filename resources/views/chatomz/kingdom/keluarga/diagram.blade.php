<x-singel-layout title="CHATOMZ - Diagram Keluarga {{ $keluarga->nama_keluarga}}" back="keluarga/{{ Crypt::encryptString($keluarga->id) }}">
    <x-slot name="head">
        <script src="{{ asset('js/familytree.js') }}"></script>
    </x-slot>
    <x-slot name="content">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header p-3">
                <x-sistem.kembali url="keluarga/{{ Crypt::encryptString($keluarga->id) }}"></x-sistem.kembali>
                  <strong class="float-end">Pohon Keluarga</strong> 
              </div>
              <div class="card-body">
                    <section>
                        <div style="width:100%; height:700px;" id="tree"/>
                    </section>
              </div>
            </div>
          </div>
        </div>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            var family = new FamilyTree(document.getElementById("tree"), {
                template: 'hugo',
                menu: {
                pdf: { text: "Export PDF" },
                png: { text: "Export PNG" }
                },
                nodeBinding: {
                    field_0: "name",
                    field_1: "gender",
                    img_0: "photo",
                },
                nodes: @json($pohonkeluarga) 
            });
            //JavaScript

// var family = new FamilyTree(document.getElementById('tree'), {
//     mouseScrool: FamilyTree.none,
//     mode: 'dark',
//     template: 'hugo',
//     roots: [3],
//     nodeMenu: {
//         edit: { text: 'Edit' },
//         details: { text: 'Details' },
//     },
//     nodeTreeMenu: true,
//     nodeBinding: {
//         field_0: 'name',
//         field_1: 'born',
//         img_0: 'photo'
//     },
//     editForm: {
//         titleBinding: "name",
//         photoBinding: "photo",
//         addMoreBtn: 'Add element',
//         addMore: 'Add more elements',
//         addMoreFieldName: 'Element name',
//         generateElementsFromFields: false,
//         elements: [
//             { type: 'textbox', label: 'Full Name', binding: 'name' },
//             { type: 'textbox', label: 'Email Address', binding: 'email' },
//             [
//                 { type: 'textbox', label: 'Phone', binding: 'phone' },
//                 { type: 'date', label: 'Date Of Birth', binding: 'born' }
//             ],
//             [
//                 { type: 'select', options: [{ value: 'bg', text: 'Bulgaria' }, { value: 'ru', text: 'Russia' }, { value: 'gr', text: 'Greece' }], label: 'Country', binding: 'country' },
//                 { type: 'textbox', label: 'City', binding: 'city' },
//             ],
//             { type: 'textbox', label: 'Photo Url', binding: 'photo', btn: 'Upload' },
//         ]
//     },
// });

// family.on('field', function (sender, args) {
//     if (args.name == 'born') {
//         var date = new Date(args.value);
//         args.value = date.toLocaleDateString();
//     }
// });


// family.load(
//     [
//         { id: 1, pids: [3], gender: 'male', photo: 'https://cdn.balkan.app/shared/m60/2.jpg', name: 'Zeph Daniels', born: '1954-09-29' },
//         { id: 2, pids: [3], gender: 'male', photo: 'https://cdn.balkan.app/shared/m60/1.jpg', name: 'Rowan Annable', born: '1952-10-10' },
//         { id: 3, pids: [1, 2], gender: 'female', photo: 'https://cdn.balkan.app/shared/w60/1.jpg', name: 'Laura Shepherd', born: '1943-01-13', email: 'laura.shepherd@gmail.com', phone: '+44 845 5752 547', city: 'Moscow', country: 'ru' },
//         { id: 4, pids: [5], photo: 'https://cdn.balkan.app/shared/m60/3.jpg', name: 'Rowan Annable' },
//         { id: 5, pids: [4], gender: 'female', photo: 'https://cdn.balkan.app/shared/w60/3.jpg', name: 'Lois Sowle' },
//         { id: 6, mid: 2, fid: 3, pids: [7], gender: 'female', photo: 'https://cdn.balkan.app/shared/w30/1.jpg', name: 'Tyler Heath', born: '1975-11-12' },
//         { id: 7, pids: [6], mid: 5, fid: 4, gender: 'male', photo: 'https://cdn.balkan.app/shared/m30/3.jpg', name: 'Samson Stokes', born: '1986-10-01' },
//         { id: 8, mid: 7, fid: 6, gender: 'female', photo: 'https://cdn.balkan.app/shared/w10/3.jpg', name: 'Celeste Castillo', born: '2021-02-01' }
//     ]
// );
        </script> 
    </x-slot>
</x-singel-layout>