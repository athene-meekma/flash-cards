<script>
  $(document).ready(function() {
    const packs = <?=json_encode(array_combine(array_column($packs, 'id'), array_values($packs)))?>;

    $(document).on("click", ".add, .edit", function (e) {
      e.preventDefault();

      let pack_id = $(this).data('id');
      let title = $(this).hasClass('add') ? 'Add Pack' : 'Edit Pack';

      $("#pack_id").val(pack_id);
      $('#editTitle').html(title);

      if(pack_id === undefined){
        $('#edit-form').get(0).reset();
      }else{
        $("#packName").val(packs[pack_id].name);
      }

      $('#editPack').modal('show');
    });

    $(document).on("click", ".delete", function (e) {
      e.preventDefault();

      let pack_id = $(this).data('id');

      $("#pack_id", $('#deletePack')).val(pack_id);
      $("#delete-pack").html(packs[pack_id].name);
      $('#deletePack').modal('show');
    });
  });
</script>

<div class="col-lg-6 list">
  <ul class="list-group ">
    <li class="list-group-item list-group-item-info">
      <h3 class="list-group-item-heading">
        Your Packs
        <button type="button" class="btn btn-sm btn-info add" data-bs-toggle="modal" data-bs-target="#editPack" style="float: right">
          <i class="fa-solid fa-plus"></i>
        </button>
      </h3>
    </li>
    <?php
      foreach($packs as $pack){
    ?>
        <a href="/pack/<?=$pack['id']?>" class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-center">
          <?= $pack['name'] ?>
          <span class="badge bg-info rounded-pill card-count"><?=$pack['cardCount']?></span>

          <div class="btn-group edit-buttons" role="group">
            <button type="button" class="btn btn-sm btn-info edit" data-id="<?=$pack['id']?>"><i class="fa-solid fa-pencil"></i></button>
            <button type="button" class="btn btn-sm btn-danger delete" data-id="<?=$pack['id']?>"><i class="fa-solid fa-trash"></i></button>
          </div>
      </a>
    <?php } ?>
  </ul>
</div>

<div class="modal fade" id="editPack" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTitle" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/pack/upsert" id="edit-form" method="post">
      <input type="hidden" id="pack_id" name="pack_id">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editTitle"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="packName" class="form-label">Pack Name</label>
            <input type="text" class="form-control" id="packName" name="packName" maxlength="255" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="deletePack" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/pack/delete" id="delete-form" method="post">
      <input type="hidden" id="pack_id" name="pack_id">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteLabel">Are you sure you want to delete this pack?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="delete-pack"></div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="submit" class="btn btn-info">Yes</button>
        </div>
      </div>
    </form>
  </div>
</div>