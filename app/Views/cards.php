<script>
    const cards = <?=json_encode(array_combine(array_column($cards, 'id'),array_values($cards)))?>;
    $(document).on("click", ".add-button", function () {
      $(".modal-body #card_id").val('');
      $('#staticBackdropLabel').html('Add Card');
      $('#addCard').modal('show');
    });
    $(document).on("click", ".edit-card", function () {
      var card_id = $(this).data('id');
      $(".modal-body #word").val(cards[card_id].word);
      $(".modal-body #definition").val(cards[card_id].definition);
      $(".modal-body #card_id").val(card_id);
      $('#staticBackdropLabel').html('Edit Card');
      $('#addCard').modal('show');
    });
</script>
<button type="button" class="btn btn-info add-button" data-bs-target="#addPack">New Card</button>

<div class="col-lg-6" style="margin: auto">
  <ul class="list-group ">
    <li class="list-group-item list-group-item-info">
      <h3 class="list-group-item-heading">Your Cards</h3>
    </li>
    <?php
      foreach($cards as $card){
        echo '<a href="#" class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-center edit-card" data-id="'.$card['id'].'">';
        echo $card['word'];
        echo '</a>';
      }
    ?>
  </ul>
</div>
<div class="modal fade" id="addCard" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/card/upsert" method="post">
      <input type="hidden" id="card_id" name="card_id">
      <input type="hidden" id="pack_id" name="pack_id" value="<?=$pack_id?>">
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
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>