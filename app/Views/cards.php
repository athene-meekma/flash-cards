<script>
    const cards = <?=json_encode(array_combine(array_column($cards, 'id'), array_values($cards)))?>;

    function initModal(card_id, title){
    }

    $(document).on("click", ".add, .edit", function () {
      let card_id = $(this).data('id');
      let title = $(this).hasClass('add') ? 'Add Card' : 'Edit Card';

      $("#card_id").val(card_id);
      $('#staticBackdropLabel').html(title);

      if(card_id === undefined){
        $('#edit-form').get(0).reset();
      }else{
        $("#word").val(cards[card_id].word);
        $("#definition").val(cards[card_id].definition);
      }

      $('#editCard').modal('show');
    });

    $(document).on("click", ".delete", function () {
      let card_id = $(this).data('id');
      $("#card_id").val(card_id);
      $("#delete-word").html(cards[card_id].word);
      $('#deleteCard').modal('show');
    });
</script>
<button type="button" class="btn btn-info add" data-bs-target="#addPack">New Card</button>

<div class="col-lg-6" style="margin: auto">
  <ul class="list-group ">
    <li class="list-group-item list-group-item-info" style="word-wrap: break-word">
      <h3 class="list-group-item-heading"><?=$pack['name']?></h3>
    </li>
    <?php foreach($cards as $card){ ?>
        <a
          href="#"
          class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between card-item"
        >
          <span><?= $card['word'] ?></span>

          <div class="btn-group edit-buttons" role="group">
            <button type="button" class="btn btn-sm btn-info edit" data-id="<?=$card['id']?>"><i class="fa-solid fa-pencil"></i></button>
            <button type="button" class="btn btn-sm btn-danger delete" data-id="<?=$card['id']?>"><i class="fa-solid fa-trash"></i></button>
          </div>
        </a>
    <?php } ?>
  </ul>
</div>
<div class="modal fade" id="editCard" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/card/upsert" id="edit-form" method="post">
      <input type="hidden" id="card_id" name="card_id">
      <input type="hidden" id="pack_id" name="pack_id" value="<?=$pack['id']?>">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="word" class="form-label">Word</label>
            <input type="text" class="form-control" id="word" name="word" maxlength="255" required>
          </div>
          <div class="mb-3">
            <label for="definition" class="form-label">Definition</label>
            <input type="text" class="form-control" id="definition" name="definition" maxlength="255" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="deleteCard" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/card/delete" id="edit-form" method="post">
      <input type="hidden" id="card_id" name="card_id">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Are you sure you want to delete this card?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="delete-word"></div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="submit" class="btn btn-info">Yes</button>
        </div>
      </div>
    </form>
  </div>
</div>