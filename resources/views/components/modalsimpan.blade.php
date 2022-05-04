<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog {{ $size }}" role="document">
        <div class="modal-content">
            <form action="{{ url($link ?? '') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="modal-header p-2">
                <h5 class="modal-title">{{ $judul ?? 'Tambah Data' }}</h5>
                <button type="button" class="close rounded-pill"
                    data-bs-dismiss="modal" aria-label="Close"> <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body py-0">
                <section>
                   {{ $slot }}
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary btn-sm"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">TUTUP</span>
                </button>
                <button type="submit" class="btn btn-primary btn-sm ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><i class="bi bi-save"></i> SIMPAN</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

  <!--scrollbar Modal -->
  {{-- <div class="modal fade" id="tambah" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Scrolling
                  Modal</h5>
              <button type="button" class="close" data-bs-dismiss="modal"
                  aria-label="Close">
                  <i data-feather="x"></i>
              </button>
          </div>
          <div class="modal-body">
              <p>
                  Biscuit powder jelly beans. Lollipop candy canes croissant
                  icing
                  chocolate cake. Cake fruitcake
                  powder pudding pastry.
              </p>
              <p>
                  Tootsie roll oat cake I love bear claw I love caramels
                  caramels halvah
                  chocolate bar. Cotton
                  candy
                  gummi bears pudding pie apple pie cookie. Cheesecake jujubes
                  lemon drops
                  danish dessert I love
                  caramels powder.
              </p>
              <p>
                  Chocolate cake icing tiramisu liquorice toffee donut sweet
                  roll cake.
                  Cupcake dessert icing
                  dragée
                  dessert. Liquorice jujubes cake tart pie donut. Cotton candy
                  candy canes
                  lollipop liquorice
                  chocolate marzipan muffin pie liquorice.
              </p>
              <p>
                  Powder cookie jelly beans sugar plum ice cream. Candy canes
                  I love
                  powder sugar plum tiramisu.
                  Liquorice pudding chocolate cake cupcake topping biscuit.
                  Lemon drops
                  apple pie sesame snaps
                  tootsie
                  roll carrot cake soufflé halvah.
                  Biscuit powder jelly beans. Lollipop candy canes croissant
                  icing
                  chocolate cake. Cake fruitcake
                  powder pudding pastry.
              </p>
              <p>
                  Tootsie roll oat cake I love bear claw I love caramels
                  caramels halvah
                  chocolate bar. Cotton
                  candy
                  gummi bears pudding pie apple pie cookie. Cheesecake jujubes
                  lemon drops
                  danish dessert I love
                  caramels powder
              </p>
              <p>
                  Chocolate cake icing tiramisu liquorice toffee donut sweet
                  roll cake.
                  Cupcake dessert icing
                  dragée
                  dessert. Liquorice jujubes cake tart pie donut. Cotton candy
                  candy canes
                  lollipop liquorice
                  chocolate marzipan muffin pie liquorice.
              </p>
              <p>
                  Powder cookie jelly beans sugar plum ice cream. Candy canes
                  I love
                  powder sugar plum tiramisu.
                  Liquorice pudding chocolate cake cupcake topping biscuit.
                  Lemon drops
                  apple pie sesame snaps
                  tootsie
                  roll carrot cake soufflé halvah.
                  Biscuit powder jelly beans. Lollipop candy canes croissant
                  icing
                  chocolate cake. Cake fruitcake
                  powder pudding pastry.
              </p>
              <p>
                  Tootsie roll oat cake I love bear claw I love caramels
                  caramels halvah
                  chocolate bar. Cotton
                  candy
                  gummi bears pudding pie apple pie cookie. Cheesecake jujubes
                  lemon drops
                  danish dessert I love
                  caramels powder.
              </p>
              <p>
                  Chocolate cake icing tiramisu liquorice toffee donut sweet
                  roll cake.
                  Cupcake dessert icing
                  dragée
                  dessert. Liquorice jujubes cake tart pie donut. Cotton candy
                  candy canes
                  lollipop liquorice
                  chocolate marzipan muffin pie liquorice.
              </p>
              <p>
                  Powder cookie jelly beans sugar plum ice cream. Candy canes
                  I love
                  powder sugar plum tiramisu.
                  Liquorice pudding chocolate cake cupcake topping biscuit.
                  Lemon drops
                  apple pie sesame snaps
                  tootsie
                  roll carrot cake soufflé halvah.
                  Biscuit powder jelly beans. Lollipop candy canes croissant
                  icing
                  chocolate cake. Cake fruitcake
                  powder pudding pastry.
              </p>
              <p>
                  Tootsie roll oat cake I love bear claw I love caramels
                  caramels halvah
                  chocolate bar. Cotton
                  candy
                  gummi bears pudding pie apple pie cookie. Cheesecake jujubes
                  lemon drops
                  danish dessert I love
                  caramels powder.
              </p>
              <p>
                  Chocolate cake icing tiramisu liquorice toffee donut sweet
                  roll cake.
                  Cupcake dessert icing
                  dragée
                  dessert. Liquorice jujubes cake tart pie donut. Cotton candy
                  candy canes
                  lollipop liquorice
                  chocolate marzipan muffin pie liquorice.
              </p>
              <p>
                  Powder cookie jelly beans sugar plum ice cream. Candy canes
                  I love
                  powder sugar plum tiramisu.
                  Liquorice pudding chocolate cake cupcake topping biscuit.
                  Lemon drops
                  apple pie sesame snaps
                  tootsie
                  roll carrot cake soufflé halvah.
              </p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-light-secondary"
                  data-bs-dismiss="modal">
                  <i class="bx bx-x d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Close</span>
              </button>

              <button type="button" class="btn btn-primary ml-1"
                  data-bs-dismiss="modal">
                  <i class="bx bx-check d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Accept</span>
              </button>
          </div>
      </div>
  </div>
</div> --}}